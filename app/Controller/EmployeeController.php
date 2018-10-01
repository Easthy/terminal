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
class EmployeeController extends AppController {

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
	public function appointment() {
		$this->layout = 'main';
		// $menu = [['Главная'], ['Сведения об учреждении']];
		// $this->set('menu', $menu);

		$model = [
			'profile' => [
				'photo' => '/img/tmp/position_1.png',
				'first_name' => 'Ирина',
				'last_name' => 'Мурынина',
				'parent_name' => 'Викторовна',
				'phone' => '+7 495 375-87-97',
				'position' => 'Директор'
			],
			'schedule' => [
				['10:00', '11:00', '16:00'],
				['11:00', '12:00'],
				['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00'],
				['10:00', '11:00', '16:00'],
				['08:00', '11:00'],
				['10:00', '11:00', '16:00'],
			]
		];

		$this->set('model', $model);
	}

	public function confirm() {
		$this->layout = 'main';

		$model = [
			'first_name' => 'Ирина',
			'last_name' => 'Мурынина',
			'parent_name' => 'Викторовна',
			'position' => 'Директор',
			'schedule' => 'Среда, 11 Июля,  9:00',
			'address' => 'ул. Реутовская, д 6 а',
			'photo' => '/img/tmp/position_1.png',
		];

		$this->set('model', $model);
	}
}