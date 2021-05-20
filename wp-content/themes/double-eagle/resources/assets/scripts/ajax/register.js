export default {
  init() {
    // Perform AJAX regsiter on register form submit
    $('form#register').submit( function(event) {
      event.preventDefault();
      event.stopImmediatePropagation(); // stops multiple submissions

      $('form#register p.status').show();
      // Perform AJAX post
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: vb_reg_vars.vb_ajax_url, // from localized php page
        data: {
          action: 'register_user',
          nonce: $('#woocommerce-register-nonce').val(),
          user: $('#reg_username').val(),
          pass: $('#reg_password').val(),
          confirm_pass: $('#confirm_password').val(),
          mail: $('#reg_email').val(),
          name: $('#reg_name').val(),
        },
        success : function( data ){ 
          $('form#register p.status').text('Account Created');
          if (data.loggedin == true){
            document.location.href = vb_reg_vars.redirecturl;
          }
        },
        error : function( error ){ 
          $('form#register p.status').text(error.responseText);
        },
      });
    });
  },
}
  