@php 
// Layout
$container_width = get_sub_field("container_width");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$include_section_header = get_sub_field("include_section_header");

$rip_options = get_sub_field('section_rips');

// Colors
$bkg_color = get_sub_field('background_color') ? "bg-" . get_sub_field('background_color') : "";
$bkg_overlay = get_sub_field('background_overlay') ? "overlay-" . get_sub_field('background_overlay') : "";
$bkg_overlay_opacity = get_sub_field('background_overlay_opacity');

// Images 
$bkg_image = get_sub_field('background_image');
  
@endphp

<section class="cooking-instructions-section {{ $bkg_color }} align-items-center rip-top--1">

  @if (in_array('Rip Top', $rip_options)) 
    <div class="rip-top rip-top--1">
      <div class="rip"></div>
    </div>
  @endif

  @if ($bkg_image || $bkg_overlay)
  <div class="standard-background">
    <div  class="background-overlay {{ $bkg_overlay }}" 
          style="opacity: {{ $bkg_overlay_opacity }};"></div>
    <div  class="background-image" 
          style="{{ $bkg_image }}; background-position: center; "></div>
  </div>
  @endif

  <div class="{{ $container_width }} py-5">

    @if ($include_section_header)
      <div class="section-intro mb-5"> <?= get_sub_field('section_header') ?></div>    
    @endif

      @while (have_rows('section_content')) @php the_row() @endphp

        <div class="row align-items-{{ $vertical_content_align }} justify-content-{{ $justify_content }}">

          @if (get_row_index() % 2 == 0) 
            <div class="image-container col-md-6 order-1 order-md-1">
              <img class="w-100" src="{{ get_sub_field('image')['url'] }}" alt="">
            </div>
            <div class="instruction-container split col-md-6 p-4 order-2 order-md-2">
                {!! get_sub_field('text') !!}
            </div>
          @else 
            <div class="instruction-container split col-md-6 p-4 order-2 order-md-1">
              {!! get_sub_field('text') !!}
            </div>
            <div class="image-container col-md-6 order-1 order-md-2">
                <img class="w-100" src="{{ get_sub_field('image')['url'] }}" alt="">
            </div>
          @endif

        </div>

      @endwhile 
             
  </div>

  @if (in_array('Rip Bottom', $rip_options)) 
    <div class="rip-bottom rip-bottom--3">
      <div class="rip"></div>
    </div>
  @endif
    
</section>