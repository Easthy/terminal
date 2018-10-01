<?php if(!empty($schedule)):?>
	<?php foreach ($schedule as $k => $activity): ?> 
		<div class="tab-item no-side-padding"  data-id="<?= $k ?>">
			<div class="activity-container">
				<div class="activity-date valign">
					<span class="text-white-small-thick"><?= $activity['date'] ?></span>
					<br>
					<span class="text-white-small-thin"><?= $activity['month'] ?></span>
				</div>
				<div class="activity-info valign" style="width: 550px;">
					<span class="text-black-small"><?= $activity['start_time'] ?></span>
					<?php if(!empty($activity['free'])):?>
						<br>
						<span class="text-black-small">Свободно мест <?= $activity['free'] ?></span>
					<?php endif;?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif;?>