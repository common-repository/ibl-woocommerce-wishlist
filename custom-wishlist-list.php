<?php 
/*
function rational_meta_boxes() {
    require_once( PLUGIN_PATH_DIR.'/class.rational-meta-box.php' );
   $rational_meta_box = new RationalMetaBoxes();
    $rational_meta_box->generate_boxes();
}
add_action( 'admin_init', 'rational_meta_boxes' );

*/
//register our settings

    register_setting( 'WCCWL_plugin-settings-group', 'default_wishlist_name' );
    register_setting( 'WCCWL_plugin-settings-group', 'wishlist_pages' );
    register_setting( 'WCCWL_plugin-settings-group', 'require_login' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_link_wl' );
    register_setting( 'WCCWL_plugin-settings-group', 'remove_product_frm_wl' );
    register_setting( 'WCCWL_plugin-settings-group', 'remove_by_anyone' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_popup' );
    register_setting( 'WCCWL_plugin-settings-group', 'redirect_to_wl' );
    register_setting( 'WCCWL_plugin-settings-group', 'view_wl_btn_text' );
    register_setting( 'WCCWL_plugin-settings-group', 'add_wl_btn_text' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_added_to_wl' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_already_to_wl' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_icon' );  
    register_setting( 'WCCWL_plugin-settings-group', 'product_list_icon' );   
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_wish_icon' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_list_wish_icon' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_btn_position' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_btn_type' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_add_to_wl_icon' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_view_to_wl_icon' );
      register_setting( 'WCCWL_plugin-settings-group', 'product_page_icon_position' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_wishlist_icon_color' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_show_btn_text' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_add_to_wl_btn_text' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_page_view_to_wl_btn_text' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_list_btn_position' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_list_btn_type' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_list_add_to_wl_icon' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_list_view_to_wl_icon' );
     register_setting( 'WCCWL_plugin-settings-group', 'product_list_icon_position' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_list_wishlist_icon_color' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_list_show_btn_text' );
    register_setting( 'WCCWL_plugin-settings-group', 'product_list_add_to_wl_btn_text' );
     register_setting( 'WCCWL_plugin-settings-group', 'product_list_view_to_wl_btn_text' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_add_cart_btn' );
    register_setting( 'WCCWL_plugin-settings-group', 'add_to_cart_txt' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_unit_price' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_stack_status' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_date_addition' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_checkbox' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_action_btn' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_add_selected_cart_btn' );
    register_setting( 'WCCWL_plugin-settings-group', 'add_selected_cart_btn_txt' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_add_all_to_cart_btn' );
    register_setting( 'WCCWL_plugin-settings-group', 'add_all_cart_btn_txt' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_fb_btn' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_twitter_btn' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_google_btn' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_email_btn' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_pinterest_btn' );
    register_setting( 'WCCWL_plugin-settings-group', 'share_on_txt' );
    register_setting( 'WCCWL_plugin-settings-group', 'social_icon_color' );
    register_setting( 'WCCWL_plugin-settings-group', 'wishlist_btn_position' );
    register_setting( 'WCCWL_plugin-settings-group', 'wishlist_icon_color' );
    register_setting( 'WCCWL_plugin-settings-group', 'show_counter_txt' );
    register_setting( 'WCCWL_plugin-settings-group', 'counter_txt' );
      register_setting( 'WCCWL_plugin-settings-group', 'use_theme_style' );
       register_setting( 'WCCWL_plugin-settings-group', 'custom_css' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_bg' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_bg_hover' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_txt' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_txt_hover' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_border_px' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_border_type' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_border' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_border_hover_px' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_border_hover_type' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_wishlist_border_hover' );
           register_setting( 'WCCWL_plugin-settings-group', 'add_cart_bg' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_cart_bg_hover' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_cart_txt' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_cart_txt_hover' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_cart_border_px' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_cart_border_type' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_cart_border' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_cart_border_hover_px' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_cart_border_hover_type' );
        register_setting( 'WCCWL_plugin-settings-group', 'add_cart_border_hover' ); 
        register_setting( 'WCCWL_plugin-settings-group', 'wishlist_tbl_bg' );
        register_setting( 'WCCWL_plugin-settings-group', 'wishlist_tbl_txt' );
         register_setting( 'WCCWL_plugin-settings-group', 'wishlist_tbl_border_px' );
        register_setting( 'WCCWL_plugin-settings-group', 'wishlist_tbl_border_type' );
        register_setting( 'WCCWL_plugin-settings-group', 'wishlist_tbl_border' );
        register_setting( 'WCCWL_plugin-settings-group', 'list_text' );
          register_setting( 'WCCWL_plugin-settings-group', 'wishlist_name' );
        
       
?>