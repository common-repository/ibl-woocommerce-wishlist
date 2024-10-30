<?php
if (! defined('ABSPATH')) {
  die();
}
// session_start();
add_action('wp_head','WCCWL_share_icon_css');
function WCCWL_share_icon_css() { ?>

<script type="text/javascript">
  var $ = jQuery;
  $(document).ready(function(){
    var arr = [];
    var i = 0;
    $('.add_to_cart_button').each(function(){

      var select = $(this);
      var k = select.attr("data-product_id" );
      var addtocartid = select.attr('href'); 

      if(k == ""){

        var emailrogh= addtocartid.split("?");

        email=emailrogh[1];

        var idrough=emailrogh[1].split("=");

        var id=idrough[1];


        arr[i++] =id;
      }else{
        arr[i++] =k;
      }

    });

    var i;
    for (i = 0; i < arr.length; ++i) {

     $('.wishlist_button_after_loop_'+arr[i]).insertAfter('#addforwish_'+arr[i]); 
     $('<div class="ibl-wishlist-clear"></div>').insertBefore('.wishlist_button_after_loop_'+arr[i]);
     $('<div class="ibl-wishlist-clear"></div>').insertAfter('.wishlist_button_after_loop_'+arr[i]); 

     $('.wishlist_button_link_after_loop_'+arr[i]).insertAfter('#addforwish_'+arr[i]); 

     $('<div class="ibl-wishlist-clear"></div>').insertBefore('.wishlist_button_link_after_loop_'+arr[i]);
     $('<div class="ibl-wishlist-clear"></div>').insertAfter('.wishlist_button_link_after_loop_'+arr[i]);

   }

 }); 
</script>
<?php 
include('commonicon.php');
$product_list_wishlist_icon_color=get_option('product_list_wishlist_icon_color');
$product_list_icon_position=get_option('product_list_icon_position');

$product_list_wish_icon=get_option('product_list_wish_icon');
$product_list_icon=get_option('product_list_icon');

?>


<style type="text/css">


  .ibl-wishlist-clear{
   visibility: visible;
   width: auto;
   height: auto;
 }
 .ibl-wishlist-clear:before{
   content: " ";
   display: table;

 }
 .ibl-wishlist-clear:after{
   clear: both;
   content: " ";
   display: table;

 }

 * { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}

 img {max-width: 100%;}
 /*Generic styles*/
 #wrapper{ max-width: 800px; width:100%;}

 .wishlist_button_after{
   margin-bottom: 10px;
 }

 .btn_after_looplink{
  margin-top: 10px;
  position: absolute;

  width: 100%;
  left: 0;
  right: 0;
  bottom: -25px !important;
}
table td, table th {
  padding: 16px 4px !important;
  word-wrap: break-word !important;
}

@media only screen and (max-width: 600px) {
  .cart_width{
    font-size: 7px;
  }
  .wishlisttbl tr td.product-remove {
   padding: 16px 0 !important;
 }
 .vwl-break-checkbox{
   margin-top: 14px;
 }

}

.wishlisttbl tr td.product-remove {
 padding: 16px ;
}


.custom-wcwl-share h4.custom-wcwl-share-title{
  margin: 10px 0;
}
.custom-wcwl-share ul, .custom-wcwl-share li

{
  height: 21px;
}
.custom-wcwl-share ul{
  margin: 5px 0;
  padding: 0;

}

.custom-wcwl-share li, .entry-content .custom-wcwl-share li{
  margin-left: 0px;
  margin-right: 0px;
}
.custom-wcwl-share ul, .custom-wcwl-share li{
  height: 21px;
}
.custom-wcwl-share li a {
  background-position: left top;
  display: inline-block;
  width: 21px;
  height: 21px;
  border: none;
}


.custom-wcwl-share li a.facebook
{
  background-image: url( '<?php  echo esc_url( plugins_url( 'img/facebook.png', __FILE__ )); ?>');
  border-radius: 20px;
}
.custom-wcwl-share li a.twitter {
  background-image: url('<?php  echo esc_url( plugins_url( 'img/twitter.png', __FILE__ )); ?>');
  border-radius: 20px;
}
.custom-wcwl-share li a.pinterest {
  background-image: url('<?php  echo esc_url( plugins_url( 'img/pinterest.jpg', __FILE__ )); ?>');
  border-radius: 20px;
}

.custom-wcwl-share li a.googleplus {
  background-image: url('<?php  echo esc_url( plugins_url( 'img/googleplus.jpg', __FILE__ )); ?>');
  border-radius: 20px;
}

.custom-wcwl-share li a.email {
  background-image: url('<?php  echo esc_url( plugins_url( 'img/email.jpg', __FILE__ )); ?>');
  border-radius: 20px;
}

.custom-wcwl-share{
	display:block !important;
}

</style>
<?php
}

