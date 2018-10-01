<div class="white-content menu-added">
	<!-- Основные сведения об учреждении -->
	<?=$this->element('Agency/agency_information_header')?>

	<div class="submenu">
		<div class="menu-item active" data-id="1"><span>Об учреждении</span></div>
		<div class="menu-item" data-id="2"><span>Руководство</span></div>
		<div class="menu-item" data-id="5"><span>Контакты</span></div>
		<div class="arrow-container"><div class="arrow-box"></div></div>
	</div>
	<div class="tab-container" >
		<div id="about-tab" class="tab" data-id="1" style="max-height:910px;">
			<!-- Основные сведения об учреждении -->
			<?=$this->element('Agency/agency_information')?>
		</div> 

		<!-- Руководство учреждения -->
		<?=$this->element('Agency/agency_management')?>

		<!-- Контактные сведения учреждения -->
		<?=$this->element('Agency/agency_contact_information')?>
	</div>

	<?php if( !empty(Configure::read('Terminal')['agency_management_appointment']) ):?>
		<div class="btn-container-big tab" data-id="2" style="display: none;">
			<div>
				<div class="btn-green btn-big">
					<div style="height:100px; width: 150px; text-align: center" class="valign">
						<div class="dummy"></div>
						<img src="/img/icons/icon_activity_appointment.png" style="width:35px; height:35px; margin-top: -10px;" class="valign">
					</div>	
					<div style="border-right: 1px solid white; width:1px; height: 80px;" class="valign"></div>
					<div style="height:100px; width: 650px; text-align: center" class="valign">
						<div class="dummy"></div>
						<span class="text-white-small-thick">Записаться на прием</span>
					</div>	
				</div>
			</div>
		</div>
	<?php endif;?>
</div>