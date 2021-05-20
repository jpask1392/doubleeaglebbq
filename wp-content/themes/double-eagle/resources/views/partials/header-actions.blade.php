@php 
global $woocommerce;
$links = wp_get_nav_menu_items('Account');
$link_title = "";
$count = count($links);
@endphp

<ul class="navbar-nav">

    @foreach ($links as $link)

      @switch($link->title)
        @case('My account')
          @php $link_title = 'My account' @endphp
          @break
        @case('Cart')
          @php $link_title = 'Cart' @endphp
          @break
      @endswitch

      <li class="nav-item {{implode(' ', $link->classes)}}">
        @if($link->title === 'Cart' )
          <span class="cart-customlocation cart-contents"> {{ WC()->cart->get_cart_contents_count() }} </span>
        @endif

        @if (!is_user_logged_in())
          <a href="{{$link->url}}" class="nav-link nav-icon" @if($link->title === 'My account') data-toggle="modal" data-target="#login-modal" @endif >
            
          </a>
        @else 
          <a href="{{$link->url}}" class="nav-link nav-icon">
            
          </a>
        @endif

      </li>
    
    @endforeach
  
</ul>