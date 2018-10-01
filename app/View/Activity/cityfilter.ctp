<div class="white-content">
	<div class="content-header-green">
		Фильтр мероприятий
	</div>
	

	<div class="service-filter-item" data-id="1">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/sport.png">
			</div>
			<div class="service-info filter valign">
				<span class="text-black-small">Физическая активность</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>

	<div class="service-filter-item"  data-id="2">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/origami_icon.png">
			</div>
			<div class="service-info filter valign" >
				<span class="text-black-small">Творчество</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item"  data-id="3">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/cooking_icon.png">
			</div>
			<div class="service-info filter valign" >
				<span class="text-black-small">Кулинария</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item"  data-id="4">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/dancing_icon.png">
			</div>
			<div class="service-info filter valign" >
				<span class="text-black-small">Танцы</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item"  data-id="5">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/singing_icon.png">
			</div>
			<div class="service-info filter valign" >
				<span class="text-black-small">Пение</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item"  data-id="6">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/draw.png">
			</div>
			<div class="service-info filter valign">
				<span class="text-black-small">Рисование</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item"  data-id="7">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/study.png">
			</div>
			<div class="service-info filter valign" >
				<span class="text-black-small">Образование</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item"  data-id="8">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/tenis_icon.png">
			</div>
			<div class="service-info filter valign" >
				<span class="text-black-small">Игры</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	<div class="btn-container">
		<a href="/activity/cityevent" class="btn btn-white btn-small text-black-small">Закрыть фильтры</a>
	</div>
	<div class="btn-container">
		<a href="/activity/cityevent" class="btn btn-green btn-small text-black-small">Показать результат</a>
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