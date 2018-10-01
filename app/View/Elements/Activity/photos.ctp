			<?php if(!empty($photos)):?>
				<div class="tab-item">
					<div class="tab-header">
						<span class="text-left tab-header-name">Фото</span>
					</div>
					<div class="albums">
						<table>
							<tr>
								<?php 
									foreach ($photos as $photo ) {
										echo '<td><a href="javascript:void(0)"><img src="/'.$photo['path'].'"></a></td>';
									}
								?>
							</tr>
							<tr>
								<?php 
									foreach ($photos as $photo ) {
										echo '<td style="vertical-align: top;">';
										if(mb_strwidth($photo['description'])>20){
											echo mb_substr($photo['description'], 0, 20).'...';
										}else{
											echo $photo['description'];
										}
										echo '</td>';
									}
								?>
							</tr>
						</table>
					</div>
				</div>
			<?php endif;?>