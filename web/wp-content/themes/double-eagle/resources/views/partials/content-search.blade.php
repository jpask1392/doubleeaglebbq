<article {{ post_class('container py-4') }}>
  <div class="row">
    <div  class="content-feature-img col-md-5" 
          style="background-image: url('{{ the_post_thumbnail_url('large') }}');">
      
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
          <span>View</span>
        </button>
      </a>
      
    </div>
  </div>
</article>
  