<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
$response = file_get_contents(site_url().'/wp-content/plugins/'.WCCWL_DOMAIN.'/json/iconhtml.json');
$iconhtml = json_decode($response); 
?>

<h1>Wishlist Settings</h1>
<form method="post" action="options.php">
	<?php  settings_fields( 'WCCWL_plugin-settings-group' ); 
	do_settings_sections( 'WCCWL_plugin-settings-group' ); ?>

	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div class="panel with-nav-tabs panel-default">
					<div class="panel-heading">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1default" data-toggle="tab">General</a></li>
							<li><a href="#tab2default" data-toggle="tab">Product page</a></li>
							<li><a href="#tab3default" data-toggle="tab">Product list</a></li>
							<li><a href="#tab4default" data-toggle="tab">Wishlist Product</a></li>
							<li><a href="#tab5default" data-toggle="tab">Wishlist table</a></li>
							<li><a href="#tab6default" data-toggle="tab">Social Networks</a></li> 

						</ul>
					</div>
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab1default">

								<table class="form-table">
									<tr valign="top">
										<th scope="row">Default Wishlist Name</th>
										<td>
											<input class="input_class" class="input_class" type="text" name="default_wishlist_name" value="<?php echo get_option( 'default_wishlist_name' ); ?>"/>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Remove Product from Wishlist if added to cart</th>
										<td>
											<label class="switch">
												<input class="input_class" type="checkbox" name="remove_product_frm_wl" <?php echo (!empty(get_option( 'remove_product_frm_wl' )) ? 'checked' : ''); ?>>
												<span class="slider round"></span>
											</label>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Required Login</th>
										<td>
											<label class="switch">
												<input class="input_class" type="checkbox" name="require_login" >
												<span class="slider round"></span>
											</label>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">Default "View Wishlist" button Text</th>
										<td>
											<input class="input_class" type="text" name="view_wl_btn_text" value="<?php echo get_option( 'view_wl_btn_text' ); ?>"/>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">Default "Add Wishlist" button Text</th>
										<td>
											<input class="input_class" type="text" name="add_wl_btn_text" value="<?php echo get_option( 'add_wl_btn_text' ); ?>"/>
										</td>
									</tr>

								</table>

							</div>
							<div class="tab-pane fade" id="tab2default">

								<table class="form-table">
									<tr valign="top">

										<th scope="row">Button position</th>
										<td>

											<select class="select_class" name="product_page_btn_position">
												<option value="after_add_cart_btn" <?php if(get_option('product_page_btn_position') == 'after_add_cart_btn') { echo 'selected';} ?>>After "Add to Cart" button</option>
												<option value="before_add_cart_btn" <?php if(get_option('product_page_btn_position') == 'before_add_cart_btn') { echo 'selected';} ?>>Before "Add to Cart" button</option>

											</select>
										</select>
									</td>
								</tr>

								<tr valign="top">
									<th scope="row">Display Icon/text</th>
									<td>

										<select class="select_class" name="product_page_icon">
											<option value="icon" <?php if(get_option('product_page_icon') == 'icon') { echo 'selected';} ?>>Icon</option>
											<option value="icon_text" <?php if(get_option('product_page_icon') == 'icon_text') { echo 'selected';} ?>>Icon+text</option>
											<option value="text" <?php if(get_option('product_page_icon') == 'text') { echo 'selected';} ?>>Text</option>
										</select>
									</td>
								</tr>

								<tr valign="top">
									<th scope="row">View wishlist Icon/text</th>
									<td>

										<select class="select_class" name="product_page_wish_icon">
											<option value="icon" <?php if(get_option('product_page_wish_icon') == 'icon') { echo 'selected';} ?>>Icon</option>
											<option value="icon_text" <?php if(get_option('product_page_wish_icon') == 'icon_text') { echo 'selected';} ?>>Icon+text</option>
											<option value="text" <?php if(get_option('product_page_wish_icon') == 'text') { echo 'selected';} ?>>Text</option>
										</select>
									</td>
								</tr>

								<tr valign="top">
									<th scope="row">Button type</th>
									<td>

										<select class="select_class" name="product_page_btn_type">
											<option value="btn" <?php if(get_option('product_page_btn_type') == 'btn') { echo 'selected';} ?>>button</option>
											<option value="link" <?php if(get_option('product_page_btn_type') == 'link') { echo 'selected';} ?>>link</option>
										</select>
									</td>
								</tr> <tr valign="top">
								<th scope="row">"Add to Wishlist" Icon</th>
								<td>

									<select class="select_class" id="myselect" name="product_page_add_to_wl_icon" class="myselect">
										<?php foreach ($iconhtml as $ivalue) { 
											if(get_option('product_page_add_to_wl_icon') == $ivalue->name){
												$selected = 'selected';
											}else{
												$selected = '';
											}

											?>
											<option value="<?php echo esc_html($ivalue->name)?>" <?php echo esc_html($selected)?> ><?php echo esc_html($ivalue->name)?></option>
											<?php } ?>									

										</select>

									</td>
								</tr> 

								<tr valign="top">
									<th scope="row">"View to Wishlist" Icon</th>
									<td>

										<select class="select_class" id="myselectpageview" name="product_page_view_to_wl_icon" class="myselect">

											<?php foreach ($iconhtml as $ivalue) { 
												if(get_option('product_page_view_to_wl_icon') == $ivalue->name){
													$selected = 'selected';
												}else{
													$selected = '';
												}

												?>
												<option value="<?php echo esc_html($ivalue->name)?>" <?php echo esc_html($selected)?> ><?php echo esc_html($ivalue->name)?></option>
												<?php } ?>	

											</select>

										</td>

									</tr>

									<tr valign="top">
										<th scope="row">Icon Position</th>
										<td>

											<select class="select_class" name="product_page_icon_position">
												<option value="left">Left</option>
												<option value="right" selected="">Right</option>
											</select>

										</td>
									</tr>

									<tr valign="top">
										<th scope="row">Icon Color</th>
										<td>

											<input class="color-field" type="text" name="product_page_wishlist_icon_color" value="<?php echo get_option('product_page_wishlist_icon_color'); ?>">

										</td>
									</tr>
									<tr valign="top">
										<th scope="row">"Add to Wishlist" button Text</th>
										<td>
											<input class="input_class" type="text" name="product_page_add_to_wl_btn_text" value="<?php echo get_option( 'product_page_add_to_wl_btn_text' ); ?>"/>
										</td>
									</tr>  
									<tr valign="top">
										<th scope="row">"View to Wishlist" button Text</th>
										<td>
											<input class="input_class" type="text" name="product_page_view_to_wl_btn_text" value="<?php echo get_option( 'product_page_view_to_wl_btn_text' ); ?>"/>
										</td>
									</tr>          
								</table>

							</div>
							<div class="tab-pane fade" id="tab3default">


								<table class="form-table">
									<tr valign="top">
										<th scope="row">Button position</th>
										<td>
											<select class="select_class" name="product_list_btn_position">
												<option value="after_add_cart_btn" <?php if(get_option('product_list_btn_position') == 'after_add_cart_btn') { echo 'selected';} ?>>After "Add to Cart" button</option>
												<option value="before_add_cart_btn" <?php if(get_option('product_list_btn_position') == 'before_add_cart_btn') { echo 'selected';} ?>>Before "Add to Cart" button</option>

											</select>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">Display Icon/text</th>
										<td>

											<select class="select_class" name="product_list_icon">
												<option value="icon" <?php if(get_option('product_list_icon') == 'icon') { echo 'selected';} ?>>Icon</option>
												<option value="icon_text" <?php if(get_option('product_list_icon') == 'icon_text') { echo 'selected';} ?>>Icon+text</option>
												<option value="text" <?php if(get_option('product_list_icon') == 'text') { echo 'selected';} ?>>Text</option>
											</select>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">View wishlist Icon/text</th>

										<td>

											<select class="select_class" name="product_list_wish_icon">
												<option value="icon" <?php if(get_option('product_list_wish_icon') == 'icon') { echo 'selected';} ?>>Icon</option>
												<option value="icon_text" <?php if(get_option('product_list_wish_icon') == 'icon_text') { echo 'selected';} ?>>Icon+text</option>
												<option value="text" <?php if(get_option('product_list_wish_icon') == 'text') { echo 'selected';} ?>>Text</option>
											</select>
										</td>
									</tr>



									<tr valign="top">
										<th scope="row">Button type</th>
										<td>
											<select class="select_class" name="product_list_btn_type">
												<option value="btn" <?php if(get_option('product_list_btn_type') == 'btn') { echo 'selected';} ?>>button</option>
												<option value="link" <?php if(get_option('product_list_btn_type') == 'link') { echo 'selected';} ?>>link</option>
											</select>
										</td>
									</tr> 
									<tr valign="top">
										<th scope="row">"Add to Wishlist" Icon</th>
										<td>


											<select class="select_class" id="myselect1" name="product_list_add_to_wl_icon" class="myselect">

												<?php foreach ($iconhtml as $ivalue) { 
													if(get_option('product_list_add_to_wl_icon') == $ivalue->name){
														$selected = 'selected';
													}else{
														$selected = '';
													}

													?>
													<option value="<?php echo esc_html($ivalue->name)?>" <?php echo esc_html($selected)?> ><?php echo esc_html($ivalue->name)?></option>
													<?php } ?>	


												</select>

											</td>
										</tr> 

										<tr valign="top">
											<th scope="row">"View to Wishlist" Icon</th>
											<td>

												<select class="select_class" id="myselectlistview" name="product_list_view_to_wl_icon" class="myselect">

													<?php foreach ($iconhtml as $ivalue) { 
														if(get_option('product_list_view_to_wl_icon') == $ivalue->name){
															$selected = 'selected';
														}else{
															$selected = '';
														}

														?>
														<option value="<?php echo esc_html($ivalue->name)?>" <?php echo esc_html($selected)?> ><?php echo esc_html($ivalue->name)?></option>
														<?php } ?>	

													</select>

												</td>

											</tr>
											<tr valign="top">
												<th scope="row">Icon Position</th>
												<td>

													<select class="select_class" name="product_list_icon_position">
														<option value="left">Left</option>
														<option value="right" selected="">Right</option>
													</select>

												</td>
											</tr>

											<tr valign="top">
												<th scope="row">  Icon Color</th>
												<td>
													<input class="color-field" type="text" name="product_list_wishlist_icon_color" value="<?php echo get_option('product_list_wishlist_icon_color'); ?>" >

												</td>
											</tr>
											<tr valign="top">
												<th scope="row">"Add to Wishlist" button Text</th>
												<td>
													<input class="input_class" type="text" name="product_list_add_to_wl_btn_text" value="<?php echo get_option( 'product_list_add_to_wl_btn_text' ); ?>"/>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row">"View to Wishlist" button Text</th>
												<td>
													<input class="input_class" type="text" name="product_list_view_to_wl_btn_text" value="<?php echo get_option( 'product_list_view_to_wl_btn_text' ); ?>"/>
												</td>
											</tr>                
										</table>

									</div>
									<div class="tab-pane fade" id="tab4default">
										<table class="form-table">
											<tr valign="top">
												<th scope="row">Show "Add to Cart" button</th>
												<td>
													<label class="switch">
														<input class="input_class" type="checkbox" name="show_add_cart_btn"  <?php echo (!empty(get_option( 'show_add_cart_btn' )) ? 'checked' : ''); ?>>
														<span class="slider round"></span>
													</label>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row">"Add to Cart" Text</th>
												<td>
													<input class="input_class" type="text" name="add_to_cart_txt" value="<?php echo get_option( 'add_to_cart_txt' ); ?>"/>
												</td>
											</tr>  
											<tr valign="top">
												<th scope="row">Show Unit price</th>
												<td>
													<label class="switch">
														<input class="input_class" type="checkbox" name="show_unit_price"  <?php echo (!empty(get_option( 'show_unit_price' )) ? 'checked' : ''); ?>>
														<span class="slider round"></span>
													</label>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row">Show Stock status</th>
												<td>
													<label class="switch">
														<input class="input_class" type="checkbox" name="show_stack_status"  <?php echo (!empty(get_option( 'show_stack_status' )) ? 'checked' : ''); ?> >
														<span class="slider round"></span>
													</label>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row">Show Date of addition</th>
												<td>
													<label class="switch">
														<input class="input_class" type="checkbox" name="show_date_addition"  <?php echo (!empty(get_option( 'show_date_addition' )) ? 'checked' : ''); ?> >
														<span class="slider round"></span>
													</label>
												</td>
											</tr>

										</table> 

									</div>
									<div class="tab-pane fade" id="tab5default"> <table class="form-table">
										<tr valign="top">
											<th scope="row">Show Checkboxes</th>
											<td>
												<label class="switch">
													<input class="input_class" type="checkbox" name="show_checkbox"  <?php echo (!empty(get_option( 'show_checkbox' )) ? 'checked' : ''); ?>>
													<span class="slider round"></span>
												</label>
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">Show Actions button</th>
											<td>
												<label class="switch">
													<input class="input_class" type="checkbox" name="show_action_btn" <?php echo (!empty(get_option( 'show_action_btn' )) ? 'checked' : ''); ?> >
													<span class="slider round"></span>
												</label>
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">Show "Add Selected to Cart" button</th>
											<td>
												<label class="switch">
													<input class="input_class" type="checkbox" name="show_add_selected_cart_btn" <?php echo (!empty(get_option( 'show_add_selected_cart_btn' )) ? 'checked' : ''); ?>>
													<span class="slider round"></span>
												</label>
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">Add Selected to Cart" Button Text</th>
											<td>
												<input class="input_class" type="text" name="add_selected_cart_btn_txt" value="<?php echo get_option( 'add_selected_cart_btn_txt' ); ?>"/>
											</td>
										</tr>  
										<tr valign="top">
											<th scope="row">Show "Add All to Cart" button</th>
											<td>
												<label class="switch">
													<input class="input_class" type="checkbox" name="show_add_all_to_cart_btn" <?php echo (!empty(get_option( 'show_add_all_to_cart_btn' )) ? 'checked' : ''); ?> >
													<span class="slider round"></span>
												</label>
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">Add All to Cart" Button Text</th>
											<td>
												<input class="input_class" type="text" name="add_all_cart_btn_txt" value="<?php echo get_option( 'add_all_cart_btn_txt' ); ?>"/>
											</td>
										</tr>  

									</table></div>
									<div class="tab-pane fade" id="tab6default">
										<table class="form-table">
											<tr valign="top">
												<th scope="row">Show "Facebook" Button</th>
												<td>
													<label class="switch">
														<input class="input_class" type="checkbox" name="show_fb_btn"  <?php echo (!empty(get_option( 'show_fb_btn' )) ? 'checked' : ''); ?>>
														<span class="slider round"></span>
													</label>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row">Show "Twitter" Button</th>
												<td>
													<label class="switch">
														<input class="input_class" type="checkbox" name="show_twitter_btn" <?php echo (!empty(get_option( 'show_twitter_btn' )) ? 'checked' : ''); ?> >
														<span class="slider round"></span>
													</label>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row">Show "Google+" Button</th>
												<td>
													<label class="switch">
														<input class="input_class" type="checkbox" name="show_google_btn" <?php echo (!empty(get_option( 'show_google_btn' )) ? 'checked' : ''); ?> >
														<span class="slider round"></span>
													</label>
												</td>
											</tr>

											<tr valign="top">
												<th scope="row">Show "Pinterest" Button</th>
												<td>
													<label class="switch">
														<input class="input_class" type="checkbox" name="show_pinterest_btn" <?php echo (!empty(get_option( 'show_pinterest_btn' )) ? 'checked' : ''); ?> >
														<span class="slider round"></span>
													</label>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row">Show "Share by Email" Button</th>
												<td>
													<label class="switch">
														<input class="input_class" type="checkbox" name="show_email_btn" <?php echo (!empty(get_option( 'show_email_btn' )) ? 'checked' : ''); ?>>
														<span class="slider round"></span>
													</label>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row">"Share on" Text</th>
												<td>
													<input class="input_class" type="text" name="share_on_txt" value="<?php echo get_option( 'share_on_txt' ); ?>">
												</td>
											</tr>

										</table>
									</div>

								</div>
							</div>
						</div>
					</div>

				</div>
			</div>




			<?php submit_button(); ?>


<!-- 
<script type="text/javascript">
		 jQuery(document).ready(function($) {
				$('#myselect').fontIconPicker(); 
					$('#myselectpageview').fontIconPicker();
						 $('#myselectlistview').fontIconPicker();
							$('#myselect1').fontIconPicker();
					
		});
</script>

 -->