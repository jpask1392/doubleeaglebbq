@php 
$bkg_overlay = '255, 255, 255'; // as rgb value
$overlay = "linear-gradient(rgba(255, 255, 255, 0.6), rgba(0,0,0,0), rgba(0, 0, 0, 0)), ";
$options = get_sub_field('slideshow_options');
$show_controls = (in_array('show_controls', $options) ? true : false);
$show_navigation = (in_array('show_indicators', $options) ? true : false);
$duplicate_text = (in_array('duplicate_text', $options) ? true : false);
@endphp

<div class="hero-slideshow {{ $bkg_overlay ? 'has-overlay' : '' }} bg-{{get_sub_field('background_color')}}">

  <div 
    id="carousel-hero" 
    class="carousel slide {{ get_sub_field('slide_animation') == 'fade' ? "carousel-fade" : "" }}" 
    data-ride="carousel" 
    data-interval="{{ get_sub_field('slideshow_speed')}}"
    data-pause="false">

    @if ($show_navigation)
    <ol class="carousel-indicators">
      @while (have_rows('hero_slides')) @php the_row() @endphp
        <li data-target="#carousel-hero" data-slide-to="{{ get_row_index() - 1 }}" class={{ get_row_index() == 1 ? "active": ""}}></li>    
      @endwhile
    </ol>
    @endif

    <div class="carousel-inner" style="background-color: rgba(0,0,0,1)">

      @if ($duplicate_text)
        @php 
          $rows = get_sub_field('hero_slides');
          $first_row = $rows[0];
          $first_content = $first_row['slide_content'];
        @endphp

        
          <div class="carousel-caption ">
            {!! $first_content !!}
          </div>
        
        
      @endif

      @while (have_rows('hero_slides')) @php the_row() @endphp
 
      <div  class="carousel-item w-100{{ get_row_index() == 1 ? " active": ""}}"
            style="background-image: {{ $overlay }}url('{{ get_sub_field('slide_image')['url'] }}')">

        <div class="carousel-caption d-none d-md-block">
          
            @if (!$duplicate_text)
              {!! get_sub_field('slide_content') !!}
            @endif
          
        </div>
        
      </div>
      @endwhile
    </div>

    @if ($show_controls)
    <a class="carousel-control-prev" href="#carousel-hero" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-hero" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    @endif
  </div>
  
  <div class="rip-bottom rip-bottom--1">
    <div class="rip bg-{{get_sub_field('background_color')}}"></div>
  </div>
</div>  