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
class ServiceController extends AppController {

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
			['name' => 'Услуги учреждения', 'href' => '#']
		];
		$this->set('menu', $menu);

		$this->loadModel('Service');
		$services = $this->Service->get_data('get_service_by_agency',array('agency_id'=>AppModel::get_agency_id()),'extract');

		$this->set('services', $services);
	}

	public function filter()
	{
		$this->loadModel('Service');
		$categories = $this->Service->get_data('get_service_category_list',array(),'extract');
		$this->set('categories', $categories);
		$this->layout = 'main';
	}

	public function info()
	{
		$this->layout = 'main';
		$menu = [
			['name' => 'Главная', 'href' => '/'], 
			['name' => 'Информация об услуге', 'href' => 'javascript:void(0)']
		];

		$referer = !empty($this->request->query['referer']) ? $this->request->query['referer'] : array('Услуги учреждения');
		$referer_link = !empty($this->request->query['referer_link']) ? $this->request->query['referer_link'] : array('/service');
		$pos = 1;

		AppModel::prepareMenu($menu,$referer,$referer_link,$pos);
		$this->set('menu', $menu);
		
		$this->loadModel('Service');
		$service = $this->Service->get_data('get_service_info',array('service_id'=>$this->request->query['service_id']),'extract');
		$this->set('service',$service);
		// debug($service);exit('!');
	}

	public function bycompany()
	{
		$this->layout = 'main';

		$menu = [
			['name' => 'Главная', 'href' => '/'],
			['name' => 'Справочник учреждений', 'href' => '/company/list'],
			['name' => 'ГБУ ТЦСО "Вешняки"', 'href' => '/company/info'],
			['name' => 'Услуги учреждения', 'href' => '/company/info'],
			['name' => 'Информация об услуге', 'href' => '#'],
		];
		$this->set('menu', $menu);

		$model = [
			'company_name' => 'ГБУ ТЦСО "Вешняки"',
			'name' => '0000. Наименование услуги длинное в две или три строки.',
			'price' => '50',
			'items' => [
				[
					'name' => 'Основная информация',
					'fields' => [
						'Стоимость:' => '100 руб. в час',
						'Форма предоставления:' => 'На дому',
						'Норма времени выполнения услуги:' => '30 мин',
						'Стоимость услуги:' => '100 руб',
						'Вес услуги:' => '-',
					]
				],
				[
					'name' => 'Условия предоставления',
					'fields' => [
						'Бесплатно' => '-',
						'Платно' => '100 руб.',
					]
				],
				[
					'name' => 'Ресурсы учреждения',
					'fields' => [
						'Финансовые' => '100 руб.',
						'Материальные' => 'Тара для доставки заказанных товаров',
						'Кадровые' => '1 социальный работник, бухгалтер, программист',
					]
				],
				[
					'name' => 'Основная информация',
					'fields' => [
						'Финансовые' => '100 руб.',
						'Материальные' => '-',
					]
				],
				[
					'name' => 'Регламент',
					'content_name' => 'Порядок выполнения:',
					'content' => '<p>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</p> 
						<p>2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</p> 
						<p>3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</p>					 
						<p>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</p>
						<p>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</p>'
				]
			]
		];

		$this->set('model', $model);	
		$this->render('info');
	}

	public function filtered()
	{
		$this->layout = 'main';
		
		$menu = [
			['name' => 'Главная', 'href' => '/'], 
			['name' => 'Услуги учреждения', 'href' => '#']
		];
		$this->set('menu', $menu);

		$model = [
			'activities' => [
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
			]
		];

		$this->set('model', $model);
		$this->set('filter', 'Экономические, Педагогические, Медицинские');
		$this->render('index');
	}

	public function searched()
	{
		$this->layout = 'main';
		
		$menu = [
			['name' => 'Главная', 'href' => '/'], 
			['name' => 'Услуги учреждения', 'href' => '#']
		];
		$this->set('menu', $menu);

		$model = [
			'activities' => [
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
				[
					'name' => '0000. Наименование услуги длинное в две или в три строки loem ipsum dolor set amet',
					'price' => '50',
					'type' => 'sport'
				],
			]
		];

		$this->set('model', $model);
		$this->set('search_string', 'ipsum dolor');
		$this->render('index');
	}
}
