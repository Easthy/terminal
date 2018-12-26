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
		if(!$this->Session->check('Agency.shortname') || !empty($this->request->query['ag_id'])){
			$this->loadModel('Agency');
			if(!empty($this->request->query['ag_id'])){
				CakeSession::write('Agency.id', $this->request->query['ag_id']);
			}else{
				CakeSession::write('Agency.id', Configure::read('Terminal')['agency_id']);
			}
			$agency_id = array(AppModel::get_agency_id());
			$agency = $this->Agency->get_data('get_agency_information',array('agency_id'=>AppModel::toPgArray($agency_id)),'extract');
			if(empty($agency)){
				echo "Agency could not be found!
				Check settings file and database.";
				exit();
			}
			$this->Session->write('Agency',$agency[0]);
		}
		$this->loadModel('Weather');
		$current_temperature = $this->Weather->get_data('get_current_temperature',array(),'extract');
		$this->set('current_temperature',$current_temperature);
    }
}