add_action( 'wp_ajax_WCCWL_ajax_request', 'WCCWL_ajax_request' );
add_action( 'wp_ajax_nopriv_WCCWL_ajax_request', 'WCCWL_ajax_request' );
add_action( 'wp_ajax_WCCWL_ajax_request1', 'WCCWL_ajax_request1' );
add_action( 'wp_ajax_nopriv_WCCWL_ajax_request1', 'WCCWL_ajax_request1' );

function WCCWL_ajax_request() {
  $requestwishlistid = sanitize_text_field($_REQUEST['wishlistid']);
  if(!empty($requestwishlistid))
  {
    $userid=get_current_user_id();
    $id1 = $requestwishlistid;
    $_SESSION['wishlistid']= $id1;
    if(!add_post_meta($id1,'addwishlistid',$userid,true))
    {
      add_post_meta($id1,'addwishlistid',$userid);
    }
  }
  die();
}

$_SESSION['wishlistid'];

function WCCWL_ajax_request1() {
	$requestwishlid = sanitize_text_field($_REQUEST['wishlid']);
	if(!empty($requestwishlid))
	{
    $userid=get_current_user_id();
    $id1=$requestwishlid;
    $_SESSION['wishlid']=$id1;

    if(!add_post_meta($id1,'addwishlistid',$userid,true))
    {
      add_post_meta($id1,'addwishlistid',$userid);
    }


  }

  die();
}



add_shortcode('wishlist', 'WCCWL_get_adsense');

