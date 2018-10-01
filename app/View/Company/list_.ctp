<div class="white-content menu-added">
	<div class="company-logo" style="background-image: url('/img/tmp/company_logo_1.png');">
		<div class="company-logo-layer">
			<div class="company-name-layer">
				<span class="company-name-layer-text">Справочник учреждений</span>
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

	<?php if(!empty($agencies)):?>
		<div class="tab-container" style="max-height:910px;" >
			<div id="contacts">
				<?php foreach($agencies as $district => $district_agencies): ?>
					<div class="contact-name">
						<span class="text-white-small-thick"><?= !empty($district) ? $district : '' ?></span>
					</div>
					<?php foreach($district_agencies as $agency):?>
						<a href="javascript:void(0)" class="open-page" data-href="/company/info?agency_id=<?= $agency['id'] ?>">
							<div class="tab-item">
								<span class="text-black-small"><?= $agency['shortname'] ?></span>
								<br>
								<span class="text-blue-small-thick"><?= !empty($agency['address'])?$agency['address']:'' ?></span>
							</div>
						</a>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif;?>
</div>