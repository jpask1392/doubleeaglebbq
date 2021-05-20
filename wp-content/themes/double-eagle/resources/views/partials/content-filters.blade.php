<div class="container blog-filter-container d-flex container justify-content-stretch py-5">

    <div class="row">
        <div class="col-md-4 btn-group m-auto">
            <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tag"></i><span class="button-text">Categories</span><i class="fas fa-angle-down"></i>
            </button>
            <div class="dropdown-menu">
               {{ wp_list_categories(array('title_li' => '')) }}
            </div>
        </div>
    
        <div class="col-md-4 btn-group">
            <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i><span class="button-text">Author</span><i class="fas fa-angle-down"></i>
            </button>
            <div class="dropdown-menu">
                {{ wp_list_authors() }}
            </div>
        </div>
    
        <div class="col-md-4 btn-group">
            <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-calendar-alt"></i><span class="button-text">Date</span><i class="fas fa-angle-down"></i>
            </button>
            <div class="dropdown-menu">
                {{ wp_get_archives() }}
            </div>
        </div>
    </div>

</div>