function WCCWL_get_adsense($atts) {

 $userid=get_current_user_id();
 if ( !add_post_meta($_SESSION['wishlid'],'addwishlistid',$userid,true) ) {
   add_post_meta($_SESSION['wishlid'],'addwishlistid',$userid);
 }
 else{
   update_post_meta($_SESSION['wishlid'],'addwishlistid',$userid);
 }
 unset($_SESSION['wishlid']);
 $wlremove = sanitize_text_field($_POST['wlremove']);
 if(!empty($wlremove))
 {
   $removeproduct=get_option( 'remove_product_frm_wl' );
   if($removeproduct == 'on')
   {
     delete_post_meta($wlremove,'addwishlistid',$userid);
   }

 }

 ?>
 <h2><?php $default_wishlist_name= get_option( 'default_wishlist_name' ); 
   echo (!empty($default_wishlist_name) ? sanitize_text_field($default_wishlist_name) : 'Default Wishlist'); ?></h2>

   <div class="container">
    <div id="wrapper">
      <section id="generic-tabs">

       <form action="<?php echo site_url(); ?>/wishlist" method="post" autocomplete="off">



        <table class="table wishlisttbl woocommerce" style="font-size: 80%;
        margin-bottom: 3.706325903em;">
        <thead>
         <tr><?php $show_checkbox= get_option( 'show_checkbox' ); 
           if($show_checkbox == 'on'){?>

           <th class="product-cb" style="padding: 16px 19px !important;"><input type="checkbox" id="checkbox-cb"  name="checkbox-cb"></th><?php } ?>
           <th class="product-remove"></th>
           <th class="product-thumbnail"><?= esc_html( 'Product Image', 'wc-custom-wishlist' ); ?></th>
           <th class="product-name"><span class="vwl-full"> <?= esc_html( 'Product Name', 'wc-custom-wishlist' ); ?></span><?php  $show_unit_price = get_option( 'show_unit_price' ); 
             if($show_unit_price == 'on') { ?>
             <th class="product-price"><?= esc_html( 'Unit Price', 'wc-custom-wishlist' ); ?></th><?php }
             $show_date_addition = get_option( 'show_date_addition' ); 
             if($show_date_addition == 'on'){ ?>

             <th class="product-date"><?= esc_html( 'Date Added', 'wc-custom-wishlist' ); ?></th><?php } ?>
             <?php  $show_stack_status =  get_option( 'show_stack_status' ); 
             if($show_stack_status == 'on') {?>
             <th class="product-stock"><?= esc_html( 'Stock Status', 'wc-custom-wishlist' ); ?></th><?php } ?>
             <th class="product-action">&nbsp;</th>

           </tr>
         </thead>
         <tbody>
           <?php
           global $wpdb;
           $wishlist="SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = 'addwishlistid' AND meta_value='".$userid."'";

           $wlist=$wpdb->get_results($wishlist);


           foreach ($wlist as $wkey => $wvalue) {

            $salepricesql="SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE meta_key ='_sale_price' AND post_id='".$wvalue->post_id."'";

            $saleprice=$wpdb->get_results($salepricesql);

            $regularpricesql="SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = '_regular_price' AND post_id='".$wvalue->post_id."'" ;
            $regularprice=$wpdb->get_results($regularpricesql);


            $stocksql="SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = '_stock_status' AND post_id='".$wvalue->post_id."'";
            $stock=$wpdb->get_results($stocksql); ?>
            <tr class="cart_remove_<?php echo esc_attr($value->ID);  ?>">
              <?php $show_checkbox= get_option( 'show_checkbox' ); 
              if($show_checkbox == 'on') { ?>
              <td class="product-cb" style="padding: 16px 19px !important;">

                <input type="checkbox" name="wishlistcb[]" id="check" value="<?php echo esc_html($wvalue->post_id); ?>">
                <input type="hidden" name="wlcb" value="<?php echo esc_html($wvalue->post_id); ?>" >
                <!-- <input type="submit" name="submit" value="go"> -->

              </td><?php } ?>

              <td class="product-remove">
                <button style=" border-radius: 30px; background-color: #e36042b8; color: white; font-size: 9px;" class="button" type="submit" name="wlremove" id="wlremove" data-id="<?php echo esc_attr($wvalue->post_id);?>" value="<?php echo esc_html($wvalue->post_id);?>">X
                </button>

              </td>
              <td class="product-thumbnail" >

                <p style="width: 72px";>
                 <?php $id= $wvalue->post_id;

                 if ( has_post_thumbnail($id) ) { 
                  ?>
                  <a href="<?php echo the_permalink($id); ?>"><?php echo get_the_post_thumbnail($id); ?>
                  </a><?php }?>

                </p>
              </td>

              <td class="product-name">

               <a href="<?php echo get_permalink( $wvalue->post_id ); ?>"> <?php echo get_the_title( $wvalue->post_id )  ?></a>

             </td><?php  $show_unit_price = get_option( 'show_unit_price' ); 
             if($show_unit_price == 'on') { ?>
             <td class="product-price"><?php 

               foreach ($regularprice as $k => $v) {

                if(!empty($v->meta_value)){

                  echo "<strike>".esc_html($_SESSION['currency']).esc_html($v->meta_value)."</strike><br/>"; 
                }

              }
              foreach ($saleprice as $k => $v) {
                if(!empty($v->meta_value)){
                  echo "<b>".esc_html($_SESSION['currency']).esc_html($v->meta_value)."</b>";
                }
              }

              ?>

            </td><?php  }
            $show_date_addition = get_option( 'show_date_addition' ); 
            if($show_date_addition == 'on'){ ?>
            <td class="product-date"><?php 
              echo get_the_date('F d,Y',$wvalue->meta_value);
              ?>
            </td><?php } 
            $show_stack_status =  get_option( 'show_stack_status' ); 
            if($show_stack_status == 'on') {?>
            <td class="product-stock"><?php 
								// if($removeid == 1){
              foreach ($stock as $k => $v) {

               $newstr = substr_replace($v->meta_value, " ", 2, 0);

               if($v->meta_value == 'outofstock')
               {
                $newstr = 'out of stock';

                echo "<p  style= color:red><i class='fa fa-frown'></i>&nbsp;".esc_html($newstr)."</p>";

              }
              else if($v->meta_value == 'instock')
              {
                $newstr = 'in stock';
                echo "<p  style= color:#0f834d><i class='fa fa-smile'></i>&nbsp;".esc_html($newstr)."</p>";

              }
              ?>
            </td>
            <?php } ?><?php $show_add_cart_btn= get_option( 'show_add_cart_btn' );
            $add_to_cart_txt= get_option( 'add_to_cart_txt' ); 
            if($show_add_cart_btn == 'on') { ?>

            <td style="width: 12%;">

             <button class="button alt cart_width btn_add_to_cart" name="add-to-cart" value="<?php echo $v->post_id; ?>"><i
              class="fa fa-shopping-cart"></i>&nbsp;<span
              class="vwl-txt"><?php echo esc_html($add_to_cart_txt); ?></span>
            </button>

          </td><?php } } //} ?>

        </tr> <?php   } ?>
      </tbody> 
      <tfoot>
       <tr>
        <td colspan="100"> <?php 	$show_action_btn =   get_option( 'show_action_btn' ); 
          if($show_action_btn == 'on') { ?>
          <select name="apply_parameter">
            <option value="actions">Actions</option>
            <option value="add-to-cart">Add to Cart</option>
            <option value="remove">Remove</option>
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;

          <button class="button" type="submit" name="apply_action" value="applyaction">Apply Action</button> <?php } ?>

          <?php  $show_add_selected_cart_btn= get_option( 'show_add_selected_cart_btn' );
          $add_selected_cart_btn_txt = get_option( 'add_selected_cart_btn_txt' ); 
          if($show_add_selected_cart_btn == 'on'){		?>

          <div style="float: right;">

           <button type="submit" class="button vwl-break-checkbox alt" name="wl-action"  value="<?php echo esc_html($wvalue->post_id); ?>" ><?php echo esc_html($add_selected_cart_btn_txt); ?></button> <?php } ?>
           &nbsp;&nbsp;&nbsp;&nbsp;
           <?php  $show_add_all_to_cart_btn= get_option( 'show_add_all_to_cart_btn' );
           $add_all_cart_btn_txt = get_option( 'add_all_cart_btn_txt' ); 
           if($show_add_all_to_cart_btn == 'on'){		?>

           <button type="submit" class="button alt" name="add-all-to-cart"  value="<?php echo esc_html($wvalue->post_id); ?>"><?php echo esc_html($add_all_cart_btn_txt); ?></button><?php } ?>
         </div>
       </td>

     </tr>

   </tfoot>
 </table>

</form>

<?php 
$idp=$wvalue->meta_value;
$share_link_title= get_option( 'default_wishlist_name' );
$share_link_url = site_url().'/wishlist/';
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $idp ), 'single-post-thumbnail' );
$image=$image[0]; 

