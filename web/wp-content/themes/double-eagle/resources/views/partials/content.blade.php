<article {{ post_class('container py-4') }}>
  <div class="row">
    <div class="col-md-5 align-self-center mb-5 mb-md-0">      
      <div class="crop-aspect">
        <div  class="crop content-feature-img" 
              style="background-image: url('{{ the_post_thumbnail_url('large') }}');">
      </div>
    </div>
    </div>
    <div class="col-md-6 offset-md-1 align-self-center">
      <header>
          <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
      </header>
      @if (get_post_type() == 'post')
        <div class="d-flex justify-content-start">
          @include('partials/entry-meta')
        </div>
        
      @endif
      <div class="entry-summary">
          @php the_excerpt() @endphp
      </div>
      <a href="{{get_the_permalink()}}">
        <button class="mt-3">
          <span>Read More</span>
        </button>
      </a>
      
    </div>
  </div>
</article>
  