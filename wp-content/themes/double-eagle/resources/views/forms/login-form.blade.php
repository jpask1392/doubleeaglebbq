<form id="login" action="login" method="post">    
    <p class="status"><img src="@asset('images/loading.gif')" alt=""></p>

    <p class="form-row">
        <input 
            id="username" 
            type="text" 
            name="username"
            placeholder="Username">
    </p>
    
    <p class="form-row">
        <input 
            id="password" 
            type="password" 
            name="password"
            placeholder="Password">
    </p>    

    <p class="text-center">
        {!! wp_nonce_field( 'ajax-login-nonce', 'security' ) !!}
        <button 
            type="submit" 
            name="login" 
            class="login-button" 
            value="<?php esc_attr_e( 'Sign In', 'woocommerce' ); ?>">
            <?php esc_html_e( 'Sign In', 'woocommerce' ); ?>
        </button>
    </p>
</form>