<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    public $base_path = APP.'SQL'.DS;
    public static $month_dictionary = array(
    	'01' => 'Января',
    	'02' => 'Февраля',
    	'03' => 'Марта',
    	'04' => 'Апреля',
    	'05' => 'Мая',
    	'06' => 'Июня',
    	'07' => 'Июля',
    	'08' => 'Августа',
    	'09' => 'Сентября',
    	'10' => 'Октября',
    	'11' => 'Ноября',
    	'12' => 'Декабря'
    );
    public $week_dictionary = array(
    	'mon' => 'Пн',
    	'tue' => 'Вт',
    	'wed' => 'Ср',
    	'thu' => 'Чт',
    	'fri' => 'Пт',
    	'sat' => 'Сб',
    	'sun' => 'Вс'
    );

    public function get_data($query_method, array $params=array(), $process_method=false){
    	$params_ = array_merge(
    		$params, 
    		$this->sql[$query_method]['params']
    	);
    	$data = $this->query_from_file(
    		$this->sql[$query_method]['sql'],
    		$params_
    	);
    	if ( $process_method ){
    		$data = $this->{$process_method}($data);
    	}
    	return $data;
    }

	public function query_from_file($sql_file,$params) {
		$sql_file_path = $this->base_path.($this->name).DS.$sql_file;
		$sql_file = fopen($sql_file_path, "r") or die("Unable to open sql-file!");
		$sql = fread($sql_file,filesize($sql_file_path));
		return $this->query($sql,$params);
	}

	public static function get_current_date_time(){
		return date('d').' '.self::$month_dictionary[date('m')].' '.date('H:i');
	}

	public function extract(&$data){
		return HASH::extract($data,'{n}.{n}');
	}

    
    // Преобразование PHP-массива в POSTEGRES-массив
    public static function toPgArray($set) {
        settype($set, 'array'); // can be called with a scalar or array
        $result = array();
        foreach ($set as $t) {
            if (is_array($t)) {
                $result[] = AppModel::toPgArray($t);
            } else {
                $t = str_replace('"', '\\"', $t); // escape double quote
                if (! is_numeric($t)) // quote only non-numeric values
                    $t = '"' . $t . '"';
                $result[] = $t;
            }
        }
        return '{' . implode(",", $result) . '}'; // format
    }
    
    // Преобразование в PHP-массив из POSTEGRES-массива
    public static function fromPgArray($s,$start=0,&$end=NULL) {
        if (empty($s) || $s[0]!='{') return NULL;
        $return = array();
        $br = 0;
        $string = false;
        $quote='';
        $len = strlen($s);
        $v = '';
        for($i=$start+1; $i<$len;$i++){
            $ch = $s[$i];

            if (!$string && $ch=='}'){
                if ($v!=='' || !empty($return)){
                    $return[] = $v;
                }
                $end = $i;
                break;
            }else
            if (!$string && $ch=='{'){
                $v = pg_array_parse($s,$i,$i);
            }else
            if (!$string && $ch==','){
                $return[] = $v;
                $v = '';
            }else
            if (!$string && ($ch=='"' || $ch=="'")){
                $string = TRUE;
                $quote = $ch;
            }else
            if ($string && $ch==$quote && $s[$i-1]=="\\"){
                $v = substr($v,0,-1).$ch;
            }else
            if ($string && $ch==$quote && $s[$i-1]!="\\"){
                $string = FALSE;
            }else{
                $v .= $ch;
            }
        }
        return $return;
    }

    /*
    Группировка многомерного массива по значению поля $field
    TODO - предусмотреть отсутствие $data[$field]
    */
    public static function groupArray( $arr, $field ){
        $result = array();
        if ( !empty($arr) ){
            foreach ($arr as $data) {
                if (!array_key_exists($field, $data)){
                    continue;
                }
                $value = $data[$field];
                $result[$value][] = $data;
            }
        }
        return $result;
    }

    public static function arrayInsert(&$array, $position, $insert)
    {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos   = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos),
                $insert,
                array_slice($array, $pos)
            );
        }
    }


    public static function prepareMenu(&$menu, $referer, $referer_link, $pos=0){
        if ( !empty($referer) ){
            $pos = 1;
            foreach ($referer as $key => $name) {
                $a = array(array( 'name'=>$name, 'href' => $referer_link[$key] ));
                AppModel::arrayInsert($menu, $pos+$key, $a, $pos );
            }
        }
    }

    /*
    Загрузка файла на сервер
    */
    public static function uploadFile( $db_file )
    {
        $new_name = false;
        // debug($db_file);
        foreach ($_FILES AS $field => $file){
            $file_path = WWW_ROOT.$db_file;
            if (!$file['error'] && $file['size']){
                if (!file_exists($file_path)) {
                    mkdir($file_path, 0777, true);
                }
                if (isset($file_path)){
                    $new_name = CakeText::uuid();
                    $ext = '.'.pathinfo( $file['name'], PATHINFO_EXTENSION ); // расширение файла
                    $new_name = "$new_name".$ext;
                    $f = file_get_contents($file['tmp_name']);
                    $path = $file_path.$new_name;
                    if ( !file_exists( $file_path ) ){
                        mkdir( $file_path, 0777, true );
                    }
                    if (file_put_contents($path, $f))
                        $result[$field] = $path;
                    else
                        throw new Exception("Файл {$file['name']} не был корректно сохранен");
                }
                else
                    throw new Exception ("Не найден путь для файла {$file['name']}");
            }
            else
                throw new Exception("Файл {$file['name']} не был корректно загружен из формы");
        }
        return $new_name;
    }
}