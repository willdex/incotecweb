<?php 


    if ( ! defined( 'ABSPATH' ) ) {
    exit;} 
    
function wpwox_add_responsive_css() {



	echo '<style type="text/css" id="wpwox_add_responsive_css">';
	  wpwox_add_css();
	  echo '</style>';
}
add_action( 'wp_head', 'wpwox_add_responsive_css', 9000);



function wpwox_add_css(){

	echo "/*-----CSS FROM PLUGIN-----*/";
//require_once('../../../../wp-load.php');
 global $wpdb;

$table_name_custom = $wpdb->prefix . 'wpwox_custom_css';

  $names_custom = $wpdb->get_results("select * from $table_name_custom", ARRAY_A);
 
 	foreach ($names_custom as $data) {
 	
 	$text = $data['text'];

 	$text = esc_textarea( $text );
 	echo $text;

}
echo "/*-----CUSTOM CSS ENDS HERE-----*/";

echo "/*Responsive css starts here*/";
 $table_name = $wpdb->prefix . 'wpwox_responsive_css';

  $names = $wpdb->get_results("select * from $table_name order by orders", ARRAY_A);

 	foreach ($names as $data) {
 
 	$name = $data['name'];
 	$name= esc_textarea($name);
 	$text = $data['text'];
 	$text = esc_textarea( $text );

echo "/*-----START OF BREAKPOINT-----*/";

 echo $name."{".$text."}";

echo "/*-----END OF BREAKPOINT-----*/";

 }
}
?>