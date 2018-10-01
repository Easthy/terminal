window.Terminal = {};
$(function() {
	// Date and time updater
	Terminal.clock = function(){
		var month_names = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня","Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря"];
		var date = new Date();
		var hours = date.getHours();
		var minutes = date.getMinutes();

		if (hours < 10) 
			hours = '0' + hours;
		if (minutes < 10) 
			minutes = '0' + minutes;

		var time = hours + ':' + minutes;
		
		var year = date.getFullYear();
		var month = date.getMonth() + 1;
		var day = date.getDate();
		if (month < 10) 
			month = month;
		if (day < 10) 
			day = '0' + day;
			
		var my_date = day + ' ' + month_names[month] + ' ' + year;
		
		document.getElementById('clock').innerHTML = time;
		document.getElementById('date').innerHTML = my_date;
		
		setTimeout('Terminal.clock()', 1000);
	};
	Terminal.clock();
	// Screensaver
	Terminal.screensaver = {
		time_wait 			: 70000,
		time_inactive 		: 70000,
		timer 				: null
	};
	Terminal.screensaver.getScreensaver = function(){
        return $.ajax({
            url: '/home/get_screensaver',
            type: "POST",
            dataType: "json",
        });
	}
	Terminal.screensaver.setScreensaver = function(src){
		$('body').append('<div id="screensaver" style="background:url('+src+')"></div>');
		$('#screensaver').css( {
			'background-size' 	: 'cover',
			'display' 			: 'block',
			'position'			: 'absolute',
			'z-index'			: 100,
			'width'				: '1080px',
			'height'			: '1920px',
			'top'				: 0,
			'left'				: 0
		});
	};
	Terminal.screensaver.redirect = function(){
		localStorage.setItem('time_inactive',0);
		window.location.href = '/';
	}
	Terminal.screensaver.start = function(){
		console.log( Terminal.screensaver.time_inactive );
		if (localStorage.getItem('time_inactive')==0){
			Terminal.screensaver.getScreensaver().done(function(sa){
				console.log(sa.screensaver);
				Terminal.screensaver.setScreensaver(sa.screensaver);
				localStorage.removeItem('time_inactive');
			});
			return;
		}

		Terminal.screensaver.timer = setTimeout(function(){
			Terminal.screensaver.time_inactive--;
			if ( Terminal.screensaver.time_inactive <= 0 ){
				Terminal.screensaver.redirect();
				return;
			}
			Terminal.screensaver.start();
		},1000);
	};
	Terminal.screensaver.stop = function(){
		clearTimeout( Terminal.screensaver.timer );
		Terminal.screensaver.reset();
		$('#screensaver').remove();
	};
	Terminal.screensaver.reset = function(){
		Terminal.screensaver.time_inactive = Terminal.screensaver.time_wait;
	};
	$(document).on('tap','#screensaver:visible',function(){
		Terminal.screensaver.start();
		$('#screensaver').hide();
	});
	$(document).on('tap','html',function(){
		Terminal.screensaver.reset();
	});
	$('html').mousemove(function(){
		Terminal.screensaver.reset();
	});
	// Start screensavers
	Terminal.screensaver.start();
	//
	$(document).on('tap','.tab-item',function() {
		var id = $(this).data('id');
		if($('.tab-item[data-id='+id+'] .check-profile').hasClass('active')) {
			$('.tab-item[data-id='+id+'] .check-profile').removeClass('active');
		} else {
			$('.tab-item[data-id='+id+'] .check-profile').addClass('active');
		}
	});
	$(document).on('tap','.open-page',function() {
		var href = $(this).data('href');
		if (href) {
			window.location.href = href;
		}
	});
	$(document).on('tap','.submenu .menu-item',function() {
		var id = $(this).data('id');
		$('.submenu .menu-item').removeClass('active');
		$('.submenu .menu-item[data-id='+id+']').addClass('active');
		$('.tab').hide();
		$('.tab[data-id='+id+']').show();

		var menu_block_width = $('.submenu .menu-item:first').width();
		//move menu arrow
		$('.arrow-box').css('left', (135+menu_block_width*(id-1))+'px')
	});

	$('.images-preview td').tap(function() {
		var index = $('.images-preview table td').index(this);

		$('.images-preview td').removeClass('active');
		$(this).addClass('active');

		//move menu arrow
		$('.arrow-box').css('left', (75+182*index)+'px');

		var src = $(this).find('img').attr('src');
		$('.company-logo').css('background-image', 'url('+src+')' );
	});
});
Date.prototype.ddmmyyyy = function() {
   var yyyy = this.getFullYear().toString();
   var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
   var dd  = this.getDate().toString();
   return (dd[1]?dd:"0"+dd[0])+'.'+(mm[1]?mm:"0"+mm[0])+'.'+yyyy; // padding
};