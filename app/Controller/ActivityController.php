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
class ActivityController extends AppController {

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

	public function bycompany()
	{
		$this->layout = 'main';
		
		$menu = [
			['name' => 'Главная', 'href' => '/'],
			['name' => 'Мероприятия учреждения', 'href' => '#']
		];
		$this->set('menu', $menu);

		$this->loadModel('Activity');
		$activities = $this->Activity->get_data(
			'get_activity_by_agency',
			array(
				'agency_id' => Configure::read('Terminal')['agency_id']
			),
			'format_activity_schedule'
		);
		$this->set('activity_action','info');
		$this->set('activities',$activities);
	}

	public function info()
	{
		$this->layout = 'main';
		
		$this->loadModel('Activity');
		$activity = $this->Activity->get_data('get_activity_by_id',array('activity_id'=>$this->request->query['activity_id']),'format_activity_schedule');
		$this->set('activity',$activity);

		$activity_photo = array();
		$photos = $this->Activity->get_data('get_photos_by_activity_id',array('activity_id'=>$this->request->query['activity_id']),'extract');
		$this->set('photos',$photos);

		$referer = !empty($this->request->query['referer']) ? $this->request->query['referer'] : 'default';
		$referer_menu = array(
			'default' => array(
				'name' => 'Мероприятия учреждения', 'href' => '/activity/bycompany'
			),
			'calendar' => array(
				'name' => 'Календарь событий', 'href' => '/calendar'
			)
		);

		$menu = [
			['name' => 'Главная', 'href' => '/'],
			$referer_menu[$referer],
			['name' => 'Информация о мероприятии', 'href' => 'javascript:void(0)']
		];
		$this->set('menu', $menu);

		$this->render('index');
	}


	public function long_life()
	{
		$this->layout = 'main';
		
		$menu = [
			['name' => 'Главная', 'href' => '/'], 
			['name' => 'Москва-город долголетия', 'href' => '#']
		];
		$this->set('menu', $menu);

		$month = AppModel::$month_dictionary[date('m')];
		$this->set('month',$month);
		$day = date('d');
		$this->set('day',$day);
		$year = date('Y');
		$this->set('year',$year);
		$this->set('date',date('d.m.Y'));
	}

	public function get_long_life_activity(){
        $this->render('/Layouts/ajax', 'ajax');

        $this->layout = false;
        $this->autoRender = false;
        $view = new View($this, false);

        $this->loadModel('Activity');
        $activities = $this->Activity->get_data('get_long_life_activity_by_date',array('start_date'=>$this->request->data['start_date']),'format_activity_schedule');
        $view->set( 'activities', $activities );
        $view->set('date',$this->request->data['start_date']);
        $view->set('activity_action','long_life_eventinfo');

        $answer['html'] = $view->element( '/Activity/activity_list_by_date' );
        echo json_encode( $answer );
	}


	public function get_agency_coming_activity_by_date(){
        $this->render('/Layouts/ajax', 'ajax');

        $this->layout = false;
        $this->autoRender = false;
        $view = new View($this, false);

		$settings = Configure::read('Terminal');
		// debug($settings);
		$this->loadModel('Activity');
		$params = array(
			'agency_id' => $settings['agency_id'],
			'start_date' => $this->request->data['start_date']
		);
		$activities = $this->Activity->get_data(
			'get_agency_coming_activity_by_date',
			$params,
			'format_activity_schedule'
		);
		$view->set('activities', $activities);
		$view->set('activity_action','info');
		$view->set('referer','calendar');
		// debug($params);

        $answer['html'] = $view->element( '/Activity/activity_list_by_date' );
        echo json_encode( $answer );
	}

	public function cityfilter()
	{
		$this->layout = 'main';
	}

	public function long_life_eventinfo()
	{
		$this->layout = 'main';

		$menu = [
			['name' => 'Главная', 'href' => '/'],
			['name' => 'Москва-город долголетия', 'href' => '/activity/long_life'],
			['name' => 'Информация о мероприятии', 'href' => '#']
		];
		$this->set('menu', $menu);

		$this->loadModel('Activity');
		$activity = $this->Activity->get_data('get_long_life_activity_by_id',array('activity_id'=>$this->request->query['activity_id']),'format_activity_schedule');
		$this->set('activity',$activity);
		// debug($activity);exit();

		$this->loadModel('Agency');
		$agency = $this->Agency->get_data('get_agency_information',array('agency_id'=>AppModel::toPgArray(array($activity[0]['agency_id']))),'extract');
		$this->Agency->format_timetables($agency);
		$this->set('agency',$agency);
		// debug($agency);

		$this->loadModel('Activity');
		$photos = $this->Activity->get_data('get_long_life_photos_by_activity_id',array('activity_id'=>$this->request->query['activity_id']),'extract');
		$this->set('photos',$photos);
	}

	public function cityevents()
	{
		$this->layout = 'main';

		$menu = [
			['name' => 'Главная', 'href' => '/'],
			['name' => 'Общегородские мероприятия', 'href' => '#']
		];

		$this->set('menu', $menu);


		$this->loadModel('CityActivity');
		$categories = $this->CityActivity->get_data('get_city_activity_category_list',array(),'extract');
		$this->set('categories',$categories);
	}

	public function cityevents_list()
	{
		$this->layout = 'main';


		$this->loadModel('Activity');
		$activities = $this->Activity->get_data('get_city_activity_list_by_category',array('category_id'=>$this->request->query['category_id']),'format_activity_schedule');

		$category = $this->Activity->get_data('get_city_activity_category_info',array('category_id'=>$this->request->query['category_id']),'extract');


		$menu = [
			['name' => 'Главная', 'href' => '/'],
			['name' => 'Общегородские мероприятия', 'href' => '/activity/cityevents'],
			['name' => $category[0]['name'], 'href' => 'javascript:void(0)'],
		];
		$this->set('menu', $menu);

		$this->set('category',$category);
        $this->set('activity_action','city_eventinfo');
		$this->set('activities',$activities);
	}

	public function city_eventinfo()
	{
		$this->layout = 'main';
		
		$this->loadModel('Activity');
		$activity = $this->Activity->get_data('get_city_activity_by_id',array('activity_id'=>$this->request->query['activity_id']),'format_activity_schedule');
		$this->set('activity',$activity);

		$activity_photo = array();
		$photos = $this->Activity->get_data('get_city_activity_photos_by_activity_id',array('activity_id'=>$this->request->query['activity_id']),'extract');
		$this->set('photos',$photos);

		$menu = [
			['name' => 'Главная', 'href' => '/'],
		];

		$referer = !empty($this->request->query['referer']) ? $this->request->query['referer'] : array('Общегородские мероприятия','Информация о мероприятии');
		$referer_link = !empty($this->request->query['referer_link']) ? $this->request->query['referer_link'] : array('/activity/cityevents','javascript:void(0)');
		$pos = 1;

		AppModel::prepareMenu($menu,$referer,$referer_link,$pos);
		$this->set('menu', $menu);

		$this->render('index');
	}

}
