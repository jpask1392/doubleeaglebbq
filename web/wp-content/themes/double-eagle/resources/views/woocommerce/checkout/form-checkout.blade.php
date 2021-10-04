

@if ( ! defined( 'ABSPATH' ) ) @php exit @endphp @endif
<div class="container">
    
<?php

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout row" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <?php if ( $checkout->get_checkout_fields() ) : ?>    
        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col-md-7 order-2 order-md-1" id="customer_details">
            <?php do_action( 'woocommerce_checkout_billing' ); ?>
            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
            <?php remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10) ?>
            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
        </div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

    
    
    <aside class="col-md-5 order-1 order-md-2">
        <div id="order_review" class="woocommerce-checkout-review-order p-2 p-lg-5 mb-5 mb-md-0">
            <?php add_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10) ?>
            <?php remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20) ?>                    
            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
        </div>
    </aside>



<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</form>

</div>