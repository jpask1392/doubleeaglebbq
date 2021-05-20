<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="loginTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <img class="modal-golf-ball" src="@asset('./images/golf-ball-lg.png')" alt="">
      <div class="modal-header">
        <button type="button" class="close p-4" data-dismiss="modal" aria-label="Close">
          <div id="burger-icon" class="animated-icon open"><span></span><span></span><span></span></div>
        </button>
      </div>
      <div class="modal-body p-5">
        <div class="form-logo-container">
          {{ the_custom_logo() }}
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-sign-up-tab" data-toggle="pill" href="#pills-sign-up" role="tab" aria-controls="pills-sign-up" aria-selected="false">Sign up</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
            @php global $woocommerce @endphp 
            @include('forms.login-form')
          </div>
          <div class="tab-pane fade" id="pills-sign-up" role="tabpanel" aria-labelledby="pills-sign-up-tab">
            @include('woocommerce.register-form')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
