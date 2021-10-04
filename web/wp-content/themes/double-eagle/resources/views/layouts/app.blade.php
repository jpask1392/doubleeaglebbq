<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  @include('modals.login')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div class="wrap" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
        @if (App\display_sidebar())
          <aside class="sidebar">
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
    @include('svgs.clip-path-hero')
    @include('svgs.clip-path-image')
    @include('svgs.clip-path-image-02')
    @include('svgs.rip-bottom-01')
    @include('svgs.rip-bottom-02')
    @include('svgs.rip-bottom-03')
    @include('svgs.rip-top-01')
  </body>
</html>
