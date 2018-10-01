     <style type="text/css">
    label{
      display: inline-block;
      clear: left;
      text-align: left;
      width: 200px;
      vertical-align: top;
      padding: 5px 0;
    }
    input[type="text"], textarea {
      margin-left: 5px;
    }
    .radiobtn{
      width: 50px;
      clear: both;
      display: inline;
      margin-right: 50px;
    }

    .radiolabel{
      width: 100%;
    }

    textarea{
      width:300px;
      height: 150px;
    }
    .first td{
      font-size: 14px;
      font-weight: bold;
    }

 table td{ padding: 3px;}
    </style>

    <?php 
    if ( ! defined( 'ABSPATH' ) ) {
    exit;} // Exit if accessed directly

    global $wpdb;
   $table_name = $wpdb->prefix . 'wpwox_responsive_css';

    $names = $wpdb->get_results("select * from $table_name order by orders", ARRAY_A);
    
      foreach ($names as $data) {
       
      $orders = $data['orders']; 

    }

    if(!isset($orders)){
      $orders=0;
    }



   // process form data

    /*for deleting breakpoints*/
    if(isset($_GET['deletebreakpoints'] )&& $_GET['deletebreakpoints']=="true"){
            $id = $_GET['bid'];
            $id = strip_tags($id);


            $result = $wpdb->get_results("SELECT * from $table_name where id = $id", ARRAY_A);
            foreach ($result as $data) {
              $orderofitem = $data['orders'];
            }


            $wpdb->delete( $table_name, array( 'id' => $id ) );

            $result = $wpdb->get_results("select * from $table_name where orders > $orderofitem", ARRAY_A);
            foreach ($result as $data) {

              $id = $data['id'];
              $order = $data['orders'];
              $order = $order-10;

              $wpdb->update( 
                  $table_name, 
                  array( 
                    'orders' => $order
                  ), 
                  array( 'id' => $id ), 
                  array( 
                    '%s', // value1
                    '%d'  // value2
                  ), 
                  array( '%d' ) 
                  );


            }


    }

    /*finish deleting breakpoints*/

    /*for updating orders*/
