(function($){

	$.pageScroller = {

		items: $('.scroller-block'),
		navigationPane: null,
		activeItem: 0,
		animated: false,

		init: function() {
			var that = this;
			$('body').css({overflow: 'hidden'});
			if(that.items.length) {
				that.navigationPane = $('<div class="page-scroller-nav-pane"></div>');
				that.navigationPane.appendTo($('body'));
				that.items.each(function(index) {
					var $target = $(this);
					$('<a href="javascript:void(0);" class="page-scroller-nav-item"></a>')
						.appendTo(that.navigationPane)
						.data('scroller-target', $target)
						.on('click', function(e) {
							e.preventDefault();
							that.goTo(index);
						});
				});
			}
			that.update();
			$(window).on('resize', function() {
				that.update();
			});
		},

		update: function() {
			var that = this;
			if($.pageScroller.navigationPane.is(':visible')) {
				$('html, body').scrollTop(0);
			}
			$('#main').addClass('page-scroller-no-animate');
			$('#main').css('transform','translate3d(0,0,0)');
			that.items.each(function() {
				$(this).data('scroll-position', $(this).offset().top);
			});
			that.goTo(that.activeItem, function() {
				setTimeout(function() {
					$('#main').removeClass('page-scroller-no-animate');
				}, 100);
			});
		},

		next: function() {
			this.goTo(this.activeItem + 1);
		},

		prev: function() {
			this.goTo(this.activeItem - 1);
		},

		goTo: function(num, callback) {
			var that = this;
			if(that.animated) return;
			if(num == -1 || num >= this.items.length) return;
			var target_top = this.items.eq(num).data('scroll-position');
			var css = $('#main').css('transform');
			$('#main').css({'transform':'translate3d(0,-'+target_top+'px,0)'});
			setTimeout(function() {
				if(css == $('#main').css('transform')) {
					that.animated = false;
					that.activeItem = num;
					$('.page-scroller-nav-item', that.navigationPane).eq(num).addClass('active');
					if($.isFunction(callback)) callback();
					that.updateTrigger(that.items.eq(num));
					$('#main').off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
				}
			}, 50);
			$('.page-scroller-nav-item.active', that.navigationPane).removeClass('active');
			that.animated = true;
			if($('#main').hasClass('page-scroller-no-animate')) {
				that.animated = false;
				that.activeItem = num;
				$('.page-scroller-nav-item', that.navigationPane).eq(num).addClass('active');
				if($.isFunction(callback)) callback();
				that.updateTrigger(that.items.eq(num));
			} else {
				$('#main').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
					that.animated = false;
					that.activeItem = num;
					$('.page-scroller-nav-item', that.navigationPane).eq(num).addClass('active');
					if($.isFunction(callback)) callback();
					that.updateTrigger(that.items.eq(num));
				});
			}
		},

		updateTrigger(elem) {
			$(document).trigger('update-page-scroller', elem);
		}

	};

	$(function() {
		if(!$('body').hasClass('compose-mode')) {
			$.pageScroller.init();
			$('body').on('mousewheel', function(event, delta, deltaX, deltaY) {
				if(!$.pageScroller.navigationPane.is(':visible')) return;
				event.preventDefault();
				if(delta > 0) {
					$.pageScroller.prev();
				} else {
					$.pageScroller.next();
				}
			});
			$('body').swipe({
				allowPageScroll:'vertical',
				preventDefaultEvents: false,
				swipe:function(event, direction, distance, duration, fingerCount) {
					if($.pageScroller.navigationPane.is(':visible')) {
						if(direction == 'down') {
							$.pageScroller.prev();
						}
						if(direction == 'up') {
							$.pageScroller.next();
						}
					}
				},
			});
		}
	});

})(jQuery);