window.Terminal = {};
$(function() {
	var extensionLists = {}; //Create an object for all extension lists
	extensionLists.video = ['m4v', 'avi','mpg','mp4', 'webm', 'ogv'];  
	extensionLists.image = ['jpg', 'gif', 'bmp', 'png', 'jpeg'];

	// One validation function for all file types    
	window.isValidFileType = function(fName, fType) {
	    console.log('fName: ',fName,'fType: ',fType);
	    return extensionLists[fType].indexOf(fName.split('.').pop().toLocaleLowerCase()) > -1;
	}
    // Extract GET variable
    window.getURLParameters = function getURLParameters(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null;
    }
	// Date and time updater
	Terminal.clock = function(){
		var month_names = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря"];
		var date = new Date();
		var hours = date.getHours();
		var minutes = date.getMinutes();

		if (hours < 10) 
			hours = '0' + hours;
		if (minutes < 10) 
			minutes = '0' + minutes;

		var time = hours + ':' + minutes;
		
		var year = date.getFullYear();
		var month = date.getMonth();
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
		time_wait 			: 70,
		time_inactive 		: 70,
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
		//
		var img = isValidFileType(src, 'image');
		var video_screensaver = '<div id="screensaver">\
		<video no-controls autoplay loop data-setup="{}">\
  			<source src="'+src+'">\
		</video>\
		</div>';
		var image_screensaver = '<div id="screensaver" style="background:url('+src+')"></div>';
		//
		$('body').append(( img ? image_screensaver : video_screensaver));
		$('#screensaver').css( {
			'background-size' 	: 'cover',
			'display' 			: 'block',
			'position'			: 'absolute',
			'z-index'			: 100,
			'width'				: '1056px',
			'height'			: '1920px',
			'top'				: 0,
			'left'				: 0
		});
	};
	var activate_screensaver = getURLParameters('activate_screensaver');
	Terminal.screensaver.start = function(){
		if (activate_screensaver==1){
			Terminal.screensaver.getScreensaver().done(function(sa){
				console.log(sa.screensaver);
				Terminal.screensaver.setScreensaver(sa.screensaver);
				activate_screensaver = 0;
			});
			return;
		}

		Terminal.screensaver.timer = setTimeout(function(){
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
		$('#screensaver').remove();
		activate_screensaver = 0;
		Terminal.screensaver.start();
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