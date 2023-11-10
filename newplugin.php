<?php 
/** 
 * @package NewPlugin
 *  
 * Plugin Name:My New Plugin
 * Description:This is my new plugin description
 * Author:Sai Charan
 * Author URI:https://github.com/saicherry 
 * 
*/
 



if ( ! defined("ABSPATH") ) exit;



class NewPlugin
{
  public $plugin;

  function __construct(){
    $this->plugin = plugin_basename( __FILE__ );
    add_action('init', array( $this,'custom_post_type') );
  }

  function register(){
    // by placing 'admin_enqueue_scripts' the files will load at backend, 
    // by placing 'wp_enqueue_scripts' the files will load at frontend
    add_action('admin_enqueue_scripts', array( $this,'enqueue') );

    add_action('admin_menu', array( $this,'add_admin_pages') );

    add_filter( "plugin_action_links_$this->plugin", array( $this,'settings_link') );
  }

  public function settings_link($links) {
   $settings_link = '<a href="admin.php?page=newplugin">My Settings</a>';
   array_push( $links, $settings_link );
   return $links;
  }

  function add_admin_pages() {
    add_menu_page( 'New Admin Page', 'Admin Page', 'manage_options', 'newplugin', array( $this, 'admin_index' ), 'dashicons-podio', 110 );
  }

  public function admin_index() {
     require_once plugin_dir_path( __FILE__ ) .'templates/admin.php';
  }

  function activate() {
    require_once plugin_dir_path( __FILE__ ) . 'inc/alecaddd-plugin-activate.php';
    NewPluginActivate::activate();
  }

   function deactivate(){
    require_once plugin_dir_path( __FILE__ ) . 'inc/alecaddd-plugin-activate.php';
    NewPluginDeactivate::deactivate();

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

register_activation_hook( __FILE__, array( $newPlugin, 'activate' ) );


// require_once( plugin_dir_path( __FILE__ ) .'/inc/newplugin-activate');
// register_activation_hook( __FILE__, array( 'NewPlugin_Activate','activate') );

//deactivation 
register_deactivation_hook( __FILE__, array( $newPlugin,'deactivate') );








?>