?>
<div class="custom-wcwl-share">
  <h4 class="custom-wcwl-share-title">
    <?php $share_on_txt = get_option( 'share_on_txt' ); 
    echo (!empty($share_on_txt) ? $share_on_txt : 'Share on').":";
    ?>
  </h4>
  <?php if(get_option( 'show_fb_btn' ) == 'on' ) { ?>
  <li style="list-style-type: none; display: inline-block;">
    <a target="_blank" class="facebook" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode($share_link_url); ?>&t=<?php echo urlencode($share_link_title);?>"></a>
  </li>
  <?php } ?>

  <?php if(get_option( 'show_twitter_btn' ) == 'on' ) { ?>     
  <li style="list-style-type: none; display: inline-block;">
    <a target="_blank" class="twitter" href="https://twitter.com/share?url=<?php echo urlencode( $share_link_url ) ?>&amp;text=<?php echo $share_twitter_summary ?>" title="<?php echo esc_html( 'Twitter', 'yith-woocommerce-wishlist' ) ?>"></a>
    <?php } ?>      


    <?php if(get_option( 'show_pinterest_btn' ) == 'on' ) { ?>          
    <li style="list-style-type: none; display: inline-block;">
      <a target="_blank" class="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( $share_link_url ); ?>&media=<?php echo urldecode($image); ?>" onclick="window.open(this.href); return false;"></a>
    </li>
    <?php } ?>        


    <?php if(get_option( 'show_google_btn' ) == 'on' ) { ?>        
    <li style="list-style-type: none; display: inline-block;">
      <a target="_blank" class="googleplus" href="https://plus.google.com/share?url=<?php echo urlencode( $share_link_url ) ?>&amp;title=<?php echo $share_link_title ?>" title="<?php echo esc_html( 'Google+', 'yith-woocommerce-wishlist' ) ?>" onclick='javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'></a>
    </li>
    <?php }  ?>     

    <?php if(get_option( 'show_email_btn' ) == 'on' ) { ?>    
    <li style="list-style-type: none; display: inline-block;">
      <a class="email" href="mailto:?subject=<?php echo urlencode( apply_filters( 'yith_wcwl_email_share_subject', $share_link_title ) )?>&amp;body=<?php echo apply_filters( 'yith_wcwl_email_share_body', urlencode( $share_link_url ) ) ?>&amp;title=<?php echo $share_link_title ?>" title="<?php echo esc_html( 'Email', 'yith-woocommerce-wishlist' ) ?>"></a>
    </li>
    <?php }  ?>

  </ul>
