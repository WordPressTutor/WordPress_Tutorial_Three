<?
/*
Plugin Name: Login And Logout Plugin
Description : Login and logout plugin details
Author : WordPress Tutorial
*/ 

function add_my_script(){
    wp_enqueue_script('custom_login_script', plugins_url('login.js',__FILE__), array('jquery'), '1.0', true );

   

}

?>