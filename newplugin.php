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

  function register(){
    // by placing 'admin_enqueue_scripts' the files will load at backend, 
    // by placing 'wp_enqueue_scripts' the files will load at frontend
    add_action('admin_enqueue_scripts', array( $this,'enqueue') );
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

   function enqueue(){
     // enqueue all our scripts
    wp_enqueue_style('mypluginstyle', plugins_url('./assets/mystyles.css', __FILE__ ) );
    wp_enqueue_script('mypluginscript', plugins_url('./assets/myscripts.js', __FILE__ ) );
    }
}


if ( class_exists( 'NewPlugin')){
    $newPlugin = new NewPlugin();
    $newPlugin->register();
}

//activation 
register_activation_hook( __FILE__, array( $newPlugin,'activate') );

//deactivation 
register_deactivation_hook( __FILE__, array( $newPlugin,'deactivate') );








?>