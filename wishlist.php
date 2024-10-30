<?php 
if( ! defined('ABSPATH')){
  die;
}
// session_start();
add_filter( 'body_class', 'WCCWL_custom_class' );
if (!function_exists('WCCWL_custom_class')){
  function WCCWL_custom_class( $classes ) {
    $classes[] = 'wishlist';
    return $classes;
  }
}
add_action('admin_head', 'WCCWL_wishlist_custom_styles', 100);
if (!function_exists('WCCWL_wishlist_custom_styles')){
  function WCCWL_wishlist_custom_styles()
  {
    $getpage = sanitize_text_field($_GET['page']);
    if($getpage == WCCWL_DOMAIN)
    {
      ?>
      <script type="text/javascript">
        function  valueChanged(){
          var $=jQuery;
          if($('.theme_chk').is(":checked"))   
            $(".theme_check_class").hide(200);
          else
            $(".theme_check_class").show(300);
        }
      </script>
      <style>
        .panel.with-nav-tabs .panel-heading{
          padding: 5px 5px 0 5px;
        }
        .panel.with-nav-tabs .nav-tabs{
          border-bottom: none;
        }
        .panel.with-nav-tabs .nav-justified{
          margin-bottom: -1px;
        }
        .with-nav-tabs.panel-default .nav-tabs > li > a,
        .with-nav-tabs.panel-default .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li > a:focus {
          color: #777;
        }
        .with-nav-tabs.panel-default .nav-tabs > .open > a,
        .with-nav-tabs.panel-default .nav-tabs > .open > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > .open > a:focus,
        .with-nav-tabs.panel-default .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li > a:focus {
          color: #777;
          background-color: #ddd;
          border-color: transparent;
        }
        .with-nav-tabs.panel-default .nav-tabs > li.active > a,
        .with-nav-tabs.panel-default .nav-tabs > li.active > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li.active > a:focus {
          color: #555;
          background-color: #fff;
          border-color: #ddd;
          border-bottom-color: transparent;
        }
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu {
          background-color: #f5f5f5;
          border-color: azure;
        }
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a {
          color: #777;   
        }
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
          background-color: #ddd;
        }
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a,
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
          color: #fff;
          background-color: #555;
        }
        .panel {
          border: cadetblue !important;
        }
        .button.button-primary {
          margin-left: 1% !important;
        }
        .input_class{
          height: 30px;
        }
        .select_class{
          height: 33px !important;
        }
        .switch {
          position: relative;
          display: inline-block;
          width: 60px;
          height: 34px;
        }
        .switch input {display:none;}
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }
        .slider:before {
          position: absolute;
          content: "";
          height: 26px;
          width: 26px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }
        input:checked + .slider {
          background-color: #2196F3;
        }
        input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }
        input:checked + .slider:before {
          -webkit-transform: translateX(26px);
          -ms-transform: translateX(26px);
          transform: translateX(26px);
        }
        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }
        .slider.round:before {
          border-radius: 50%;
        }
      </style>
      <?php } } }?>
      <?php
      if (!function_exists('WCCWL_wishlist_init')){
        function WCCWL_wishlist_init(){
         wp_enqueue_style( 'font-wl-style', plugins_url( 'fontIconPicker/css/jquery.fonticonpicker.min.css', __FILE__ ),array(),'');
         wp_enqueue_style('font-icon-picker',plugins_url('fontIconPicker/fontello-7275ca86/css/fontello.css',__FILE__));
         wp_enqueue_style('font-icon-style',plugins_url('fontIconPicker/icomoon/style.css',__FILE__));
         wp_enqueue_script( 'fontpicker', plugins_url(  'fontIconPicker/jquery.fonticonpicker.min.js',__FILE__), array('jquery') , false );
         wp_enqueue_script( 'jscolor', plugins_url(  '/js/jscolor.js',__FILE__), array('jquery'), false );
       }
     }
     add_filter( 'woocommerce_loop_add_to_cart_args', 'WCCWL_filter_woocommerce_loop_add_to_cart_args', 10, 2 );
     if (!function_exists('WCCWL_filter_woocommerce_loop_add_to_cart_args')){
       function WCCWL_filter_woocommerce_loop_add_to_cart_args( $args, $product ) {
        $args['attributes']['id'] = 'addforwish_'.get_the_ID();
        return $args;
      }
    }
    add_action('init','WCCWL_wishlist_init');
    $product_page_wishlist_icon_color=get_option('product_page_wishlist_icon_color');
    $product_page_icon_position=get_option('product_page_icon_position');
    $product_list_wishlist_icon_color=get_option('product_list_wishlist_icon_color');
    $product_list_icon_position=get_option('product_list_icon_position');
    $product_page_icon=get_option('product_page_add_to_wl_icon');
    $button_position=get_option('product_page_btn_position');
    $product_page_btn_type=get_option('product_page_btn_type'); 
    $button_list_position=get_option('product_list_btn_position');
    ?>
    <?php
    switch($button_list_position){
      case 'after_add_cart_btn' :
      add_action( 'woocommerce_after_shop_loop_item', 'WCCWL_woocommerce_after_shoploop_button', 10 );
      break;
      case  'before_add_cart_btn' :
      add_action( 'woocommerce_after_shop_loop_item', 'WCCWL_woocommerce_before_shoploop_button',10 );
      break;
    }
    switch($button_position){
      case 'after_add_cart_btn' :
      add_action( 'woocommerce_after_add_to_cart_button', 'WCCWL_woocommerce_after_add_to_cart_button', 10,0 );
      break;
      case  'before_add_cart_btn' :
      add_action('woocommerce_before_add_to_cart_button', 'WCCWL_woocommerce_before_add_to_cart_button', 10, 0 ); 
      break;
    }
