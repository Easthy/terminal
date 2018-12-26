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
class AboutController extends AppController {

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
		
		$menu = [
			['name' => 'Главная', 'href' => '/'], 
			['name' => 'Сведения об учреждении', 'href' => '#']
		];
		$this->set('menu', $menu);

		$this->loadModel('Agency');
		$affiliate_id = $this->Agency->get_data('get_agency_affiliate',array('agency_id'=>AppModel::get_agency_id()));
		$affiliate_id = HASH::extract($affiliate_id,'{n}.{n}.id');
		$affiliates = $this->Agency->get_data('get_agency_information',array('agency_id'=>AppModel::toPgArray($affiliate_id)),'extract');
		$agency_id = AppModel::get_agency_id();
		$agency = $this->Agency->get_data('get_agency_information',array('agency_id'=>AppModel::toPgArray($agency_id)),'extract')[0];
		$agency['logo'] = '/img/tmp/company_logo_1.png';
		array_unshift($affiliates, $agency);
		// $this->Agency->format_timetables($affiliates);
		$this->Agency->format_timetable($agency);
		$this->set('affiliates',$affiliates);
		$this->set('agency',$agency);

		$this->loadModel('AgencyManagement');
		$management = $this->AgencyManagement->get_data('get_agency_management',array('agency_id'=>AppModel::toPgArray($affiliate_id)),'extract');
		$this->set('management',$management);

		$this->loadModel('AgencyPhotoAlbum');
		$albums = $this->AgencyPhotoAlbum->get_data('get_agency_photo_album',array('agency_id'=>AppModel::toPgArray(array(AppModel::get_agency_id()))),'extract');
		$albums = AppModel::groupArray($albums,'photo_album_id');
		$this->set('albums',$albums);

		$this->set('info', false);
	}

	public function department() {
		$this->layout = 'main';
		
		$menu = [
			['name' => 'Главная', 'href' => '/'], 
			['name' => 'Руководство департамента', 'href' => '#']
		];
		$this->set('menu', $menu);

		$this->loadModel('DepartmentManagement');
		$management = $this->DepartmentManagement->get_data('get_department_management',array(),'extract');
		$this->set('management',$management);

		$agency = array();
		$agency['id'] = null;
		$agency['shortname'] = 'Департамент труда и соц защиты населения Москвы';
		$agency['logo'] = '/img/tmp/company_logo_1.png';
		$agency['address'] = 'г. Москва, ул. Новая Басманная, д. 10, стр. 1 ';
		$agency['phone'] = '+7 (495) 623-10-20 ';
		$this->set('agency',$agency);

		$this->set('info', false);
	}
}