if(isset($_GET['updateorder']) && $_GET['updateorder']=="true"){
      $position = $_GET['clicked'];
    $clickedorder = $_GET['order'];

    $position = strip_tags ($position);
    $clickedorder = strip_tags($clickedorder);


    $lastorder = "100";

    $name = $wpdb->get_results('select * from '.$table_name.' order by orders', ARRAY_A);


    foreach ($name as $testforlast) {
        $lastorder = $testforlast['orders'];
        //echo $lastorder;
      }

    $names = $wpdb->get_results("select * from $table_name where orders= $clickedorder", ARRAY_A);

    foreach ($names as $data) {
      if($position=="up" && $clickedorder>10){
        $lowerorder= $clickedorder-10;
        $lower_id = $data['id'];
        $upvalue = $wpdb->get_results("select * from $table_name where orders= $lowerorder", ARRAY_A);
        
        foreach ($upvalue as $newdata) {
        
          $upperorder = $clickedorder;
          $upper_id = $newdata['id'];
          //echo $upperorder;
          //echo "up";
        }


        $wpdb->update( 
          $table_name, 
          array( 
            'orders' => $lowerorder
          ), 
          array( 'id' => $lower_id ), 
          array( 
            '%s', // value1
            '%d'  // value2
          ), 
          array( '%d' ) 
          );
        $wpdb->update( 
          $table_name, 
          array( 
            'orders' => $upperorder
          ), 
          array( 'id' => $upper_id ), 
          array( 
            '%s', // value1
            '%d'  // value2
          ), 
          array( '%d' ) 
          );


      }
    else if($position=="down" && $lastorder!=$clickedorder ){
        $upperorder= $clickedorder+10;
        $upper_id = $data['id'];
        $downvalue = $wpdb->get_results("select * from $table_name where orders= $upperorder", ARRAY_A);
        
        foreach ($downvalue as $newdata) {
          $lowerorder = $clickedorder;
          $lower_id = $newdata['id'];
        }

        $wpdb->update( 
          $table_name, 
          array( 
            'orders' => $lowerorder
          ), 
          array( 'id' => $lower_id ), 
          array( 
            '%s', // value1
            '%d'  // value2
          ), 
          array( '%d' ) 
          );
        $wpdb->update( 
          $table_name, 
          array( 
            'orders' => $upperorder
          ), 
          array( 'id' => $upper_id ), 
          array( 
            '%s', // value1
            '%d'  // value2
          ), 
          array( '%d' ) 
          );

      }


     }



}

    /*finish updating orders*/

    /*for adding breakpoints*/

    if(isset($_POST['first_value'])){
          if ( ! isset( $_POST['wpwox_noncename'] ) || ! wp_verify_nonce( $_POST['wpwox_noncename'], plugin_basename( __FILE__ ) ) ) {

   print 'Sorry, your nonce did not verify.';
   exit;

} else {

      $first = $_POST['first'];
      $first_value = $_POST['first_value'];

      $first = esc_html($first);
      $first_value = esc_html($first_value);


      if(($_POST['second']!="none") && isset($_POST['second_value']) ){
        $second = $_POST['second'];
        $second_value = $_POST['second_value'];

         $second = esc_html($second);
        $second_value = esc_html($second_value);

        $name = "@media only screen and (".$first.":".$first_value."px ) and (".$second.":".$second_value."px)";
      }
      else{
        $name = "@media only screen and (".$first.":".$first_value."px )";
      }

      $orders= $orders+10;
      

      $wpdb->insert( 
          $table_name, 
          array( 
            'orders' => $orders, 
            'name' => $name
          )
        );

    }
    }

  ?>


   <a href="?page=wpwoxresponsive_editorsss_functions-identifier" class="button-primary" style="float: right;">Add CSS to the defined breakpoints</a>
   <br>
    <h2>Responsive CSS Break Point Settings</h2>
      <form method="post" action="?page=responsive_css_editor_setting&deleteorder=false&updateorder=false">

  <table style=" margin: 20px 0; background: #ffffff none repeat scroll 0 0; border: 1px solid #cccccc; width: 100%; max-width: 900px;">
    <tr class="first">
    <td>S.N.</td><td>Order</td><td>Media Query</td><td> Delete</td>
  </tr>


  <?php 
  
 
    $id = 1;
    $names = $wpdb->get_results("select * from $table_name order by orders", ARRAY_A);
     
      foreach ($names as $data) {
      
    
  ?>

  <tr>
    <td><?php echo $id; ?> </td><td><a href="?page=responsive_css_editor_setting&deleteorder=false&updateorder=true&clicked=up&order=<?php echo $data['orders']; ?>"><img src="<?php echo WPWOXRESPONSIVECSS__PLUGIN_URL; ?>assets/up_aro.png" style="width: 20px;"></a> <a href="?page=responsive_css_editor_setting&deleteorder=false&updateorder=true&clicked=down&order=<?php echo $data['orders']; ?>"><img src="<?php echo WPWOXRESPONSIVECSS__PLUGIN_URL; ?>assets/down_aro.png"  style="width: 20px;"></a></td><td> <?php echo $data['name'];?>
    </td><td> <a href= "?page=responsive_css_editor_setting&updateorder=false&deletebreakpoints=true&bid=<?php echo $data['id']; ?>"><img src="<?php echo WPWOXRESPONSIVECSS__PLUGIN_URL; ?>assets/delete icon.png"  style="width: 20px;"></a></td>
  </tr>
  <?php $id++;
  $orders = $data['orders']; } ?>


   </table> 

    <h2>Add New Responsive Breakpoint</h2>


  <table style=" margin: 20px 0; background: #ffffff none repeat scroll 0 0; border: 1px solid #cccccc; width: 100%; max-width: 900px;">

  <tr>
    <td>@media only screen and (
    <select name="first">
      <option value="max-width">max-width:</option>
      <option value = "min-width">min-width:</option>
  </select>
      <input type="text" value="" style="width:50px;" name="first_value"  placeholder="100">px) and (
  <select name="second">
    <option value="none" >none</option>
    <option value="max-width">max-width:</option>
    <option value = "min-width">min-width:</option>
  </select> <input type="text" value="" name="second_value" style="width:50px;" placeholder="100">px) 
 <?php // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'wpwox_noncename' );
  ?>
  <input type="submit" name="Submit" class="button-primary" value="Add New" />
            <input type="hidden" name="footerflyout" value="save" style="display:none;" />
            </td>
  </tr>

   </table> 

     
      </form>

     <p> To read full documentation about this plugin please visit <a href="http://www.wpwox.com/responsive-css-editor/">WPWOX Responsive CSS Editor</a></p>