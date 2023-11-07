<?php 
/*
 Plugin Name:My New Plugin
 Description:This is my new plugin description
 Author:Sai Charan
 Author URI:https://github.com/saicherry
*/


if ( ! defined("ABSPATH") ) exit;



class NewPlugin
{
  function __construct(){
    add_action('init', array( $this,'custom_post_type') );
  }

   function activate(){
    // generated a CPT
    $this->custom_post_type();
    // flush rewrite rules
    flush_rewrite_rules();
   }

   function deactivate(){
    // flush rewrite rules
    flush_rewrite_rules();

   }

   function custom_post_type(){
   register_post_type( 'book', ['public' => true, 'label' => 'Books' ] );
   }
}


if ( class_exists( 'NewPlugin')){
    $newPlugin = new NewPlugin();
}

//activation 
register_activation_hook( __FILE__, array( $newPlugin,'activate') );

//deactivation 
register_deactivation_hook( __FILE__, array( $newPlugin,'deactivate') );








?>