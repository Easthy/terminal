<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('AppModel', 'Model');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public function beforeFilter() {
		if(!$this->Session->check('Agency.shortname')){
			$this->loadModel('Agency');
			$agency_id = array(Configure::read('Terminal')['agency_id']);
			$agency = $this->Agency->get_data('get_agency_information',array('agency_id'=>AppModel::toPgArray($agency_id)),'extract');
			$this->Session->write('Agency',$agency[0]);
		}
		// $current_date = AppModel::get_current_date_time();
		// $this->set('current_date',$current_date);
    }

	public function getTemperature() {
		return '23 C';
	}
}
