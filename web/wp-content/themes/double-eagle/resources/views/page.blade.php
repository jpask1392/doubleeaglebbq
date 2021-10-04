@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @if (!is_front_page()) 
      @include('partials.page-header')
    @endif
    
    @include('partials.content-page')

    @while (have_rows('page_content')) @php the_row() @endphp

      @if (get_row_layout() == "hero_slideshow_layout") 
        @include('sections.section-hero-slideshow')
      @endif

      @if (get_row_layout() == "standard_layout") 
        @include('sections.section-standard')
      @endif

      @if (get_row_layout() == "grid_layout") 
        @include('sections.section-grid')
      @endif

      @if (get_row_layout() == "split_layout") 
        @include('sections.section-split')
      @endif

      @if (get_row_layout() == "favorites_layout") 
        @include('sections.section-favorites')
      @endif

      @if (get_row_layout() == "banner_layout") 
        @include('sections.section-banner')
      @endif

      @if (get_row_layout() == "recipe_slideshow_layout") 
        @include('sections.section-recipe-slideshow')
      @endif

      @if (get_row_layout() == "accordion_layout") 
        @include('sections.section-accordion', ['section_index' => get_row_index()])
      @endif

    @endwhile
  @endwhile
@endsection
