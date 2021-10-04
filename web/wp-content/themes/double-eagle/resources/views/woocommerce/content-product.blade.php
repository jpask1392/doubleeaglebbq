@php 
defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$subcats = get_terms( array(
    'taxonomy'    => 'product_cat',
    'hide_empty'  => true,
    'parent'      => $product->get_category_ids()[0]
));

// var_dump($product->get_category_ids())
@endphp

<li {{ wc_product_class( '', $product ) }}>
    <div class="woocommerce-product-img-wrapper">
        {{ do_action( 'woocommerce_before_shop_loop_item' ) }}
        {{ do_action( 'woocommerce_before_shop_loop_item_title' ) }}
    </div>
    
	{{ do_action( 'woocommerce_shop_loop_item_title' ) }}

    <div class="mt-n2">
        @foreach ( $subcats as $term )
            @if (is_single())
                <p>{{$term->name}}</p>
            @else 
                <h4>{{$term->name}}</h4>
            @endif
        @endforeach
    </div>

    @if (!is_single())
        {{ do_action( 'woocommerce_after_shop_loop_item_title' ) }}
    @endif
    {{ do_action( 'woocommerce_after_shop_loop_item' ) }}
    
</li>
