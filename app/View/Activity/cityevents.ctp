<div class="white-content menu-added">
	<div class="company-logo" style="background-image: url('/img/tmp/event.png');">
		<div class="company-logo-layer" style="background-color: rgba(102,51,153,0.3)">
			<div class="logo-content-layer text-centered">
				<span class="company-name-layer-text">Общегородские мероприятия</span>
				<div>
					<hr class="line-long">
					<hr class="line-short">
				</div>
			</div>
		</div>
	</div>
</div>

<table class="event-categories">
	<?php if(!empty($categories)):?>
		<?php for($i=0;$i<count($categories);$i):?>
			<tr>
				<td>
					<?php if(!empty($categories[$i])):?>
						<div class="white-content open-page" data-href="/activity/cityevents_list?category_id=<?=$categories[$i]['id']?>">
							<img src="/<?=$categories[$i]['icon_path']?>">
							<div class="text-centered">
								<span class="text-black-small"><?=$categories[$i]['name']?></span>
							</div>
						</div>
						<div class="bottom-line"></div>
					<?php endif;?>
				</td>
				<td>
					<?php if(!empty($categories[$i+1])):?>
						<div class="white-content open-page" data-href="/activity/cityevents_list?category_id=<?=$categories[$i+1]['id']?>">
							<img src="/<?=$categories[$i+1]['icon_path']?>">
							<div class="text-centered">
								<span class="text-black-small"><?=$categories[$i+1]['name']?></span>
							</div>
						</div>
						<div class="bottom-line"></div>
					<?php endif;?>
				</td>
			</tr>
			<?php $i=$i+2;?>
		<?php endfor;?>
	<?php endif;?>
</table>