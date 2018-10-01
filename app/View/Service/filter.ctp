<div class="white-content">
	<div class="content-header-green">
		Фильтр услуг
	</div>
	

	<div class="service-filter-item" style="height:100px;" data-id="1">
		<div class="service-container valign">
			<div class="service-type valign">
				<img src="/img/icons/domestic_icon.png">
			</div>
			<div class="service-info valign" style="width: 650px;">
				<span class="text-black-small">Бытовые услуги</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>

	<div class="service-filter-item" style="height:100px;" data-id="2">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/economic_icon.png">
			</div>
			<div class="service-info valign" style="width: 650px;" >
				<span class="text-black-small">Экономические услуги</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item" style="height:100px;" data-id="3">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/law_icon.png">
			</div>
			<div class="service-info valign" style="width: 650px;" >
				<span class="text-black-small">Юридические услуги</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item" style="height:100px;" data-id="4">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/study.png">
			</div>
			<div class="service-info valign" style="width: 650px;" >
				<span class="text-black-small">Педагогические услуги</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item" style="height:100px;" data-id="5">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/medical_icon.png">
			</div>
			<div class="service-info valign" style="width: 650px;" >
				<span class="text-black-small">Медицинские услуги</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item" style="height:100px;" data-id="6">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/culture_icon.png">
			</div>
			<div class="service-info valign" style="width: 650px;" >
				<span class="text-black-small">Культурные услуги</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="service-filter-item" style="height:100px;" data-id="7">
		<div class="service-container">
			<div class="service-type valign">
				<img src="/img/icons/psychological_icon.png">
			</div>
			<div class="service-info valign" style="width: 650px;" >
				<span class="text-black-small">Психологические услуги</span>
			</div>
			<div class="profile-inner valign" style="width: 80px;">
				<div class="check-profile"></div>
			</div>
		</div>
	</div>

	<div class="horizontal-line"></div>
	
	<div class="btn-container">
		<a href="/service">
			<div class="btn btn-white btn-small text-black-small">Закрыть фильтры</div>
		</a>
	</div>
	<div class="btn-container">
		<a href="/service/filtered">
			<div class="btn btn-green btn-small text-black-small">Показать результат</div>
		</a>
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