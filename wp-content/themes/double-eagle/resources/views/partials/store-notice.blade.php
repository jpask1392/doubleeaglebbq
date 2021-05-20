<div class="store-notice-wrapper">
    <p class="site-notice-text px-5 py-2 mr-md-4">{{ the_field('site_notice', 'option') }}</p>
    <div class="search-bar-wrapper d-flex py-2 px-5">
        <div class="collapse from-side flex-grow-1 flex-grow-md-0" id="collapseSearch">
            @php dynamic_sidebar('search-bar') @endphp
        </div>
        <a class="text-white" data-toggle="collapse" href="#collapseSearch" role="button" aria-expanded="false" aria-controls="collapseSearch">
            <i class="fas fa-search"></i>
        </a>
    </div>
</div>