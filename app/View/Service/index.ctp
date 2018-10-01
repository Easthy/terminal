<div class="white-content menu-added">
	<div class="company-logo" style="background-image: url('/img/tmp/service_logo.png');">
		<div class="service-logo-layer" style="background-color: rgba(153,51,51,0.3);">
			<div class="company-name-layer">
				<span class="company-name-layer-text">Услуги учреждения</span>
				<div>
					<hr class="line-long-left">
					<hr class="line-short-left">
				</div>
				<?php if(isset($filter)): ?>
					<span class="text-white-small-thick">Фильтр:</span>
					<div class="text-white-small-thin" style="width: 400px;">
						<?= $filter ?>
					</div>
				<?php endif; ?>
				<?php if(isset($search_string)): ?>
					<span class="text-white-small-thick">Результат поиска для:</span>
					<div class="text-white-small-thin" style="width: 400px;">
						<?= $search_string ?>
					</div>
					<?php foreach ($model['activities'] as &$activity) {
						$temp = explode($search_string, $activity['name']);
						$activity['name'] = $temp[0].'<span class="text-green-small-thick">'.$search_string.'</span>'.$temp[1];
					} ?>
				<?php endif; ?>
				<div class="logo-footer">
					<div class="text-container">
					</div>
<!-- 					<div class="icons-container">
						<div class="logo-icon">
							<a href="/service/filter">
								<img src="/img/icons/logo_filter.png">
							</a>
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
		<div class="tab" id="service">
			<?=$this->element('Service/service_list')?>
		</div>
	</div>

	<?=$this->element('service_appointment')?>
</div>