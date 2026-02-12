<?php
/**
 * Core theme setup and UI helpers.
 *
 * @package Alafi
 */

if (! defined('ABSPATH')) {
    exit;
}

class Alafi_Theme
{
    public static function init(): void
    {
        add_action('after_setup_theme', [__CLASS__, 'setup']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
        add_action('widgets_init', [__CLASS__, 'register_sidebars']);
        add_action('wp_head', [__CLASS__, 'meta_tags']);
        add_filter('body_class', [__CLASS__, 'body_classes']);
    }

    public static function setup(): void
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('woocommerce');
        add_theme_support('custom-logo');
        add_theme_support('automatic-feed-links');
        add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption', 'style', 'script']);
        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        add_theme_support('responsive-embeds');

        register_nav_menus([
            'primary' => __('Primary Navigation', 'alafi'),
            'footer' => __('Footer Navigation', 'alafi'),
            'category' => __('Category Mega Menu', 'alafi'),
        ]);
    }

    public static function enqueue_assets(): void
    {
        wp_enqueue_style('alafi-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap', [], null);
        wp_enqueue_style('alafi-theme', ALAFI_THEME_URI . '/assets/css/theme.css', ['alafi-fonts'], ALAFI_THEME_VERSION);

        wp_enqueue_script('alafi-theme', ALAFI_THEME_URI . '/assets/js/theme.js', ['jquery'], ALAFI_THEME_VERSION, true);
        wp_localize_script('alafi-theme', 'alafiData', [
            'restUrl' => esc_url_raw(rest_url('alafi/v1/')),
            'nonce' => wp_create_nonce('wp_rest'),
            'currencySymbol' => get_woocommerce_currency_symbol(),
        ]);
    }

    public static function register_sidebars(): void
    {
        register_sidebar([
            'name' => __('Shop Filters', 'alafi'),
            'id' => 'shop-filters',
            'description' => __('Flipkart-like faceted sidebar for product archives.', 'alafi'),
            'before_widget' => '<section class="alafi-filter-card">',
            'after_widget' => '</section>',
        ]);

        register_sidebar([
            'name' => __('Footer Widgets', 'alafi'),
            'id' => 'footer-widgets',
            'before_widget' => '<section class="alafi-footer-widget">',
            'after_widget' => '</section>',
        ]);
    }

    public static function meta_tags(): void
    {
        echo '<meta name="theme-color" content="#2563eb" />' . PHP_EOL;
        echo '<meta name="viewport" content="width=device-width, initial-scale=1" />' . PHP_EOL;
    }

    public static function body_classes(array $classes): array
    {
        if (is_user_logged_in()) {
            $classes[] = 'alafi-user-authenticated';
        }

        if (isset($_COOKIE['alafi_dark_mode']) && $_COOKIE['alafi_dark_mode'] === '1') {
            $classes[] = 'alafi-dark-mode';
        }

        return $classes;
    }
}
