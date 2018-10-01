<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'pys_edd_events' ) ) {

	function pys_edd_events() {
        global $post, $posts;

		if ( pys_get_option( 'edd', 'enabled' ) == false || pys_is_edd_active() == false ) {
			return;
		}

		// set defaults params
		$params                 = array();
		$params['content_type'] = 'product';

		// ViewContent Event
		if ( pys_get_option( 'edd', 'on_view_content' ) && is_singular( array( 'download' ) ) ) {

			$params['content_ids'] = "['" . pys_get_edd_content_id( $post->ID ) . "']";
			
			// currency, value
			if ( pys_get_option( 'edd', 'enable_view_content_value' ) ) {
				
				$params['value']    = pys_get_option( 'edd', 'view_content_global_value' );
				$params['currency'] = edd_get_currency();
				
			}
            
            // contents
            $params['contents'] = json_encode( array(
                array(
                    'id'         => (string) $post->ID,
                    'quantity'   => 1,
                )
            ) );
			
			pys_add_event( 'ViewContent', $params, 0 );

			return;

		}
        
        // ViewCategory
        if ( pys_get_option( 'edd', 'on_view_category', true ) && is_tax( 'download_category' ) ) {
            
            $term                   = get_term_by( 'slug', get_query_var( 'term' ), 'download_category' );
            $params['content_name'] = $term->name;
            
            $parent_ids                 = get_ancestors( $term->term_id, 'download_category', 'taxonomy' );
            $params['content_category'] = array();
            
            foreach ( $parent_ids as $term_id ) {
                $term                         = get_term_by( 'id', $term_id, 'download_category' );
                $params['content_category'][] = $term->name;
            }
            
            $params['content_category'] = implode( ',', $params['content_category'] );
            
            $content_ids = array();
            $limit       = min( count( $posts ), 5 );
            
            for ( $i = 0; $i < $limit; $i ++ ) {
                $content_ids[] = (string) $posts[ $i ]->ID;
            }
            
            $params['content_ids']  = json_encode( $content_ids );
            $params['content_type'] = 'product';
    
            pys_add_event( 'ViewCategory', $params );
            
            return;
            
        }

		/**
		 * AddToCart Event (button)
		 *
		 * @see pys_edd_purchase_link_args()
		 */
        
        // AddToCart on Checkout page
        if ( pys_get_option( 'edd', 'on_add_to_cart_checkout' ) && edd_is_checkout() ) {
            
            $ids = array();
            $contents = array();
            
            foreach ( edd_get_cart_contents() as $cart_item ) {
                
                $download_id = intval( $cart_item['id'] );
                $ids[]       = (string) pys_get_edd_content_id( $download_id );
    
                // contents
                $contents[] = array(
                    'id'         => (string) $download_id,
                    'quantity'   => $cart_item['quantity']
                );
                
            }
            
            $params['content_ids'] = json_encode( $ids );
            $params['contents'] = json_encode( $contents );
            
            // currency, value
            if ( pys_get_option( 'edd', 'enable_add_to_cart_value' ) ) {
                
                $params['value']    = pys_get_option( 'edd', 'add_to_cart_global_value' );
                $params['currency'] = edd_get_currency();
                
            }
            
            pys_add_event( 'AddToCart', $params );

        }

		// InitiateCheckout Event
		if ( pys_get_option( 'edd', 'on_checkout_page' ) && edd_is_checkout() ) {

			$ids   = array();

			foreach ( edd_get_cart_contents() as $cart_item ) {

				$download_id = intval( $cart_item['id'] );
				$ids[] = pys_get_edd_content_id( $download_id );

			}

			$params['content_ids'] = "'[" . implode( "','", $ids ) . "']";

			// currency, value
			if ( pys_get_option( 'edd', 'enable_checkout_value' ) ) {

				$params['value']    = pys_get_option( 'edd', 'checkout_global_value' );
				$params['currency'] = edd_get_currency();

			}

			pys_add_event( 'InitiateCheckout', $params );

			return;

		}

		// Purchase Event
		if ( pys_get_option( 'edd', 'on_success_page' ) && edd_is_success_page() ) {

			## skip payment confirmation page
			if( isset( $_GET['payment-confirmation'] ) ) {
				return;
			}

			global $edd_receipt_args;

			$session = edd_get_purchase_session();
			if ( isset( $_GET['payment_key'] ) ) {
				$payment_key = urldecode( $_GET['payment_key'] );
			} else if ( $session ) {
				$payment_key = $session['purchase_key'];
			} elseif ( $edd_receipt_args['payment_key'] ) {
				$payment_key = $edd_receipt_args['payment_key'];
			}

			if ( ! isset( $payment_key ) ) {
				return;
			}

			$payment_id = edd_get_purchase_id_by_key( $payment_key );
			$user_can_view = edd_can_view_receipt( $payment_key );

			if ( ! $user_can_view && ! empty( $payment_key ) && ! is_user_logged_in() && ! edd_is_guest_payment( $payment_id ) ) {
				return;
			}

			$cart   = edd_get_payment_meta_cart_details( $payment_id, true );
			$status = edd_get_payment_status( $payment_id, true );

			## pending payment status used because we can't fire event on IPN
			if( strtolower( $status ) != 'complete' && strtolower( $status ) != 'pending' ) {
				return;
			}
            
            $ids      = array();
            $contents = array();

			foreach ( $cart as $cart_item ) {

				$download_id = intval( $cart_item['id'] );
				$ids[]       = (string) pys_get_edd_content_id( $download_id );
                
                // contents
                $contents[] = array(
                    'id'       => (string) $download_id,
                    'quantity' => $cart_item['quantity']
                );
                
			}
            
            $params['content_ids'] = json_encode( $ids );
            $params['contents']    = json_encode( $contents );

			// currency, value
			if ( pys_get_option( 'edd', 'enable_purchase_value' ) ) {

				$params['value']    = pys_get_option( 'edd', 'purchase_global_value' );
				$params['currency'] = edd_get_currency();

			}

			pys_add_event( 'Purchase', $params );

			return;

		}

	}

}

if ( ! function_exists( 'pys_edd_purchase_link_args' ) ) {

	function pys_edd_purchase_link_args( $args = array() ) {
		global $pys_edd_ajax_events;

		$download_id = $args['download_id'];
		$content_id = (string) pys_get_edd_content_id( $download_id );
		
		$event_id    = uniqid();

		$params                 = array();
		$params['content_type'] = 'product';
		$params['content_ids']  = json_encode( array( $content_id ) );

		// currency, value
		if ( pys_get_option( 'edd', 'enable_add_to_cart_value' ) ) {

			$params['value']    = pys_get_option( 'edd', 'add_to_cart_global_value' );
			$params['currency'] = edd_get_currency();

		}
        
        // contents
        $params['contents'] = json_encode( array(
            'id'       => (string) $content_id,
            'quantity' => 1,
        ) );

		$pys_edd_ajax_events[ $event_id ] = array(
			'name'   => 'AddToCart',
			'params' => $params
		);

		$classes       = isset( $args['class'] ) ? $args['class'] : null;
		$args['class'] = $classes . " pys-event-id-{$event_id}";

		return $args;

	}

}