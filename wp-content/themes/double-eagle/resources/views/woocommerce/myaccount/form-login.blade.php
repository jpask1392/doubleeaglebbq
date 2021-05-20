<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-6" id="customer_login">
			<h2 class="mb-4"><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>
			@include('forms.login-form')
		</div>
		
		<div class="col-md-6">
			<h2 class="mb-4"><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>
			@include('woocommerce.register-form')
		</div>	
	</div>
</div>
