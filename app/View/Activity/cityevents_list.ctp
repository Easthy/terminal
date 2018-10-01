<div class="white-content menu-added">
	<div class="company-logo" style="background-image: url(/<?=!empty($category[0]['image_path'])?$category[0]['image_path']:''?>);">
		<div class="service-logo-layer" style="background-color: rgba(153,51,51,0.2)">
			<div class="company-name-layer">
				<span class="company-name-layer-text">
					<?=!empty($category[0]['name'])?$category[0]['name']:'Общегородские мероприятия'?>
				</span>
				<div>
					<hr class="line-long-left">
					<hr class="line-short-left">
				</div>
				<div class="logo-footer">
					<div class="text-container">
					</div>
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