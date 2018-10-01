		<?php if(!empty($activities)):?>	
			<?php foreach ($activities as $k => $activity): ?> 
				<div class="tab-item no-side-padding"  data-id="<?= $k ?>">
					<a class="open-page" href="javascript:void(0)" data-href="/activity/<?=$activity_action?>?activity_id=<?=$activity['id']?><?=!empty($referer)?'&referer='.$referer:''?>" >
						<div class="activity-container">
							<div class="activity-date green valign" style="line-height:60px">
								<span class="text-white-small-thick">
									<?= !empty($activity['start_time'])? $activity['start_time'] : '--' ?>
								</span>
							</div>
							<div class="activity-type valign">
								<?php if(!empty($activity['category_image'])):?>
									<img src="/<?=$activity['category_icon']?>">
								<?php endif;?>
							</div>
							<div class="activity-info valign" style="width: 550px;">
								<span class="text-blue-small-thick">
									<?= !empty($activity['shortname'])?$activity['shortname'].'<br>':'' ?>
								</span>
								<span class="text-black-small"><?= $activity['name']; ?></span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		<?php else:?>
			<div class="tab-item no-side-padding"  data-id="-1">
				<div class="activity-container" style="text-align: center;">
					<div class="activity-info valign" style="width: 100%;">
						<span class="text-blue-small-thick">
							Мероприятия отсутствуют
						</span>
					</div>
				</div>
			</div>
		<?php endif;?>