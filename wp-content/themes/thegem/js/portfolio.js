(function($) {
	$(function() {

		window.defaultSortData = {
			date: '[data-sort-date] parseInt',
			name: '.title'
		};

		function portfolio_images_loaded($box, image_selector, callback) {
			var $images = $(image_selector, $box).filter(function() {
					return !(this.complete && this.naturalWidth !== undefined && this.naturalWidth != 0);
				}),
				images_count = $images.length;

			if (images_count == 0) {
				return callback();
			}

			$images.on('load error', function() {
				images_count--;
				if (images_count == 0) {
					callback();
				}
			});
		}

		function init_prev_next_navigator_buttons ($portfolio) {
			var current_page = $portfolio.data('current-page');
			var pages_count = $portfolio.data('pages-count');
			if (current_page <= 1)
				$('.portfolio-navigator a.prev', $portfolio).css('visibility', 'hidden');
			else
				$('.portfolio-navigator a.prev', $portfolio).css('visibility', 'visible');

			if (current_page >= pages_count)
				$('.portfolio-navigator a.next', $portfolio).css('visibility', 'hidden');
			else
				$('.portfolio-navigator a.next', $portfolio).css('visibility', 'visible');
		}

		function get_portfolio_sorted_items($portfolio) {
			if ($('.portfolio-sorting a.sorting-switcher', $portfolio).length == 0) {
				return $('.portfolio-set .portfolio-item', $portfolio);
			}


			var sortOptions = get_portfolio_sorting_data($portfolio);
			var sortBy = window.defaultSortData[ sortOptions.sortBy ];

			var isParseInt = false;
			if (sortBy.indexOf('parseInt') != -1) {
				sortBy = sortBy.replace(' parseInt', '');
				var isParseInt = true;
			}

			var isSortByAttr = false;
			var m = sortBy.match( /^\[(.+)\]$/ );
			if (m) {
				sortBy = m[1];
				var isSortByAttr = true;
			}

			var $items = $('.portfolio-set .portfolio-item', $portfolio);
			$items.sort(function($item1, $item2) {
				if (isSortByAttr) {
					var item1_value = $item1.getAttribute( sortBy );
					var item2_value = $item2.getAttribute( sortBy );
				} else {
					var item1_value = $(sortBy, $item1).text();
					var item2_value = $(sortBy, $item2).text();
				}

				if (isParseInt) {
					item1_value = parseInt(item1_value);
					item2_value = parseInt(item2_value);
				}

				return ( item1_value > item2_value ? 1 : -1 ) * ( sortOptions.sortAscending ? 1 : -1 );
			});
			return $items;
		}

		function init_portfolio_pages($portfolio) {
			var count = $('.portfolio-set .portfolio-item', $portfolio).size();
			var default_per_page = $portfolio.data('per-page') || count;

			if ($('.portfolio-count select', $portfolio).size() > 0)
				var per_page = $('.portfolio-count select', $portfolio).val();
			else
				var per_page = default_per_page;

			var pages_count = Math.ceil(count / per_page);
			var current_page = 1;

			$portfolio.data('per-page', per_page);
			$portfolio.data('pages-count', pages_count);
			$portfolio.data('current-page', current_page);

			if ($('.portfolio-navigator', $portfolio).size() > 0 && pages_count > 1) {
				var pagenavigator = '<a href="#" class="prev">&#xe603;</a>';
				for (var i = 0; i < pages_count; i++)
					pagenavigator += '<a href="#" data-page="' + (i + 1) + '">' + (i + 1) + '</a>';
				pagenavigator += '<a href="#" class="next">&#xe601;</a>';
				$('.portfolio-navigator', $portfolio).html(pagenavigator).show();
				$('.portfolio-set', $portfolio).css('margin-bottom', '');
				$('.portfolio-navigator a[data-page="' + current_page + '"]', $portfolio).addClass('current')
				init_prev_next_navigator_buttons($portfolio);
			} else {
				$('.portfolio-navigator', $portfolio).html('').hide();
				$('.portfolio-set', $portfolio).css('margin-bottom', 0);
			}

			$('.portfolio-set .portfolio-item', $portfolio).removeClass(function(index, class_name) {
				return  (class_name.match (/\bpaginator-page-\S+/g) || []).join(' ');
			});

			var sorted_items = get_portfolio_sorted_items($portfolio);
			$.each(sorted_items, function(i, item) {
				var page = Math.ceil((i + 1) / per_page);
				$(item).addClass('paginator-page-' + page);
			});

			$('.portfolio-navigator', $portfolio).on('click', 'a', function() {
				if ($(this).hasClass('current'))
					return false;
				var current_page = $(this).siblings('.current:first').data('page');
				if ($(this).hasClass('prev')) {
					var page = current_page - 1;
				} else if ($(this).hasClass('next')) {
					var page = current_page + 1
				} else {
					var page = $(this).data('page');
				}
				if (page < 1)
					page = 1;
				if (page > pages_count)
					page = pages_count;
				$(this).siblings('a').removeClass('current');
				$(this).parent().find('a[data-page="' + page + '"]').addClass('current');
				$portfolio.data('current-page', page);
				init_prev_next_navigator_buttons($portfolio);
				var filterValue = '';
				if ($('.portfolio-filters a.active', $portfolio).size() > 0) {
					filterValue += $('.portfolio-filters a.active', $portfolio).data('filter');
				}
				filterValue += '.paginator-page-' + page;

				$portfolio.itemsAnimations('instance').reinitItems($('.portfolio-set .portfolio-item', $portfolio));

				$('.portfolio-set', $portfolio).isotope({ filter: filterValue });
				$("html, body").animate({ scrollTop: $portfolio.offset().top - 200 }, 600);
				return false;
			});
		}

		function init_portfolio_count($portfolio) {
			if (!$('.portfolio-count select', $portfolio).length) {
				return false;
			}
			$('.portfolio-count select', $portfolio).on('change', function() {
				init_portfolio_pages($portfolio);
				if ($('.portfolio-filters', $portfolio).length) {
					$('.portfolio-filters a', $portfolio).removeClass('active');
					$('.portfolio-filters a[data-filter="*"]', $portfolio).addClass('active');
				}
				var current_page = $portfolio.data('current-page');
				$portfolio.itemsAnimations('instance').reinitItems($('.portfolio-set .portfolio-item', $portfolio));
				$('.portfolio-set', $portfolio).isotope({
					filter: '.paginator-page-' + current_page
				});
			});
		}

		function get_portfolio_sorting_data($portfolio) {
			var sorting = {
				sortBy: $('.portfolio-sorting .orderby .sorting-switcher', $portfolio).data('current'),
				sortAscending: $('.portfolio-sorting .order .sorting-switcher', $portfolio).data('current') == 'ASC'
			};

			return sorting;
		}

		function init_portfolio_sorting($portfolio) {
			if ($('.portfolio-sorting a.sorting-switcher', $portfolio).length == 0)
				return false;

			$('.portfolio-sorting a.sorting-switcher', $portfolio).on('click', function(e) {
				var $selected = $('label[data-value!="' + $(this).data('current') + '"]', $(this).parent());
				$(this).data('current', $selected.data('value'));

				if($(this).next().is($selected)) {
					$(this).addClass('right');
				} else {
					$(this).removeClass('right');
				}

				if ($portfolio.hasClass('portfolio-pagination-scroll')) {
					$portfolio.data('next-page', 1);
					portfolio_scroll_load_next_request($portfolio);

				} else if ($('.portfolio-load-more', $portfolio).size() == 0) {
					init_portfolio_pages($portfolio);
					var current_page = $portfolio.data('current-page');
					var sortOptions = get_portfolio_sorting_data($portfolio);
					$portfolio.itemsAnimations('instance').reinitItems($('.portfolio-set .portfolio-item', $portfolio));
					$('.portfolio-set', $portfolio).isotope({
						filter: '.paginator-page-' + current_page,
						sortBy: sortOptions.sortBy,
						sortAscending: sortOptions.sortAscending
					});
				} else {
					$portfolio.data('next-page', 1);
					portfolio_load_core_request($portfolio);
				}

				e.preventDefault();
				return false;
			});

			$('.portfolio-sorting label', $portfolio).on('click', function(e) {
				if($(this).data('value') != $('.sorting-switcher', $(this).parent()).data('current')) {
					$('.sorting-switcher', $(this).parent()).click();
				}
				e.preventDefault();
				return false;
			});
		}

		function portfolio_load_more_request($portfolio, $set, is_scroll) {
			var uid = $portfolio.data('portfolio-uid'),
				is_processing_request = $set.data('request-process') || false;
			if (is_processing_request) {
				return false;
			}

			var data = $.extend(true, {}, window['portfolio_ajax_' + uid]);
			if ($('.portfolio-count select', $portfolio).length) {
				data['data']['more_count'] = $('.portfolio-count select', $portfolio).val();
			}

			data['data']['more_page'] = $portfolio.data('next-page');
			if (data['data']['more_page'] == null || data['data']['more_page'] == undefined) {
				data['data']['more_page'] = 1;
			}
			if (data['data']['more_page'] == 0) {
				return false;
			}

			if ($('.portfolio-filters', $portfolio).length) {
				data['data']['portfolio'] = $portfolio.data('more-filter') || data['data']['portfolio'];
			}

			if ($('.portfolio-sorting', $portfolio).length) {
				data['data']['orderby'] = $('.portfolio-sorting .orderby .sorting-switcher', $portfolio).data('current');
				data['data']['order'] = $('.portfolio-sorting .order .sorting-switcher', $portfolio).data('current');
			}

			data['action'] = 'portfolio_load_more';
			$set.data('request-process', true);

			if (is_scroll) {
				$('.portfolio-scroll-pagination', $portfolio).addClass('active').html('<div class="loading"></div>');
			} else {
				$('.portfolio-load-more .gem-button', $portfolio).before('<div class="loading"></div>');
			}

			$.ajax({
				type: 'post',
				dataType: 'json',
				url: data.url,
				data: data,
				success: function(response) {
					if (response.status == 'success') {
						var $newItems = $(response.html),
							current_page = $newItems.data('page'),
							next_page = $newItems.data('next-page'),
							$inserted_data = $($newItems.html());

						$inserted_data.addClass('paginator-page-1');
						if ($portfolio.itemsAnimations('instance').getAnimationName() != 'disabled') {
							$inserted_data.addClass('item-animations-not-inited');
						} else {
							$inserted_data.removeClass('item-animations-not-inited');
						}
						if (($portfolio.hasClass('columns-2') || $portfolio.hasClass('columns-3') || $portfolio.hasClass('columns-4')) && $portfolio.closest('.vc_row[data-vc-stretch-content="true"]').length > 0) {
							$('.image-inner picture source', $inserted_data).remove();
						}
						portfolio_images_loaded($inserted_data, '.image-inner img', function() {
							if (current_page == 1) {
								$portfolio.itemsAnimations('instance').clear();
								$set.html('');
							}

							$set.isotope('insert', $inserted_data);
							$portfolio.itemsAnimations('instance').show($inserted_data);

							if (is_scroll) {
								$('.portfolio-scroll-pagination', $portfolio).removeClass('active').html('');
							} else {
								$('.portfolio-scroll-pagination', $portfolio).addClass('active').html('<div class="loading"></div>');
								if (next_page > 0) {
									$('.portfolio-load-more', $portfolio).show();
								} else {
									$('.portfolio-load-more', $portfolio).hide();
								}
							}

							$portfolio.data('next-page', next_page);
							$set.data('request-process', false);
						});
					} else {
						alert(response.message);
					}
				}
			});
		}

		function portfolio_load_core_request($portfolio) {
			var $set = $('.portfolio-set', $portfolio);
			var uid = $portfolio.data('portfolio-uid');
			var is_processing_request = $set.data('request-process') || false;
			if (is_processing_request)
				return false;
			$set.data('request-process', true);
			var data = $.extend(true, {}, window['portfolio_ajax_' + uid]);
			data['action'] = 'portfolio_load_more';
			if ($('.portfolio-count select', $portfolio).size() > 0)
				data['data']['more_count'] = $('.portfolio-count select', $portfolio).val();
			data['data']['more_page'] = $portfolio.data('next-page') || 1;
			if (data['data']['more_page'] == 0)
				return false;
			if ($('.portfolio-filters', $portfolio).size() > 0) {
				data['data']['portfolio'] = $portfolio.data('more-filter') || data['data']['portfolio'];
			}

			if ($('.portfolio-sorting', $portfolio).length > 0) {
				data['data']['orderby'] = $('.portfolio-sorting .orderby .sorting-switcher', $portfolio).data('current');
				data['data']['order'] = $('.portfolio-sorting .order .sorting-switcher', $portfolio).data('current');
			}

			$('.portfolio-load-more .gem-button', $portfolio).before('<div class="loading"><div class="preloader-spin"></div></div>');

			$.ajax({
				type: 'post',
				dataType: 'json',
				url: data.url,
				data: data,
				success: function(response) {
					if (response.status == 'success') {
						var minZIndex = $('.portfolio-item:last', $set).css('z-index') - 1;
						var $newItems = $(response.html);
						$('.portfolio-item', $newItems).addClass('paginator-page-1')
						$('.portfolio-item', $newItems).each(function() {
							$(this).css('z-index', minZIndex--);
						});
						var current_page = $newItems.data('page');
						var next_page = $newItems.data('next-page');
						var $inserted_data = $($newItems.html());
						if ($portfolio.itemsAnimations('instance').getAnimationName() != 'disabled') {
							$inserted_data.addClass('item-animations-not-inited');
						} else {
							$inserted_data.removeClass('item-animations-not-inited');
						}

						if (($portfolio.hasClass('columns-2') || $portfolio.hasClass('columns-3') || $portfolio.hasClass('columns-4')) && $portfolio.closest('.vc_row[data-vc-stretch-content="true"]').length > 0) {
							$('.image-inner picture source', $inserted_data).remove();
						}
						portfolio_images_loaded($inserted_data, '.image-inner img', function() {
							if (current_page == 1) {
								$portfolio.itemsAnimations('instance').clear();
								$set.html('');
							}

							$set.isotope('insert', $inserted_data);
							init_circular_overlay($portfolio, $set);
							$portfolio.itemsAnimations('instance').show($inserted_data);

							$('.portfolio-load-more .loading', $portfolio).remove();
							$portfolio.data('next-page', next_page);
							if (next_page > 0) {
								$('.portfolio-load-more', $portfolio).show();
							} else {
								$('.portfolio-load-more', $portfolio).hide();
							}

							$set.data('request-process', false);
						});
					} else {
						alert(response.message);
						$('.portfolio-load-more .gem-button .loading', $portfolio).remove();
					}
				}
			});
		}

		function init_portfolio_more_count($portfolio) {
			if ($('.portfolio-count select', $portfolio).size() == 0)
				return false;
			$('.portfolio-count select', $portfolio).on('change', function() {
				$portfolio.data('next-page', 1);
				portfolio_load_core_request($portfolio);
			});
		}

		function init_portfolio_scroll_next_count($portfolio) {
			if ($('.portfolio-count select', $portfolio).size() == 0)
				return false;
			$('.portfolio-count select', $portfolio).on('change', function() {
				$portfolio.data('next-page', 1);
				portfolio_scroll_load_next_request($portfolio);
			});
		}

		function portfolio_scroll_load_next_request($portfolio) {
			var $set = $('.portfolio-set', $portfolio);
			var uid = $portfolio.data('portfolio-uid');
			var is_processing_request = $set.data('request-process') || false;
			if (is_processing_request)
				return false;
			var data = $.extend(true, {}, window['portfolio_ajax_' + uid]);
			data['action'] = 'portfolio_load_more';
			if ($('.portfolio-count select', $portfolio).size() > 0)
				data['data']['more_count'] = $('.portfolio-count select', $portfolio).val();

			data['data']['more_page'] = $portfolio.data('next-page');
			if (data['data']['more_page'] == null || data['data']['more_page'] == undefined) {
				data['data']['more_page'] = 1;
			}
			if (data['data']['more_page'] == 0)
				return false;
			if ($('.portfolio-filters', $portfolio).size() > 0) {
				data['data']['portfolio'] = $portfolio.data('more-filter') || data['data']['portfolio'];
			}

			if ($('.portfolio-sorting', $portfolio).length > 0) {
				data['data']['orderby'] = $('.portfolio-sorting .orderby .sorting-switcher', $portfolio).data('current');
				data['data']['order'] = $('.portfolio-sorting .order .sorting-switcher', $portfolio).data('current');
			}

			$set.data('request-process', true);
			$('.portfolio-scroll-pagination', $portfolio).addClass('active').html('<div class="loading"><div class="preloader-spin"></div></div>');

			$.ajax({
				type: 'post',
				dataType: 'json',
				url: data.url,
				data: data,
				success: function(response) {
					if (response.status == 'success') {
						var minZIndex = $('.portfolio-item:last', $set).css('z-index') - 1;
						var $newItems = $(response.html);
						$('.portfolio-item', $newItems).addClass('paginator-page-1')
						$('.portfolio-item', $newItems).each(function() {
							$(this).css('z-index', minZIndex--);
						});
						var current_page = $newItems.data('page');
						var next_page = $newItems.data('next-page');
						var $inserted_data = $($newItems.html());
						if ($portfolio.itemsAnimations('instance').getAnimationName() != 'disabled') {
							$inserted_data.addClass('item-animations-not-inited');
						} else {
							$inserted_data.removeClass('item-animations-not-inited');
						}
						if (($portfolio.hasClass('columns-2') || $portfolio.hasClass('columns-3') || $portfolio.hasClass('columns-4')) && $portfolio.closest('.vc_row[data-vc-stretch-content="true"]').length > 0) {
							$('.image-inner picture source', $inserted_data).remove();
						}
						portfolio_images_loaded($inserted_data, '.image-inner img', function() {
							if (current_page == 1) {
								$portfolio.itemsAnimations('instance').clear();
								$set.html('');
							}

							$set.isotope('insert', $inserted_data);
							init_circular_overlay($portfolio, $set);
							$portfolio.itemsAnimations('instance').show($inserted_data);

							$('.portfolio-scroll-pagination', $portfolio).removeClass('active').html('');
							$portfolio.data('next-page', next_page);
							$set.data('request-process', false);
						});
					} else {
						alert(response.message);
						$('.portfolio-scroll-pagination', $portfolio).removeClass('active').html('');
					}
				}
			});
		}

		function init_portfolio_scroll_next_page($portfolio) {
			if ($('.portfolio-scroll-pagination', $portfolio).length == 0) {
				return false;
			}

			var $pagination = $('.portfolio-scroll-pagination', $portfolio);
			var watcher = scrollMonitor.create($pagination[0]);
			watcher.enterViewport(function() {
				portfolio_scroll_load_next_request($portfolio);
			});
		}

		$('.portfolio-count select').combobox();

		function init_circular_overlay($portfolio, $set) {
			if (!$portfolio.hasClass('hover-circular')) {
				return;
			}

			$('.portfolio-item', $set).on('mouseenter', function() {
				var overlayWidth = $('.overlay', this).width(),
					overlayHeight = $('.overlay', this).height(),
					$overlayCircle = $('.overlay-circle', this),
					maxSize = 0;

				if (overlayWidth > overlayHeight) {
					maxSize = overlayWidth;
					$overlayCircle.height(overlayWidth)
				} else {
					maxSize = overlayHeight;
					$overlayCircle.width(overlayHeight);
				}
				maxSize += overlayWidth * 0.3;

				$overlayCircle.css({
					marginLeft: -maxSize / 2,
					marginTop: -maxSize / 2
				});
			});
		}

		$('.portfolio').not('.portfolio-slider').each(function() {
			var $portfolio = $(this);
			var $set = $('.portfolio-set', this);
			if ($portfolio.hasClass('portfolio-pagination-scroll')) {
				var current_page = 1;
				$('.portfolio-set .portfolio-item', $portfolio).addClass('paginator-page-1');
				init_portfolio_sorting($portfolio);
				init_portfolio_scroll_next_count($portfolio);

			} else if ($('.portfolio-load-more', $portfolio).size() == 0) {
				init_portfolio_count($portfolio);
				init_portfolio_sorting($portfolio);
				init_portfolio_pages($portfolio);
				var current_page = $portfolio.data('current-page');
			} else {
				var current_page = 1;
				$('.portfolio-set .portfolio-item', $portfolio).addClass('paginator-page-1');
				init_portfolio_sorting($portfolio);
				init_portfolio_more_count($portfolio);
			}

			if (($portfolio.hasClass('columns-2') || $portfolio.hasClass('columns-3') || $portfolio.hasClass('columns-4')) && $portfolio.closest('.vc_row[data-vc-stretch-content="true"]').length > 0) {
				$('.image-inner picture source', $set).remove();
			}

			portfolio_images_loaded($set, '.image-inner img', function() {
				var sortOptions = get_portfolio_sorting_data($portfolio);
				var layoutMode = 'masonry-custom';
				if ($portfolio.hasClass('portfolio-style-metro')) {
					layoutMode = 'metro';
				}

				var itemsAnimations = $portfolio.itemsAnimations({
					itemSelector: '.portfolio-item',
					scrollMonitor: true
				});

				init_circular_overlay($portfolio, $set);

				var isotope_options = {
					itemSelector: '.portfolio-item',
					layoutMode: layoutMode,
					itemImageWrapperSelector: '.image-inner',
					fixHeightDoubleItems: $portfolio.hasClass('portfolio-style-justified'),
					'masonry-custom': {
						columnWidth: '.portfolio-item:not(.double-item)'
					},
					filter: '.paginator-page-' + current_page,
					transitionDuration: 0
				};

				if ($('.portfolio-load-more', $portfolio).size() == 0 && !$portfolio.hasClass('portfolio-pagination-scroll')) {
					isotope_options['getSortData'] = window.defaultSortData;
					isotope_options['sortBy'] = sortOptions.sortBy;
					isotope_options['sortAscending'] = sortOptions.sortAscending;
				}

				var init_portfolio = true;

				$portfolio.closest('.portfolio-preloader-wrapper').prev('.preloader').remove();

				$set
					.on( 'arrangeComplete', function( event, filteredItems ) {
						if ($set.closest('.fullwidth-block').size() > 0) {
							$set.closest('.fullwidth-block').bind('fullwidthUpdate', function() {
								if ($set.data('isotope')) {
									$set.isotope('layout');
									return false;
								}
							});
						} else {
							if ($set.closest('.vc_row[data-vc-stretch-content="true"]').length > 0) {
								$set.closest('.vc_row[data-vc-stretch-content="true"]').bind('VCRowFullwidthUpdate', function() {
									if ($set.data('isotope')) {
										$set.isotope('layout');
										return false;
									}
								});
							}
						}

						if (init_portfolio) {

							var items = [];
							filteredItems.forEach(function(item) {
								items.push(item.element);
							});

							//setTimeout(function() {
								itemsAnimations.show($(items));
							//}, 0);
						}
					})
					.isotope(isotope_options);

				if (!window.gemSettings.lasyDisabled) {
					var elems = $('.portfolio-item:visible', $set);
					var items = [];
					for (var i = 0; i < elems.length; i++)
						items.push($set.isotope('getItem', elems[i]));
					$set.isotope('reveal', items);
				}

				if ($set.closest('.gem_tab').size() > 0) {
					$set.closest('.gem_tab').bind('tab-update', function() {
						if ($set.data('isotope')) {
							$set.isotope('layout');
						}
					});
				}

				$(document).on('gem.show.vc.tabs', '[data-vc-accordion]', function() {
					var $tab = $(this).data('vc.accordion').getTarget();
					if($tab.find($set).length) {
						if ($set.data('isotope')) {
							$set.isotope('layout');
						}
					}
				});

				$(document).on('gem.show.vc.accordion', '[data-vc-accordion]', function() {
					var $tab = $(this).data('vc.accordion').getTarget();
					if($tab.find($set).length) {
						if ($set.data('isotope')) {
							$set.isotope('layout');
						}
					}
				});

				if ($set.closest('.gem_accordion_content').size() > 0) {
					$set.closest('.gem_accordion_content').bind('accordion-update', function() {
						if ($set.data('isotope')) {
							$set.isotope('layout');
						}
					});
				}


				if ($('.portfolio-filters', $portfolio).size() > 0) {
					$('.portfolio-filters, .portfolio-filters-resp ul li', $portfolio).on('click', 'a', function() {
						if ($('.portfolio-load-more', $portfolio).size() == 0 && !$portfolio.hasClass('portfolio-pagination-scroll')) {
							var current_page = $portfolio.data('current-page');
							var filterValue = $(this).data('filter') || '';
							filterValue += '.paginator-page-' + current_page;
							$('.portfolio-filters a.active, .portfolio-filters-resp ul li a.active', $portfolio).removeClass('active');
							$(this).addClass('active');
							$portfolio.itemsAnimations('instance').reinitItems($('.portfolio-set .portfolio-item', $portfolio));
							$('.portfolio-set', $portfolio).isotope({
								filter: filterValue
							});
						} else {
							var filterValue = $(this).data('filter') || '';
							$('.portfolio-filters a.active, .portfolio-filters-resp ul li a.active', $portfolio).removeClass('active');
							$(this).addClass('active');
							$portfolio.data('more-filter', filterValue.substr(1));
							$portfolio.data('next-page', 1);

							if ($portfolio.hasClass('portfolio-pagination-scroll')) {
								portfolio_scroll_load_next_request($portfolio);
							} else {
								portfolio_load_core_request($portfolio);
							}
						}
						if ($('.portfolio-filters-resp', $portfolio).size() > 0)
							$('.portfolio-filters-resp', $portfolio).dlmenu('closeMenu');
						return false;
					});
				}
				$('.info', $portfolio).on('click', 'a:not(.zilla-likes)', function() {
					var slug = $(this).data('slug') || '';
					$('.portfolio-filters a[data-filter=".' + slug + '"]').click();
					return false;
				});
				$('.portfolio-load-more', $portfolio).on('click', function() {
					portfolio_load_core_request($portfolio);
				});
				if ($portfolio.hasClass('portfolio-pagination-scroll')) {
					init_portfolio_scroll_next_page($portfolio);
				}
			});
			$('.portfolio-filters-resp', $portfolio).dlmenu({
				animationClasses: {
					classin : 'dl-animate-in',
					classout : 'dl-animate-out'
				}
			});
		});

		function update_slider_paddings($portfolio) {
				var first_item_height = $('.portfolio-item:first .image-inner', $portfolio).outerHeight();
				var button_height = $('.portolio-slider-prev span', $portfolio).outerHeight();
				$('.portolio-slider-prev', $portfolio).css('padding-top', (first_item_height - button_height) / 2);
				$('.portolio-slider-next', $portfolio).css('padding-top', (first_item_height - button_height) / 2);
		}

		$('.portfolio.portfolio-slider').each(function() {
			var $portfolio = $(this);
			var $set = $('.portfolio-set', this);
			var $prev = $('.portolio-slider-prev span', $portfolio);
			var $next = $('.portolio-slider-next span', $portfolio);

			portfolio_images_loaded($set, '.image-inner img', function() {
				init_circular_overlay($portfolio, $set);
				$set.juraSlider({
				element: '.portfolio-item',
				prevButton: $prev,
				nextButton: $next,
				afterInit: function() {
					$portfolio.prev('.preloader').remove();
				},
				autoscroll: $set.data('autoscroll') ? $set.data('autoscroll') : false
				});
				update_slider_paddings($portfolio);
			});
		});

		$(window).resize(function() {
			$('.portfolio.portfolio-slider').each(function() {
				var $portfolio = $(this);
				setTimeout(function() {
					update_slider_paddings($portfolio);
				}, 10);
			});
		});

		$('body').on('click', 'a.icon.share', function(e) {
			e.preventDefault();
			$(this).closest('.links').find('.portfolio-sharing-pane').toggleClass('active');
			return false;
		});
		$('.portfolio-item').on('mouseleave', function(){
			$('.portfolio-sharing-pane').removeClass('active');
		});

		$('.portfolio').on('click', '.portfolio-item', function() {
			$(this).mouseover();
		});

	});
})(jQuery);
