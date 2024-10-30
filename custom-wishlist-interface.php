<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
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
.tinvwl-table {
    display: table;
    /* height: 100%; */
    width: 100%;
    max-width: 100%;
}
</style>
 
</head>
<body>
    <h1>General Settings</h1>
    <form method="post" action="options.php">
     
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Default Wishlist Name</th>
                    <td>
                        <input type="text" name="default_wishlist_name" value="<?php echo get_option( 'default_wishlist_name' ); ?>"/>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">Wishlist Page</th>
                    <td>
                        <select name="wishlist_pages">
                        <option value="pages">pages</option>
                        </select>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">Require Login</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="require_login" <?php echo (!empty(get_option( 'require_login' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Show Link to Wishlist in my account</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_link_wl" <?php echo (!empty(get_option( 'show_link_wl' )) ? 'checked' : ''); ?>  >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Remove Product from Wishlist if added to cart</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="remove_product_frm_wl" <?php echo (!empty(get_option( 'remove_product_frm_wl' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Remove by anyone</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="remove_by_anyone" <?php echo (!empty(get_option( 'remove_by_anyone' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
            
             <tr valign="top">
                <th scope="row">Show successful notice in popup</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_popup"  <?php echo (!empty(get_option( 'show_popup' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Redirect to Wishlist</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="redirect_to_wl" <?php echo (!empty(get_option( 'redirect_to_wl' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">"View Wishlist" button Text</th>
                    <td>
                     <input type="text" name="view_wl_btn_text" value="<?php echo get_option( 'view_wl_btn_text' ); ?>"/>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">"Product added to Wishlist" Text</th>
                    <td>
                    <input type="text" name="product_added_to_wl" value="<?php echo get_option( 'product_added_to_wl' ); ?>"/>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">"Product already in Wishlist" Text</th>
                    <td>
                    <input type="text" name="product_already_to_wl" value="<?php echo get_option( 'product_already_to_wl' ); ?>"/>
                    </td>
            </tr>

        </table>
        <h1> Product page "Add to Wishlist" Button Settings </h1>
         <table class="form-table">
             <tr valign="top">
                <th scope="row">Button position</th>
                    <td>
                       
                         <select name="product_page_btn_position">
                        <option value="after_add_cart_btn" <?php if(get_option('product_page_btn_position') == 'after_add_cart_btn') { echo 'selected';} ?>>After "Add to Cart" button</option>
                        <option value="before_add_cart_btn" <?php if(get_option('product_page_btn_position') == 'before_add_cart_btn') { echo 'selected';} ?>>Before "Add to Cart" button</option>
                        <option value="custom_position_with_code" <?php if(get_option('product_page_btn_position') == 'custom_position_with_code') { echo 'selected';} ?>>Custom position with code</option>
                        </select>
                        </select>
                    </td>
            </tr> <tr valign="top">
                <th scope="row">Button type</th>
                    <td>
                        <select name="product_page_btn_type">
                          <option value="btn" <?php if(get_option('product_page_btn_type') == 'btn') { echo 'selected';} ?>>button</option>
                        <option value="link" <?php if(get_option('product_page_btn_type') == 'link') { echo 'selected';} ?>>link</option>
                        </select>
                    </td>
            </tr> <tr valign="top">
                <th scope="row">"Add to Wishlist" Icon</th>
                    <td>
                         <select name="product_page_add_to_wl_icon">
                        <option value="none" <?php if(get_option('product_page_add_to_wl_icon') == 'none') { echo 'selected';} ?>>None</option>
                        <option value="heart" <?php if(get_option('product_page_add_to_wl_icon') == 'Heart') { echo 'selected';} ?>>Heart</option>
                        <option value="heart+" <?php if(get_option('product_page_add_to_wl_icon') == 'Heart+') { echo 'selected';} ?>>Heart+</option>
                        <option value="custom"<?php if(get_option('product_page_add_to_wl_icon') == 'custom') { echo 'selected';} ?>>Custom</option>
                        </select>
                        </select>
                    </td>
            </tr> <tr valign="top">
                <th scope="row">"Add to Wishlist" Icon Color</th>
                    <td>
                        <select name="product_page_wishlist_pages">
                        <option value="black" <?php if(get_option('product_page_wishlist_pages') == 'black') { echo 'selected';} ?>>Black</option>
                        <option value="white" <?php if(get_option('product_page_wishlist_pages') == 'white') { echo 'selected';} ?>>White</option>
                        </select>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Show button text</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="product_page_show_btn_text"  <?php echo (!empty(get_option( 'product_page_show_btn_text' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">"Add to Wishlist" button Text</th>
                    <td>
                       <input type="text" name="product_page_add_to_wl_btn_text" value="<?php echo get_option( 'add_to_wl_btn_text' ); ?>"/>
                    </td>
            </tr>          
        </table>
        <h1> Product List "Add to Wishlist" Button Settings </h1>
         <table class="form-table">
             <tr valign="top">
                <th scope="row">Button position</th>
                    <td>
                        <select name="product_list_btn_position">
                        <option value="after_add_cart_btn" <?php if(get_option('product_list_btn_position') == 'after_add_cart_btn') { echo 'selected';} ?>>After "Add to Cart" button</option>
                        <option value="before_add_cart_btn" <?php if(get_option('product_list_btn_position') == 'before_add_cart_btn') { echo 'selected';} ?>>Before "Add to Cart" button</option>
                        <option value="product_list_btn_position" <?php if(get_option('product_list_btn_position') == 'product_list_btn_position') { echo 'selected';} ?>>Custom position with code</option>
                        </select>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Button type</th>
                    <td>
                        <select name="product_list_btn_type">
                        <option value="btn" <?php if(get_option('product_list_btn_type') == 'btn') { echo 'selected';} ?>>button</option>
                        <option value="link" <?php if(get_option('product_list_btn_type') == 'link') { echo 'selected';} ?>>link</option>
                        </select>
                    </td>
            </tr> 
            <tr valign="top">
                <th scope="row">"Add to Wishlist" Icon</th>
                    <td>
                        <select name="product_list_add_to_wl_icon">
                        <option value="none" <?php if(get_option('product_list_add_to_wl_icon') == 'none') { echo 'selected';} ?>>None</option>
                        <option value="heart" <?php if(get_option('product_list_add_to_wl_icon') == 'heart') { echo 'selected';} ?>>Heart</option>
                        <option value="heart+" <?php if(get_option('product_list_add_to_wl_icon') == 'heart+') { echo 'selected';} ?>>Heart+</option>
                        <option value="custom" <?php if(get_option('product_list_add_to_wl_icon') == 'custom') { echo 'selected';} ?>>Custom</option>
                        </select>
                    </td>
            </tr> 
            <tr valign="top">
                <th scope="row">"Add to Wishlist" Icon Color</th>
                    <td>
                        <select name="product_list_wishlist_pages">
                          <option value="black" <?php if(get_option('product_list_wishlist_pages') == 'black') { echo 'selected';} ?>>Black</option>
                        <option value="white" <?php if(get_option('product_list_wishlist_pages') == 'white') { echo 'selected';} ?>>White</option>
                        </select>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Show button text</th>
                    <td>
                        <label class="switch"> 
                        <input type="checkbox" name="product_list_show_btn_text"  <?php echo (!empty(get_option( 'product_list_show_btn_text' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">"Add to Wishlist" button Text</th>
                    <td>
                       <input type="text" name="product_list_add_to_wl_btn_text" value="<?php echo get_option( 'product_list_add_to_wl_btn_text' ); ?>"/>
                    </td>
            </tr>          
        </table>
      
          <h1> Wishlist Product Settings </h1>
         <table class="form-table">
             <tr valign="top">
                <th scope="row">Show "Add to Cart" button</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_add_cart_btn"  <?php echo (!empty(get_option( 'show_add_cart_btn' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">"Add to Cart" Text</th>
                    <td>
                       <input type="text" name="add_to_cart_txt" value="<?php echo get_option( 'add_to_cart_txt' ); ?>"/>
                    </td>
            </tr>  
             <tr valign="top">
                <th scope="row">Show Unit price</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_unit_price"  <?php echo (!empty(get_option( 'show_unit_price' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Show Stock status</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_stack_status"  <?php echo (!empty(get_option( 'show_stack_status' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Show Date of addition</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_date_addition"  <?php echo (!empty(get_option( 'show_date_addition' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
            
        </table> 
        <h1> Wishlist Table Settings </h1>
         <table class="form-table">
             <tr valign="top">
                <th scope="row">Show Checkboxes</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_checkbox"  <?php echo (!empty(get_option( 'show_checkbox' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Show Actions button</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_action_btn" <?php echo (!empty(get_option( 'show_action_btn' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Show "Add Selected to Cart" button</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_add_selected_cart_btn" <?php echo (!empty(get_option( 'show_add_selected_cart_btn' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Add Selected to Cart" Button Text</th>
                    <td>
                    <input type="text" name="add_selected_cart_btn_txt" value="<?php echo get_option( 'add_selected_cart_btn_txt' ); ?>"/>
                    </td>
            </tr>  
             <tr valign="top">
                <th scope="row">Show "Add All to Cart" button</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_add_all_to_cart_btn" <?php echo (!empty(get_option( 'show_add_all_to_cart_btn' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Add All to Cart" Button Text</th>
                    <td>
                    <input type="text" name="add_all_cart_btn_txt" value="<?php echo get_option( 'add_all_cart_btn_txt' ); ?>"/>
                    </td>
            </tr>  
            
        </table>
         <h1> Social Networks Sharing Options </h1>
         <table class="form-table">
             <tr valign="top">
                <th scope="row">Show "Facebook" Button</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_fb_btn"  <?php echo (!empty(get_option( 'show_fb_btn' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">Show "Twitter" Button</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_twitter_btn" <?php echo (!empty(get_option( 'show_twitter_btn' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">Show "Google+" Button</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_google_btn" <?php echo (!empty(get_option( 'show_google_btn' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">Show "Share by Email" Button</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_email_btn" <?php echo (!empty(get_option( 'show_email_btn' )) ? 'checked' : ''); ?>>
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">"Share on" Text</th>
                    <td>
                       <input type="text" name="share_on_txt" <?php echo (!empty(get_option( 'share_on_txt' )) ? 'checked' : ''); ?>>
                    </td>
            </tr>
             <tr valign="top">
                <th scope="row">Social Icons Color</th>
                    <td>
                        <select name="social_icon_color">

                        <option value="dark" <?php if(get_option('social_icon_color') == 'dark') { echo 'selected';} ?>>Dark</option>
                        <option value="white" <?php if(get_option('social_icon_color') == 'white') { echo 'selected';} ?>>White</option>
                        </select>
                       
                    </td>
            </tr>
        </table>
             <h1> Wishlist Products Counter </h1>
         <table class="form-table">
            <tr valign="top">
                <th scope="row">"Wishlist" Icon</th>
                    <td>
                        <select name="wishlist_btn_position">
                       <option value="none" <?php if(get_option('wishlist_btn_position') == 'none') { echo 'selected';} ?>>None</option>
                        <option value="heart" <?php if(get_option('wishlist_btn_position') == 'heart') { echo 'selected';} ?>>Heart</option>
                        <option value="heart+" <?php if(get_option('wishlist_btn_position') == 'heart+') { echo 'selected';} ?>>Heart+</option>
                        <option value="custom" <?php if(get_option('wishlist_btn_position') == 'custom') { echo 'selected';} ?>>Custom</option>

                        </select>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">"Wishlist" Icon Color</th>
                    <td>
                        <select name="wishlist_icon_color">
                        <option value="black" <?php if(get_option('wishlist_icon_color') == 'black') { echo 'selected';} ?>>Black</option>
                        <option value="white" <?php if(get_option('wishlist_icon_color') == 'white') { echo 'selected';} ?>>White</option>
                        </select>
                    </td>
            </tr> 
            <tr valign="top">
                <th scope="row">Show counter text</th>
                    <td>
                        <label class="switch">
                        <input type="checkbox" name="show_counter_txt"  <?php echo (!empty(get_option( 'show_counter_txt' )) ? 'checked' : ''); ?> >
                        <span class="slider round"></span>
                        </label>
                    </td>
            </tr>
            <tr valign="top">
                <th scope="row">Counter Text</th>
                    <td>
                       <input type="text" name="counter_txt" value="<?php echo get_option( 'counter_txt' ); ?>"/>
                    </td>
            </tr>
            

        </table><?php submit_button(); ?>
    </form>
    </body>
</html>
