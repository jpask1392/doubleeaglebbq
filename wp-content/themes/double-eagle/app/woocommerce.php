<?php
/**
 * Override theme default specification for product # per row
*/
add_filter('loop_shop_columns', function () {
  return 2; // 2 products per row
}, 999);

/**
 * Product archive page
*/
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item', function () {
  global $product;
  $link = $product->get_permalink();
  // $text = _( 'Buy Now', 'woocommerce' );
  echo '<a href="'.$link.'" class="button addtocartbutton">Buy Now</a>';
});

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);


/**
 * Single product page ---------------------------
*/

// remove sales badge
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
 
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// wrap price and title
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', function () {
  global $product;
  echo '<div class="product-title-price-container">';
  echo the_title( '<h4 class="product_title entry-title">', '</h4>' );
  echo '<h3 class="' . esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ) . '"> ' . $product->get_price_html() . '</h3>';
  echo '</div>';
}, 5, 0);

add_action('woocommerce_before_add_to_cart_quantity', function () {
  echo '<div class="quanity-wrapper d-flex"> <h6>Quantity</h6> ';
});

add_action('woocommerce_after_add_to_cart_quantity', function () {
  echo '</div>';
});

add_action('woocommerce_after_add_to_cart_button', function () {
  echo '<div class="single-socials-wrapper">';
  if (have_rows('socials', 'options')) :
    while (have_rows('socials', 'options')) : the_row();
      ?>
      <a href="<?php the_sub_field('social_profile_link') ?>">
        <i class="fab fa-<?php the_sub_field('social_icon_name')?>"></i>
      </a>
      <?php 
    endwhile;
  endif;
  echo '</div>';
});

// add_filter( 'woocommerce_checkout_fields' , function ( $fields ) {
//      $fields['billing']['billing_first_name']['placeholder'] = 'My new placeholder';
//      $fields['order']['order_comments']['label'] = 'My new label';
//      return $fields;
// } );

// wrap product summary and image in container 
add_action( 'woocommerce_before_single_product_summary', function () {
  echo '<div class="container d-md-flex align-items-center">';
}, 1);

add_action( 'woocommerce_after_single_product_summary', function () {
  echo '</div>';
}, 5);

// add section before related products
add_action( 'woocommerce_after_single_product_summary', function () {
  global $product;
  ?>
  <div class="split-section single-product-description-wrapper bg-secondary rip-bottom--2 rip-top--1">
    <div class="rip-top rip-top--1">
      <div class="rip"></div>
    </div>
    <div class="container-fluid px-md-5 py-3 py-md-5">
      <div class="row align-items-center">
        <div class="col-md-6 image image-crop">
          <div style="background-image:url('<?php echo get_field('image')['url'] ?>')"></div>
        </div>
        <div class="col-md-6 text">
          <?php echo $product->get_data()['description'] ?>
        </div>
      </div>
    </div>
    <div class="rip-bottom rip-bottom--2">
      <div class="rip"></div>
    </div>
  </div>
  <?php
}, 15);

add_filter( 'woocommerce_product_review_list_args', function ($args) {
  $args['reverse_top_level'] = true;
  return $args;
});

// Change number of related products output
add_filter( 'woocommerce_output_related_products_args', function ( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}, 20 );

/**
 * Checkout page ---------------------------
*/

// hide order notes
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

// Change text in checkout button
function woocommerce_button_proceed_to_checkout() {
  ?>
  <a href="<?php echo esc_url( wc_get_checkout_url() );?>" class="checkout-button button alt wc-forward">
    <?php esc_html_e( 'Checkout', 'woocommerce' ); ?>
  </a>
  <?php
 }

 // Create a function to update cart on quantity click
 add_action( 'wp_footer', function () { 
  if (is_cart()) { 
     ?> 
     <script type="text/javascript"> 
        jQuery('div.woocommerce').on('click', 'input.qty', function(){ 
           jQuery("[name='update_cart']").trigger("click"); 
        }); 
     </script> 
     <?php 
  } 
} ); 

add_action( 'wp_footer', function () { 
     ?> 
     <script type="text/javascript"> 
        jQuery('div.woocommerce').on('click', 'input.qty', function(){ 
           jQuery("[name='update_cart']").trigger("click"); 
        }); 
     </script> 
     <?php 
} ); 

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

add_filter( 'woocommerce_cart_shipping_method_full_label', function ( $label, $method ) {
  $new_label = preg_replace( '/^.+:/', '', $label );
  return $new_label;
}, 10, 2 );  

add_filter( 'woocommerce_checkout_fields' , function ( $fields ) {
  // var_dump($fields['billing']['billing_email']['class']);
  $fields['billing']['billing_state']['class'] = ['address-field', 'form-row-first'];
  $fields['billing']['billing_postcode']['class'] = ['address-field', 'form-row-last'];
  $fields['billing']['billing_phone']['class'] = ['form-row-first'];
  $fields['billing']['billing_email']['class'] = ['form-row-last'];

  $fields['shipping']['shipping_state']['class'] = ['address-field', 'form-row-first'];
  $fields['shipping']['shipping_postcode']['class'] = ['address-field', 'form-row-last'];
  return $fields;
} );


/**
 * Cart page ---------------------------
*/
add_action( 'woocommerce_after_cart_totals', function () {
  echo '<a class="continue-shopping" href="'  . get_permalink( wc_get_page_id( 'shop' )) . '">or Continue Shopping <i class="fas fa-chevron-right"></i></a>';
}, 10, 0 ); 

/**
 * Account page ---------------------------
*/

// Remove downloads tab
add_filter( 'woocommerce_account_menu_items', function ( $items ) {
  unset($items['downloads']);
  return $items;
}, 999 );

// Add the code below to your theme's functions.php file to add a confirm password field on the register form under My Accounts.
// add_filter('woocommerce_registration_errors', function ($reg_errors, $sanitized_user_login, $user_email) {
// 	global $woocommerce;
// 	extract( $_POST );
// 	if ( strcmp( $password, $password2 ) !== 0 ) {
// 		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
// 	}
// 	return $reg_errors;
// }, 10,3);

add_action( 'woocommerce_register_form', function () {
	?>
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
	<?php
} );
 

/**
 * This code execute inside head tag
 */
// add_action( "wp_head",  __NAMESPACE__ . '\\xlwcty_thank_you_header_script', 20 );

// if ( ! function_exists( 'xlwcty_thank_you_header_script' ) ) {

// 	function xlwcty_thank_you_header_script() {
// 		if ( function_exists( 'is_order_received_page' ) && is_order_received_page() && isset($_GET['key']) ) {
//       $order_id = wc_get_order_id_by_order_key( $_GET['key'] );
// 			$order    = wc_get_order( $order_id );
// 			if ( $order instanceof \WC_Order ) {
//       }
//     }
//   }
// };

add_action( 'wp_head', __NAMESPACE__ . '\\script_in_head' );

function script_in_head(){
  // On Order received endpoint only
  if( is_wc_endpoint_url( 'order-received' ) ) :
    $order_id = absint( get_query_var('order-received') );
    if( get_post_type( $order_id ) !== 'shop_order' ) return; // Exit
      $order = wc_get_order( $order_id );
    ?>
    <script type="text/javascript">
      // script goes here
      gtag('event', 'conversion', {
        'send_to': 'AW-959454922/ovrYCJGBrssBEMq9wMkD',
    	'transaction_id': ''
	  });
    </script>
    <?php   
  endif;
}
