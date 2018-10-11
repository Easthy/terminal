<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<!-- Insert this line above script imports  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
	
	<script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
	
	<?php
		echo $this->Html->meta('icon');

		// echo $this->Html->css('cake.generic');
		echo $this->Html->css([
			'main',
			'fix.css'
		]);

		echo $this->Html->script([
			'jquery-3.3.1.min',
			'jquery.mobile-events-1.5.0-alpha',
			'base-functions'
		]);

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
	<script src="https://api-maps.yandex.ru/2.1/?lang=en_RU" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ru.js"></script>

	<!-- Insert this line after script imports -->
	<script>if (window.module) module = window.module;</script>
</head>
<body scroll="no">
	<div id="container">
		<div id="header">
			<div class="header-content">
				<span class="text-left">
					<span id="date"></span>
					<span id="clock"></span>
					
				</span>
				<span class="text-right" onClick="window.location.href='/home/webcam'" style="cursor:pointer;">
					23 C
					<?php //echo $this->getTemperature(); ?>
				</span>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php 
				if(isset($menu)) {
					if(count($menu) > 4) {
						$margin = 150 + (count($menu) - 5)*210;
						echo '<div id="top-menu" style="margin-left: -'.$margin.'px"><div class="menu-blur"></div>';	
					} else {
						echo '<div id="top-menu">';
					}

					foreach ($menu as $key => $menu_item) {
						if($key == (count($menu) - 1)) {
							$class = "menu-active";
						} else {
							$class = "menu-root";
						}

						echo '<a href="javascript:void(0)" class="open-page" data-href="'.$menu_item['href'].'"><div class="menu-item '.$class.'">
							<div class="dummy"></div><div class="valign">'.$menu_item['name'].'</div></div></a>';
					}

					echo '</div>';
				}
			?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<span>
				<?php echo CakeSession::read('Agency.shortname')?>
			</span>
		</div>
		<div class="clear"></div>
	</div>
</body>
</html>
