<?php
/**
 * PWA hooks.
 *
 * @package Alafi
 */

if (! defined('ABSPATH')) {
    exit;
}

class Alafi_PWA
{
    public static function init(): void
    {
        add_action('wp_head', [__CLASS__, 'manifest_link']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'register_sw']);
    }

    public static function manifest_link(): void
    {
        echo '<link rel="manifest" href="' . esc_url(ALAFI_THEME_URI . '/manifest.webmanifest') . '" />' . PHP_EOL;
    }

    public static function register_sw(): void
    {
        $sw_url = esc_url(ALAFI_THEME_URI . '/service-worker.js');
        $script = "if ('serviceWorker' in navigator) { window.addEventListener('load', function() { navigator.serviceWorker.register('{$sw_url}').catch(console.error); }); }";

        wp_add_inline_script('alafi-theme', $script, 'after');
    }
}
