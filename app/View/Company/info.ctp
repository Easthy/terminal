<div class="white-content menu-added">
	<!-- Основные сведения об учреждении -->
	<?=$this->element('Agency/agency_information_header')?>

	<div class="submenu">
		<div class="menu-item active info" data-id="1"><span>Об учреждении</span></div>
		<div class="menu-item info" data-id="2"><span>Руководство</span></div>
		<div class="menu-item info" data-id="3"><span>Услуги</span></div>
		<div class="menu-item info" data-id="4"><span>Мероприятия</span></div>
		<div class="menu-item info" data-id="5"><span>Контакты</span></div>
		<div class="arrow-container"><div class="arrow-box info"></div></div>
	</div>
	<div class="tab-container" style="max-height:910px;" >
		<div id="about-tab" class="tab" data-id="1" style="max-height:910px;">
			<!-- Основные сведения об учреждении -->
			<?=$this->element('Agency/agency_information')?>
		</div>

		<!-- Руководство учреждения -->
		<?=$this->element('Agency/agency_management')?>

		<!-- Список услуг -->
		<div id="service" class="tab" data-id="3" style="display: none;">
			<?=$this->element('Service/service_list')?>
		</div>

		<!-- Список мероприятий -->
		<div id="activities" class="tab" data-id="4" style="display: none;">
			<?=$this->element('Activity/activity_list')?>
		</div>

		<!-- Контактные сведения учреждения -->
		<?=$this->element('Agency/agency_contact_information')?>
	</div>
</div>