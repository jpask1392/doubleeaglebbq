<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="navigation-modal" tabindex="-1" role="dialog" aria-labelledby="navigationTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <div class="">
            {{ the_custom_logo() }}
          </div>  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <div id="burger-icon" class="animated-icon open"><span></span><span></span><span></span></div>
          </button>
        </div>

        <div class="modal-body p-0">
          <nav id="primary-header" class="navbar navbar-expand-lg px-0 px-lg-5">
          
            <div class="w-100" id="primary-navigation">
              {!! wp_nav_menu(array(
                    'container'     => false,
                    'menu'          => 'Primary',
                    'menu_class'    => 'primary-navigation navbar-nav p-0 pt-5', 
                    'walker'        => new Primary_Nav_Walker()
                )) !!} 
            </div>
          </nav>
        </div>

      </div>
    </div>
  </div>
  