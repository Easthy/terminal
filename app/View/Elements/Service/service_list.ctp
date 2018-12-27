		
			<?php if(!empty($services)):?>
				<?php foreach ($services as $k => $service): ?>
					<?
						$link='/service/info?service_id='.$service['id'].(!empty($this->request->query['ag_id'])?'&ag_id='.$this->request->query['ag_id']:'');
						
						if(!empty($referer)) {
							foreach($referer as $key=> $r){
								$link .= '&referer[]='.$r.'&referer_link[]='.$referer_link[$key];
							}
						}
					?>
					<div 
						class="tab-item open-page" 
						data-id="<?= $service['id'] ?>" 
						data-href="<?=$link?>"
					>
						<div class="service-container">
							<div class="activity-date valign">
								<?php if(!empty($service['price_hour'])):?>
									<span class="text-white-small-thick">
										<?=$service['price_hour']?>
									</span>
									<br>
									<span class="text-white-small-thin">в час</span>
								<?php else:?>
									<span class="text-white-small-thick">
										<?=$service['price']?>
									</span>
									<br>
									<span class="text-white-small-thin">рублей</span>
								<?php endif;?>
							</div>
							<div class="service-type valign">
								<?php if(!empty($service['icon_image'])):?>
									<img src="/<?php echo $service['icon_image'] ?>">
								<?php endif;?>
							</div>
							<div class="service-info valign">
								<span class="text-black-small">
									<?=!empty($service['code']) ? $service['code'] : ''?>.
									<?= $service['name']; ?>
								</span>
							</div>
							<div class="profile-inner valign" style="width: 60px;">
								<div class="check-profile"></div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif;?>
