<?php 

function user_exists($username){
global $wpdb,$wp_query;
$parents_table = $wpdb->prefix . 'parents';
$prepare = $wpdb->prepare(
  	"SELECT first_name from $parents_table where username = %s" , $username
  	);
$wpdb->get_results($prepare);
 return (($wpdb->num_rows)>0) ? true : false ; 

}

function get_user_id($username){
global $wpdb,$wp_query;
$parents_table = $wpdb->prefix . 'parents';
$prepare = $wpdb->prepare(
  	"SELECT user_id from $parents_table where username = %s" , $username
  	);
  	// $user_id = $wpdb->get_var($prepare);	
  	// echo " the user id is: " . $user_id;
  	return $wpdb->get_var($prepare);
}

function login($username, $password){
$user_id = get_user_id($username);
$password = md5($password);
global $wpdb,$wp_query;
$parents_table = $wpdb->prefix . 'parents';
$prepare = $wpdb->prepare(
  	"SELECT first_name from $parents_table where username = %s and password = %s" , $username, $password
  	);
$wpdb->get_results($prepare);
return (($wpdb->num_rows)==1) ? $user_id : false ; 
}

function logged_id(){
	return (isset($_SESSION['user_id'])) ? true : false ;
}
?>