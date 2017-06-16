<?php 
/*
Plugin Name: Moh Login
Plugin URI: localhost
Description: for school
Author: Marie
Version: 1.0

*/
if( ! defined( 'ABSPATH')){
  exit;
}
// require (plugin_dir_path(__FILE__) . 'admin/moh-room-fields.php');
// require (plugin_dir_path(__FILE__) . 'admin/moh-rooms-custom-post.php');
// require (plugin_dir_path(__FILE__) . 'admin/moh-manage-bookings.php');
// require_once('vendor/autoload.php');
require_once('classes/Validator.php');
require_once('classes/ErrorHandler.php');
include('queries/queries.php');

      function register_session(){
    if( !session_id() )
        session_start();
}
add_action('init','register_session');

/*
Enqueue Scripts
*/


// function moh_admin_enqueue_scripts(){

//   // wp_enqueue_style( 'moh_enqueue_style', plugins_url('public/css/moh-style.css', __FILE__ ) );
//   // //admin css is specifically for calendar
//   // global $pagenow, $typenow;
//   // if($pagenow == 'edit.php'){
//   // wp_enqueue_style( 'moh_enqueue_admin_style', plugins_url('admin/css/moh-admin.css', __FILE__ ) );
//   // }

//   // wp_enqueue_style('jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css' );
//   // wp_register_script( 'moh_admin_js', plugin_dir_url( __FILE__).'/admin/js/moh-admin.js',  array('jquery', 'jquery-ui-datepicker'), '1', true );   
//   // wp_register_script( 'moh_main_js', plugin_dir_url( __FILE__).'/public/js/moh-main.js',  array('jquery', 'jquery-ui-datepicker'), '1', true );   
//   // wp_localize_script('moh_main_js', 'myAjax', array(
//   //     'security' => wp_create_nonce('moh_check_avail'),
//   //     'security_guest'=>wp_create_nonce('moh_guest'),
//   //     'ajaxurl'  => admin_url('admin-ajax.php'),
//   //     'checkAvail_security'=>wp_create_nonce('moh_check_avail_action'),
//   //     'guest_security'=>wp_create_nonce('moh_ajax_action_guest_info'),
//   //     'payment_security'=>wp_create_nonce('moh_stripe_charge')
//   //     ));
//   // wp_enqueue_script('jquery');
//   // wp_enqueue_script('moh_main_js');
//   // wp_enqueue_script('moh_admin_js');
// }
//add_action('init', 'moh_admin_enqueue_scripts' );

//////////////////////////////////////
//////////   Availabity   ////////////
//////////////////////////////////////
/*
Default Wordpress - no javaScript
*/












      // $prepared_query = $wpdb->prepare(
      //   "SELECT checkin, checkout, room_no , fname, lname, address, email, country, $guests.no_adults, $guests.no_children, arrival,  booking_id, $bookings.guest_id, checkin
      //   FROM $bookings, $guests 
      //     WHERE $bookings.guest_id = $guests.guest_id 
      //     AND checkin < %s
      //      AND checkout > %s" , $depart, $arrive);

    //   $all_rooms_query = $wpdb->prepare(
    //        "SELECT room_no 
    //     FROM $bookings
    //       WHERE checkin < %s
    //        AND checkout > %s" , $depart, $arrive);

       
      
    //   $avail = $wpdb->get_results($prepared_query);
    //   unset($all_rooms_booked_today);
    //   foreach($avail as $get_the_rooms){
    //   $all_rooms_booked_today[] = $get_the_rooms->room_no;
    // }

//$get_all_rooms_booked_each_day = $wpdb->get_results($all_rooms_query);
//       $number_of_bookings = $wpdb->num_rows;
//         foreach($avail as $available){
//          // $all_rooms_booked_today[] = $get_booked_rooms->room_no;
//           //$get_room_no = $available->room_no;
//           // foreach($get_room_no as $get_booked_rooms){
//           //     $get_booked_rooms['room_no'];
//           //   }
//           $adminResponse[] = array(
//            "all_rooms_booked_today"=>$all_rooms_booked_today,
//            "checkin"=>$available->checkin,
//            "checkout"=>$available->checkout,
//             "number_of_bookings"=> $number_of_bookings,
//             "names_of_all_rooms" => $names_of_all_rooms,
//             "total_number_of_rooms" =>$total_number_of_rooms,
//             "data_arr_date" => $arrive,
//             "data_dep_date"=>$depart,
//             "data_room_num" =>  $available->room_no,
//             "data_guest_id" => $available->guest_id,
//              "data_guest_name" =>  $available->fname." ".$available->lname ,
//              "data_booking_id"=>$available->booking_id,
//              "data_arrival_time"=>$available->arrival,
//              "arr_date" => "<p>Check In: ".$arrive."</p>",
//             "dep_date"=>"<p>Check Out: ".$depart."</p>",
//             "room_num" =>"<p>".$available->room_no."</p>",
//             "guest_id" =>"<p>Guest Id: ". $available->guest_id."</p>",
//              "guest_name" =>"<p><b>Name: </b>" .$available->fname." ".$available->lname. "</p>",
//              "booking_id"=>"<p>Booking ID: " . $available->booking_id . "</p>"

