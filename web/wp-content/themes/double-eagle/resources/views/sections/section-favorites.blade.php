@php 
$container_width = get_sub_field("container_width");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$include_section_header = get_sub_field("include_section_header");

// Colors
$bkg_color = get_sub_field('background_color') ? "bg-" . get_sub_field('background_color') : "";
$bkg_overlay = get_sub_field('background_overlay') ? "overlay-" . get_sub_field('background_overlay') : "";
$bkg_overlay_opacity = get_sub_field('background_overlay_opacity');

// Images 
$bkg_image = get_sub_field('background_image');

$display_count = get_sub_field('display_count'); // default 'no limit'
$col_width;
switch ($display_count) {
    case 1: $col_width = "col-lg-12"; break;
    case 2: $col_width = "col-lg-6"; break;
    case 3: $col_width = "col-sm-6 col-lg-4"; break;
    case 4: $col_width = "col-sm-6 col-lg-3"; break;
    default: $col_width = "col-sm-6 col-md-3 col-lg-2"; break;
}

$args = array( 
    'post_type'         => 'product',
    'meta_key'          => 'total_sales',
    'orderby'           => 'meta_value_num',
    'posts_per_page'    => $display_count
);

$loop = new WP_Query( $args );

@endphp

<section class="favorites woocommerce my-5">

  @if ($bkg_image || $bkg_overlay)
  <div class="standard-background">
    <div  class="background-overlay {{ $bkg_overlay }}" 
          style="opacity: {{ $bkg_overlay_opacity }};"></div>
    <div  class="background-image" 
          style="{{ $bkg_image }}; background-position: center; "></div>
  </div>
  @endif

  @if ($include_section_header)    
    <div class="section-intro mb-5"> <?= get_sub_field('section_header') ?></div>    
  @endif
  
  <div class="{{ $container_width }}">
    <div class="row">
      @while ( $loop->have_posts() ) @php $loop->the_post() @endphp
        <div class="{{ $col_width }} d-flex flex-column fade-in">
          @php global $product @endphp
          <div class="favorites-thumbnail">
            {{ the_post_thumbnail() }}
          </div>
          <h5 class="text-center flex-grow-1 mt-3">{{$product->get_title()}}</h5>
          <p class="mt-0 mb-4 text-center">
            @php 
            $subcats = get_terms( array(
              'taxonomy'    => 'product_cat',
              'hide_empty'  => true,
              'parent'      => $product->get_category_ids()[0]
            ));
            foreach ($subcats as $value) {
              echo $value->name;
            }
            @endphp
          </p>
          <a class="d-block text-center" href="{{ get_permalink( $product->get_id() ) }}"><button><span>Shop Now</span></button></a>
        </div>
      @endwhile
      
      {{wp_reset_query()}}
      
    </div>
  </div>
    
</section>

