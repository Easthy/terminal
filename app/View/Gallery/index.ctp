<div class="white-content">
	<div class="content-header-green">
        <div class="text-white-small-thick" style="line-height: 60px;">
        	<?php echo CakeSession::read('Agency.shortname')?>
        </div>
        <div class="text-white-small-thin">Фотогалерея</div>
        <div class="text-white-big-thick" style="line-height: 60px; margin-bottom: 20px;">
        	<?= !empty($photo[0]['album_name']) ? $photo[0]['album_name'] : ''?>
        </div>
    </div>

	<div class="company-logo slider-viewport" style="background-image: url('<?= !empty($photo[0]['path']) ? $photo[0]['path'] : '' ; ?>'); margin: 8px;">
	</div>

	<div class="tab-item no-margin">
		<div class="images-preview">
			<div class="arrow-container"><div class="arrow-box"></div></div>
			<table>
				<tr>
					<?php 
						foreach ($photo as $k => $each ) {
							if($k == 0) {
								echo '<td class="active"><img src="'.$each['path'].'" alt="image '.$k.'"></td>';
							} else {
								echo '<td><img src="'.$each['path'].'" alt="'.$k.'"></td>';
							}
						}
					?>
				</tr>
			</table>
		</div>
	</div>

	<div class="btn-container-big">
        <a href="javascript:void(0)" data-href="<?=!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/about'?>" class="btn btn-white btn-big text-black-small open-page">Закрыть</a>
    </div>
    </div>
</div>

<style type="text/css">
.arrow-container {
	height: 12px;
}
.arrow-box {
	position: relative;
	left: 75px;
    width: 20px;
    height: 15px;
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
    border-bottom: 15px solid #00cc99;
    clear: both;
}
</style>
