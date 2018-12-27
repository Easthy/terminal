<div class="white-content">
	<div class="content-header-green">
		Ближайшие события
	</div>
	<div class="tab-container inner-padding" style="max-height: 462px;">
		<div class="tab" id="activities">
			<?php if(!empty($activities)):?>
				<?php foreach ($activities as $activity): ?> 
					<div class="tab-item no-side-padding">
						<div class="activity-container">
							<div class="activity-date valign">
								<span class="text-white-small-thick"><?= $activity['date'] ?></span>
								<br>
								<span class="text-white-small-thin"><?= $activity['month'] ?></span>
							</div>
							<div class="activity-type valign">
								<?php if(!empty($activity['category_icon'])):?>
									<img src="/<?=$activity['category_icon']?>">
								<?php endif;?>
							</div>
							<div class="activity-info valign">
								<span class="text-black-small"><?= $activity['name']; ?></span>
								<br>
								<br>
								<?php 
									if($activity['periodicity_id']==ONE_TIME_ACTIVITY_ID) {
										echo '<span class="text-blue-small-thick">Начало в '.$activity['start_time'].'</span>';
									} else {
										echo '<span class="text-blue-small-thick">Расписание:</span><br>';
										echo '<span class="text-blue-small-thin">';
										echo join(',',$activity['schedule']);

										echo '</span>';
									}	
								?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else:?>
					<div class="tab-item no-side-padding" style="text-align: center;">
						<div class="activity-container">
							<div class="activity-info valign">
								<span class="text-black-small">Мероприятия не запланированы</span>
							</div>
						</div>
					</div>
			<?php endif;?>
		</div>
	</div>

	<div class="btn-container-big">
		<a href="javascript:void(0)" class="open-page" data-href="/calendar">
			<div class="btn-green btn-big">
				<div style="height:100px; width: 150px; text-align: center" class="valign">
					<img src="/img/icons/calendar_button.png" style="width:100px; height:100px;">
				</div>	
				<div style="border-right: 1px solid white; width:1px; height: 80px;" class="valign"></div>
				<div style="height:100px; width: 650px; text-align: center" class="valign">
					<div class="dummy"></div>
					<span class="text-white-small-thick">Открыть календарь событий</span>
				</div>	
			</div>
		</a>
	</div>
</div>

<a href="javascript:void(0)" class="open-page" data-href="/about">
	<div style="width:400px; height: 150px; float:left; background-color: #ffffff; border-radius: 80px; margin:20px;">
		<div style="margin-top:55px; margin-left:60px; float: left;">
			<img src="/img/icons/book.png" style="width:40px; height:40px;">
		</div>	
		<div style="border-right: 1px solid #5B76D0; width:1px; float:left; margin-top:30px; margin-left:30px; height: 100px;"></div>
		<div style="float: left;">
			<div class="text-blue-small-thick text-centered text-open-sans" style="width: 200px; height: 150px;">О нас</div>
		</div>	
	</div>
</a>

<a href="javascript:void(0)" class="open-page" data-href="/company/list_">
	<div style="width:400px; height: 150px; float:left; background-color: #ffffff; border-radius: 80px; margin:20px;">
		<div style="margin-top:55px; margin-left:60px; float: left;">
			<img src="/img/icons/book.png" style="width:40px; height:40px;">
		</div>	
		<div style="border-right: 1px solid #5B76D0; width:1px; float:left; margin-top:30px; margin-left:30px; height: 100px;"></div>
		<div style="float: left;">
			<div class="text-blue-small-thick text-centered text-open-sans" style="width: 200px; height: 150px;">Справочник учреждений</div>
		</div>	
	</div>
</a>

<a href="javascript:void(0)" class="open-page"  data-href="/service">
	<div style="width:400px; height: 150px; float:left; background-color: #ffffff; border-radius: 80px; margin:20px;">
		<div style="margin-top:55px; margin-left:60px; float: left;">
			<img src="/img/icons/hand.png" style="width:40px; height:40px;">
		</div>	
		<div style="border-right: 1px solid #5B76D0; width:1px; float:left; margin-top:30px; margin-left:30px; height: 100px;"></div>
		<div style="float: left;">
			<div class="text-blue-small-thick text-centered text-open-sans" style="width: 200px; height: 150px;">Наши услуги</div>
		</div>	
	</div>
</a>

<a href="javascript:void(0)" class="open-page" data-href="/activity/bycompany">
	<div style="width:400px; height: 150px; float:left; background-color: #ffffff; border-radius: 80px; margin:20px;">
		<div style="margin-top:55px; margin-left:60px; float: left;">
			<img src="/img/icons/about_activity.png" style="width:40px; height:40px;">
		</div>	
		<div style="border-right: 1px solid #5B76D0; width:1px; float:left; margin-top:30px; margin-left:30px; height: 100px;"></div>
		<div style="float: left;">
			<div class="text-blue-small-thick text-centered text-open-sans" style="width: 200px; height: 150px;">Наши мероприятия</div>
		</div>	
	</div>
</a>

<a href="javascript:void(0)" class="open-page" data-href="/activity/long_life">
	<div style="width:400px; height: 150px; float:left; background-color: #ffffff; border-radius: 80px; margin:20px;">
		<div style="margin-top:45px; margin-left:60px; float: left;">
			<img src="/img/icons/kremlin.png" style="width:40px; height:60px;">
		</div>	
		<div style="border-right: 1px solid #5B76D0; width:1px; float:left; margin-top:30px; margin-left:30px; height: 100px;"></div>
		<div style="float: left;">
			<div class="text-blue-small-thick text-centered text-open-sans" style="width: 200px; height: 150px;">Москва-город долголетия</div>
		</div>	
	</div>
</a>

<a href="javascript:void(0)" class="open-page" data-href="/activity/cityevents">
	<div style="width:400px; height: 150px; float:left; background-color: #ffffff; border-radius: 80px; margin:20px;">
		<div style="margin-top:55px; margin-left:60px; float: left;">
			<img src="/img/icons/theater.png" style="width:40px; height:40px;">
		</div>	
		<div style="border-right: 1px solid #5B76D0; width:1px; float:left; margin-top:30px; margin-left:30px; height: 100px;"></div>
		<div style="float: left;">
			<div class="text-blue-small-thick text-centered text-open-sans" style="width: 200px; height:150px;">Общегородские мероприятия</div>
		</div>	
	</div>
</a>

<a href="javascript:void(0)" class="open-page" data-href="/about/department">
	<div style="width:400px; height: 150px; float:left; background-color: #ffffff; border-radius: 80px; margin:20px;">
		<div style="margin-top:55px; margin-left:60px; float: left;">
			<img src="/img/icons/lead.png" style="width:40px; height:40px;">
		</div>	
		<div style="border-right: 1px solid #5B76D0; width:1px; float:left; margin-top:30px; margin-left:30px; height: 100px;"></div>
		<div style="float: left;">
			<div class="text-blue-small-thick text-centered text-open-sans" style="width: 200px; height: 150px;">Руководство департамента</div>
		</div>	
	</div>
</a>

<a href="javascript:void(0)" class="open-page" data-href="https://emias.info/appointment/">
	<div style="width:400px; height: 150px; float:left; background-color: #ffffff; border-radius: 80px; margin:20px;">
		<div style="float: left; margin-left:100px;">
			<div class="text-blue-small-thick text-open-sans text-centered" style="width: 150px; height: 150px;">Запись к врачу</div>
		</div>	
		<div style="margin-top:55px; float: left;">
			<img src="/img/icons/arrow-right.png" style="width:40px; height:40px;">
		</div>	
	</div>
</a>
