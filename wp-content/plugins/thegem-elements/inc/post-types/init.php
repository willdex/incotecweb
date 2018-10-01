<?php

require_once(plugin_dir_path( __FILE__ ) . 'clients.php');
require_once(plugin_dir_path( __FILE__ ) . 'galleries.php');
require_once(plugin_dir_path( __FILE__ ) . 'news.php');
require_once(plugin_dir_path( __FILE__ ) . 'portfolios.php');
require_once(plugin_dir_path( __FILE__ ) . 'quickfinders.php');
require_once(plugin_dir_path( __FILE__ ) . 'teams.php');
require_once(plugin_dir_path( __FILE__ ) . 'testimonials.php');
require_once(plugin_dir_path( __FILE__ ) . 'slideshows.php');

function thegem_rewrite_flush() {
	thegem_news_post_type_init();
	thegem_portfolio_item_post_type_init();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'thegem_rewrite_flush' );

add_action( 'after_switch_theme', 'flush_rewrite_rules' );