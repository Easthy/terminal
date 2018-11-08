<div class="white-content menu-added">
	<div class="company-logo" style="background-image: url('/<?=!empty($service[0]['category_image'])?$service[0]['category_image']:''?>');">
		<div class="service-logo-layer text-centered">
			<?php if(isset($model['company_name'])): ?>
				<span class="text-white-small-thick">Услуги <?= $model['company_name'] ?></span>
				<br>
			<?php endif; ?>
			<span class="text-white-small-thin">Категория</span>
			<br>
			<p class="text-white-big-thick">
				<?php echo !empty($service[0]['category_name']) ? $service[0]['category_name'] : ''?>
			</p>
			<div>
				<hr class="line-long">
				<hr class="line-short">
			</div>
		</div>
	</div>
	<div class="sub-logo">
		<span class="text-black-big-thick">
			<?php echo !empty($service[0]['code']) ? $service[0]['code'] : ''?>.
			<?php echo !empty($service[0]['name']) ? $service[0]['name'] : ''?>
		</span>
		<br>
		<br>
		<span class="text-blue-small-thin">
			Стоимость: 
			<?= !empty($service[0]['price_hour']) ? $service[0]['price_hour'].'₽ в час' : '' ?>
			<?= empty($service[0]['price_hour'])&&!empty($service[0]['price']) ? $service[0]['price'].'₽' : '' ?>
		</span>
	</div>
	<div class="tab-container" style="max-height:700px;">
		<div class="tab">
			<div class="tab-item">
				<div class="tab-header">
					<span class="text-blue-small-thick">Основная информация</span>
				</div>
				<table class="service-table">
					<?php if(!empty($service[0]['price_hour'])):?>
						<tr>
							<td>
								<span class="text-grey-small">
									Стоимость:
								</span>
							</td>
							<td>
								<span class="text-black-small-thin">
									<?=!empty($service[0]['price_hour'])?$service[0]['price_hour'].'₽ в час':''?>
								</span>
							</td>
						</tr>
					<?php endif;?>
					<?php if(!empty($service[0]['service_location_type'])):?>
						<tr>
							<td>
								<span class="text-grey-small">
									Форма предоставления:
								</span>
							</td>
							<td>
								<span class="text-black-small-thin">
									<?=!empty($service[0]['service_location_type'])?$service[0]['service_location_type']:''?>
								</span>
							</td>
						</tr>
					<?php endif;?>
					<?php if(!empty($service[0]['time'])):?>
						<tr>
							<td>
								<span class="text-grey-small">
									Норма времени выполнения услуги:
								</span>
							</td>
							<td>
								<span class="text-black-small-thin">
									<?=!empty($service[0]['time'])?$service[0]['time'].' мин':''?>
								</span>
							</td>
						</tr>
					<?php endif;?>
					<?php if(!empty($service[0]['price'])):?>
						<tr>
							<td>
								<span class="text-grey-small">
									Стоимость услуги:
								</span>
							</td>
							<td>
								<span class="text-black-small-thin">
									<?=!empty($service[0]['price'])?$service[0]['price'].'₽':''?>
								</span>
							</td>
						</tr>
					<?php endif;?>
				</table>
			</div>
		</div>
		<?php if(!empty($service[0]['chargeable_type'])):?>
			<div class="tab">
				<div class="tab-item">
					<div class="tab-header">
						<span class="text-blue-small-thick">Условия предоставления</span>
					</div>
					<table class="service-table">
						<?php foreach(AppModel::json_decode_escaped($service[0]['chargeable_type'],true) as $key => $chargeable_type):?>
							<tr>
								<td>
									<span class="text-grey-small">
										<?=$chargeable_type?>
									</span>
								</td>
								<td>
									<span class="text-black-small-thin">
										<?
											$factor = AppModel::json_decode_escaped($service[0]['chargeable_type_factor'],true);
											$price = '-';
											if( mb_strtolower($chargeable_type) != 'бесплатно' ){
												$price = ($service[0]['price']*$factor[$key]).'₽';
											}
											echo $price;
										?>
									</span>
								</td>
							</tr>
						<?php endforeach;?>
					</table>
				</div>
			</div>
		<?php endif;?>
		<?php if(!empty($service[0]['agency_resources'])):?>
			<div class="tab">
				<div class="tab-item">
					<div class="tab-header">
						<span class="text-blue-small-thick">Ресурсы учреждения</span>
					</div>
					<?php foreach( AppModel::json_decode_escaped($service[0]['agency_resources'],true) as $key => $item):?>
						<div class="text-black-small-thin">
							<?=$key+1?>. <?=$item?>
						</div>
					<?php endforeach;?>
				</div>
			</div>
		<?php endif;?>
		<?php if(!empty($service[0]['client_resources'])):?>
			<div class="tab">
				<div class="tab-item">
					<div class="tab-header">
						<span class="text-blue-small-thick">Ресурсы клиента</span>
					</div>
					<?php foreach( AppModel::json_decode_escaped($service[0]['client_resources'],true) as $key => $item):?>
						<div class="text-black-small-thin">
							<?=$key+1?>. <?=$item?>
						</div>
					<?php endforeach;?>
				</div>
			</div>
		<?php endif;?>
		<?php if(!empty($service[0]['description'])):?>
			<div class="tab">
				<div class="tab-item">
					<div class="tab-header">
						<span class="text-blue-small-thick">Регламент</span>
					</div>
					<p class="text-grey-small">Порядок выполнения:</p>
					<?php foreach( AppModel::json_decode_escaped($service[0]['description'],true) as $key => $item):?>
						<div class="text-black-small-thin">
							<?=$key+1?>. <?=$item?>
						</div>
					<?php endforeach;?>
				</div>
			</div>
		<?php endif;?>
	</div>
	<?php if( !empty(Configure::read('Terminal')['service_appointment']) ):?>
		<div class="btn-container-big">
		<div class="btn-green btn-big">
			<div style="height:100px; width: 150px; text-align: center" class="valign">
				<div class="dummy"></div>
				<img src="/img/icons/icon_checklist.png" style="width:35px; height:35px; margin-top: -10px;" class="valign">
			</div>	
			<div style="border-right: 1px solid white; width:1px; height: 80px;" class="valign"></div>
			<div style="height:100px; width: 650px; text-align: center" class="valign">
				<div class="dummy"></div>
				<span class="text-white-small-thick">Заказать услугу</span>
			</div>	
		</div>
		</div>
	<?php endif;?>
</div>