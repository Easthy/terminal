<div class="white-content menu-added">
	<?php 
		if(!empty($photos)) {
			$logo = $photos[0]['path'];
		} else {
			$logo = !empty($activity[0]['category_image'])?$activity[0]['category_image']:'';
		}
	?>
	<div class="company-logo slider-viewport" style="background-image: url('/<?=$logo?>');">
		<?php if(empty($photos)): ?>
			<div class="logo-content-layer text-centered">
				<span class="text-white-small-thin">Категория</span>
				<br>
				<span class="text-white-big-thick"><?= !empty($activity[0]['category_name'])?$activity[0]['category_name']:'' ?></span>
				<hr class="line-long">
				<hr class="line-short">
			</div>
		<?php endif; ?>
	</div>
	<?php if(!empty($photos)): ?>
		<div class="images-preview">
			<div class="arrow-container"><div class="arrow-box"></div></div>
			<table>
				<tr>
					<?php 
						foreach ($photos as $k => $photo ) {
							if($k == 0) {
								echo '<td class="active"><img src="/'.$photo['path'].'" alt="Image '.$k.'"></td>';
							} else {
								echo '<td><img src="/'.$photo['path'].'" alt="Image '.$k.'"></td>';
							}
						}
					?>
				</tr>
			</table>
		</div>
		<div class="horizontal-line"></div>
	<?php endif; ?>

	<div class="sub-logo">
		<span class="text-black-big-thick"><?= !empty($activity[0]['name'])?$activity[0]['name']:'' ?></span>
		<br>
		<br>
		<span class="text-blue-small-thick">
			<?= !empty($activity[0]['schedule']) 	? join(', ',$activity[0]['schedule']).'<br>' 	: ''?>
			<?= !empty($activity[0]['address'])		? $activity[0]['address']				: '' ?>
		</span>
	</div>

	<div class="tab-container" style="max-height: <?= isset($model['photos']) ? 600 : 700 ?>px;">
		<div class="tab">
			<div class="tab-item text-grey-small">
				<?= !empty($activity[0]['description'])		? $activity[0]['description']				: '' ?>
			</div>
		</div>
	</div>

	<?=$this->element('activity_appointment')?>
</div>

<style type="text/css">
.arrow-container {
	height: 12px;
}
.arrow-box {
	position: relative;
	left: 76px;
    width: 20px;
    height: 15px;
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
    border-bottom: 15px solid lightgrey;
    clear: both;
}

.images-preview {
	padding-top: 16px;
	padding-bottom: 16px;
}

.images-preview td {
	background-color: #f2f2f2;
	vertical-align: middle;
	text-align: center;
}

.images-preview img {
	display: inline-block;
}

</style>