if (!function_exists('WCCWL_woocommerce_before_add_to_cart_button')){ 
    function WCCWL_woocommerce_before_add_to_cart_button( ) {
      global  $woocommerce;    
      $_SESSION['currency']=get_woocommerce_currency_symbol(); 

      $product_page_btn_type=get_option('product_page_btn_type');  
      $product_page_add_to_wl_btn_text=get_option( 'product_page_add_to_wl_btn_text' ); 
      $product_page_add_to_wl_icon=get_option('product_page_add_to_wl_icon');
      $product_page_view_to_wl_icon=get_option('product_page_view_to_wl_icon');
      $product_page_icon=get_option('product_page_icon');
      $product_page_wish_icon=get_option('product_page_wish_icon');
      $product_page_view_to_wl_btn_text=get_option( 'product_page_view_to_wl_btn_text' );
      $product_page_wishlist_icon_color=get_option('product_page_wishlist_icon_color');
      $product_page_icon_position=get_option('product_page_icon_position');
      $icon_color= (!empty($product_page_wishlist_icon_color) ? $product_page_wishlist_icon_color : 'gray') ;
      if($product_page_icon_position == "right"){
        $styleicon = "float:right;margin-left:10px;";
      }else if($product_page_icon_position == "left"){
        $styleicon = "float:left;margin-right:10px;";
      }else{
        $styleicon = "float:left;margin-right:10px;";
      }
      if($product_page_icon_position == "right"){
        $styleonlyicon = "float:right;";
      }else if($product_page_icon_position == "left"){
        $styleonlyicon = "float:left;";
      }else{
        $styleonlyicon = "float:left;";
      }
      $product_page_show_btn_text = get_option( 'product_page_show_btn_text' );
      $view_wl_btn_text =  get_option( 'view_wl_btn_text' );
      $add_wl_btn_text = get_option( 'add_wl_btn_text' );
      if(!empty($product_page_view_to_wl_btn_text))
      {
        $view_wl_text = $product_page_view_to_wl_btn_text;
      }
      else if(!empty($view_wl_btn_text)){
        $view_wl_text = $view_wl_btn_text;
      }  else {
       $view_wl_text = "View Wishlist";
     }

     if(!empty($product_page_add_to_wl_btn_text))
     {
      $wl_text=$product_page_add_to_wl_btn_text;
    }
    else if(!empty($add_wl_btn_text)){
      $wl_text = $add_wl_btn_text;
    }
    else 
    {
      $wl_text="Add to Wishlist";
    }

    if($product_page_btn_type == 'btn' ) {
     global $wpdb;
     $value = get_current_user_id();
     $meta = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='addwishlistid' AND post_id='".get_the_ID()."' AND meta_value='".$value."'");
     foreach ($meta as $key => $mmvalue) {
      $array[] = $mmvalue->post_id;
    }
    switch ($product_page_icon) {
      case 'text': 
      if(!isset($array) || !in_array(get_the_ID(),$array))
      {
        echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' ><button type='button' class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-page' style='margin-bottom: 10px;' >".esc_html($wl_text)."</button></div><div class='ibl-wishlist-clear'></div>";
      }
      else{
       switch ($product_page_wish_icon) {
        case 'icon': 
        echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_redirect btn_style_css btnsubmit'style='margin-bottom: 10px;' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div><div class='ibl-wishlist-clear'></div>" ;
        break;
        case 'icon_text':
        echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i> ".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
        break;
        case 'text':
        echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
        break;
      }
    }
    break;
    case 'icon_text' :
    if(!isset($array) || !in_array(get_the_ID(),$array))
    {
     echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add'><button type='button' class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-page' style='margin-bottom: 10px;'><i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i>".esc_html($wl_text)."</button></div><div class='ibl-wishlist-clear'></div>";
   }
   else{
    switch ($product_page_wish_icon) {
      case 'icon': 
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div><div class='ibl-wishlist-clear'></div>" ;
      break;
      case 'icon_text':
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i>".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
      break;
      case 'text':
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
      break;
    }
  }
  break;
  case 'icon' :
  if(!isset($array) || !in_array(get_the_ID(),$array))
  {
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'   data-id='".esc_attr(get_the_ID())."' type-id='product-page'  style='margin-bottom: 10px;' ><i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i> </button></div><div class='ibl-wishlist-clear'></div>";
  }
  else{
    switch ($product_page_wish_icon) {
      case 'icon': 
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_redirect btn_style_css btnsubmit'  style='margin-bottom: 10px;'  ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div><div class='ibl-wishlist-clear'></div>" ;
      break;
      case 'icon_text':
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_redirect btn_style_css btnsubmit'  style='margin-bottom: 10px;'  ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i>".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
      break;
      case 'text':
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_add' > <button type='button' class='button btn_redirect btn_style_css btnsubmit'   style='margin-bottom: 10px;' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
      break;
    }
  }
  break;
  default:
  break;
}
}
else if($product_page_btn_type == 'link' ) {
 global $wpdb;
 $value = get_current_user_id();
 $meta = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='addwishlistid' AND post_id='".get_the_ID()."'  AND meta_value='".$value."'");
 foreach ($meta as $key => $mmvalue) {
  $array[] = $mmvalue->post_id;
}
if($icon_color=='#ffffff'){
  $icon_color = "#000000";
}
if($product_list_wishlist_icon_color=='#ffffff'){
  $product_list_wishlist_icon_color = "#000000";
}
switch ($product_page_icon) {
 case 'text' : 
 if(!isset($array) || !in_array(get_the_ID(),$array))
 {
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'   data-id='".esc_attr(get_the_ID())."' type-id='product-page'>".esc_html($wl_text)." </a></div><div class='ibl-wishlist-clear'></div>";
}
else{
 switch ($product_page_wish_icon) {
  case 'icon': 
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_redirect btnsubmit'><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div><div class='ibl-wishlist-clear'></div>" ;
  break;
  case 'icon_text':
  if($product_page_icon_position == "right"){
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a  style='cursor:pointer;' class='btn_redirect btnsubmit' >".esc_attr($view_wl_text)."<i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div><div class='ibl-wishlist-clear'></div>" ;
  }else{
   echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a  style='cursor:pointer;' class='btn_redirect btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i>".esc_html($view_wl_text)."</a></div><div class='ibl-wishlist-clear'></div>" ;
 }
 break;
 case 'text':
 echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a  style='cursor:pointer;' class='btn_redirect btnsubmit' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
 break;
}
      // echo "<div class='wishlist_button_add' > <button type='button' class='btn_redirect' class='btnsubmit' ><i class='fa fa-heart-o'></i> view wishlist</button></div>";
}
break;
case 'icon_text' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
  if($product_page_icon_position == "right"){
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-page'>".esc_html($wl_text)."<i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> </a></div><div class='ibl-wishlist-clear'></div>";
  }else{
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-page'><i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i>".esc_html($wl_text)." </a></div><div class='ibl-wishlist-clear'></div>";
  }
}
else{
 switch ($product_page_wish_icon) {
  case 'icon': 
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_redirect btnsubmit'><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div><div class='ibl-wishlist-clear'></div>" ;
  break;
  case 'icon_text':
  if($product_page_icon_position == "right"){
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-page'>".esc_html($view_wl_text)."<i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> </a></div><div class='ibl-wishlist-clear'></div>";
  }else{
   echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a  style='cursor:pointer;'  class='btn_redirect btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> ".esc_html($view_wl_text)."</a></div><div class='ibl-wishlist-clear'></div>" ;
 }
 break;
 case 'text':
 echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a style='cursor:pointer;'  class='btn_redirect btnsubmit' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
 break;
}
}
break;
case 'icon' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'   data-id='".esc_attr(get_the_ID())."' type-id='product-page' ><i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> </a></div><div class='ibl-wishlist-clear'></div>";
}
else{
 switch ($product_page_wish_icon) {
  case 'icon': 
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_redirect btnsubmit'><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div><div class='ibl-wishlist-clear'></div>" ;
  break;
  case 'icon_text':
  if($product_page_icon_position == "right"){
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-page'>".esc_html($view_wl_text)."<i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> </a></div><div class='ibl-wishlist-clear'></div>";
  }else{
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a style='cursor:pointer;'   class='btn_redirect btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i>".esc_html($view_wl_text)."</a></div><div class='ibl-wishlist-clear'></div>" ;
  }
  break;
  case 'text':
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a style='cursor:pointer;'  class='btn_redirect btnsubmit' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
  break;
}
}
break;
default:
break;
}
}
}
}
if (!function_exists('WCCWL_woocommerce_after_add_to_cart_button')){ 
function WCCWL_woocommerce_after_add_to_cart_button(  ) { 
  global  $woocommerce;    
  $_SESSION['currency']=get_woocommerce_currency_symbol(); 
  $product_page_add_to_wl_icon=get_option('product_page_add_to_wl_icon');
  $product_page_view_to_wl_icon=get_option('product_page_view_to_wl_icon');
  $product_page_icon=get_option('product_page_icon');
  $product_page_wish_icon=get_option('product_page_wish_icon');
  $product_page_wishlist_icon_color=get_option('product_page_wishlist_icon_color');
  $product_page_icon_position=get_option('product_page_icon_position');
  $product_page_btn_type=get_option('product_page_btn_type'); 
  $product_page_add_to_wl_btn_text=get_option( 'product_page_add_to_wl_btn_text' );
  $product_page_view_to_wl_btn_text=get_option( 'product_page_view_to_wl_btn_text' );
  $icon_color= (!empty($product_page_wishlist_icon_color) ? $product_page_wishlist_icon_color : 'gray') ;
  if($product_page_icon_position == "right"){
    $styleicon = "float:right;margin-left:10px;";
  }else if($product_page_icon_position == "left"){
    $styleicon = "float:left;margin-right:10px;";
  }else{
    $styleicon = "float:left;margin-right:10px;";
  }
  if($product_page_icon_position == "right"){
    $styleonlyicon = "float:right;";
  }else if($product_page_icon_position == "left"){
    $styleonlyicon = "float:left;";
  }else{
    $styleonlyicon = "float:left;";
  }
  $product_page_show_btn_text = get_option( 'product_page_show_btn_text' );
  $view_wl_btn_text =  get_option( 'view_wl_btn_text' );
  $add_wl_btn_text =  get_option( 'add_wl_btn_text' );
  if(!empty($product_page_view_to_wl_btn_text))
  {
    $view_wl_text = $product_page_view_to_wl_btn_text;
  }
  else if(!empty($view_wl_btn_text)){
    $view_wl_text = $view_wl_btn_text;
  }  else {
   $view_wl_text = "View Wishlist";
 }


 if(!empty($product_page_add_to_wl_btn_text))
 {

  $wl_text=$product_page_add_to_wl_btn_text;
}
else if(!empty($add_wl_btn_text)){
  $wl_text = $add_wl_btn_text;
}
else 
{
  $wl_text="Add Wishlist";
}

if($product_page_btn_type == 'btn' ) {
  global $wpdb;
  $key= 'addwishlistid';
  $value = get_current_user_id();
  $meta = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='addwishlistid' AND post_id='".get_the_ID()."' AND meta_value='".$value."'");
  foreach ($meta as $key => $mmvalue) {
    $array[] = $mmvalue->post_id;
  }  
  switch ($product_page_icon) {
    case 'text': 
    if(!isset($array) || !in_array(get_the_ID(),$array))
    {
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' ><button type='button' class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-page'>".esc_html($wl_text)."</button></div><div class='ibl-wishlist-clear'></div>";
    }
    else{
     switch ($product_page_wish_icon) {
      case 'icon': 
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div><div class='ibl-wishlist-clear'></div>" ;
      break;
      case 'icon_text':
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i>".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
      break;
      case 'text':
      echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
      break;
    }
  }
  break;
  case 'icon_text' :
  if(!isset($array) || !in_array(get_the_ID(),$array))
  {
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' ><button type='button' class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-page'><i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i>".esc_html($wl_text)."</button></div><div class='ibl-wishlist-clear'></div>";
  }
  else{
   switch ($product_page_wish_icon) {
    case 'icon': 
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div><div class='ibl-wishlist-clear'></div>" ;
    break;
    case 'icon_text':
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i>".esc_attr($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
    break;
    case 'text':
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' >".esc_attr($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
    break;
  }
}
break;
case 'icon' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
 echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-page'><i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></i></button></div><div class='ibl-wishlist-clear'></div>";
}
else{
 switch ($product_page_wish_icon) {
  case 'icon': 
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div><div class='ibl-wishlist-clear'></div>" ;
  break;
  case 'icon_text':
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i>".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
  break;
  case 'text':
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_after' > <button type='button' class='button btn_redirect btn_style_css btnsubmit' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
  break;
}
}
break;
default:
break;
}
}
else if($product_page_btn_type == 'link' ) {
  global $wpdb;
  $value = get_current_user_id();
  $meta = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='addwishlistid' AND post_id='".get_the_ID()."' AND meta_value='".$value."'");
  foreach ($meta as $key => $mmvalue) {
    $array[] = $mmvalue->post_id;
  }
  if($icon_color=='#ffffff'){
    $icon_color = "#000000";
  }
  if($product_list_wishlist_icon_color=='#ffffff'){
    $product_list_wishlist_icon_color = "#000000";
  }
  switch ($product_page_icon) {
   case 'text' : 
   if(!isset($array) || !in_array(get_the_ID(),$array))
   {
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'   data-id='".esc_attr(get_the_ID())."' type-id='product-page'>".esc_html($wl_text)." </a></div><div class='ibl-wishlist-clear'></div>";
  }
  else{
   switch ($product_page_wish_icon) {
    case 'icon': 
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_redirect btnsubmit'><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div><div class='ibl-wishlist-clear'></div>" ;
    break;
    case 'icon_text':
    if($product_page_icon_position == "right"){
     echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a  style='cursor:pointer;' class='btn_redirect btnsubmit' > ".esc_html($view_wl_text)."<i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div><div class='ibl-wishlist-clear'></div>" ;
   }else{
    echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a  style='cursor:pointer;' class='btn_redirect btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> ".esc_html($view_wl_text)."</a></div><div class='ibl-wishlist-clear'></div>" ;
  }
  break;
  case 'text':
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a  style='cursor:pointer;' class='btn_redirect btnsubmit' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
  break;
}
}
break;
case 'icon_text' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
 if($product_page_icon_position == "right"){
   echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'   data-id='".esc_attr(get_the_ID())."' type-id='product-page'>".esc_html($wl_text)."<i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";font-size: 21px;'></i> </a></div><div class='ibl-wishlist-clear'></div>";
 }else{
   echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'   data-id='".esc_attr(get_the_ID())."' type-id='product-page'><i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";font-size: 21px;'></i>".esc_html($wl_text)." </a></div><div class='ibl-wishlist-clear'></div>";
 }
}
else{
 switch ($product_page_wish_icon) {
  case 'icon': 
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_redirect btnsubmit'><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color)."; '></i></a></div><div class='ibl-wishlist-clear'></div>" ;
  break;
  case 'icon_text':
  if($product_page_icon_position == "right"){
   echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a  style='cursor:pointer;'  class='btn_redirect btnsubmit' >".esc_html($view_wl_text)."<i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> </a></div><div class='ibl-wishlist-clear'></div>" ;
 }else{
   echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a  style='cursor:pointer;'  class='btn_redirect btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> ".esc_html($view_wl_text)."</a></div><div class='ibl-wishlist-clear'></div>" ;
 }
 break;
 case 'text':
 echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a style='cursor:pointer;'  class='btn_redirect btnsubmit' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
 break;
}
}
break;
case 'icon' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'   data-id='".esc_attr(get_the_ID())."' type-id='product-page' ><i class='".esc_attr($product_page_add_to_wl_icon)."' style='color:".esc_attr($icon_color)."; font-size: 21px;'></i> </a></div><div class='ibl-wishlist-clear'></div>";
}
else{
 switch ($product_page_wish_icon) {
  case 'icon': 
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' ><a style='cursor:pointer;' class='btn_redirect btnsubmit'><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";font-size: 21px; '></i></a></div><div class='ibl-wishlist-clear'></div>" ;
  break;
  case 'icon_text':
  if($product_page_icon_position == "right"){
   echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a style='cursor:pointer;'   class='btn_redirect btnsubmit' >".esc_html($view_wl_text)."<i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color)."; '></i></a></div><div class='ibl-wishlist-clear'></div>" ;
 }else{
  echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a style='cursor:pointer;'   class='btn_redirect btnsubmit' ><i class='".esc_attr($product_page_view_to_wl_icon)."' style='color:".esc_attr($icon_color)."; '></i>".esc_html($view_wl_text)."</a></div><div class='ibl-wishlist-clear'></div>" ;
}
break;
case 'text':
echo "<div class='ibl-wishlist-clear'></div><div class='wishlist_button_link_after' > <a style='cursor:pointer;'  class='btn_redirect btnsubmit' >".esc_html($view_wl_text)."</button></div><div class='ibl-wishlist-clear'></div>" ;
break;
}
}
break;
default:
break;
}
}
}  
}
if (!function_exists('WCCWL_woocommerce_after_shoploop_button')){ 
function WCCWL_woocommerce_after_shoploop_button(  ) { 
  global  $woocommerce;    
  $_SESSION['currency']=get_woocommerce_currency_symbol(); 
  $product_list_icon=get_option('product_list_icon');
  $product_list_wish_icon=get_option('product_list_wish_icon');
  $product_list_add_to_wl_icon=get_option('product_list_add_to_wl_icon');
  $product_list_wishlist_icon_color=get_option('product_list_wishlist_icon_color');
  $product_list_icon_position=get_option('product_list_icon_position');
  $product_list_btn_type=get_option('product_list_btn_type'); 
  $product_list_add_to_wl_btn_text=get_option( 'product_list_add_to_wl_btn_text' );
  $product_list_view_to_wl_icon=get_option('product_list_view_to_wl_icon');
  $view_wl_btn_text = get_option( 'view_wl_btn_text' );
  $add_wl_btn_text =get_option( 'add_wl_btn_text' );
  $product_list_view_to_wl_btn_text=get_option( 'product_list_view_to_wl_btn_text' );
  $icon_color= (!empty($product_list_wishlist_icon_color) ? $product_list_wishlist_icon_color : 'gray') ; 
  if($product_list_icon_position == "right"){
    $styleicon = "float:right;margin-left:10px;";
  }else if($product_list_icon_position == "left"){
    $styleicon = "float:left;margin-right:10px;";
  }else{
    $styleicon = "float:left;margin-right:10px;";
  }
  if($product_list_icon_position == "right"){
    $styleonlyicon = "float:right;";
  }else if($product_list_icon_position == "left"){
    $styleonlyicon = "float:left;";
  }else{
    $styleonlyicon = "float:left;";
  }
  if(!empty($product_list_add_to_wl_btn_text))
  {
    $add_text=$product_list_add_to_wl_btn_text;
  }
  else if(!empty($add_wl_btn_text)){
    $add_text=$add_wl_btn_text;
  }else{
    $add_text="Add to WishList";
  }

  if(!empty($product_list_view_to_wl_btn_text))
  {
    $view_text=$product_list_view_to_wl_btn_text;
  }
  else if(!empty($view_wl_btn_text)){
    $view_text=$view_wl_btn_text;
  }else{
    $view_text="View Wishlist";
  }
  if($product_list_btn_type == 'btn' ) {
    global $wpdb;
    $value = get_current_user_id();
    $meta = $wpdb->get_results("SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key='addwishlistid' AND post_id='".get_the_ID()."' AND post_id='".get_the_ID()."' AND meta_value=".$value);
    foreach ($meta as $key => $mmvalue) {
      $array[] = $mmvalue->post_id;
    }
    ?>
    <?php
// for ($i=0; $i <  ; $i++) { 
// }
    switch ($product_list_icon) {
     case 'text': 
     if(!isset($array) || !in_array(get_the_ID(),$array))
     {
      echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' ><button type='button'  class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())." btn_after_loop' data-id='".esc_attr(get_the_ID())."' type-id='product-list' style='position: relative;width: fit-content;'>".esc_html($add_text)."</button></div>";
    }
    else{
     switch ($product_list_wish_icon) {
      case 'icon': 
      echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_redirect btnsubmit btn_after_loop btn_style_css' style='position: relative;width: fit-content;'><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div>" ;
      break;
      case 'icon_text':
      echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_redirect btnsubmit btn_after_loop btn_style_css' style='position: relative;width: fit-content;'><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i> ".esc_html($view_text)."</button></div>" ;
      break;
      case 'text':
      echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_redirect btnsubmit btn_after_loop btn_style_css' style='position: relative;width: fit-content;' >".esc_html($view_text)."</button></div>" ;
      break;
    }
  }
  break;
  case 'icon_text' :
 // echo $postid;
 // echo get_the_ID();
  if(!isset($array) || !in_array(get_the_ID(),$array))
  {
   echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' ><button type='button' class='button btn_style_css  wlid1 wlbtn_".esc_attr(get_the_ID())." btn_after_loop' data-id='".esc_attr(get_the_ID())."' type-id='product-list'   ><i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i>". esc_html($add_text)."</button></div>";
 }
 else
 {
  switch ($product_list_wish_icon) {
    case 'icon': 
    echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_redirect btn_after_loop btnsubmit btn_style_css'><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div>" ;
    break;
    case 'icon_text':
    echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_redirect btnsubmit btn_after_loop btn_style_css' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i> ".esc_html($view_text)."</button></div>" ;
    break;
    case 'text':
    echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_redirect btnsubmit btn_after_loop btn_style_css' >".esc_html($view_text)."</button></div>" ;
    break;
  }
}
break;
case 'icon' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
  echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_style_css  wlid1 wlbtn_".esc_attr(get_the_ID())." btn_after_loop' data-id='".esc_attr(get_the_ID())."' type-id='product-list'  style='position: relative;width: fit-content;'><i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div>";
}
else{
  switch ($product_list_wish_icon) {
    case 'icon':
    echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_redirect btnsubmit btn_after_loop btn_style_css' style='position: relative;width: fit-content;'><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></div>" ;
    break;
    case 'icon_text':
    echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_redirect btnsubmit btn_after_loop btn_style_css' style='position: relative;width: fit-content;' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i>".esc_html($view_text)."</button></div>" ;
    break;
    case 'text':
    echo "<div class='wishlist_button_after_loop_".esc_attr(get_the_ID())."' > <button type='button' class='button btn_redirect btnsubmit btn_after_loop btn_style_css' style='position: relative;width: fit-content;'>".esc_html($view_text)."</button></div>" ;
    break;
  }
}
break;
default:
break;
}
}
else if($product_list_btn_type == 'link' ) {
  global $wpdb;
  $value = get_current_user_id();
  $meta = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='addwishlistid' AND post_id='".get_the_ID()."' AND meta_value='".$value."'");
  foreach ($meta as $key => $mmvalue) {
    $array[] = $mmvalue->post_id;
  }  
  if($icon_color=='#ffffff'){
    $icon_color = "#000000";
  }
  if($product_list_wishlist_icon_color=='#ffffff'){
    $product_list_wishlist_icon_color = "#000000";
  }
  switch ($product_list_icon) {
   case 'text': 
   //$postid= get_post_meta(get_the_ID(),'addwishlistid',true);
   if(!isset($array) || !in_array(get_the_ID(),$array))
   {
     echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;'><a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())." btn_after_looplink' data-id='".esc_attr(get_the_ID())."' type-id='product-list'>".esc_html($product_list_add_to_wl_btn_text)." </a></div>";
   }
   else{
     switch ($product_list_wish_icon) {
      case 'icon': 
      echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' > <a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color)."; '></i></a></div>" ;
      break;
      case 'icon_text':
      if($product_list_icon_position == "right"){
       echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' > <a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' >".esc_html($product_list_view_to_wl_btn_text)."<i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div>" ;
     }else{
      echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' > <a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i>".esc_html($product_list_view_to_wl_btn_text)."</a></div>" ;
    }
    break;
    case 'text':
    echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;'><a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' >".esc_html($product_list_view_to_wl_btn_text)."</a></div>" ;
    break;
  }
}
break;
case 'icon_text' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
  if($product_list_icon_position == "right"){
   echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' ><a class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())." btn_after_looplink' data-id='".esc_attr(get_the_ID())."' type-id='product-list' style='cursor:pointer;position:inherit;width:fit-content;'>".esc_html($product_list_add_to_wl_btn_text)."<i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div>";
 }else{
  echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' ><a class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())." btn_after_looplink' data-id='".esc_attr(get_the_ID())."' type-id='product-list' style='cursor:pointer;position:inherit;width:fit-content;'><i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i>".esc_html($product_list_add_to_wl_btn_text)."</a></div>";
}
}
else{
 switch ($product_list_wish_icon) {
  case 'icon': 
  echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;'> <a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div>" ;
  break;
  case 'icon_text':
  if($product_list_icon_position == "right"){
    echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' > <a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' >".esc_attr($product_list_view_to_wl_btn_text)."<i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> </a></div>" ;
  }else{
    echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' > <a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> ".esc_html($product_list_view_to_wl_btn_text)."</a></div>" ;
  }
  break;
  case 'text':
  echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' ><a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' >".esc_html($product_list_view_to_wl_btn_text)."</a></div>" ;
  break;
}
}
break;
case 'icon' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
  echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;'><a style='cursor:pointer;position:inherit;width:fit-content;'  class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())." btn_after_looplink'  data-id='".esc_attr(get_the_ID())."' type-id='product-list' > <i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($icon_color)."; '></i></a></div>";
}
else{
 switch ($product_list_wish_icon) {
  case 'icon': 
  echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' > <a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div>" ;
  break;
  case 'icon_text':
  if($product_list_icon_position == "right"){
   echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' > <a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' >".esc_html($product_list_view_to_wl_btn_text)." <i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div>" ;
 }else{
  echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."' style='margin-top: 8px;' > <a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> ".esc_html($product_list_view_to_wl_btn_text)."</a></div>" ;
}
break;
case 'text':
echo "<div class='wishlist_button_link_after_loop_".esc_attr(get_the_ID())."'  style='margin-top: 8px;'><a style='cursor:pointer;position:inherit;width:fit-content;' class='btn_redirect btn_after_looplink btnsubmit' >".esc_html($product_list_view_to_wl_btn_text)."</a></div>" ;
break;
}
}
break;
default:
break;
}
}
}  
}
if (!function_exists('WCCWL_woocommerce_before_shoploop_button')){  
function WCCWL_woocommerce_before_shoploop_button(  ) { 
  global  $woocommerce;    
  $i=0; 
  $_SESSION['currency']=get_woocommerce_currency_symbol(); 
  $product_list_add_to_wl_icon=get_option('product_list_add_to_wl_icon');
  $product_list_icon=get_option('product_list_icon');
  $product_list_wish_icon=get_option('product_list_wish_icon');
  $product_list_view_to_wl_icon=get_option('product_list_view_to_wl_icon');
  $product_list_view_to_wl_btn_text=get_option( 'product_list_view_to_wl_btn_text' );
  $product_list_wishlist_icon_color=get_option('product_list_wishlist_icon_color');
  $product_list_icon_position=get_option('product_list_icon_position');
  $product_list_btn_type=get_option('product_list_btn_type'); 
  $product_list_add_to_wl_btn_text=get_option( 'product_list_add_to_wl_btn_text' );
  $icon_color= (!empty($product_list_wishlist_icon_color) ? $product_list_wishlist_icon_color : 'gray') ; 
  if($product_list_icon_position == "right"){
    $styleicon = "float:right;margin-left:10px;";
  }else if($product_list_icon_position == "left"){
    $styleicon = "float:left;margin-right:10px;";
  }else{
    $styleicon = "float:left;margin-right:10px;";
  }
  if($product_list_icon_position == "right"){
    $styleonlyicon = "float:right;";
  }else if($product_list_icon_position == "left"){
    $styleonlyicon = "float:left;";
  }else{
    $styleonlyicon = "float:left;";
  }
  $product_list_show_btn_text = get_option( 'product_list_show_btn_text' );
  $view_wl_btn_text =  get_option( 'view_wl_btn_text' );
  if(!empty($product_list_add_to_wl_btn_text))
  {
    $add_text=$product_list_add_to_wl_btn_text;
  }
  else if(!empty($add_wl_btn_text)){
    $add_text=$add_wl_btn_text;
  }else{
    $add_text="Add to WishList";
  }

  if(!empty($product_list_view_to_wl_btn_text))
  {
    $view_text=$product_list_view_to_wl_btn_text;
  }
  else if(!empty($view_wl_btn_text)){
    $view_text=$view_wl_btn_text;
  }else{
    $view_text="View Wishlist";
  }
  if($product_list_btn_type == 'btn' ) {
    global $wpdb;
    $value = get_current_user_id();
    $meta = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='addwishlistid' AND post_id='".get_the_ID()."' AND meta_value='".$value."'");
    foreach ($meta as $key => $mmvalue) {
      $array[] = $mmvalue->post_id;
    } 

    switch ($product_list_icon) {
     case 'text': 
     if(!isset($array) || !in_array(get_the_ID(),$array))
     {
      echo "<div class='wishlist_button_after' ><button type='button'  class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())." btn_style_css' data-id='".esc_attr(get_the_ID())."' type-id='product-list'>".esc_html($add_text)."</button></div>";
    }
    else{
      switch ($product_list_wish_icon) {
        case 'icon': 
        echo "<div class='wishlist_button_after' > <button type='button' class='button btn_redirect btnsubmit btn_style_css' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleonlyicon)."'></i></button></div>" ;
        break;
        case 'icon_text':
        echo "<div class='wishlist_button_after' > <button type='button' class='button btn_redirect btnsubmit btn_style_css' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i> ".esc_html($view_text)."</button></div>" ;
        break;
        case 'text':
        echo "<div class='wishlist_button_after' > <button type='button' class='button btn_redirect btnsubmit btn_style_css' >".esc_html($view_text)."</button></div>" ;
        break;
      }
    }
    break;
    case 'icon_text' :
    if(!isset($array) || !in_array(get_the_ID(),$array))
    {
      echo "<div class='wishlist_button_after' ><button type='button'  class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."' data-id='".esc_attr(get_the_ID())."' type-id='product-list'><i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($product_list_wishlist_icon_color).";".esc_attr($styleicon)."'></i>".esc_html($add_text)."</button></div>";
    }
    else
    {
     switch ($product_list_wish_icon) {
      case 'icon': 
      echo "<div class='wishlist_button_after' > <button type='button' class='button btn_redirect btnsubmit btn_style_css' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($product_list_wishlist_icon_color).";".esc_attr($styleonlyicon)."'></i></button></div>" ;
      break;
      case 'icon_text':
      echo "<div class='wishlist_button_after' > <button type='button' class='button btn_redirect btnsubmit btn_style_css' ><i class='".esc_attr($product_list_view_to_wl_icon)."'  style='color:".esc_attr($product_list_wishlist_icon_color).";".esc_attr($styleicon)."'></i> ".esc_html($view_text)."</button></div>" ;
      break;
      case 'text':
      echo "<div class='wishlist_button_after' > <button type='button' class='button btn_redirect btnsubmit btn_style_css' >".esc_html($view_text)."</button></div>" ;
      break;
    }
  }
  break;
    // case 'heartbeat' :
    //   echo "<div class='wishlist_button_add' > <button type='button' name='krishna' value='".get_the_ID()."'   data-toggle='modal' data-target='#WishlistModal'><i class='fa fa-heartbeat' style='color:".esc_attr($icon_color).";margin-right:10px'></i>". $product_list_add_to_wl_btn_text." </button></div>
    //     ";
  case 'icon' :
  if(!isset($array) || !in_array(get_the_ID(),$array))
  {
    echo "<div class='wishlist_button_after' ><button type='button'  class='button btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."' data-id='".esc_attr(get_the_ID())."' type-id='product-list'><i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($product_list_wishlist_icon_color).";".esc_attr($styleonlyicon)."'></i></button></div>";
  }
  else{
    switch ($product_list_wish_icon) {
      case 'icon': 
      echo "<div class='wishlist_button_after' > <button type='button' class='button btn_redirect btnsubmit btn_style_css' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i></button></div>" ;
      break;
      case 'icon_text':
      echo "<div class='wishlist_button_after' > <button type='button' class='button btn_redirect' btnsubmit btn_style_css' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleicon)."'></i> ".esc_html($view_text)."</button></div>" ;
      break;
      case 'text':
      echo "<div class='wishlist_button_after' > <button type='button' class='button btn_redirect btnsubmit btn_style_css' >".esc_html($view_text)."</button></div>" ;
      break;
    }
  }
  break;
  default:
  break;
}
}
else if($product_list_btn_type == 'link' ) {
  global $wpdb;
  $value = get_current_user_id();
  $meta = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='addwishlistid' AND meta_value='".$value."'");
  foreach ($meta as $key => $mmvalue) {
    $array[] = $mmvalue->post_id;
  } 
  if($icon_color=='#ffffff'){
    $icon_color = "#000000";
  }
  if($product_list_wishlist_icon_color=='#ffffff'){
    $product_list_wishlist_icon_color = "#000000";
  }
  switch ($product_list_icon) {
   case 'text': 
   if(!isset($array) || !in_array(get_the_ID(),$array))
   {
    echo "<div class='wishlist_button_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."' data-id='".esc_attr(get_the_ID())."' type-id='product-list'> ".esc_html($add_text)." </a></div>";
  }
  else{
   switch ($product_list_wish_icon) {
    case 'icon': 
    echo "<div class='wishlist_button_after' > <a style='cursor:pointer;' class='btn_redirect btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div>" ;
    break;
    case 'icon_text':
    if($product_list_icon_position == "right"){
     echo "<div class='wishlist_button_after' > <a style='cursor:pointer;' class='btn_redirect btnsubmit' >".esc_attr($view_text)."<i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> </a></div>" ;
   }else{
    echo "<div class='wishlist_button_after' > <a style='cursor:pointer;' class='btn_redirect btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i> ".esc_html($view_text)."</a></div>" ;
  }
  break;
  case 'text':
  echo "<div class='wishlist_button_after' ><a style='cursor:pointer;' class='btn_redirect btnsubmit' >".esc_html($view_text)."</a></div>" ;
  break;
}
}
break;
case 'icon_text' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
  if($product_list_icon_position == "right"){
    echo "<div class='wishlist_button_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-list'> ".esc_html($add_text)."<i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($product_list_wishlist_icon_color).";'></i></a></div>";
  }else{
   echo "<div class='wishlist_button_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-list'> <i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($product_list_wishlist_icon_color).";'></i>".esc_html($add_text)."</a></div>";
 }
}
else{
 switch ($product_list_wish_icon) {
  case 'icon': 
  echo "<div class='wishlist_button_after' > <a style='cursor:pointer;' class='btn_redirect btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div>" ;
  break;
  case 'icon_text':
  if($product_list_icon_position == "right"){
   echo "<div class='wishlist_button_after' > <a style='cursor:pointer;' class='btn_redirect btnsubmit' >".esc_html($view_text)." <i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";".esc_attr($styleiconl)."'></i></a></div>" ;
 }else{
  echo "<div class='wishlist_button_after' > <a style='cursor:pointer;' class='btn_redirect btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color)."; '></i> ".esc_html($view_text)."</a></div>" ;
}
break;
case 'text':
echo "sdfgsdfg";
echo "<div class='wishlist_button_after' ><a style='cursor:pointer;' class='btn_redirect btnsubmit' >".esc_html($view_text)."</a></div>" ;
break;
}
}
break;
case 'icon' :
if(!isset($array) || !in_array(get_the_ID(),$array))
{
 echo "<div class='wishlist_button_after' ><a style='cursor:pointer;' class='btn_style_css wlid1 wlbtn_".esc_attr(get_the_ID())."'  data-id='".esc_attr(get_the_ID())."' type-id='product-list'> <i class='".esc_attr($product_list_add_to_wl_icon)."' style='color:".esc_attr($product_list_wishlist_icon_color)."; '></i></a></div>";
}
else{
 switch ($product_list_wish_icon) {
  case 'icon': 
  echo "<div class='wishlist_button_after' > <a style='cursor:pointer;' class='btn_redirect btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color).";'></i></a></div>" ;
  break;
  case 'icon_text':
  if($product_list_icon_position == "right"){
    echo "<div class='wishlist_button_after' > <a style='cursor:pointer;' class='btn_redirect btnsubmit' >".esc_attr($view_text)." <i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color)."; '></i></a></div>" ;
  }else{
    echo "<div class='wishlist_button_after' > <a style='cursor:pointer;' class='btn_redirect btnsubmit' ><i class='".esc_attr($product_list_view_to_wl_icon)."' style='color:".esc_attr($icon_color)."; '></i> ".esc_html($view_text)."</a></div>" ;
  }
  break;
  case 'text':
  echo "<div class='wishlist_button_after' ><a style='cursor:pointer;' class='btn_redirect btnsubmit' >".esc_attr($view_text)."</a></div>" ;
  break;
}
}
break;
default:
break;
}
}
$i += 1;
// }
} 
}  
add_action('wp_footer','modal_create_list');
function modal_create_list(){
  if(is_product() || is_shop() || is_category())
  {
    ?>
    <style>
      .wishlist_name{
        width: 100%;    margin-top: 10px;
      }
      .list-label {
        padding-top: 15px !important;
        margin-bottom: 0 !important;
        text-align: right !important;
      }
    </style>
    <?php 
    $k=site_url();
    $product_page_view_to_wl_icon=get_option('product_page_view_to_wl_icon');
    $product_list_view_to_wl_icon=get_option('product_list_view_to_wl_icon');
    $product_page_wish_icon=get_option('product_page_wish_icon');
    $product_list_wish_icon=get_option('product_list_wish_icon');
    $product_page_view_to_wl_btn_text=get_option( 'product_page_view_to_wl_btn_text' );
    $product_list_view_to_wl_btn_text=get_option( 'product_list_view_to_wl_btn_text' );
    $product_page_btn_type=get_option('product_page_btn_type'); 
    $product_list_btn_type=get_option('product_list_btn_type'); 
    $button_list_position=get_option('product_list_btn_position');
    $view_wl_btn_text =  get_option( 'view_wl_btn_text' );
    $add_wl_btn_text =  get_option( 'add_wl_btn_text' );
    $require_login=get_option( 'require_login' );
    $product_page_wishlist_icon_color=get_option('product_page_wishlist_icon_color');
    $product_page_icon_position=get_option('product_page_icon_position');
    $product_list_wishlist_icon_color=get_option('product_list_wishlist_icon_color');
    $product_list_icon_position=get_option('product_list_icon_position');
    ?>
    <script>
      var $=jQuery;
      $(document).ready(function(){
        var site_url = "<?php echo $k; ?>";
        var id = $(this).attr('data-id');
        $('.wlid1').on('click',function(){

          var site_url = "<?php echo $k; ?>";
          var ajaxurl = site_url+'/wp-admin/admin-ajax.php';
          var id = $(this).attr('data-id');
          var type = $(this).attr('type-id');
          $.ajax({
            type : 'post',
            url: ajaxurl,
            data: {
              'action':'WCCWL_ajax_request',
              'wishlistid' : id
            },
            success:function(data) {
            },
            error: function(errorThrown){
              console.log(errorThrown);
            }
          });  
          if(type == 'product-page')
          {
            var view_icon = '<?php echo $product_page_view_to_wl_icon; ?>';
            var product_page_wish_icon = '<?php echo $product_page_wish_icon; ?>';
            var view_to_wl_btn_text = '<?php echo $product_page_view_to_wl_btn_text; ?>'; 
            var product_page_btn_type = '<?php echo  $product_page_btn_type ?>';
            var  view_wl_btn_text = '<?php echo  $view_wl_btn_text ?>';
            var  product_page_wishlist_icon_color = '<?php echo  $product_page_wishlist_icon_color ?>';
            var  product_page_icon_position = '<?php echo  $product_page_icon_position ?>';
            if(view_to_wl_btn_text != ''){
              view_wl_text = view_to_wl_btn_text;
            }else if((view_wl_btn_text != '')){
              view_wl_text = view_wl_btn_text;
            }else{
              view_wl_text = "View Wishlist";
            }
            if(product_page_wishlist_icon_color != ''){
              var icon_color = product_page_wishlist_icon_color;
            }else{
              var icon_color = 'gray';
            }
            var styleicon;
            var styleonlyicon;
            if(product_page_icon_position == "right"){
              styleicon = "float:right;margin-left:10px;";
            }else if(product_page_icon_position == "left"){
              styleicon = "float:left;margin-right:10px;";
            }else{
              styleicon = "float:left;margin-right:10px;";
            }
            if(product_page_icon_position == "right"){
              styleonlyicon = "float:right;";
            }else if(product_page_icon_position == "left"){
              styleonlyicon = "float:left;";
            }else{
              styleonlyicon = "float:left;";
            }
            if(product_page_btn_type == 'btn'){
              switch(product_page_wish_icon){
                case 'icon_text' : 
                var view_wishlist =  "<button type='button' class='button btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;'><i class='"+view_icon+"' style='color:"+icon_color+";"+styleicon+"'></i> "+view_wl_text+"</button>";
                break;  
                case 'icon' :
                var view_wishlist =  " <button type='button' class='button btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;'><i class='"+view_icon+"' style='color:"+icon_color+";"+styleonlyicon+"'></i></button>";
                break;
                case 'text' :
                var view_wishlist =  " <button type='button' class='button btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;'>"+view_wl_text+"</button>";
                break;
              }
            }
            else if(product_page_btn_type == 'link')
            {
              if(icon_color == "#ffffff"){
                icon_color = "#000000";
              }
              switch(product_page_wish_icon){
                case 'icon_text' :               
                if(product_post_icon_position == "right"){
                  var view_wishlist = "<a style='cursor:pointer;' class='btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;'>"+view_wl_text+" <i class='"+view_icon+"' style='color:"+icon_color+"; '></i></a>";
                }else{
                 var view_wishlist = "<a style='cursor:pointer;' class='btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;'><i class='"+view_icon+"' style='color:"+icon_color+"; '></i>"+view_wl_text+" </a>";
               }
               break;  
               case 'icon' :
               var view_wishlist = "<a style='cursor:pointer;' class='btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;'><i class='"+view_icon+"' style='color:"+icon_color+"; '></i></a>";
               break;
               case 'text' :
               var view_wishlist = "<a style='cursor:pointer;' class='btn_redirect btn_style_css btnsubmit' style='margin-bottom: 10px;'>"+view_wl_text+"</a>";
               break;
             }
           }
         }
         else if(type == 'product-list')
         {
          var product_list_view_icon = '<?php echo $product_list_view_to_wl_icon; ?>';
          var product_list_wish_icon = '<?php echo $product_list_wish_icon; ?>';
          var product_list_view_to_wl_btn_text = '<?php echo $product_list_view_to_wl_btn_text; ?>'; 
          var product_list_btn_type = '<?php echo  $product_list_btn_type ?>';
          var button_list_position = '<?php echo  $button_list_position ?>'; 
          var  view_wl_btn_text = '<?php echo  $view_wl_btn_text ?>';
          var  product_list_wishlist_icon_color = '<?php echo  $product_list_wishlist_icon_color ?>';
          var  product_list_icon_position = '<?php echo  $product_list_icon_position ?>';
          
          if(product_list_view_to_wl_btn_text != '')
          {
            view_wl_text = product_list_view_to_wl_btn_text;
          }
          else if((view_wl_btn_text) != ''){
            view_wl_text = view_wl_btn_text;
          }else{
            view_wl_text = "View Wishlist";
          }

          if(product_list_wishlist_icon_color != ''){
            var icon_color = product_list_wishlist_icon_color;
          }else{
            var icon_color = 'gray';
          }
          var styleicon;
          var styleonlyicon;
          if(product_list_icon_position == "right"){
            styleicon = "float:right;margin-left:10px;";
          }else if(product_list_icon_position == "left"){
            styleicon = "float:left;margin-right:10px;";
          }else{
            styleicon = "float:left;margin-right:10px;";
          }
          if(product_list_icon_position == "right"){
            styleonlyicon = "float:right;";
          }else if(product_list_icon_position == "left"){
            styleonlyicon = "float:left;";
          }else{
            styleonlyicon = "float:left;";
          }
          if(button_list_position == 'after_add_cart_btn')
          {
            if(product_list_btn_type == 'btn')
            {
              switch(product_list_wish_icon){
                case 'icon_text' : 
                var view_wishlist =  " <button type='button' class='button btnsubmit btn_after_loop' ><i class='"+product_list_view_icon+"'  style='color:"+icon_color+";"+styleicon+"'></i>"+view_wl_text+"</button>";
                break;  
                case 'icon' :
                var view_wishlist =  " <button type='button' class='button btnsubmit btn_after_loop' ><i class='"+product_list_view_icon+"'  style='color:"+icon_color+";"+styleonlyicon+"'></i></button>";
                break;
                case 'text' :
                var view_wishlist =  "<button type='button' class='button btnsubmit btn_after_loop' >"+view_wl_text+"</button>";
                break;
              }
            }
            else if(product_list_btn_type == 'link')
            {
              if(icon_color == "#ffffff"){
                icon_color = "#000000";
              }
              switch(product_list_wish_icon){
                case 'icon_text' : 
                if(product_list_icon_position == "right"){
                  var view_wishlist = "<a style='cursor:pointer;position:inherit;width:fit-content;' class='btnsubmit btn_after_loop' >"+view_wl_text+"<i class='"+product_list_view_icon+"' style='color:"+icon_color+";'></i> </a>";
                }else{
                 var view_wishlist = "<a style='cursor:pointer;position:inherit;width:fit-content;' class='btnsubmit btn_after_loop' ><i class='"+product_list_view_icon+"' style='color:"+icon_color+";'></i>"+view_wl_text+" </a>";
               }
               break;  
               case 'icon' :
               var view_wishlist = "<a style='cursor:pointer;position:inherit;width:fit-content;' class='btnsubmit btn_after_loop'  ><i class='"+product_list_view_icon+"' style='color:"+icon_color+";'></i></a>";
               break;
               case 'text' :
               var view_wishlist = "<a style='cursor:pointer;position:inherit;width:fit-content;' class='btnsubmit btn_after_loop'  >"+view_wl_text+"</a>";
               break;
             }
           }
         }
         else if(button_list_position == 'before_add_cart_btn')
         {
          if(product_list_btn_type == 'btn')
          {
            switch(product_list_wish_icon){
              case 'icon_text' :                 
              var view_wishlist =  " <button type='button' class='button btnsubmit' ><i class='"+product_list_view_icon+"'  style='color:"+icon_color+";"+styleicon+"'></i> "+view_wl_text+"</button>";
              break;  
              case 'icon' :
              var view_wishlist =  "<button type='button' class='button btnsubmit' ><i class='"+product_list_view_icon+"'  style='color:"+icon_color+";"+styleonlyicon+"'></i></button>";
              break;
              case 'text' :
              var view_wishlist =  " <button type='button' class='button btnsubmit' >"+view_wl_text+"</button>";
              break;
            }
          }
          else if(product_list_btn_type == 'link')
          {
            if(icon_color == "#ffffff"){
              icon_color = "#000000";
            }
            switch(product_list_wish_icon){
              case 'icon_text' : 
              if(product_list_icon_position == "right"){
                var view_wishlist = "<a style='cursor:pointer;' class='btnsubmit' >"+view_wl_text+"<i class='"+product_list_view_icon+"' style='color:"+icon_color+"; '></i> </a>";
              }else{
               var view_wishlist = "<a style='cursor:pointer;' class='btnsubmit' ><i class='"+product_list_view_icon+"' style='color:"+icon_color+"; '></i>"+view_wl_text+" </a>";
             }
             break;  
             case 'icon' :
             var view_wishlist = "<a style='cursor:pointer;' class='btnsubmit'  ><i class='"+product_list_view_icon+"' style='color:"+icon_color+"; '></i></a>";
             break;
             case 'text' :
             var view_wishlist = "<a style='cursor:pointer;' class='btnsubmit'  >"+view_wl_text+"</a>";
             break;
           }
         }
       }
     }
     $( ".wlbtn_"+id ).replaceWith(view_wishlist );
     var site_url = "<?php echo $k; ?>";
     $(".btnsubmit").click(function(){
       window.location.assign(site_url+"/wishlist"); 
     });
   });
});
$(".btnsubmit").click(function(){
  var site_url = "<?php echo $k; ?>";
  window.location.assign(site_url+"/wishlist"); 
});
//});
</script>
<?php
}
}
?>