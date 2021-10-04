@extends('layouts.app')

@section('content')

  @include('partials.page-header')

  <div class="container">

    <div class="headline-wrapper text-center py-5">
      <h5>OUR DELICIOUS</h5>
      <h2>PRODUCTS</h2>
    </div>

    @if (woocommerce_product_loop())
    <div class="custom-select">
      {{ do_action( 'woocommerce_before_shop_loop' ) }}
    </div>
    
	  {{ woocommerce_product_loop_start() }}

    @if ( wc_get_loop_prop( 'total' ) )
      @while ( have_posts() ) @php the_post() @endphp
        {{ do_action( 'woocommerce_shop_loop' ) }}
        {{ wc_get_template_part( 'content', 'product' ) }}
      @endwhile
    @endif

    {{ woocommerce_product_loop_end() }}
	  {{ do_action( 'woocommerce_after_shop_loop' ) }}
  @else
	  {{ do_action( 'woocommerce_no_products_found' ) }}
  @endif

  </div>

@endsection