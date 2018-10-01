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
	// public function index() {
	// 	$this->layout = 'main';
		
	// 	$menu = [
	// 		['name' => 'Главная', 'href' => '/'], 
	// 		['name' => 'Календарь событий', 'href' => '/calendar'],
	// 		['name' => 'Детали события', 'href' => '#']
	// 	];
	// 	$this->set('menu', $menu);

	// 	$model = [
	// 		'name' => 'Наименование события длинное можно и в две строки',
	// 		'date' => '20 Июня, 18:00',
	// 		'type' => 'sport',
	// 		'photos' => [
	// 			'/img/tmp/activity_1.png', '', '', '', ''
	// 		],
	// 		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
 // 					<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.',
	// 	];

	// 	$this->set('model', $model);
	// }

	// public function nophoto()
	// {
	// 	$this->layout = 'main';
		
	// 	$menu = [
	// 		['name' => 'Главная', 'href' => '/'], 
	// 		['name' => 'Календарь событий', 'href' => '/calendar'],
	// 		['name' => 'Детали события', 'href' => '#']
	// 	];
	// 	$this->set('menu', $menu);

	// 	$model = [
	// 		'name' => 'Наименование события длинное можно и в две строки',
	// 		'date' => '20 Июня, 18:00',
	// 		'type' => 'sport',
	// 		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
 // 					<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.',
	// 	];

	// 	$this->set('model', $model);
	// 	$this->render('index');
	// }

	public function bycompany()
	{
		$this->layout = 'main';
		
		$menu = [
			['name' => 'Главная', 'href' => '/'],
			['name' => 'Мероприятия учреждения', 'href' => '#']
		];
		$this->set('menu', $menu);

		$this->loadModel('Activity');
		$activities = $this->Activity->get_data('get_activity_by_agency',array('agency_id'=>Configure::read('Terminal')['agency_id']),'format_activity_schedule');
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

	// public function period()
	// {
	// 	$this->layout = 'main';
		
	// 	$active_days = [
	// 		9 => [11,13,18,20]
	// 	];
	// 	$this->set('active_days', json_encode($active_days, JSON_PRETTY_PRINT));
	// 	$this->set('active_week_days', json_encode([2,4], JSON_PRETTY_PRINT));

	// 	$model = [
	// 		'name' => 'Обучение плаванию в  бассейне',
	// 		'date' => 'ВТ 18:00, ЧТ 20:00, 70 баллов<br>ул. Советская, д. 120, бассейн "Олимпик"',
	// 		'type' => 'sport',
	// 		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
 // 					<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.',
	// 	];

	// 	$this->set('model', $model);
	// }

	// public function confirm()
	// {
	// 	$this->layout = 'main';
	// 	// $menu = [['Главная'], ['Сведения об учреждении']];
	// 	// $this->set('menu', $menu);

	// 	$model = [
	// 		'name' => 'Обучение плаванию в  бассейне',
	// 		'schedule' => 'ВТ 18:00, ЧТ 20:00', 
	// 		'points' => 70,
	// 		'address' => 'ул. Советская, д. 120, бассейн "Олимпик"',
	// 		'type' => 'sport',
	// 		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
 // 					<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br><br>
 // 					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
	// 				<br>
	// 				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.',
	// 	];

	// 	$this->set('model', $model);
	// }

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
		$activities = $this->Activity->get_data('get_agency_coming_activity_by_date',$params,'format_activity_schedule');
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

	// public function companyevent()
	// {
	// 	$this->layout = 'main';
	// 	// $menu = [['Главная'], ['Сведения об учреждении']];
	// 	// $this->set('menu', $menu);

	// 	$model = [
	// 		'date' => '20 июня 2018',
	// 		'company_name' => 'Досуговый центр №1',
	// 		'activities' => [
	// 			[
	// 				'name' => 'Название события длинное если нужно то и в две строки',
	// 				'date' => '05',
	// 				'month' => 'ИЮЛЯ',
	// 				'type' => 'sport',
	// 				'start' => '14:00',
	// 				'company' => 'Досуговый центр №1',
	// 				'schedule' => ''
	// 			],
	// 			[
	// 				'name' => 'Название события длинное если нужно то и в две строки',
	// 				'date' => '08',
	// 				'month' => 'ИЮЛЯ',
	// 				'type' => 'art',
	// 				'start' => '14:00',
	// 				'company' => 'Досуговый центр №1',
	// 				'schedule' => ''
	// 			],
	// 			[
	// 				'name' => 'Название события длинное если нужно то и в две строки',
	// 				'date' => '12',
	// 				'month' => 'ИЮЛЯ',
	// 				'type' => 'study',
	// 				'start' => '10:00',
	// 				'company' => 'Досуговый центр №1',
	// 				'schedule' => [['day'=>'ПН', 'time' => '10:00'], ['day'=>'ВТ', 'time' => '12:00'], ['day'=>'СР', 'time' => '14:00']]
	// 			],
	// 			[
	// 				'name' => 'Название события длинное если нужно то и в две строки',
	// 				'date' => '05',
	// 				'month' => 'ИЮЛЯ',
	// 				'type' => 'sport',
	// 				'start' => '14:00',
	// 				'company' => 'Досуговый центр №1',
	// 				'schedule' => ''
	// 			],
	// 			[
	// 				'name' => 'Название события длинное если нужно то и в две строки',
	// 				'date' => '08',
	// 				'month' => 'ИЮЛЯ',
	// 				'type' => 'draw',
	// 				'start' => '14:00',
	// 				'company' => 'Досуговый центр №1',
	// 				'schedule' => ''
	// 			],
	// 			[
	// 				'name' => 'Название события длинное если нужно то и в две строки',
	// 				'date' => '12',
	// 				'month' => 'ИЮЛЯ',
	// 				'type' => 'study',
	// 				'start' => '10:00',
	// 				'company' => 'Досуговый центр №1',
	// 				'schedule' => [['day'=>'ПН', 'time' => '10:00'], ['day'=>'ВТ', 'time' => '12:00'], ['day'=>'СР', 'time' => '14:00']]
	// 			],			
	// 		]
	// 	];

	// 	$this->set('model', $model);
	// }

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
