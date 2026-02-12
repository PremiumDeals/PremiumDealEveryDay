<?php
/**
 * Alafi Marketplace theme bootstrap.
 *
 * @package Alafi
 */

if (! defined('ABSPATH')) {
    exit;
}

define('ALAFI_THEME_VERSION', '1.0.0');
define('ALAFI_THEME_PATH', get_template_directory());
define('ALAFI_THEME_URI', get_template_directory_uri());

require_once ALAFI_THEME_PATH . '/inc/class-alafi-theme.php';
require_once ALAFI_THEME_PATH . '/inc/class-alafi-woocommerce.php';
require_once ALAFI_THEME_PATH . '/inc/class-alafi-rest.php';
require_once ALAFI_THEME_PATH . '/inc/class-alafi-pwa.php';

Alafi_Theme::init();
Alafi_WooCommerce::init();
Alafi_REST::init();
Alafi_PWA::init();
