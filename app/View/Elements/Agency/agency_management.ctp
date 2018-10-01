		<?php if(!empty($management)):?>
			<div id="profiles" class="tab" style="display: <?=empty($display)?'none':$display?>; max-height:740px;" data-id="2">
				<?php foreach ($management as $key => $profile): ?> 
					<div class="tab-item" data-id="<?= $key ?>">
						
						<div class="profile-inner valign" style="width: 164px;">
							<?php if(!empty( $profile['path'] )):?>
								<img src="<?= $profile['path'] ?>">
							<?php endif;?>
						</div>
						
						<div class="profile-inner valign" style="width: 630px; height:198px; position:relative;">
							<span class="name"><?= mb_strtoupper($profile['surname']) ?></span>
							<br>
							<span class="name"><?= $profile['firstname'] . ' ' . $profile['fathername'] ?></span>
							<br>
							<span class="position"><?= $profile['post'] ?></span>
							<br>
							<?php if(!empty($profile['phone'])):?>
								<span class="phone">Тел.: <?= $profile['phone'] ?></span>
							<?php endif;?>
						</div>
						<div class="profile-inner valign" style="width: 60px;">
							<div class="check-profile"></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif;?>