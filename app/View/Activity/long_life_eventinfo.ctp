<div class="white-content menu-added">
	<?php 
		if(!empty($activity_photo)) {
			$logo = $activity_photo[0]['path'];
		} else {
			$logo = !empty($activity[0]['category_image'])?$activity[0]['category_image']:'';
		}
	?>
	<div class="company-logo" style="background-image: url('/<?=$logo?>');">
			<div class="logo-content-layer text-centered">
				<?php if(!empty($category_name)):?>
					<span class="text-white-small-thin">Категория</span>
					<br>
					<span class="text-white-big-thick">
						<?=$category_name?>
					</span>
					<hr class="line-long">
					<hr class="line-short">
				<?php endif;?>
			</div>
	</div>
	<div class="sub-logo">
		<span class="text-black-big-thick">
			<?= !empty($activity[0]['name']) ? $activity[0]['name'] : '' ?>
		</span>
		<br>
		<span class="text-blue-small-thick">
			<?= !empty($activity[0]['date']) ? $activity[0]['date'] : '' ?>
			<?= !empty($activity[0]['month']) ? $activity[0]['month'] : '' ?>
			<?= !empty($activity[0]['year']) ? $activity[0]['year'] : '' ?><?= !empty($activity[0]['start_time']) ? ', '.$activity[0]['start_time'] : '' ?>
		</span>
		<br>
		<span class="text-blue-small-thick">
			<?= !empty($agency[0]['shortname']) ? $agency[0]['shortname'] : '' ?><?= !empty($agency[0]['address']) ? ', '.$agency[0]['address'] : '' ?>
		</span>
	</div>
	<div class="submenu">
		<div class="menu-item active" data-id="1"><span>Описание мероприятия</span></div>
		<div class="menu-item" data-id="2"><span>Расписание</span></div>
		<div class="menu-item" data-id="3"><span>Об учреждении</span></div>
		<div class="arrow-container"><div class="arrow-box"></div></div>
	</div>
	
	<div class="tab-container" style="max-height: 700px">

		<div id="about-tab" class="tab" data-id="1">
			<!-- Фотографии -->
			<?=$this->element('Activity/photos')?>

			<?php if(!empty($activity[0]['description'])):?>
				<div class="tab-item">
					<div class="tab-header">
						<span class="text-left tab-header-name">Описание</span>
					</div>
					<p class="text-grey-small">
						<?= $activity[0]['description'] ?>
					</p>
				</div>
			<?php endif;?>
		</div>

		<div id="activities" class="tab" data-id="2" style="display: none;">
			<?=$this->element('Activity/activity_schedule_list')?>
		</div>

		<div class="tab" data-id="3" style="display:none"?>
			<!-- Основные сведения об учреждении -->
			<?=$this->element('Agency/agency_information',array('agency'=>$agency[0]))?>
		</div>
	</div>
		
	</div>
</div>
