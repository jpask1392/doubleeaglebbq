@php 

// Layout
$col_class = get_sub_field('split_column') ? "col-md-6" : 'col'; 
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
@endphp

<section class="standard-section {{ $bkg_color }} justify-content-{{ $justify_content }} align-items-center">

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

    <div class="row align-items-{{ $vertical_content_align }}">
        
      @if (have_rows('accordion'))
        @while (have_rows('accordion')) @php the_row() @endphp
        @php $unique_id = $section_index . '-' . get_row_index() @endphp 
          <div class="accordion" id="accordion-{{ $unique_id }}">
            <div class="accordion-card">
                
              <div  class="card-header p-4" 
                    id="heading-{{ $unique_id }}" 
                    data-toggle="collapse" 
                    data-target="#collapse-{{ $unique_id }}" 
                    aria-expanded="true" 
                    aria-controls="collapse-{{ $unique_id }}">
          
                  <h5 class="mb-0">
                      {{ get_sub_field('accordion_header') }}
                  </h5>
                  <i class="fas fa-angle-down" style="font-size:2rem"></i>
          
              </div>
          
              <div id="collapse-{{ $unique_id }}" class="collapse" aria-labelledby="heading-{{ $unique_id }}" data-parent="#accordion-{{ $unique_id }}">
                  <div class="card-body bg-primary text-white p-5">
                      {!! get_sub_field('accordion_content') !!}
                  </div>
              </div>
            </div>
          </div>
        @endwhile
        @endif
             
    </div>
  </div>
    
</section>

