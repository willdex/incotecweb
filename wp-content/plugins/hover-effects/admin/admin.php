<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	
	//* Add page in admin menu
	add_action('admin_menu', 'wow_admin_menu_he', 999);
	function wow_admin_menu_he() {
		
		add_submenu_page('options-general.php', WOW_HE_NAME, __( WOW_HE_NAME, "wow-he-lang"), 'manage_options', WOW_HE_BASENAME, 'wow_admin_he');	
	}
	
	function wow_admin_he() {
		global $wow_plugin_he;	
		$wow_plugin_he = true;				 
		include_once( 'partials/main.php' );	
		wp_enqueue_style(WOW_HE_BASENAME.'-style', plugin_dir_url(__FILE__) . 'css/style.css',false, WOW_HE_VERSION);
		wp_enqueue_style(WOW_HE_BASENAME.'-hover', WOW_HE_URL. 'asset/css/hover.css', null, WOW_HE_VERSION);
		wp_enqueue_style( 'fontawesome', WOW_HE_URL . 'asset/font-awesome/css/font-awesome.min.css', false, '4.7.0' );
	}	
	//* Footer text
	
	
	add_filter( 'admin_footer_text', 'wow_plugins_admin_footer_text_he' );
		function wow_plugins_admin_footer_text_he( $footer_text ) {
			global $wow_plugin_bm;
			if ( $wow_plugin_bm == true ) {
				$rate_text = sprintf( '<span id="footer-thankyou">Developed by <a href="http://wow-company.com/" target="_blank">Wow-Company</a> | <a href="https://wordpress.org/support/plugin/wow-hover-effects" target="_blank">Support </a> | <a href="https://www.facebook.com/wowaffect/" target="_blank">Join us on Facebook</a></span>');
				return str_replace( '</span>', '', $footer_text ) . ' | ' . $rate_text . '</span>';
			}
			else {
				return $footer_text;
			}
		}
			