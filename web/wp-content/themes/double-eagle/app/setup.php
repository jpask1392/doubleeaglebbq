<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

add_action( 'login_enqueue_scripts', function () {
    wp_enqueue_style( 'sage/login.css', asset_path('styles/login.css'), false, null );
});

add_action( 'admin_enqueue_scripts', function ( ) {
    wp_enqueue_style( 'sage/admin.css', asset_path('styles/admin.css'), false, null );
} );

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('fonts', 'https://use.typekit.net/yxt6ngk.css');
    wp_enqueue_script('animations', 'https://unpkg.com/scrollreveal');
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
    wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.2.0/css/all.css');

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');

    add_theme_support( 'custom-logo' );
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
    register_sidebar([
        'name'          => __('Search', 'sage'),
        'id'            => 'search-bar'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array (
        'page_title' 	=> 'App Settings',
        'menu_title'	=> 'TechyScouts',
        'menu_slug' 	=> 'theme-general-settings'
    ));
	
}

// add readmore button to description comment
add_action( 'wp_footer', function () { 
    if ( ! is_product() ) return;
    ?>
    <script type="text/javascript">
        
        jQuery(document).ready(function($){
        
        var show_char = 300;
        var ellipses = "... ";
        var descriptions = document.getElementsByClassName('description');

        // loop through all .descriptions on page
        for (let i = 0; i < descriptions.length; i++) {
            var content = descriptions[i].innerHTML;
            if (content.length > show_char) {
                var a = content.substr(0, show_char);
                var b = content.substr(show_char - content.length);
                var html = a + '<span class="truncated">' + ellipses + '<a href="" class="read-more">Read more</a></span><span class="truncated" style="display:none">' + b + '</span>';
                document.getElementsByClassName('description')[i].innerHTML = html;
            }
        }

        $(".read-more").click(function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().find(".truncated").toggle()
        });
       });
        
    </script>
    <?php
 } );


// add_action('get_header', function () {
//     remove_action('wp_head', '_admin_bar_bump_cb');
// });

/*
* Creating a function to create our CPT
*/
     
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
    
add_action( 'init', function () {
 
    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Recipes', 'Post Type General Name', 'doubleeaglebbq' ),
        'singular_name'       => _x( 'Recipe', 'Post Type Singular Name', 'doubleeaglebbq' ),
        'menu_name'           => __( 'Recipes', 'doubleeaglebbq' ),
        'parent_item_colon'   => __( 'Parent Movie', 'doubleeaglebbq' ),
        'all_items'           => __( 'All Recipes', 'doubleeaglebbq' ),
        'view_item'           => __( 'View Recipe', 'doubleeaglebbq' ),
        'add_new_item'        => __( 'Add New Recipe', 'doubleeaglebbq' ),
        'add_new'             => __( 'Add New', 'doubleeaglebbq' ),
        'edit_item'           => __( 'Edit Recipe', 'doubleeaglebbq' ),
        'update_item'         => __( 'Update Recipe', 'doubleeaglebbq' ),
        'search_items'        => __( 'Search Recipe', 'doubleeaglebbq' ),
        'not_found'           => __( 'Not Found', 'doubleeaglebbq' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'doubleeaglebbq' ),
    );
        
    // Set other options for Custom Post Type    
    $args = array(
        'label'               => __( 'movies', 'doubleeaglebbq' ),
        'description'         => __( 'Movie news and reviews', 'doubleeaglebbq' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true, // allows wp to read 'archive-recpies.php' as template
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'show_in_rest'        => true, // enables block editor
    );
        
    // Registering your Custom Post Type
    register_post_type( 'recipes', $args );
    
}, 0 );

remove_action( 'wp_footer', 'woocommerce_demo_store' );

// http://natko.com/wordpress-ajax-login-without-a-plugin-the-right-way/
// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', function () {

        wp_enqueue_script('ajax_scripts', asset_path('scripts/ajax_main.js'), ['jquery'], null, true);
        
        // locallize the script - allows javascript to access php variables
        wp_localize_script( 'ajax_scripts', 'ajax_login_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'redirecturl' => is_checkout() ? wc_get_checkout_url() : home_url(),
        ));
    
        // Enable the user with no privileges to run function in AJAX
        add_action( 'wp_ajax_nopriv_ajaxlogin', function () {

            // First check the nonce, if it fails the function will break
            check_ajax_referer( 'ajax-login-nonce', 'security' );
            
            // Nonce is checked, get the POST data and sign user on
            $info = array();
            $info['user_login'] = $_POST['username'];
            $info['user_password'] = $_POST['password'];
            $info['remember'] = true;
        
            $user_signon = wp_signon( $info, false );
            if ( is_wp_error($user_signon) ){
                echo json_encode(array('loggedin'=>false, 'message'=>__('Incorrect username or password.')));
            } else {
                echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
            }
            die();
        } );
    });
};

// handle register form if user not logged in
if (!is_user_logged_in()) {
    add_action('init', function () {  
        
        wp_localize_script( 'ajax_scripts', 'vb_reg_vars', array(
            'vb_ajax_url' => admin_url( 'admin-ajax.php' ),
            'redirecturl' => get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ),
            )
        );

        // collect post information from ajax post
        // only works when user is not logged in
        add_action('wp_ajax_nopriv_register_user', function () {
            
            // Verify nonce
            if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'woocommerce-register' ) ) {
            die( 'Ooops, something went wrong, please try again later.' );
            }
            
            // Post values
            // set username if autogenerate username is active
            ('no' === get_option( 'woocommerce_registration_generate_username' )) 
            ? $username = $_POST['user'] 
            : $username = $_POST['mail'] ?? "-"; // to avoid username error
            $password      = $_POST['pass'];
            $confirm_pass  = $_POST['confirm_pass'];
            $email         = $_POST['mail'];
            $name          = $_POST['name'];
            
            /**
             * Server Side Validations
             * 1. No empty fields
             * 2. Passwords match
             */
            $error = new \WP_Error();

            if (empty($email)) {
            $error->add( 'empty', 'Please enter a valid email address' );
            echo $error->get_error_message();
            die();
            }

            if (empty($password)) {
            $error->add( 'empty', 'Please enter a password' );
            echo $error->get_error_message();
            die();
            }

            if (empty($confirm_pass)) {
            $error->add( 'empty', 'Please confirm password' );
            echo $error->get_error_message();
            die();
            }

            if ($password != $confirm_pass) {
            $error->add( 'empty', 'Passwords do not match' );
            echo $error->get_error_message();
            die();
            }
            
            /**
             * Create new user
             */
            $userdata = array(
            'user_login' => $username,
            'user_pass'  => $password,
            'user_email' => $email,
            'first_name' => $name,
            'role'       => 'customer',
            );
            $user_id = wp_insert_user( $userdata ) ;

            /**
             * Log new user in
             */
            $info = array();
            $info['user_login'] = $userdata['user_login'];
            $info['user_password'] = $userdata['user_pass'];
            $info['remember'] = true;

            $user_signon = wp_signon( $info, false );

            // returns the message to the error response in the ajax call
            if( !is_wp_error($user_id) && !is_wp_error($user_signon)) {
            echo json_encode(array('loggedin' => true ));
            } else {
            echo $user_id->get_error_message();
            }
            die();
            
        });
    });
};

add_action('wp_logout', function (){
    wp_redirect( home_url() );
    exit();
});


//