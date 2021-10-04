export default {
  init() {
    // Perform AJAX login on login form submit 
    $('form#login').on('submit', function(e){
      e.preventDefault();
      e.stopImmediatePropagation(); // stops multiple submissions

      $('form#login p.status').show();
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_login_object.ajaxurl,
        data: { 
          'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
          'username': $('form#login #username').val(), 
          'password': $('form#login #password').val(), 
          'security': $('form#login #security').val() },
        success: function(data){
          $('form#login p.status').text(data.message);
          if (data.loggedin == true){
              document.location.href = ajax_login_object.redirecturl;
          }
        },
      });
    })
  },
}
