@php 
// if page is posts archive
if (is_home()) {
  $feature_img_url = get_the_post_thumbnail_url(get_option('page_for_posts')) ?: \App\asset_path('images/default-blog-header.jpg');
  $display_page_header = get_field('display_page_header', get_option('page_for_posts'));
  $title = get_field('alternative_page_header', get_option('page_for_posts')) ?? App::title();
  $bkg_color = 'white';
} 
elseif (is_woocommerce() || is_cart() || is_checkout()) {
  $feature_img_url = get_the_post_thumbnail_url(get_option( 'woocommerce_shop_page_id' ));
  $title = woocommerce_page_title( false );
  $bkg_color = get_field("background_color", get_option( 'woocommerce_shop_page_id' ));
}
elseif (is_archive() && get_post_type() == 'recipes') {
  // 63 is the ID of the recipe archive page
  // i cant find a way of calling this ID .. 
  $feature_img_url = get_the_post_thumbnail_url(63);
  $display_page_header = get_field('display_page_header');
  $title = the_field('alternative_page_header', 63) ?? get_the_archive_title('', false);
  $bkg_color = get_field("background_color", 63);
}
elseif (is_single()) {
  $feature_img_url = get_the_post_thumbnail_url();
  $title = get_the_title();
  $bkg_color = 'white';
}
else {
  $feature_img_url = get_the_post_thumbnail_url();
  $display_page_header = get_field('display_page_header');
  $title = the_field('alternative_page_header') ?? App::title();
  $bkg_color = get_field("background_color") ?? 'white';
}

$bkg_overlay = true;
$overlay = "linear-gradient(rgba(255, 255, 255, 0.6), rgba(0,0,0,0.35) 120px, rgba(0,0,0,0.35)), ";

@endphp

<section  class="page-header {{ $bkg_overlay ? 'has-overlay' : '' }}" 
          style="background-image: {{ $overlay }}url('{{ $feature_img_url }}'); background-color: {{$bkg_color}}">
  <div class="content--header d-flex flex-column justify-content-center align-items-center">
    <h1 class="mb-4">
        {!! $title !!}
    </h1>
    @include('svgs.logo-golf-clubs', ['color' => 'white'])
    
  </div>

  <div class="rip-bottom rip-bottom--1">
    <div class="rip" style="background-color:{{$bkg_color}}"></div>
  </div>

</section>