//           );
//         }
//       $day_num ++;

//   }

//   wp_send_json_success($adminResponse);


// }
// add_action('wp_ajax_moh_send_admin_data', 'moh_send_admin_data');
// add_action('wp_ajax_nopriv_moh_send_admin_data', 'moh_send_admin_data');





// function moh_send_admin_data_ids(){
//   global $wpdb;
//    $rooms = $wpdb->prefix.'rooms';
//           $get_rooms_in_db = $wpdb->get_results( $wpdb->prepare(
//             "SELECT * from $rooms"));
//     foreach($get_rooms_in_db as $rooms_in_db){
//       $all_rooms_in_db[] = $rooms_in_db->actual_rm_no;
//     }
//     wp_send_json_success($all_rooms_in_db );

// }


// add_action('wp_ajax_moh_send_admin_data_ids', 'moh_send_admin_data_ids');
// add_action('wp_ajax_nopriv_moh_send_admin_data_ids', 'moh_send_admin_data_ids');




add_action('admin_post_nopriv_moh_login', 'moh_login');
add_action('admin_post_moh_login', 'moh_login');
function moh_login(){
    if(!empty($_POST)){
      $username = $_POST['username'];
      $password = $_POST['password'];
    if(empty($username) || empty($password)){
      $errors[] = "fill in both username and password";
      wp_die($errors[0]);
    } 
      if(!user_exists($username)){
        $errors[]= "user doesn't exist";
        wp_die($errors[0]);
      }
      //get_user_id($username);
      $login = login($username, $password);
      if(!$login){
        $errors[] = "incorrect user or password";
        echo "bad";
      }else{
        echo "ok to log in";
        //set session
        $_SESSION['user_id']= $login;
        //header(Location: 'index.php');
        $url = site_url();
        wp_redirect(  $url.'/class'  );
        exit;
        //exit();
        //redirect to class page
      }


      //var_dump($errors);

      $errorHandler = new ErrorHandler;

    $validator = new Validator($errorHandler);  

    $validation = $validator->check($_POST,[
        'username' => [
          'required' => true,
          'maxlength' => 21,
          'minlength' => 2,
          'alnum' =>true
        ],
        'password' =>[
          'required' => true,
          'maxlength' => 21,
          'minlength' => 2
        ]
        ]);
      //var_dump($validation->errors());

if($validation->fails()){
    echo'<pre>',print_r($validation->errors()->all()) , '</pre>';
    // foreach($validation->errors()->all() as $er){
    //   echo "<p>".$er."</p>";
    // }

  }

    }


}

add_action('admin_post_nopriv_moh_logout', 'moh_logout');
add_action('admin_post_moh_logout', 'moh_logout');
function moh_logout(){

  session_start();
  session_destroy();
  $url = site_url();
        wp_redirect( $url );
        exit;
  }

    
  














/////////////////////////////////////
////////       Widget       /////////
/////////////////////////////////////

//register widget area in divi-child theme functions.php
//body of widget in moh-booking plugin index.php
//add widget to page in wp admin widget area

class moh_login extends WP_Widget{
  function __construct(){
    parent::__construct(false, $name = __('MOH Login'));
}
function form($instance){

}
function update($new_instance, $old_instance){

}
//output widget info
function widget($args, $instance){
   ?>
   <h1>This is the widget</h1>
    <div class="widget check-avail">
      <h4>Login Widget</h4>
      <?php include 'moh-index.php';?>
   


    </div> 
    <?php

  }

}

//initialise widget
add_action('widgets_init', function(){
  register_widget('moh_login');
});




/////////////////////////////////////
////////Add Tables To Database///////
/////////////////////////////////////
register_activation_hook( __FILE__, 'moh_install' );
//register_activation_hook( __FILE__, 'moh_install_data' );

function moh_install () {
   global $wpdb;

   $charset_collate = $wpdb->get_charset_collate();

  $parents_table = $wpdb->prefix . 'parents';
  

  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $parents_table (
  user_id mediumint(9) NOT NULL AUTO_INCREMENT,
  username varchar(32) NOT NULL,
  password varchar(32) NOT NULL,
  first_name varchar(32) NOT NULL,
  last_name varchar(32) NOT NULL,
  email varchar(1024),
  jnr int(11) DEFAULT 0,
  snr int(11) DEFAULT 0,
  first int(11) DEFAULT 0,
  second int(11) DEFAULT 0,
  third int(11) DEFAULT 0,
  fourth int(11) DEFAULT 0,
  fifth int(11) DEFAULT 0,
  sixth int(11) DEFAULT 0, 
  other_1 int(11) DEFAULT 0,
  other_2 int(11) DEFAULT 0, 
  master int(11) DEFAULT 0,
  PRIMARY KEY  (user_id)
  ) $charset_collate;";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
}
?>