@php 
// Layout
$col_class = get_sub_field('split_column') ? "col-md-6" : 'col'; 
$container_width = get_sub_field("container_width");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$include_section_header = get_sub_field("include_section_header");

$rip_options = get_sub_field('section_rips');
$column_count = get_sub_field('split_column') ? 2 : 1;

// Colors
$bkg_color = get_sub_field('background_color') ? "bg-" . get_sub_field('background_color') : "";
$bkg_overlay = get_sub_field('background_overlay') ? "overlay-" . get_sub_field('background_overlay') : "";
$bkg_overlay_opacity = get_sub_field('background_overlay_opacity');

// Images 
$bkg_image = get_sub_field('background_image');

$rip_top = (in_array('Rip Top', $rip_options)) ? 'rip-top--1' : false;
$rip_bottom = (in_array('Rip Bottom', $rip_options)) ? 'rip-bottom--2' : false;
@endphp


<section class="standard {{ $bkg_color }} align-items-center {{$rip_top}} {{ $rip_bottom }}">

  @if ($rip_top) 
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

    <div class="row align-items-{{ $vertical_content_align }} justify-content-{{ $justify_content }}">
        
      @while (have_rows('section_content')) @php the_row() @endphp
        
          @if (get_sub_field('split_section'))
            <div class="row mb-3 animate-up">
              <div class="col-md-6">
                {!! get_sub_field('content_lhs') !!}
              </div>
              <div class="col-md-6">
                {!! get_sub_field('content_rhs') !!}
              </div>  
            </div>
          @else 
          <div class="col-12 animate-up">
            {!! get_sub_field('text') !!}
          </div>
            
          @endif
        
      @endwhile 
             
    </div>
  </div>

  @if ($rip_bottom) 
    <div class="rip-bottom rip-bottom--2">
      <div class="rip"></div>
    </div>
  @endif
    
</section>