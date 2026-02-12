<?php
/**
 * Child theme enqueue.
 */

add_action('wp_enqueue_scripts', static function (): void {
    wp_enqueue_style('alafi-child', get_stylesheet_uri(), ['alafi-theme'], '1.0.0');
});
