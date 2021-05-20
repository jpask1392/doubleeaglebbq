<form id="register" method="post" class="">
  <p class="status"><img src="@asset('images/loading.gif')" alt=""></p>

  @if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) )
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="Username*" /><?php // @codingStandardsIgnoreLine ?>
    </p>
  @endif

    <p class="form-row">
      <input 
        id="reg_email"
        type="email" 
        class="" 
        name="email"  
        value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" 
        placeholder="Email" />
    </p>


  @if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) )

      <p class="form-row password">
        <input
          id="reg_password"
          type="password" 
          class="" 
          name="password"
          placeholder="Password" />
      </p>

      <p class="form-row">
        <input 
          id="confirm_password" 
          type="password" 
          class="" 
          name="confirm-password"
          placeholder="Confirm Password" />
      </p>

  @else

    <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

  @endif
  
  {{-- Nonce for security --}}
  <p class="text-center">
    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
    <button 
      type="submit" 
      name="register" 
      class="register-button" 
      value="<?php esc_attr_e( 'Sign Up', 'woocommerce' ); ?>">
        <?php esc_html_e( 'Sign Up', 'woocommerce' ); ?>
    </button>
  </p>
  
</form>