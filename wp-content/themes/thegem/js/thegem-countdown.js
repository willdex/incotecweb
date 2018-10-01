(function($) {

	function countdown_init_time(timestamp){

		var now = new Date();
		var currentTime = now.getTime();
		var eventTime = timestamp * 1000;

		if((eventTime - currentTime) < 0){
			eventTime = currentTime;
		}

		var remTime = eventTime - currentTime;
		var s = Math.floor(remTime / 1000);
		var m = Math.floor(s / 60);
		var h = Math.floor(m / 60);
		var d = Math.floor(h / 24);

		h %= 24;
		m %= 60;
		s %= 60;

		h = h + 100;
		m = m + 100;
		s = s + 100;

		return [d, h, m, s];

	}

	function countdown_init_circle_time(timestamp, startEventDate){

		var now = new Date();
		var currentTime = now.getTime();
		var eventTime = timestamp * 1000;
		var dd = Math.floor((eventTime - startEventDate*1000) / 1000 / 24 / 60 / 60);

		if((eventTime - currentTime) < 0){
			eventTime = currentTime;
		}

		var remTime = eventTime - currentTime;
		var s = Math.floor(remTime / 1000);
		var m = Math.floor(s / 60);
		var h = Math.floor(m / 60);
		var d = Math.floor(h / 24);

		h %= 24;
		m %= 60;
		s %= 60;

		h = h + 100;
		m = m + 100;
		s = s + 100;

		return [d, h, m, s, dd];

	}

	function colorToRGBA(colour, opacity) {

	    var hex;

	    if (colour.charAt(0) != '#'){
            var rgb = colour.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
            hex = (rgb && rgb.length === 4) ? "#" +
            ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
        } else {
            hex = colour;
        }

        hex = hex.replace('#','');
        var r = parseInt(hex.substring(0,2), 16);
        var g = parseInt(hex.substring(2,4), 16);
        var b = parseInt(hex.substring(4,6), 16);

        var result = 'rgba('+r+','+g+','+b+','+opacity/100+')';

	    return result;
    }

	function circle_path(value, total) {

		var alpha = 360 / total * value,
			R = 104,
			a = (90 - alpha) * Math.PI / 180,
			x = 108 + R * Math.cos(a),
			y = 108 - R * Math.sin(a),
			path;

		if ( total == value ) {
			path = [["M", 108, 108 - R], ["A", R, R, 0, 1, 1, 107.99, 108 - R]];
		} else {
			path = [["M", 108, 108 - R], ["A", R, R, 0, +(alpha > 180), 1, x, y]];
		}
		return path;
	};

	function rdraw_days($rCanvas, elCD, elAllCD) {
		$rCanvas.layerDays.animate({arc: [(elCD), elAllCD, $rCanvas.colorDays]}, 1000, "linear");
	}

	function rdraw_hours($rCanvas, elCH) {
		$rCanvas.layerHours.animate({arc: [(elCH-100), 24, $rCanvas.colorHours]}, 1000, "linear");
	}

	function rdraw_minutes($rCanvas, elCM) {
		$rCanvas.layerMinutes.animate({arc: [(elCM-100), 60, $rCanvas.colorMinutes]}, 1000, "linear");
	}

	function rdraw_seconds($rCanvas, elCS) {
		if(elCS == 100)
			elCS = 161;
		$rCanvas.layerSeconds.animate({arc: [(elCS-101), 60, $rCanvas.colorSeconds]}, 1000, "linear");
	}

	function countdown(elem, odometerDays, odometerHours, odometerMinutes, odometerSeconds, $rCanvas){

		var elEventDate = elem.attr('data-eventdate'),
			elD = countdown_init_time(elEventDate)[0],
			elH = countdown_init_time(elEventDate)[1],
			elM = countdown_init_time(elEventDate)[2],
			elS = countdown_init_time(elEventDate)[3];

		if($('.countdown-container').hasClass('countdown-style-5')){
			var elStartEventDate = elem.attr('data-starteventdate'),
				elCD = countdown_init_circle_time(elEventDate, elStartEventDate)[0],
				elCH = countdown_init_circle_time(elEventDate, elStartEventDate)[1],
				elCM = countdown_init_circle_time(elEventDate, elStartEventDate)[2],
				elCS = countdown_init_circle_time(elEventDate, elStartEventDate)[3],
				elAllCD = countdown_init_circle_time(elEventDate, elStartEventDate)[4];
		}

		if($('.countdown-days', elem) && odometerDays){
			$('.countdown-days', elem).text(elD);
			odometerDays.value = elD;
		}
		if($('.countdown-hours', elem) && odometerHours){
			$('.countdown-hours', elem).text(elH);
			odometerHours.value = elH;
		}
		if($('.countdown-minutes', elem) && odometerMinutes){
			$('.countdown-minutes', elem).text(elM);
			odometerMinutes.value = elM;
		}
		if($('.countdown-seconds', elem) && odometerSeconds){
			$('.countdown-seconds', elem).text(elS);
			odometerSeconds.value = elS;
		}

		setTimeout(function() {
            if(elem.hasClass('countdown-style-5')) {
                rdraw_days($rCanvas, elCD, elAllCD);
                rdraw_hours($rCanvas, elCH);
                rdraw_minutes($rCanvas, elCM);
                rdraw_seconds($rCanvas, elCS);
            }
			countdown(elem, odometerDays, odometerHours, odometerMinutes, odometerSeconds, $rCanvas);
		}, 1000);
	}

	$(function() {
		$('.countdown-container').each(function() {

			var $glEvent = $(this);
			var glEventDate = $glEvent.attr('data-eventdate');
			var glStartEventDate = $glEvent.attr('date-starteventdate');

			if($glEvent.hasClass('countdown-style-1') || $glEvent.hasClass('countdown-style-3') || $glEvent.hasClass('countdown-style-4') || $glEvent.hasClass('countdown-style-7')){
				var odometerDays = new Odometer({ auto: false, el: $('.countdown-days', $glEvent).get(0), duration: 1000, theme: 'minimal'});
				if($glEvent.hasClass('countdown-style-1') || $glEvent.hasClass('countdown-style-3') || $glEvent.hasClass('countdown-style-4')){
					var odometerHours = new Odometer({ auto: false, el: $('.countdown-hours', $glEvent).get(0), duration: 1000, theme: 'minimal' });
					var odometerMinutes = new Odometer({ auto: false, el: $('.countdown-minutes', $glEvent).get(0), duration: 1000, theme: 'minimal' });
					var odometerSeconds = new Odometer({ auto: false, el: $('.countdown-seconds', $glEvent).get(0), duration: 1000, theme: 'minimal' });
				}
				countdown($glEvent, odometerDays, odometerHours, odometerMinutes, odometerSeconds, '');
			}

			if($glEvent.hasClass('countdown-style-6')){
				var glD = countdown_init_time(glEventDate)[0];
				var glH = countdown_init_time(glEventDate)[1];
				var glM = countdown_init_time(glEventDate)[2];
				var glS = countdown_init_time(glEventDate)[3];
				var odometerDays = new Odometer({ auto: false, el: $('.countdown-days', $glEvent).get(0), value: glD, duration: 1000, theme: 'minimal'});
				var odometerHours = new Odometer({ auto: false, el: $('.countdown-hours', $glEvent).get(0), value: glH, duration: 1000, theme: 'minimal' });
				var odometerMinutes = new Odometer({ auto: false, el: $('.countdown-minutes', $glEvent).get(0), value: glM, duration: 1000, theme: 'minimal' });
				var odometerSeconds = new Odometer({ auto: false, el: $('.countdown-seconds', $glEvent).get(0), value: glS, duration: 1000, theme: 'minimal' });
				countdown($glEvent, odometerDays, odometerHours, odometerMinutes, odometerSeconds, '');
			}

			if($glEvent.hasClass('countdown-style-5')){

				var glStartEventDate = $glEvent.attr('data-starteventdate'),
                    glNumberWeight = $glEvent.attr('data-weightnumber');
					glColorDays = $glEvent.attr('data-colordays'),
					glColorHours = $glEvent.attr('data-colorhours'),
					glColorMinutes = $glEvent.attr('data-colorminutes'),
					glColorSeconds = $glEvent.attr('data-colorseconds'),
					elCD = countdown_init_circle_time(glEventDate, glStartEventDate)[0],
					elCH = countdown_init_circle_time(glEventDate, glStartEventDate)[1],
					elCM = countdown_init_circle_time(glEventDate, glStartEventDate)[2],
					elCS = countdown_init_circle_time(glEventDate, glStartEventDate)[3],
					elAllCD = countdown_init_circle_time(glEventDate, glStartEventDate)[4];

				var odometerDays = new Odometer({ auto: false, el: $('.countdown-days', $glEvent).get(0), duration: 1000, theme: 'minimal' });
				var odometerHours = new Odometer({ auto: false, el: $('.countdown-hours', $glEvent).get(0), duration: 1000, theme: 'minimal' });
				var odometerMinutes = new Odometer({ auto: false, el: $('.countdown-minutes', $glEvent).get(0), duration: 1000, theme: 'minimal' });
				var odometerSeconds = new Odometer({ auto: false, el: $('.countdown-seconds', $glEvent).get(0), duration: 1000, theme: 'minimal' });

				var rCanvasDays = new Raphael($('.circle-raphael-days', $glEvent).get(0), 216, 216),
					rCanvasHours = new Raphael($('.circle-raphael-hours', $glEvent).get(0), 216, 216),
					rCanvasMinutes = new Raphael($('.circle-raphael-minutes', $glEvent).get(0), 216, 216),
					rCanvasSeconds = new Raphael($('.circle-raphael-seconds', $glEvent).get(0), 216, 216),
					paramDays = {stroke: colorToRGBA(glColorDays, 100), "stroke-width": glNumberWeight},
					paramHours = {stroke: colorToRGBA(glColorHours, 100), "stroke-width": glNumberWeight},
					paramMinutes = {stroke: colorToRGBA(glColorMinutes, 100), "stroke-width": glNumberWeight},
					paramSeconds = {stroke: colorToRGBA(glColorSeconds, 100), "stroke-width": glNumberWeight};

				rCanvasDays.customAttributes.arc = function (value, total) {
					return {path: circle_path(value, total)};
				};
				rCanvasHours.customAttributes.arc = function (value, total) {
					return {path: circle_path(value, total)};
				};
				rCanvasMinutes.customAttributes.arc = function (value, total) {
					return {path: circle_path(value, total)};
				};
				rCanvasSeconds.customAttributes.arc = function (value, total) {
					return {path: circle_path(value, total)};
				};

				var $rCanvas = {
					rCanvasDays : rCanvasDays,
					rCanvasHours : rCanvasHours,
					rCanvasMinutes : rCanvasMinutes,
					rCanvasSeconds : rCanvasSeconds,
					layerDays : rCanvasDays.path().attr(paramDays).attr({arc: [0, elAllCD]}),
					layerHours : rCanvasHours.path().attr(paramHours).attr({arc: [0, 24]}),
					layerMinutes : rCanvasMinutes.path().attr(paramMinutes).attr({arc: [0, 60]}),
					layerSeconds : rCanvasSeconds.path().attr(paramSeconds).attr({arc: [0, 60]}),
                    colorDays : colorToRGBA(glColorDays, 100),
                    colorHours : colorToRGBA(glColorHours, 100),
                    colorMinutes : colorToRGBA(glColorMinutes, 100),
                    colorSeconds : colorToRGBA(glColorSeconds, 100)
				}

				rCanvasDays.circle(108, 108, 104).attr({stroke: colorToRGBA(glColorDays, 30), "stroke-width": glNumberWeight});
				rCanvasHours.circle(108, 108, 104).attr({stroke: colorToRGBA(glColorHours, 30), "stroke-width": glNumberWeight});
				rCanvasMinutes.circle(108, 108, 104).attr({stroke: colorToRGBA(glColorMinutes, 30), "stroke-width": glNumberWeight});
				rCanvasSeconds.circle(108, 108, 104).attr({stroke: colorToRGBA(glColorSeconds, 30), "stroke-width": glNumberWeight});

				$rCanvas.layerDays.animate({arc: [elCD, elAllCD]}, 1000, "linear");
				$rCanvas.layerHours.animate({arc: [elCH-100, 24]}, 1000, "linear");
				$rCanvas.layerMinutes.animate({arc: [elCM-100, 60]}, 1000, "linear");
				$rCanvas.layerSeconds.animate({arc: [elCS-100, 60]}, 1000, "linear");

				countdown($glEvent, odometerDays, odometerHours, odometerMinutes, odometerSeconds, $rCanvas);
			}

		});
	});

})(jQuery);