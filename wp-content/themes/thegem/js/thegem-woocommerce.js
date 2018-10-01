(function($) {
	$('.variations_form').each(function() {
		$form = $(this)
			.on('change', '.variations select', function(event) {
				var $text = $(this).closest('.combobox-wrapper').find('.combobox-text');
				$text.text($('option:selected', $(this)).text());
			});
	});

	$('body').on('updated_checkout', function() {
		$('input.gem-checkbox').checkbox();
		$('select.shipping_method').combobox();
		window.init_checkout_navigation();
	});

	$('body').on('updated_shipping_method', function() {
		$('input.gem-checkbox').checkbox();
		$('select.shipping_method').combobox();
	});

	$('.remove_from_wishlist_resp').on('click', function(e) {
		$(this).closest('.cart-item').find('.wishlist_table .product-remove .remove_from_wishlist').click();
		e.preventDefault();
        return false;
    });

	$(function() {
		$('.price_slider_amount .button').addClass('gem-button gem-button-style-outline gem-button-size-tiny');
	});

	// Quantity buttons
	$( 'form:not(.cart) div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<button type="button" class="plus" >+</button>' ).prepend( '<button type="button" class="minus" >-</button>' );

	$( document ).on( 'click', '.plus, .minus', function() {

		// Get values
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

	});

	$( document ).on( 'click', '.product-bottom a.add_to_cart_button', function() {
		$(this).closest('.product-bottom').find('a').hide();
	});

	$( document ).on( 'click', '.product-bottom a.add_to_wishlist', function() {
		$(this).closest('.product-bottom').find('a').hide();
		$(this).closest('.product-bottom').find('.yith-wcwl-wishlistaddedbrowse a').show();
	});


	$( document ).on( 'click', '.woocommerce-review-link', function(e) {
		$('.gem-woocommerce-tabs').find('a[data-vc-accordion][href="#tab-reviews"]').trigger('click');
	});

	$(function() {
		if(typeof wc_add_to_cart_variation_params !== 'undefined') {
			$('.variations_form').each( function() {
				$(this).on('show_variation', function(event, variation) {
					if(variation.image_link) {
						var $product_content = $(this).closest('.single-product-content');
						var $gallery = $product_content.find('.gem-gallery').eq(0);
						if($gallery.length) {
							var $gallery_item = $gallery.find('.gem-gallery-thumbs-carousel .gem-gallery-item a[data-full-image-url="'+variation.image_link+'"]');
							$gallery_item.closest('.gem-gallery-item').addClass('active');
							$gallery_item.trigger('click');
						}
					}
				});
			});
		}
	});

	$(document.body).on('updated_wc_div', function() {
		$( '.shop_table.cart' ).closest( 'form' ).eq(0).nextAll('.woocommerce-message').remove();
		$( '.shop_table.cart' ).closest( 'form' ).eq(0).nextAll('.woocommerce-info').remove();
		$( '.shop_table.cart' ).closest( 'form' ).eq(1).nextAll('form').remove();
		$('input.gem-checkbox').checkbox();
		$('select.shipping_method').combobox();
		$( 'form:not(.cart) div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<button type="button" class="plus" >+</button>' ).prepend( '<button type="button" class="minus" >-</button>' );
	});

})(jQuery);
