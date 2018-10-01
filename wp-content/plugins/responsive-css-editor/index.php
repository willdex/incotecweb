<?php
/*
Plugin Name: Responsive CSS EDITOR
Plugin URI: http://www.wpwox.com
Description: WPWOX Responsive CSS Editor provides the easier and efficient method to create breakpoints and add css to them.
Version: 1.0
Author: WP WOX
Author URI: http://www.wpwox.com

Copyright 2015 WpWox

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

//Get the plugin location.
define( 'WPWOXRESPONSIVECSS_VERSION', '1.0' );
define( 'WPWOXRESPONSIVECSS__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WPWOXRESPONSIVECSS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );



include('assets/responsivecss.php');

//add admin menu
add_action( 'admin_menu', 'respnosivecssmainmenu' );


function respnosivecssmainmenu() {
	add_menu_page( 'Settings', 'Responsive CSS settings', 'manage_options', 'responsive_css_editor_setting', 'responsive_css_editor_setting_options' );
}

function responsive_css_editor_setting_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
 
    wpwox_respnosive_css_metaboxs();


}





//Displays a box that allows users to insert the scripts for the post or page
function wpwox_respnosive_css_metaboxs() {


  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'wpwox_noncename' );
  include('addbreakpoints.php');

}



/** setup menu for responsive css editor in admin > appearance > responsive editor*/
add_action('admin_menu', 'wpwoxresponsive_editorsss');

function wpwoxresponsive_editorsss() {
  add_theme_page('Responsive CSS', 'Responsive CSS', 'edit_theme_options', 'wpwoxresponsive_editorsss_functions-identifier', 'wpwoxresponsive_editorsss_functions');
}



function wpwoxresponsive_editorsss_functions() {
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
 
  include ('addcsstobreakpoints.php');
}

 


global $wpwox_db_version;
$wpwox_db_version = '1.0';

function wpwox_install_database() {
  global $wpdb;
  global $wpwox_db_version;

  $table_name = $wpdb->prefix . 'wpwox_responsive_css';
  
  
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    orders int NOT NULL,
    name tinytext NOT NULL,
    text longtext NOT NULL,
    UNIQUE KEY id (id)
  ) $charset_collate;";


  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );


  /*for custom css*/
  $table_name_custom = $wpdb->prefix . 'wpwox_custom_css';
    $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $table_name_custom (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    text longtext NOT NULL,
    UNIQUE KEY id (id)
  ) $charset_collate;";


  //require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );

  add_option( 'wpwox_db_version', $wpwox_db_version );
  
}

function wpwox_install_data() {
  global $wpdb;
  global $table_name;
  
  
 $welcomemedias= array( 0 => "@media only screen and (min-width: 1080px)", 1=> "@media only screen and ( min-width: 980px ) and ( max-width: 1080px )", 2=> "@media only screen and ( min-width: 767px ) and ( max-width: 980px ) ", 3=> "@media only screen and ( min-width: 480px ) and ( max-width: 767px ) ", 4=>"@media only screen and ( max-width: 480px ) ");

 
  
  $table_name = $wpdb->prefix . 'wpwox_responsive_css';

  $result = $wpdb->get_results("select `id` from $table_name", ARRAY_A);

  
 
  if(!$result){
   
  
    for($z=0;$z<5; $z++) {
    $wpdb->insert( 
      $table_name, 
      array( 
        'orders' => ($z+1)*10, 
        'name' => $welcomemedias[$z]
      ) 
    );
     }/// end of for loop
 }//end of if

 /*for custom css*/

  $table_name_custom = $wpdb->prefix . 'wpwox_custom_css';

  $result = $wpdb->get_results("select `id` from $table_name_custom", ARRAY_A);
  
 
  if(!$result){
  
    for($z=0;$z<1; $z++) {
    $wpdb->insert( 
      $table_name_custom, 
      array(  
        'text' => '/*Add Custom CSS Here*/', 
      ) 
    );
     }/// end of for loop
 }//end of if

}

register_activation_hook( __FILE__, 'wpwox_install_database' );
register_activation_hook( __FILE__, 'wpwox_install_data' );




?>