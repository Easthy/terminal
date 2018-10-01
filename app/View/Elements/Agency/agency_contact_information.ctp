		<div id="contacts" class="tab" data-id="5" style="display: none; max-height:910px;">
			<?php foreach ($affiliates as $key => $affiliate): ?> 
				<?php if($key != 0 && isset($affiliate['shortname'])): ?>
					<div class="contact-name">
						<span class="text-white-small-thick">
							<?=!empty($affiliate['shortname'])?$affiliate['shortname']:''?>
						</span>
					</div>
				<?php endif; ?>

				<?php if(!empty($affiliate['phone'])): ?>
					<div class="tab-item">
						<div class="tab-header">
							<span class="text-blue-small-thick">Телефон приемной</span>
						</div>
						<span class="text-grey-small"><?= $affiliate['phone'] ?></span>
					</div>
				<?php endif; ?>

				<?php if(!empty($affiliate['schedule'])): ?>
					<div class="tab-item">
						<div class="tab-header">
							<span class="text-blue-small-thick">Режим работы</span>
						</div>
						<?php foreach ($affiliate['schedule'] as $schedule): ?>
							<span class="text-grey-small">
								<?= !empty($schedule['day'])		? $schedule['day']				: ''?>
								<?php if(!empty($schedule['time_start'])&&!empty($schedule['time_end'])):?>
									с <?php echo $schedule['time_start']?>
									по <?php echo $schedule['time_end']?>
									<?= !empty($schedule['breakstart']) ? ' Обед с '.$schedule['breakstart'].' до '.$schedule['breakend']:''?>
								<?php else:?>
									Выходной
								<?php endif;?>
							</span><br>
						<?php endforeach; ?>
						<?php if(!empty($agency['break'])):?>
							<span class="text-grey-small">
								Обед с <?php echo $agency['break']['break_start']?> до <?php echo $agency['break']['break_end']?>
							</span>
						<?php endif;?>
					</div>
				<?php endif; ?>

				<?php if(isset($affiliate['address'])): ?>
					<div class="tab-item">
						<div class="tab-header">
							<span class="text-blue-small-thick">Адрес</span>
						</div>
						<span class="text-grey-small"><?= $affiliate['address'] ?></span>
						<div id="map<?= $key ?>" style="width: 900px; height: 430px;"></div>

						<script type="text/javascript">
							ymaps.ready(init);

							function init() {
							    var myMap = new ymaps.Map('map<?= $key ?>', {
							        center: [55.753994, 37.622093],
							        zoom: 11,
	        						controls: []
							    });

							    myMap.behaviors.disable('scrollZoom'); 
							    
							    // Finding coordinates of the center of Nizhny Novgorod.
							    ymaps.geocode('<?= $affiliate['address'] ?>', {
							        results: 1
							    }).then(function (res) {
							            // Selecting the first result of geocoding.
							            var firstGeoObject = res.geoObjects.get(0),
							                // The coordinates of the geo object.
							                coords = firstGeoObject.geometry.getCoordinates();
							                // The viewport of the geo object.
							                //TODO: сделать центрирование на точке
							                bounds = firstGeoObject.properties.get('boundedBy');
							            firstGeoObject.options.set('preset', 'islands#darkBlueDotIconWithCaption');
							            // Getting the address string and displaying it in the geo object icon.
							            firstGeoObject.properties.set('iconCaption', firstGeoObject.getAddressLine());

							            // Adding first found geo object to the map.
							            myMap.geoObjects.add(firstGeoObject);
							            // Scaling the map to the geo object viewport.
							            myMap.setBounds(bounds, {
							                // Checking the availability of tiles at the given zoom level.
							                checkZoomRange: true
							            });

							            /**
							             * To add a placemark with its own styles and balloon content at the coordinates found by the geocoder, create a new placemark at the coordinates of the found placemark and add it to the map in place of the found one.
							             */
							            /**
							             var myPlacemark = new ymaps.Placemark(coords, {
							             iconContent: 'my placemark',
							             balloonContent: 'Content of the <strong>my placemark</strong> balloon'
							             }, {
							             preset: 'islands#violetStretchyIcon'
							             });

							             myMap.geoObjects.add(myPlacemark);
							             */
							        });
							}

						</script>
					</div>
				<?php endif; ?>

				<?php if(isset($affiliate['address_comment'])): ?>
					<div class="tab-item">
						<div class="tab-header">
							<span class="text-blue-small-thick">Проезд</span>
						</div>
						<span class="text-grey-small"><?= $affiliate['address_comment'] ?></span>
					</div>
				<?php endif; ?>

				<?php if(isset($affiliate['email'])): ?>
					<div class="tab-item">
						<div class="tab-header">
							<span class="text-blue-small-thick">Электронная почта</span>
						</div>
						<span class="text-grey-small"><?= $affiliate['email'] ?></span>
					</div>
				<?php endif; ?>

				<?php if(isset($affiliate['www'])): ?>
					<div class="tab-item">
						<div class="tab-header">
							<span class="text-blue-small-thick">Сайт</span>
						</div>
						<span class="text-grey-small"><?= $affiliate['www'] ?></span>
					</div>
				<?php endif; ?>

				
			<?php endforeach; ?>
		</div>