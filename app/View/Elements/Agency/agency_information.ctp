		
			<?php if(!empty($albums)):?>
				<div class="tab-item">
					<div class="tab-header">
						<span class="text-left tab-header-name">Фото</span>
					</div>
					<div class="albums">
						<table>
							<tr>
								<?php 
									foreach ($albums as $album ) {
										echo '<td><a href="javascript:void(0)" class="open-page" data-href="/gallery?photo_album_id='.$album[0]['photo_album_id'].'"><img src="/'.$album[0]['path'].'"></a></td>';
									}
								?>
							</tr>
							<tr>
								<?php 
									foreach ($albums as $album ) {
										echo '<td style="vertical-align: top;">'.$album[0]['album_name'].'</td>';
									}
								?>
							</tr>
							<tr>
								<?php 
									foreach ($albums as $album ) {
										echo '<td style="font-weight: 400;">'.$album[0]['photo_count'] . ' фото</td>';
									}
								?>
							</tr>
						</table>
					</div>
				</div>
			<?php endif;?>
			<?php if(!empty($agency['schedule'])):?>
				<div class="tab-item">
					<div class="tab-header">
						<span class="text-left tab-header-name">Режим работы</span>
						<?php if(!empty($agency['break'])):?>
							<span class="text-right">Обед с <?= $agency['break']['break_start'] ?> до <?= $agency['break']['break_end'] ?></span>
						<?php endif;?>
					</div>
					<div class="schedule">
						<table>
							<tr>
								<?php 
									foreach($agency['schedule'] as $day => $schedule) {
										echo '<td style="color:#5B76D0">'.$schedule['day'].'</td>';
									}
								?>
							</tr>
							<tr>
								<?php foreach($agency['schedule'] as $day => $schedule):?> 
									<td style="color:#666666; font-weight: 400;">
										<?php echo !empty($schedule['time_start']) 	? $schedule['time_start'] : '-'?><br>
										<?php echo !empty($schedule['time_end']) 	? $schedule['time_end']   : '-'?>
									</td>
								<?php endforeach;?>
							</tr>
						</table>
					</div>
				</div>
			<?php endif;?>
			<div class="tab-item">
				<div class="tab-header">
					<span class="text-left tab-header-name">Описание</span>
				</div>
				<p class="text-grey-small"><?= !empty($agency['description'])?$agency['description']:'' ?></p>
			</div>
		
