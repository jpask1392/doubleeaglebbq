<?php

namespace App;

/**
 * Golf club logo
 */
add_shortcode('club_logo', function ($atts) {
    $icon_color = $atts['color'];
    return '<span>' . \App\template('svgs.logo-golf-clubs', ['color' => $icon_color]) . '<span>';
});

/**
 * Button
 */
add_shortcode('button', function ( $atts, $content = null ) {
    return '<button type="button"><span>'. $content .'</span></button>';
});