@php 
$bkg_overlay = '255, 255, 255'; // as rgb value
$overlay = "linear-gradient(rgba(255, 255, 255, 0.6), rgba(0,0,0,0), rgba(0, 0, 0, 0)), ";
$include_section_header = get_sub_field("include_section_header");

$options = get_sub_field('slideshow_options');
$show_controls = (in_array('show_controls', $options) ? true : false);
$show_navigation = (in_array('show_indicators', $options) ? true : false);

$args = array( 
    'post_type'         => 'recipes',
    'posts_per_page'    => 2,
    'order_by'          => 'date', 
    'order'             => 'ASC', 
);

$loop = new WP_Query( $args );
@endphp

<section class="recipe-slideshow {{ $bkg_overlay ? 'has-overlay' : '' }} bg-{{get_sub_field('background_color')}} my-5">

  @if ($include_section_header)
    <div class="section-intro container mb-5"> <?= get_sub_field('section_header') ?></div>    
  @endif

  
  <div id="carousel-recipes" class="carousel slide carousel-fade container" data-ride="carousel">
    <div class="carousel-inner">

      @if ($loop->have_posts())
      @while ( $loop->have_posts() ) @php $loop->the_post() @endphp
      
      <div class="carousel-item {{ $loop->current_post == 0 ? "active": ""}}">
        <div class="row align-items-center">

        <div class="order-1 d-block d-md-none text-center w-100" style="padding: 15px">
          <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
          <time class="updated d-block" datetime="{{ get_post_time('c', true) }}"><i class="far fa-calendar-alt mr-2"></i>{{ get_the_date() }}</time>
        </div>

        <div class="item-description d-block col-md-6 order-3 order-md-2">

          <div class="d-none d-md-block">
            <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
            <time class="updated d-block" datetime="{{ get_post_time('c', true) }}"><i class="far fa-calendar-alt mr-2"></i>{{ get_the_date() }}</time>
          </div>
  
          <p>{!! get_the_excerpt() !!}</p>
          <div class="navigation-controls">
            <a href="{{ the_permalink() }}" class="btn btn-primary read-more">Read More <span class="sr-only">about "{{ the_title() }}"</span></a>

            <div class="controls-wrapper">
              <a class="control-prev" href="#carousel-recipes" role="button" data-slide="prev">
                <i class="fas fa-arrow-left"></i>
                <span class="sr-only">Previous</span>
              </a>
              <a class="control-next" href="#carousel-recipes" role="button" data-slide="next">
                <i class="fas fa-arrow-right ml-3"></i>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          </div>

        <div class="col-md-6 order-2 order-md-3">
          <div class="crop-aspect">
            <div  class="crop" 
                  style="background-image: url('{{ the_post_thumbnail_url('large') }}')">
            </div>
          </div>
        </div>
      </div>
      </div>
  
      @endwhile
      @endif
      {{wp_reset_query()}}
    </div>
  </div>
  

</section>

