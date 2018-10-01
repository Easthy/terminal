	<?php if( !empty(Configure::read('Terminal')['activity_appointment']) ):?>
		<div class="btn-container-big">
			<a href="/activity/period">
				<div class="btn-green btn-big">
					<div style="height:100px; width: 150px; text-align: center" class="valign">
						<div class="dummy"></div>
						<img src="/img/icons/icon_activity_appointment.png" style="width:35px; height:35px; margin-top: -10px;" class="valign">
					</div>	
					<div style="border-right: 1px solid white; width:1px; height: 80px;" class="valign"></div>
					<div style="height:100px; width: 650px; text-align: center" class="valign">
						<div class="dummy"></div>
						<span class="text-white-small-thick">Записаться на мероприятие</span>
					</div>	
				</div>
			</a>
		</div>
	<?php endif;?> 
