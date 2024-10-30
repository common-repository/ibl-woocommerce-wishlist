<?php
/**
Plugin Name:  IBL WooCommerce Wishlist Plugin
Plugin URI: https://iblinfotech.com/ibl-woocommerce-wishlist-plugin
Description: Just another wishlist form plugin. Simple but flexible.
Author: Ibl infotech
Text Domain: ibl-woocommerce-wishlist
Author URI: https://iblinfotech.com/
Domain Path: /languages/
Version: 1.0.0
*/
/*if the file is called directly,abort*/
if( ! defined('ABSPATH')){
  die;
}
if( ! defined('WCCWL_PREFIX')){
  define('WCCWL_PREFIX','wccwishl');
}
if( ! defined('WCCWL_DOMAIN')){
  define('WCCWL_DOMAIN', 'ibl-woocommerce-wishlist');
}
if( ! defined('WCCWL_PATH')){
  define('WCCWL_PATH', plugin_dir_path(__FILE__));
}
if( ! defined('WCCWL_BASENAME')){
  define('WCCWL_BASENAME',plugin_basename(__FILE__));
}
if( ! defined ('WCCWL_PLUGIN_PATH')){
  define('WCCWL_PLUGIN_PATH' , __FILE__);
}
if (! defined('WCCWL_PLUGIN_PATH_DIR')){
  define('WCCWL_PLUGIN_PATH_DIR', untrailingslashit(dirname(PLUGIN_PATH)));
}
if ( ! class_exists( 'WCCWLSettingPage' ) ) {
  class WCCWLSettingPage{
    public function __construct(){
      add_action('admin_menu',array($this,'wccwl_wishlist_page') );
      add_action('admin_init', array($this,'wccwl_register_custom_plugin_settings') );
      add_action('admin_init',array($this,'wccwl_wishlist_plugin_dependency'));  
      add_action( 'admin_enqueue_scripts', array($this,'wccwl_backend_scripts'));
      add_action('wp_enqueue_scripts', array($this,'wccwl_backend_styles' ));
      add_action('admin_enqueue_scripts', array($this,'wccwl_admin_wishlist_styles' ));
      register_activation_hook( WCCWL_PATH.'/wc-custom-wishlist.php', array($this,'wccwl_wishlist_activate' ));
      register_deactivation_hook( WCCWL_PATH.'/wc-custom-wishlist.php', array($this,'wccwl_wishlist_deactivate'));
    }

    public function wccwl_admin_wishlist_styles(){
      wp_enqueue_script( 'custom-wishlist', plugins_url(  '/js/custom_wishlist.js',__FILE__), array('jquery') , false );
      if(sanitize_text_field($_GET['page']) ==WCCWL_DOMAIN )
      {
        wp_enqueue_script( 'wishlist-bootstrap', plugins_url(  '/js/bootstrap.min.js',__FILE__), array('jquery') , false );
        wp_enqueue_style('wilist-bootcss',plugins_url('/css/bootstrap.min.css',__FILE__));
      }
    }
    public function wccwl_backend_styles(){
     wp_enqueue_style( 'custom-wl-style', plugins_url( '/css/wl-addcart.css', __FILE__ ),array(),'');
     wp_enqueue_style('font-icon-awesome',plugins_url('/css/font-awesome.min.css',__FILE__));
     if ( is_product() || is_shop() || is_category() ){ 
      wp_enqueue_script( 'wishlist-bootstrap', plugins_url(  '/js/bootstrap.min.js',__FILE__), array('jquery') , false );
      wp_enqueue_style('wilist-bootcss',plugins_url('/css/bootstrap.min.css',__FILE__));
    }
  }
  public function wccwl_wishlist_page(){       
    add_menu_page( 'IBL WooCommerce Wishlist', 'IBL WooCommerce Wishlist', 'manage_options', WCCWL_DOMAIN, array($this,'wccwl_wishlist_manu_options'),'dashicons-heart',2 ); 
    add_submenu_page(
      'custom_wishlist',
      'Setting',
      'Setting',
      'manage_options',
      WCCWL_DOMAIN,
      array($this,'wccwl_wishlist_manu_options') );
  }
  public function wccwl_register_custom_plugin_settings() {
    include('custom-wishlist-list.php');
  }   

  public function wccwl_wishlist_manu_options(){
    if( is_admin() ) 
     include('custom-wishlist-design.php');
 }
 public   function wccwl_wishlist_activate() {
   if ( is_admin() ) 
    if ( ! current_user_can( 'activate_plugins' ) ) return;
  $this->wccwl_wishlist_plugin_dependency();
  global $wpdb;
  $the_page_title = 'Wishlist';
  $the_page_name = 'wishlist';
        // the menu entry...
  delete_option("wccwl_page_title");
  add_option("wccwl_page_title", $the_page_title, '', 'yes');
        // the slug...
  delete_option("wccwl_page_name");
  add_option("wccwl_page_name", $the_page_name, '', 'yes');
        // the id...
  delete_option("wccwl_page_id");
  add_option("wccwl_page_id", '0', '', 'yes');
  $the_page = get_page_by_title( $the_page_title );
  if ( ! $the_page ) {
            // Create post object
    $_p = array();
    $_p['post_title'] = $the_page_title;
    $_p['post_content'] = "[wishlist]";
    $_p['post_status'] = 'publish';
    $_p['post_type'] = 'page';
    $_p['comment_status'] = 'closed';
    $_p['ping_status'] = 'closed';
    $_p['post_category'] = array(1); 
  // Insert the post into the database
    $the_page_id = wp_insert_post( $_p );
  }
  else {
  // the plugin may have been previously active and the page may just be trashed...
    $the_page_id = $the_page->ID;
   //make sure the page is not trashed...
    $the_page->post_status = 'publish';
    $the_page_id = wp_update_post($the_page_id);
  }
  delete_option( 'my_plugin_page_id' );
  add_option( 'my_plugin_page_id', $the_page_id );
  flush_rewrite_rules();
}
public function wccwl_wishlist_deactivate() {
  if ( is_admin() )
    delete_option("custom-wishlist-options");
  flush_rewrite_rules();
}
public function wccwl_wishlist_plugin_dependency() {
  if( ! class_exists('WooCommerce')){
    add_action('admin_notices', array($this,'my_acf_admin_warning') );
  }
  else{$this->my_plugin_redirect();
  }
}
public function wccwl_backend_scripts( $hook ) {
  wp_enqueue_style( 'wp-color-picker');
  wp_enqueue_script( 'wp-color-picker-script', plugins_url('/js/custom_wishlist.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
public function my_plugin_redirect(){
  if (get_option('custom-wishlist-options', false)) {
              //delete_option("custom-wishlist-options");
   wp_redirect("admin.php?page=custom_wishlist");
         //wp_redirect() does not exit automatically and should almost always be followed by exit.
   exit;
 }
}

public function my_acf_admin_warning(){?>
<div class="notice error my-acf-notice is-dismissible" >
  <p><?php _e( ' wc custom  WooCommerce Wishlist is enabled but not effective. It requires WooCommerce in order to work. ', WCCWL_DOMAIN ) ?></p>
</div><?php
}}}
$my_settings_page = new WCCWLSettingPage();
include('wishlist.php');
include('wishlist-list.php');
?>