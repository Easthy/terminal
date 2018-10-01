<div class="white-content">
	<div class="content-header-green">
		<div class="text-white-small-thick" style="line-height: 60px;"><?= $model['date'] ?></div>
        <div class="text-white-small-thin">Мероприятия учреждения</div>
        <div class="text-white-big-thick" style="line-height: 60px; margin-bottom: 20px;"><?= $model['company_name'] ?></div>
	</div>
	
	<?php foreach ($model['activities'] as $k => $activity): ?> 
		<div class="activity-container full-width" style="display:block; margin-top:20px; margin-bottom: 20px;">
			<div class="activity-date green valign" style="line-height:60px">
				<span class="text-white-small-thick"><?= $activity['start'] ?></span>
			</div>
			<div class="activity-type valign">
				<?php
					switch($activity['type']) {
						case 'sport':
							$img = '/img/icons/sport.png';
							break;
						case 'art':
							$img = '/img/icons/draw.png';
							break;
						case 'study':
							$img = '/img/icons/study.png';
							break;
					}
					echo '<img src="'.$img.'">';
				?>
			</div>
			<div class="activity-info valign" style="width: 550px;">
				<div>
					<img src="/img/icons/star.png" class="star">
					<img src="/img/icons/star.png" class="star">
					<img src="/img/icons/star.png" class="star">
					<img src="/img/icons/star.png" class="star">
					<img src="/img/icons/star.png" class="star no-star">
				</div>
				<span class="text-black-small"><?= $activity['name']; ?></span>
			</div>
		</div>
		<div class="horizontal-line"></div>
	<?php endforeach; ?>

	<div class="btn-container-big">
		<a href="/activity/cityevent" class="btn btn-white btn-big text-black-small">Закрыть фильтры</a>
	</div>
	
</div>

<script type="text/javascript">
	$(function() {
		$('.service-filter-item').click(function() {
			var id = $(this).data('id');
			if($('.service-filter-item[data-id='+id+'] .check-profile').hasClass('active')) {
				$('.service-filter-item[data-id='+id+'] .check-profile').removeClass('active');
			} else {
				$('.service-filter-item[data-id='+id+'] .check-profile').addClass('active');
			}
		});
	});
</script>