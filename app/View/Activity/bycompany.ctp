<div class="white-content menu-added">
	<div class="company-logo" style="background-image: url('/img/tmp/activity_bycompany_logo.png');">
		<div class="service-logo-layer" style="background-color: rgba(153,51,51,0.2)">
			<div class="company-name-layer">
				<span class="company-name-layer-text">
					<?=!empty($page_header)?$page_header:'Мероприятия учреждения'?>
				</span>
				<div>
					<hr class="line-long-left">
					<hr class="line-short-left">
				</div>
				<div class="logo-footer">
					<div class="text-container">
					</div>
<!-- 					<div class="icons-container">
						<div class="logo-icon">
							<img src="/img/icons/logo_list_alt.png">
						</div>
						<div class="logo-icon">
							<img src="/img/icons/logo_filter.png">
						</div>
						<div class="logo-icon">
							<img src="/img/icons/logo_magnifier.png">
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	
	<div class="tab-container" style="max-height: 800px; margin-top:8px;">
		<div class="tab" id="activities">
			<?=$this->element('Activity/activity_list')?>
		</div>
	</div>

	<?=$this->element('activity_appointment')?>
</div>