</div>

</section>	
</div>

</div>

<script type="text/javascript">
  var $ = jQuery;
  $(document).ready(function()
  {
    $('#checkbox-cb').click(function() { $(this.form.elements).filter(':checkbox').prop('checked', this.checked);

  });

  });
</script>  
<?php 
}

function woocommerce_after_shop_loop_item_title_short_description() {
 global $products;

 $products = wc_get_products( array(
  'status' => 'publish',
  ) );

  ?>
  <div itemprop="description">
  </div>
  <?php
}

add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_short_description', 5);

add_action( 'template_redirect', 'WCCWL_list_add_product_to_cart',10);

function WCCWL_list_add_product_to_cart() {
  $addtocart = sanitize_text_field($_POST['add-to-cart']);
  if(!empty($addtocart))
  {
    $userid = get_current_user_id();
    $remove_product_frm_wl= get_option( 'remove_product_frm_wl' );
    if ( WC()->cart->get_cart_contents_count() == 0 ) {
     WC()->cart->add_to_cart( $addtocart);
   }
   if($remove_product_frm_wl == 'on')
   {
    delete_post_meta($addtocart,'addwishlistid',$userid);
    delete_post_meta($addtocart,"listname".$userid);

  }
      // unset($_SESSION['id1']);
}
$checkboxcb = sanitize_text_field($_POST['checkbox-cb']);
if(!empty($checkboxcb))
{
  $apply_parameter = sanitize_text_field($_POST['apply_parameter']);
  if($apply_parameter == 'add-to-cart' ) {
    $userid = get_current_user_id();
    $remove_product_frm_wl= get_option( 'remove_product_frm_wl' );
    $wishlistcb=sanitize_text_field($_POST['wishlistcb']);
  //print_r($wishlistcb);
    foreach ($wishlistcb as $key => $value) {
     WC()->cart->add_to_cart($value);
     if($remove_product_frm_wl == 'on')
     {

       delete_post_meta($value,'addwishlistid',$userid);

       delete_post_meta($value,"listname".$userid);
     }
   } 
 }
 else if($apply_parameter == 'remove' ) {
  $postwishlistcb = sanitize_text_field($_POST['wishlistcb']);
  if(!empty($postwishlistcb)){
    $userid = get_current_user_id();

    $remove_product_frm_wl= get_option( 'remove_product_frm_wl' );

    $wishlistcb=$postwishlistcb;
    foreach ($wishlistcb as $key => $value) {
     if($remove_product_frm_wl == 'on')
     {
      delete_post_meta($value,'addwishlistid',$userid);

      delete_post_meta($value,"listname".$userid);
    }

  }

}
}
}
$postwishlistcb2 = sanitize_text_field($_POST['wishlistcb']);
if(!empty($postwishlistcb2)){
  $apply_parameter = sanitize_text_field($_POST['apply_parameter']);
  if($apply_parameter == 'add-to-cart' ) {
    $userid = get_current_user_id();
    $remove_product_frm_wl= get_option( 'remove_product_frm_wl' );
    $wishlistcb=$postwishlistcb2;
  //print_r($wishlistcb);
    foreach ($wishlistcb as $key => $value) {
      WC()->cart->add_to_cart($value);
      if($remove_product_frm_wl == 'on')
      {
       delete_post_meta($value,'addwishlistid',$userid);
       
       delete_post_meta($value,"listname".$userid);
     }
   }  
 }
 else if($apply_parameter == 'remove' )
 {
  $userid = get_current_user_id();
  $remove_product_frm_wl= get_option( 'remove_product_frm_wl' );
  $wishlistcb=$postwishlistcb2;
  foreach ($wishlistcb as $key => $value) {
   if($remove_product_frm_wl == 'on')
   {
     delete_post_meta($value,'addwishlistid',$userid);
     
     delete_post_meta($value,"listname".$userid);
   }
 }
 
}
else {
  $wlaction = sanitize_text_field( $_POST['wl-action'] );
  if(!empty($wlaction)){
   $userid = get_current_user_id();
   $remove_product_frm_wl= get_option( 'remove_product_frm_wl' );

   $postwishlistcb3 = sanitize_text_field($_POST['wishlistcb']);
   $wishlistcb=$postwishlistcb3;
   foreach ($wishlistcb as $key => $value) {
    WC()->cart->add_to_cart($value);
    if($remove_product_frm_wl == 'on')
    {
      delete_post_meta($value,'addwishlistid',$userid);
      
      delete_post_meta($value,"listname".$userid);
    }
        //delete_post_meta($_SESSION['id1'],'addwishlistid',$_SESSION['id1']);
        /*unset($_SESSION['fruit']);
        unset($_SESSION['id1']);*/
        unset($_SESSION['listid']);
      } 
    }
  }
}
$addalltocart = sanitize_text_field( $_POST['add-all-to-cart'] );
if(!empty($addalltocart))
{
  $remove_product_frm_wl= get_option( 'remove_product_frm_wl' );
  $userid = get_current_user_id();
  global $wpdb;
  $sql="SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = 'addwishlistid'";
  $addtoallcart=$wpdb->get_results($sql);
  // echo "<pre>";
  // print_r($addtoallcart);
  foreach ($addtoallcart as $key => $value) {

    WC()->cart->add_to_cart($value->post_id);
    if($remove_product_frm_wl == 'on')
    {
     delete_post_meta($value->post_id,'addwishlistid',$userid);
     delete_post_meta($value,'listname',$_SESSION['listid']);
   }
   
        //delete_post_meta($_SESSION['id1'],'addwishlistid',$_SESSION['id1']);
    // unset($_SESSION['fruit']);
    // unset($_SESSION['id1']);
 }
}
}
function filter_woocommerce_cart_item_product_id( $cart_item_product_id, $cart_item, $cart_item_key ) { 
 unset( WC()->cart->cart_contents[$cart_item_key] );

 return $cart_item_product_id; 
}; 
add_filter( 'woocommerce_cart_item_product_id', 'filter_woocommerce_cart_item_product_id', 10, 3 ); 

