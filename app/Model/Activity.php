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
class Activity extends AppModel {
    public $name = 'Activity';
    public $useTable='activity';
    public $one_time_activity = 1;

    protected $sql = array(
    	'get_agency_coming_activity'	=> 	array(
    		'sql'		=>	'get_agency_coming_activity.sql',
    		'params'	=>	array(
    			'interval'	=> '14 DAYS',
                'limit'     => '20'
    		)
    	),
        'get_agency_coming_activity_by_date'    =>  array(
            'sql'       =>  'get_agency_coming_activity_by_date.sql',
            'params'    =>  array(
                'limit'     => '50'
            )
        ),
        'get_activity_by_agency'   =>  array(
            'sql'       =>  'get_activity_by_agency.sql',
            'params'    =>  array(
                'limit'     => '50'
            )
        ),
        'get_shared_activity'   =>  array(
            'sql'       =>  'get_shared_activity.sql',
            'params'    =>  array(
                'limit'     => '50'
            )
        ),
        'get_activity_by_id'   =>  array(
            'sql'       =>  'get_activity_by_id.sql',
            'params'    =>  array(
            )
        ),
        'get_long_life_activity_by_date'   =>  array(
            'sql'       =>  'get_long_life_activity_by_date.sql',
            'params'    =>  array(
            )
        ),
        'get_long_life_activity_by_id' => array(
            'sql'       =>  'get_long_life_activity_by_id.sql',
            'params'    =>  array(
            )
        ),
        'get_photos_by_activity_id' => array(
            'sql'       =>  'get_photos_by_activity_id.sql',
            'params'    =>  array(
            )
        ),
        'get_long_life_photos_by_activity_id' => array(
            'sql'       =>  'get_long_life_photos_by_activity_id.sql',
            'params'    =>  array(
            )
        ),
        'get_city_activity_list_by_category' => array(
            'sql'       =>  'get_city_activity_list_by_category.sql',
            'params'    =>  array(
            )
        ),
        'get_city_activity_category_info' => array(
            'sql'       =>  'get_city_activity_category_info.sql',
            'params'    =>  array(
            )
        ),
        'get_city_activity_by_id' => array(
            'sql'       =>  'get_city_activity_by_id.sql',
            'params'    =>  array(
            )
        ),
        'get_city_activity_photos_by_activity_id' => array(
            'sql'       =>  'get_city_activity_photos_by_activity_id.sql',
            'params'    =>  array(
            )
        )
    );

    public function format_activity_schedule(&$data){
        $data = HASH::extract($data,'{n}.{n}');
        $month_dictionairy = self::$month_dictionary;
        $week_dictionary = $this->week_dictionary;
        $one_time_activity = $this->one_time_activity;
        $data = array_map(function($a) use ($month_dictionairy,$week_dictionary,$one_time_activity) {
            $a['month'] = !empty($month_dictionairy[$a['month']]) ? $month_dictionairy[$a['month']] : $a['month'];
            $activity_schedule = AppModel::json_decode_escaped($a['activity_schedule'],true);
            $a['schedule'] = array();
            if ($a['periodicity_id'] != $one_time_activity){
                foreach( $activity_schedule as $day){
                    $a['schedule'][] = $week_dictionary[$day['date']].' '.$day['start_time'];
                }
                $a['start_date'] = date_format(date_create($a['start_date']),'d.m.Y');
            }else{
                $a['start_date'] = date_format(date_create($activity_schedule[0]['date']),'d.m.Y');
                $a['start_time'] = $activity_schedule[0]['start_time'];
            }
            return $a;
        }, $data);

        return $data;
    }
}
