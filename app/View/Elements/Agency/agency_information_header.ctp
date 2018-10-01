	<div class="company-logo" style="background-image: url('<?= !empty($agency['logo'])?$agency['logo']:''; ?>');">
		<div class="company-logo-layer">
			<div class="company-name-layer">
				<span class="company-name-layer-text">
					<?= !empty($agency['shortname'])?mb_substr($agency['shortname'],0,63):'' ?>
				</span>
				<div>
					<hr class="line-long-left">
					<hr class="line-short-left">
				</div>
				<div class="logo-footer">
					<div class="text-container">
						<?php if( !empty($agency) && CakeSession::read('Agency.id') == $agency['id'] ):?>
							<span class="text-white-small-thick">Вы находитесь здесь!</span>
						<?php else:?>
							<?php if(!empty($agency['address'])):?>
								<span class="text-white-small-thick"><?= $agency['address'] ?></span><br>
							<?php endif;?>
							<?php if(!empty($agency['phone'])):?>
								<span class="text-white-small-thin"><?= $agency['phone'] ?></span>
							<?php endif;?>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>