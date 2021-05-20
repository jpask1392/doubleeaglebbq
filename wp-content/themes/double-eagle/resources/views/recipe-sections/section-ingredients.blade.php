@php 
// Layout
$container_width = get_sub_field("container_width");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$include_section_header = get_sub_field("include_section_header");

// Colors
$bkg_color = get_sub_field('background_color') ? "bg-" . get_sub_field('background_color') : "";
$bkg_overlay = !get_sub_field('background_gradient_overlay') ? "overlay-" . get_sub_field('background_overlay') : "";
$bkg_overlay_opacity = get_sub_field('background_overlay_opacity');

// Images 
$bkg_image = get_sub_field('background_image');

// conditionals
$container_bkg_color = get_sub_field('container_background_color') 
  ? "bg-" . get_sub_field('container_background_color') . " ignore-padding" 
  : "";
$bkg_gradient_colors = (object) array (
  'start'   => get_sub_field('background_gradient_colors')['gradient_start'], 
  'end'     => get_sub_field('background_gradient_colors')['gradient_end']
);
$bkg_gradient = get_sub_field('background_gradient_overlay') 
  ? ", linear-gradient(90deg," . $bkg_gradient_colors->start . " 0%, " . $bkg_gradient_colors->end . " 100%)" 
  : "";
$bkg_image = get_sub_field('background_image') 
  ? "background-image: url('" . $bkg_image['url'] . "')" . $bkg_gradient 
  : "";
  
@endphp


<section class="ingredients-section {{ $bkg_color }} align-items-center">

  <div class="standard-background">
    <div  class="background-overlay {{ $bkg_overlay }}" 
          style="opacity: {{ $bkg_overlay_opacity }};"></div>
    <div  class="background-image" 
          style="{{ $bkg_image }}; background-position: center; "></div>
  </div>

  <div class="{{ $container_width }} overlay-{{ $bkg_overlay }}-text py-5">

    @if ($include_section_header)
      <div class="section-intro mb-5"> <?= get_sub_field('section_header') ?></div>    
    @endif

    <div class="row align-items-{{ $vertical_content_align }} justify-content-{{ $justify_content }}">
        <div class="col-md-6 ingredients-wrapper">
          <h3>Ingredients</h3>
          <ul>
            @if (have_rows('ingredients'))
              @while (have_rows('ingredients')) @php the_row() @endphp
                <li>{!! get_sub_field('ingredient') !!}</li>
              @endwhile
            @endif
          </ul> 
        </div>
        <div class="col-md-6 image-wrapper">
          <div class="crop-aspect">
            <div class="crop" style="background-image:url('{{ get_sub_field('image')['url'] }}')"></div>
          </div>
        </div>
    </div>
  </div>
    
</section>