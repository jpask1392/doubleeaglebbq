@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (get_post_type() == 'post')
    @include('partials.content-filters')
  @endif

  <div class="container">
    @if (!have_posts())
      <div class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
      {!! get_search_form(false) !!}
    @endif

    @while (have_posts()) @php the_post() @endphp
      @include('partials.content-'.get_post_type())
    @endwhile
  </div>


  <nav class="post-pagination container-fluid mt-5" role="navigation">
    
    @php 
    $prev = get_previous_posts_page_link();
    $next = get_next_posts_page_link();
    @endphp 
    <a href="{!! $prev !!}" class="btn-prev {{ !get_previous_posts_link() ? "disabled" : "" }}"><i class="fas fa-arrow-left"></i> Prev <span class="sr-only">Page</span></a>
    {!! paginate_links(array(
      'end_size' => 1,
      'mid_size'=> 1,
      'type' => 'list',
      'before_page_number' => '<span class="sr-only">Page </span>',
      'prev_next' => false,
    )) !!} 
    <a href="{!! $next !!}" class="btn-next  {{ !get_next_posts_link() ? "disabled" : "" }}">Next<i class="fas fa-arrow-right"></i> <span class="sr-only">Page</span></a>
  </nav>
@endsection
