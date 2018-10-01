<style>
	label{
		width:90%;
		display: block;
		font-size: 14px;
		font-weight: bold;
	}
	textarea{
		width: 70%;
		min-height: 200px;
		font-size: 12px;
	}


</style>




<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;} // Exit if accessed directly
   

if(isset($_POST['subm'])){

if ( ! isset( $_POST['wpwox_noncename'] ) || ! wp_verify_nonce( $_POST['wpwox_noncename'], plugin_basename( __FILE__ )) ) {

   print 'Sorry, your nonce did not verify.';
   exit;

} else {


 global $wpdb;
 $table_name = $wpdb->prefix . 'wpwox_responsive_css';


 $names = $wpdb->get_results("select * from $table_name order by orders", ARRAY_A);
 	foreach ($names as $data) {
	$name = $data['name'];
	$id = $data['id'];


	$text = $_POST["$id"];

	$text= sanitize_text_field($text);
	
	
 		$wpdb->update( 
			$table_name, 
			array( 
				'text' => $text
			), 
			array( 'id' => $id ), 
			array( 
				'%s',	// value1
				'%d'	// value2
			), 
			array( '%d' ) 
			);	
}

 $table_name_custom = $wpdb->prefix . 'wpwox_custom_css';

 $names_custom = $wpdb->get_results("select * from $table_name_custom", ARRAY_A);
 
 	foreach ($names_custom as $data) {
	$id = $data['id'];


	$text = $_POST["custom_css"];

	$text= sanitize_text_field($text);
	

	$wpdb->update( 
			$table_name_custom, 
			array( 
				'text' => $text
			), 
			array( 'id' => $id ), 
			array( 
				'%s',	// value1
				'%d'	// value2
			), 
			array( '%d' ) 
			);

	
}

}
}

?>
    <p>
<a href="?page=responsive_css_editor_setting" class="button-primary" style="float:right;">Click here to setup BreakPoints</a>
</p>
<br>
<?php

 global $wpdb;
 $table_name = $wpdb->prefix . 'wpwox_responsive_css';


$names = $wpdb->get_results("select * from $table_name order by orders", ARRAY_A);


?>
<h2>Add CSS to the defined breakpoints</h2>

<form name="addcsstobreakpoints" method="post">

<?php
/*for custom css*/
$table_name_custom = $wpdb->prefix . 'wpwox_custom_css';


$names_custom = $wpdb->get_results("select * from $table_name_custom", ARRAY_A);



foreach ($names_custom as $data) {
$text= $data['text'];
	$id = $data['id'];

	?>

	<p>
		<label>Custom CSS</label>
		<textarea name="custom_css"><?php echo esc_textarea( $text ); ?></textarea>
	</p>

<?php

}

/*For responsive css*/

foreach ($names as $data) {

	$orders = $data['orders'];
	$name = $data['name'];
	$text= $data['text'];
	$id = $data['id'];

	?>

	<p>
		<label><?php echo esc_textarea($name); ?></label>
		<textarea name="<?php echo $id; ?>"><?php echo esc_textarea( $text ); ?></textarea>
	</p>

<?php

}

 // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'wpwox_noncename' );
?>
<input type="hidden" value="subm" name="subm">
<input type="submit" value="Save Settings" class="button-primary" >


</form>

 <p> To read full documentation about this plugin please visit <a href="http://www.wpwox.com/responsive-css-editor/">WPWOX Responsive CSS Editor</a></p>

