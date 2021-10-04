@php 
$args = array(
    'container'     => false,
    'menu'          => 'Primary',
    'menu_class'    => 'primary-navigation navbar-nav m-auto h-100', 
    'walker'        => new Primary_Nav_Walker()
);
@endphp

@include('partials.store-notice')

<header class="banner">
  <nav id="primary-header" class="navbar navbar-expand-lg px-md-5 w-100">
    
    <?php the_custom_logo() ?>
  
    <button id="navbar-toggler" class="navbar-toggler first-button border-0" type="button"
      aria-controls="primary-navigation" aria-expanded="false" aria-label="Toggle navigation">
      <div id="burger-icon" class="animated-icon"><span></span><span></span><span></span></div>
    </button>
  
    <div class="collapse navbar-collapse" id="primary-navigation">
      {!! wp_nav_menu($args) !!} 
    </div>
    <div id="account-navigation">
      @include('partials.header-actions')
    </div>
  </nav>
</header>
@include('modals.navigation')
