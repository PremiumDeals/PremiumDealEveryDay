<?php
/**
 * Plugin Name: Alafi Marketplace Core
 * Description: Enterprise marketplace extensions: login methods, wishlist, wallet, gateway toggles, analytics, and workflow automations.
 * Version: 1.0.0
 * Requires at least: 6.5
 * Requires PHP: 8.1
 * Author: Alafi Engineering Team
 */

if (! defined('ABSPATH')) {
    exit;
}

define('ALAFI_CORE_VERSION', '1.0.0');
define('ALAFI_CORE_PATH', plugin_dir_path(__FILE__));
define('ALAFI_CORE_URL', plugin_dir_url(__FILE__));

require_once ALAFI_CORE_PATH . 'includes/class-alafi-core.php';
Alafi_Core::init();
