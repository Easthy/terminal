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

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CompanyController extends AppController {

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
	public function list_() {
		$this->layout = 'main';
		
		$menu = [
			['name' => 'Главная', 'href' => '/'],
			['name' => 'Справочник учреждений', 'href' => '#']
		];
		$this->set('menu', $menu);

		$this->loadModel('Agency');
		$agencies = $this->Agency->get_data('get_agency_list',array(),'extract');
		$agencies = AppModel::groupArray($agencies,'district_fullname');
		$this->set('agencies', $agencies);
	}

	public function info()
	{
		$this->layout = 'main';

		$this->loadModel('Agency');
		$affiliate_id = $this->Agency->get_data('get_agency_affiliate',array('agency_id'=>$this->request->query['agency_id']));
		$affiliate_id = HASH::extract($affiliate_id,'{n}.{n}.id');
		$affiliates = $this->Agency->get_data('get_agency_information',array('agency_id'=>AppModel::toPgArray($affiliate_id)),'extract');
		$agency = $this->Agency->get_data('get_agency_information',array('agency_id'=>AppModel::toPgArray($this->request->query['agency_id'])),'extract')[0];
		$agency['logo'] = '/img/tmp/company_logo_1.png';
		array_unshift($affiliates, $agency);
		$this->Agency->format_timetables($affiliates);
		$this->Agency->format_timetable($agency);
		$this->set('affiliates',$affiliates);
		$this->set('agency',$agency);

		$this->loadModel('AgencyManagement');
		$management = $this->AgencyManagement->get_data('get_agency_management',array('agency_id'=>AppModel::toPgArray($affiliate_id)),'extract');
		$this->set('management',$management);

		$this->loadModel('AgencyPhotoAlbum');
		$albums = $this->AgencyPhotoAlbum->get_data('get_agency_photo_album',array('agency_id'=>AppModel::toPgArray(array($this->request->query['agency_id']))),'extract');
		$albums = AppModel::groupArray($albums,'photo_album_id');
		$this->set('albums',$albums);

		$this->loadModel('Service');
		$services = $this->Service->get_data('get_service_by_agency',array('agency_id'=>$this->request->query['agency_id']),'extract');
		$this->set('services', $services);

		$this->loadModel('Activity');
		$activities = $this->Activity->get_data('get_activity_by_agency',array('agency_id'=>$this->request->query['agency_id']),'format_activity_schedule');
		$this->set('activities',$activities);


		$menu = [
			['name' => 'Главная', 'href' => '/'],
			['name' => 'Справочник учреждений', 'href' => '/company/list_'],
			['name' => $agency['shortname'], 'href' => 'javascript:void(0)']
		];
		$this->set('menu', $menu);
        $this->set('activity_action','info');
		$this->set('referer',array('Справочник учреждений',htmlspecialchars($agency['shortname'])));
		$this->set('referer_link',array('/company/list_',htmlspecialchars('/company/info?agency_id='.$this->request->query['agency_id'])));
	}
}
