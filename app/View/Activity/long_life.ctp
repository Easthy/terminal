<div class="white-content menu-added">
	<div class="company-logo" style="background-image: url('/img/tmp/moscow.png');">
		<div class="service-logo-layer" style="background-color: rgba(102,51,153,0.3)">
			<div class="company-name-layer">
				<span class="company-name-layer-text">Москва - город долголетия</span>
				<br>
				<span class="text-white-small-thick">Мероприятия города</span>
				<div>
					<hr class="line-long-left">
					<hr class="line-short-left">
				</div>
				<div class="logo-footer">					
					<div class="text-container" style="margin-top: 0">
						<div class="event-button text-centered">
							<div class="valign" style="height: 75px; width:50px; margin-right: 20px;">
								<div class="dummy"></div>
								<img class="valign" src="/img/icons/event_activity.png" style="width: 30px; height:30px;">
							</div>
							<div class="valign" style="width: 240px;">
								<span style="color: #00cc99; font-size:24px; font-weight: 400;">Выбрать дату</span>
								<br>
								<span 
                                    id="calendar-date" 
                                    style="color: #00cc99; font-size:24px; font-weight: 700;"
                                    data-date="<?=$date?>"
                                ><?=$day?> <?=$month?> <?=$year?></span>
							</div>
						</div>
					</div>
					<div class="icons-container">
<!-- 						<div class="logo-icon" data-id="3">
							<a href="/activity/cityfilter">
								<img src="/img/icons/logo_filter.png">
							</a>
						</div>
						<div class="logo-icon" data-id="2">
							<img src="/img/icons/logo_flag.png">
							<img src="/img/icons/flag_green.png" class="active">
						</div>
						<div class="logo-icon list active" data-id="1">
							<img src="/img/icons/logo_list.png">
							<img src="/img/icons/logo_list_active.png" class="active">
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="tab-container" style="max-height: 900px; margin-top:8px;">
		<div id="calendar-wrap">
		</div>
		<div class="tab" id="activities" data-id="1" style="min-height: 900px;">

		</div>

		<div class="tab" data-id="2" style="display: none">
				<div id="map" style="width: 1600px; height: 1200px;"></div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="/css/calendar.css"/>
<script type="text/javascript" src="/js/calendar.js"></script>

<script type="text/javascript">
var calendar = new Calendar('calendar-wrap'); 

$(function(){
    $(document).on('tap','.event-button,.calendar-cell', function () {
        if($('#calendar-wrap').hasClass('active')) {
            $('#calendar-wrap').removeClass('active');
        } else {
            $('#calendar-wrap').addClass('active');
        }
    });

    $(document).on('tap','.calendar-cell',function(){
        if(calendar.selected_date=='Invalid Date'){return true;}
        loadActivityList(calendar);
    });

    loadActivityList = function(calendar){
        var date = calendar.selected_date.ddmmyyyy();
        console.log('date',date);
        var date_txt = calendar.selected_date.getDate() + ' ' + calendar.getMonthName( calendar.selected_date ) + ' ' + calendar.selected_date.getFullYear();

        $('#calendar-date').data('date',date).text(date_txt);
        var activities = getActivityList(date).done(function(sa){
        	$('#activities').html( (sa.html ? sa.html : '') );
        });
    }

    getActivityList = function(date){
        return $.ajax({
            url: '/activity/get_long_life_activity',
            type: "POST",
            dataType: "json",
            data: {"start_date":date}, // конец data
        });
    }

    loadActivityList(calendar);
});
</script>