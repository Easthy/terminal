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
class Agency extends AppModel {
    public $name = 'Agency';
    public $useTable='agency';

    protected $sql = array(
    	'get_agency_information'	=> 	array(
    		'sql'		=>	'get_agency_information.sql',
    		'params'	=>	array(
    		)
    	),
    	'get_agency_affiliate'	=> 	array(
    		'sql'		=>	'get_agency_affiliate.sql',
    		'params'	=>	array(
    		)
    	),
        'get_agency_list'  =>  array(
            'sql'       =>  'get_agency_list.sql',
            'params'    =>  array(
            )
        )
    );

    public function format_timetables(&$affiliates){
    	for ($i=0; $i < count($affiliates); $i++) {
            $this->format_timetable($affiliates[$i]);
    	}
    }

    public function format_timetable(&$agency){
        if( empty($agency['timetable']) ){
            return false;
        }
        $timetable = AppModel::json_decode_escaped($agency['timetable'],true);
        $wds = array_keys($this->week_dictionary);
        foreach ($wds as $wd) {
            if ( !empty($timetable[$wd]) ){
                $st = '';
                if(!empty($timetable[$wd.'start'])) {
                    $ste = explode(':', $timetable[$wd.'start']);
                    $st = join(':',array($ste[0],$ste[1]));
                }
                $et = '';
                if(!empty($timetable[$wd.'end'])) {
                    $ete = explode(':', $timetable[$wd.'end']);
                    $et = join(':',array($ete[0],$ete[1]));
                }
                $schedule = array();
                $schedule['day'] = $this->week_dictionary[$wd];
                $schedule['time_start'] = $st;
                $schedule['time_end'] = $et;
                if(!empty($timetable[$wd.'bs'])&&!empty($timetable[$wd.'be'])){
                    $schedule['breakstart'] = $timetable[$wd.'bs'];
                    $schedule['breakend'] = $timetable[$wd.'be'];
                }
                $agency['schedule'][$wd] = $schedule;
            }else{
                $agency['schedule'][$wd] = array(
                    'day' => $this->week_dictionary[$wd]
                );
            }
        }
        if ( !empty($timetable['break_start']) && !empty($timetable['break_end']) ){
            $agency['break'] = array(
                'break_start'   => $timetable['break_start'],
                'break_end'     => $timetable['break_end']
            );
        }
        return $agency['schedule'];
    }
}
