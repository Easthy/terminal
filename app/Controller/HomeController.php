<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class HomeController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	public function index() {
		$this->layout = 'main';
		// $menu = [['Главная'], ['Сведения об учреждении']];
		// $this->set('menu', $menu);
		$agency_id = AppModel::get_agency_id();
		// debug($settings);
		$this->loadModel('Activity');
		$params = array(
			'agency_id' => $agency_id
		);
		$activities = $this->Activity->get_data('get_agency_coming_activity',$params,'format_activity_schedule');
		$this->set('activities', $activities);
	}

	public function get_screensaver(){
		$this->render('/Layouts/ajax', 'ajax');
		$agency_id = AppModel::get_agency_id();
		$settings = Configure::read('Terminal');
		$this->loadModel('ScreenSaver');
		$params = array(
			'agency_id' => $agency_id
		);
		$agency_screensaver = $this->ScreenSaver->get_data('get_active_screensaver',$params,'extract');
		$screensaver = DS.$settings['default_screensaver'];
		if ( !empty($agency_screensaver[0]['link_file']) && file_exists(WWW_ROOT.DS.$agency_screensaver[0]['link_file']) ){
			$screensaver = DS.$agency_screensaver[0]['link_file'];
		}
		echo json_encode(array('screensaver'=>$screensaver));
	}

	public function webcam(){
		$this->layout = 'main';	
	}

	public function save_video(){
		$this->render('/Layouts/ajax', 'ajax');

		$this->log($_FILES);
		AppModel::uploadFile('tmp/video/');
		debug( $this->request );
	}
}
