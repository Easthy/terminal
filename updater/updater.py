import os
import requests
import json
import psycopg2
import subprocess
import logging
import signal
import hashlib

class Updater:
    DS = '/'
    dir_path = os.path.dirname(os.path.realpath(__file__))
    settings_file = 'settings.json'

    def __init__(self):
        settings_path = self.dir_path + self.DS + self.settings_file
        if not os.path.isfile(settings_path):
            raise Exception('Settings file must be placed at directory of updater!')

        with open( settings_path, 'r') as f:
            self.settings = json.loads(f.read())
            # Parsing settings and replace #infomat_id# by the value
            self.settings = json.loads(
                json.dumps(self.settings).replace('#infomat_id#',self.settings['infomat_id'])
            )
        f.close()

        if not os.path.isfile(self.settings["updater_sql_path"]):
            raise Exception('There is no table updater sql file')

        with open( self.settings["updater_sql_path"], 'r') as f:
            self.updater_sql = f.read()
        f.close()


    def db_connect(self):
        """ Connect to the PostgreSQL database server """
        conn = None
        try:
            # read connection parameters
            params = self.settings['infomat_db']
     
            # connect to the PostgreSQL server
            return psycopg2.connect(**params)
        except (Exception, psycopg2.DatabaseError) as error:
            print(error)
        finally:
            if conn is not None:
                conn.close()
                print('Database connection closed.')

    def auth(self):
        auth_url = self.settings['base_url'] + self.DS + self.settings['api_url'] + self.DS + self.settings['auth_service']
        auth_headers = self.get_query_headers()
        auth_data = json.dumps(self.settings['credentials'])
        auth_response = requests.post(auth_url, data=auth_data, headers=auth_headers)
        if auth_response.status_code != 200:
            raise Exception('Authentication failed!')
        auth_content = json.loads(auth_response.content.decode('utf-8'))
        self.session_token = auth_content['session_token']

    def run_shell_instructions(self):
        if not os.path.exists(self.dir_path + self.DS + self.settings['sh_folder']):
            os.mkdir(self.dir_path + self.DS + self.settings['sh_folder'])

        self.download_shell_script()
        self.execute_shell_script()

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
                sh_file_path = self.dir_path + self.DS + self.settings['sh_folder'] + self.DS + sh['sh_name'] + '#' + str(sh['id']) + '.sh'
                f = open(sh_file_path, "w")
                f.write( sh['sh_code'] )
                f.close()
                os.chmod(sh_file_path, 0o777)

    def execute_shell_script(self):
        """
        Executes files located at the directory "script" with extension ".sh" as shell scripts.
        After execution shell scripts will be deleted and marked as "executed" via "patch" request to dreamfactory service
        """
        for file in os.listdir(self.settings['sh_folder']):
            if file.endswith(".sh"):
                # shell script id parsing from the shell script name
                sh_id = os.path.splitext(file)[0].split('#')[1]
                sh_file_path = self.dir_path + self.DS + self.settings['sh_folder'] + self.DS + file
                # run shell script
                proc = subprocess.Popen(
                    [sh_file_path], 
                    cwd=self.settings['sh_folder'], shell=True
                )
                proc.wait()
                # os.kill(proc.pid, signal.SIGTERM)
                # remove shell script after execution
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
        response = requests.request(
            method, 
            query_url, 
            data=data,
            json=json_params, 
            headers=query_headers
        )
        if response.status_code != 200:
            raise Exception('Quering table "' +table+ '" failed!\n'+response.content.decode('utf-8'))
        return json.loads(response.content.decode('utf-8'))

    def get_query_headers(self):
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
        url = self.settings['base_url'] + \
              self.DS + \
              self.settings['api_url'] + \
              self.DS + \
              service + \
              self.DS + \
              '_table' + \
              self.DS + \
              table
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
        f = open(full_path, "wb")
        # f.write( json.dumps(data['resource'], ensure_ascii=False) )
        # f.write( json.dumps(data['resource'], separators=(',', ':')) )
        f.write( json.dumps(data['resource']).encode("unicode_escape") )
        # f.write( json.dumps(data['resource']).encode("unicode_escape").decode("utf-8") )
        f.close()

    def update_table(self,table):
        """
        Updates database with the query self.updater_sql from json files
        """
        full_path = self.settings['storage_base_path'] + self.DS + table + '.json'
        if not os.path.isfile(full_path):
            raise Exception('JSON updater file is not exists')

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
        os.makedirs(os.path.dirname(path), exist_ok=True)
        with open(path,'wb') as f:
            f.write(file)
            f.close()

    def download_files(self,table):
        full_path = self.settings['storage_base_path'] + self.DS + table + '.json'
        if not 'files' in self.settings["tables"][table]:
            print("No file path specified. Skipping")
            return
        if not os.path.exists(full_path):
            print("File cache does not exist. Skipping")
            return

        for file_path in self.settings["tables"][table]["files"]:
            table_data = self.open_file(full_path)
            files = [d[file_path] for d in table_data if d[file_path] is not None]
            if files:
                for file in files:
                    path = self.DS+self.settings['file_root_path']+self.DS+file
                    # print(path)
                    # print(os.path.exists(path))
                    # print(os.path.isfile(path))
                    if os.path.exists(path) and os.path.isfile(path):
                        print('File exists. Skipping')
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
    
