import os
import requests
import json
import psycopg2
import subprocess
import logging
import signal
import hashlib
import atexit

class UpdaterError(Exception):
    def __init__(self, message):
        super().__init__(message)
        up = Updater()
        up.errors.append(message)
        up.slack_notificate()

class Updater:
    """DB updater class"""
    DS = '/'
    dir_path = os.path.dirname(os.path.realpath(__file__))
    settings_file = 'settings.json'
    errors = []

    def __init__(self):
        atexit.register(self.on_exit)
        settings_path = self.dir_path + self.DS + self.settings_file
        if not os.path.isfile(settings_path):
            error = 'Settings file must be placed at directory of updater!'
            self.errors.append(error)
            raise Exception(error)

        with open( settings_path, 'r') as f:
            self.settings = json.loads(f.read())
            # Parsing settings and replace #infomat_id# by the value
            self.settings = json.loads(
                json.dumps(self.settings).replace('#infomat_id#',self.settings['infomat_id'])
            )
        f.close()

        if not os.path.isfile(self.settings["updater_sql_path"]):
            error = 'There is no table updater sql file'
            self.errors.append(error)
            raise Exception(error)

        with open( self.settings["updater_sql_path"], 'r') as f:
            self.updater_sql = f.read()
        f.close()

    def on_exit(self):
        """Action called after script ends"""
        self.slack_notificate()

    def slack_notificate(self):
        """Send update notification"""
        header = 'Infomat ID '+self.settings['infomat_id']
        message = 'Success'
        color = 'good'
        if self.errors:
            color = 'warning'
            message = "\n".join(self.errors)

        response = requests.post(
            self.settings["slack_webhook_url"], data=json.dumps({'text': header, "attachments": [{"color": color, "text": message}]}),
            headers={'Content-Type': 'application/json'}
        )

    def db_connect(self):
        """ Connect to the PostgreSQL database server """
        conn = None
        try:
            # read connection parameters
            params = self.settings['infomat_db']
            # connect to the PostgreSQL server
            return psycopg2.connect(**params)
        except (Exception, psycopg2.DatabaseError) as error:
            self.errors.append(str(error))
            raise Exception(str(error))
        finally:
            if conn is not None:
                conn.close()

    def auth(self):
        auth_url = self.settings['base_url'] + self.DS + self.settings['api_url'] + self.DS + self.settings['auth_service']
        auth_headers = self.get_query_headers()
        auth_data = json.dumps(self.settings['credentials'])
        try:
            auth_response = requests.post(auth_url, data=auth_data, headers=auth_headers)
        except (Exception) as error:
            self.errors.append(str(error))
            raise Exception(str(error))

        if auth_response.status_code != 200:
            error = 'Dreamfactory authentication failed!'
            self.errors.append(error)
            raise Exception(error)
        auth_content = json.loads(auth_response.content.decode('utf-8'))
        self.session_token = auth_content['session_token']

    def run_shell_instructions(self):
        if not os.path.exists( self.DS.join([self.dir_path, self.settings['sh_folder']]) ):
            os.mkdir( self.DS.join([self.dir_path, self.settings['sh_folder']]) )
        try:
            self.download_shell_script()
            self.execute_shell_script()
        except (Exception) as error:
            self.errors.append(str(error))
            raise Exception(str(error))

    def download_shell_script(self):
        """
        Downloads shell scripts via dreamfactory service and store it in the script directory pointed by setting.json
        """
        shell_scripts = self.query_service(
            self.settings["sh_table"],
            self.settings["sh_service"],
            self.settings["sh_query_params"]
        )
        if shell_scripts['resource']:
            for sh in shell_scripts['resource']:
                sh_file_path = self.DS.join([self.dir_path,self.settings['sh_folder'],sh['sh_name']]) + '#' + str(sh['id']) + '.sh'
                f = open(sh_file_path, "w")
                f.write( sh['sh_code'] )
                f.close()
                os.chmod(sh_file_path, 0o777)

    def execute_shell_script(self):
        """
        Executes files located at the directory "script" with extension ".sh" as shell scripts.
        After execution shell scripts will be deleted and marked as "executed" via "patch" request to dreamfactory service
        """
        for file in os.listdir( self.DS.join([self.dir_path, self.settings['sh_folder']]) ):
            if file.endswith(".sh"):
                # shell script id parsing from the shell script name
                sh_id = os.path.splitext(file)[0].split('#')[1]
                sh_file_path = self.DS.join( [self.dir_path, self.settings['sh_folder'], file] )
                # run shell script
                proc = subprocess.Popen(
                    [sh_file_path], 
                    cwd=self.settings['sh_folder'], shell=True
                )
                proc.wait()
                os.remove(sh_file_path)
                # mark shell script executed
                self.query_service(
                    self.settings['sh_table'],
                    self.settings["sh_service"],
                    None,
                    None,
                    {"resource": [{ "id": str(sh_id), "executed": 1}]},
                    'PATCH'
                )

    def query_service(self,table,service,params,data=None,json_params=None,method='GET'):
        """
        Forming url, headers and data to send, then sends request to dreamfactory service
        """
        query_url = self.get_query_url(table,service,params)
        query_headers = self.get_query_headers()

        try:
            response = requests.request(
                method, 
                query_url, 
                data=data,
                json=json_params, 
                headers=query_headers
            )
        except (Exception) as error:
            self.errors.append(str(error))
            raise Exception(str(error))

        if response.status_code != 200:
            error = 'Dreamfactory quering table "' +table+ '" failed!\n'+response.content.decode('utf-8')
            self.errors.append(error)
            raise Exception(error)
        return json.loads(response.content.decode('utf-8'))

    def get_query_headers(self):
        """Forming http query headers"""
        headers = {
            'Accept': 'application/json', 
            'Accept-Encoding': 'gzip, deflate',
            'Connection': 'keep-alive',
            'X-Dreamfactory-API-Key': self.settings['api_key'],
            'User-Agent': self.settings['user_agent'],
            'Content-Type': 'application/json;charset=UTF-8',
            'Accept-Language': 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
        }
        if hasattr(self, 'session_token') and self.session_token:
            headers['X-DreamFactory-Session-Token'] = self.session_token
        return headers

    def get_query_url(self,table,service,params):
        """
        Forming query url
        """
        url = self.DS.join( [self.settings['base_url'], self.settings['api_url'], service, '_table', table] )
        query = self.get_query_params(params)
        return '?'.join([url,query])

    def get_query_params(self,params):
        """
        Forming GET-method parameters
        """
        query = []
        if params:
            for param,value in params.items():
                query.append( param+'='+value )
        return '&'.join(query)

    def save_json(self,data,table):
        """
        Saves json files to update database
        """
        full_path = self.settings['storage_base_path'] + self.DS + table + '.json'
        if not os.path.exists(self.settings['storage_base_path']):
            os.mkdir(self.settings['storage_base_path'])
        try:
            f = open(full_path, "wb")
            f.write(json.dumps(data['resource']).encode("unicode_escape"))
            f.close()
        except(Exception) as e:
            error = str(e)
            self.errors.append(error)
            raise Exception(error)

    def update_table(self,table):
        """
        Updates database with the query self.updater_sql from json files
        """
        full_path = self.settings['storage_base_path'] + self.DS + table + '.json'
        if not os.path.isfile(full_path):
            error = 'JSON updater file is not exists'
            self.errors.append(error)
            raise Exception(error)

        sql = self.updater_sql.format(
            updater_json_file = full_path,
            table = table
        )

        cursor = self.db_connect().cursor()
        cursor.execute(sql)
        cursor.close()

    def get_table_list(self):
        """
        Returns list of tables to fetch data from
        """
        return self.settings['tables']

    def open_file(self,path):
        with open(path,"r", encoding="unicode_escape") as f:
            data = f.read()
            return json.loads(data)

    def save_file(self,path,file):
        """Save file"""
        if(len(file)>0):
            os.makedirs(os.path.dirname(path), exist_ok=True)
            with open(path,'wb') as f:
                f.write(file)
                f.close()

    def download_files(self,table):
        """Download images by path in columns, specified in settings"""
        full_path = self.settings['storage_base_path'] + self.DS + table + '.json'
        if not 'files' in self.settings["tables"][table]:
            logging.info("No file path for table "+table+" specified. Skipping")
            return
        if not os.path.exists(full_path):
            error = "File cache for table "+table+" does not exist. Skipping"
            self.errors.append(error)
            return

        for file_path in self.settings["tables"][table]["files"]:
            table_data = self.open_file(full_path)
            files = [d[file_path] for d in table_data if d[file_path] is not None]
            if files:
                for file in files:
                    path = self.DS+self.settings['file_root_path']+self.DS+file
                    if os.path.exists(path) and os.path.isfile(path):
                        logging.info('File exists. Skipping')
                        continue
                    f = requests.get(self.settings['file_url']+self.DS+file).content
                    self.save_file(path,f)



up = Updater()
up.auth()
up.run_shell_instructions()
tables = up.get_table_list()

# Fill file_cache
for table,params in tables.items():
    response = up.query_service(table,params['service'],params["query_params"])
    up.save_json(response,table)

# Download files
for table,params in tables.items():
    up.download_files(table)

# Update tables
for table,params in tables.items():
    up.update_table(table)
