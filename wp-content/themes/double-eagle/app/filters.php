<?php

namespace App;

// change login url
add_filter('login_headerurl', function () {
    return "https://www.doubleeaglebbq.com";
});

add_filter( 'login_title', function () {
    return "Login - Double Eagle BBQ";
});

add_filter( 'login_headertext', function () {
    return "Double Eagle BBQ";
});

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

/**
 * Incorporate bootstrap classes to navigation items
 */
add_filter('nav_menu_css_class' , function ($classes, $item){
    $classes[] = 'nav-item py-2';
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
  } , 10 , 2);

add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
    $atts['class'] = 'nav-link';
    return $atts;
}, 10, 3 );

add_filter('excerpt_more', function () {
    return '';
}); 

add_filter('excerpt_length', function () {
    return 35;
});

// remove 'archive: ' prefix on recipes page
add_filter( 'get_the_archive_title', function ( $title ) {
    if ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }
    return $title;
} );

/**
 * Add custom gravatar
 */
add_filter( 'avatar_defaults', function ($avatar_defaults) {
    $myavatar = 'http://doubleeagle.local/wp-content/uploads/2020/01/gravatar-default.png';
    $avatar_defaults[$myavatar] = "Default Gravatar";
    return $avatar_defaults;
});

add_filter( 'get_search_form', function ( $html ) {

    $html = str_replace( 'value="Search"', 'value="Go"', $html );
    return $html;
} );
