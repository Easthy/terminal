			<?php if(!empty($activities)):?>
				<?php foreach ($activities as $k => $activity): ?> 
					<div class="tab-item no-side-padding open-page" data-id="<?=$k?>" data-href="/activity/<?=$activity_action?>?activity_id=<?=$activity['id']?><?=!empty($this->request->query['ag_id'])?'&ag_id='.$this->request->query['ag_id']:''?>">

						<div class="activity-container">
							<div class="activity-date valign">
								<span class="text-white-small-thick"><?= $activity['date'] ?></span>
								<br>
								<span class="text-white-small-thin"><?= $activity['month'] ?></span>
							</div>
							<div class="activity-type valign">
								<?php if(!empty($activity['category_image'])):?>
									<img src="/<?=$activity['category_icon']?>">
								<?php endif;?>
							</div>
							<div class="activity-info valign" style="width: 550px;">
								<span class="text-black-small"><?= $activity['name']; ?></span>
								<br>
								<?php 
									if($activity['periodicity_id']==ONE_TIME_ACTIVITY_ID) {
										echo '<span class="text-blue-small-thick">Начало в '.$activity['start_time'].'</span>';
									} else {
										echo '<span class="text-blue-small-thick">Расписание:</span><br>';
										echo '<span class="text-blue-small-thin">';
										echo join(',',$activity['schedule']);
										echo '</span>';
									}	
								?>
								<?=!empty($activity['ag_shortname'])? '<br>'.$activity['ag_shortname'] : ''?>
							</div>
							<div class="profile-inner valign" style="width: 80px;">
								<div class="check-profile"></div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else:?>
				<div class="tab-item no-side-padding" data-id="-1">
					<div class="activity-container" style="text-align: center;">
						<div class="activity-info valign" style="width: 100%;">
							<span class="text-blue-small-thick">
								Мероприятия отсутствуют
							</span>
						</div>
					</div>
				</div>
			<?php endif;?>