<?php
/**
 * Plugin Name:       Hover Effects
 * Plugin URI:        https://wordpress.org/plugins/hover-effects/
 * Description:       Hover Effect is easily applied to your own elements, modified or just used for inspiration.
 * Version:           2.1
 * Author:            Wow-Company
 * Author URI:        http://wow-company.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
  */
if ( ! defined( 'WPINC' ) ) {die;}
	// Declaration Wow-Company class
	if( !class_exists( 'Wow_Company' )) {
		require_once plugin_dir_path( __FILE__ ) . 'include/class/wow-company.php';				
	}	
	if( !class_exists( 'WOW_DATA' )) {
		require_once plugin_dir_path( __FILE__ ) . 'include/class/data.php';
	}
	if( !class_exists( 'JavaScriptPacker' )) {
		require_once plugin_dir_path( __FILE__ ) . 'include/class/packer.php';
	}
	// Declaration of the plugin class
	if( !class_exists( 'Hover_Effects_Class' ) ) {
		class Hover_Effects_Class
		{				
			function __construct() {
				$this->name = 'Hover Effects';
				$this->version = '2.1';				
				$this->pluginname = dirname(plugin_basename(__FILE__));
				$this->plugindir = plugin_dir_path( __FILE__ );
				$this->pluginurl = plugin_dir_url( __FILE__ );									
				// admin pages
				add_action( 'admin_menu', array($this, 'add_menu_page') );
											
				// add general style
				add_action( 'wp_enqueue_scripts', array($this, 'plugin_scripts') );
				// admin links
				add_filter( 'plugin_row_meta', array($this, 'row_meta'), 10, 4 );
				add_filter( 'plugin_action_links', array($this, 'action_links'), 10, 2 );
						
			}
			
			// AdminPanel
			function add_menu_page() {
				add_submenu_page('wow-company', $this->name, $this->name, 'manage_options', $this->pluginname, array( $this, 'plugin_admin' ));
			}
			function plugin_admin() {
				$name = $this->name;	
				$pluginname = $this->pluginname;
				$version = $this->version;
				global $wow_company_plugin;	
				$wow_company_plugin = true;
				include_once( 'admin/partials/main.php' );
				self:: plugin_admin_style_script();				
			}					
			function plugin_admin_style_script() {
				// plugin sctyle & script			
				wp_enqueue_style( $this->pluginname.'-style', $this->pluginurl . 'admin/css/style.css',false, $this->version);
				wp_enqueue_script($this->pluginname.'-script', $this->pluginurl . 'admin/js/script.js', array('jquery'), $this->version);
				// icon style
				wp_enqueue_style( $this->pluginname.'-icon', $this->pluginurl . 'asset/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
				wp_enqueue_style( $this->pluginname, plugin_dir_url( __FILE__ ) . 'asset/css/hover.css', array(), $this->version);
			}		
			
			// General plugin styles & scripts
			function plugin_scripts(){
				wp_enqueue_style( $this->pluginname, plugin_dir_url( __FILE__ ) . 'asset/css/hover.css', array(), $this->version);
			}
			// Admin links
			function row_meta( $meta, $plugin_file ){
				if( false === strpos( $plugin_file, basename(__FILE__) ) )
				return $meta;
				$meta[] = '<a href="https://wordpress.org/support/plugin/hover-effects/" target="_blank">Support </a> ';
				return $meta;
			}
			function action_links( $actions, $plugin_file ){
				if( false === strpos( $plugin_file, basename(__FILE__) ) )
				return $actions;
				$settings_link = '<a href="admin.php?page='. $this->pluginname .'">Settings</a>'; 
				array_unshift( $actions, $settings_link ); 
				return $actions; 
			}
					
		}
		$plugin = new Hover_Effects_Class();		
	}			