

@if ( ! defined( 'ABSPATH' ) ) @php exit @endphp @endif
@php global $product @endphp
@if ( ! wc_review_ratings_enabled() ) @php return @endphp @endif

@php 
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
@endphp

@if ( $rating_count > 0 )

	<div class="woocommerce-product-rating">
		@if ( comments_open() )
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow">
                <span class="count">Read the Testimonials</span>
            </a>
		@endif
	</div>

@endif
