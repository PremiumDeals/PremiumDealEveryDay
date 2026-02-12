<?php
/**
 * Theme header.
 *
 * @package Alafi
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-slate-50 text-slate-900'); ?>>
<?php wp_body_open(); ?>
<header class="alafi-header">
    <div class="alafi-topbar">
        <a class="alafi-brand" href="<?php echo esc_url(home_url('/')); ?>">alafi</a>
        <?php get_search_form(); ?>
        <nav class="alafi-actions">
            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php esc_html_e('Account', 'alafi'); ?></a>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>"><?php esc_html_e('Cart', 'alafi'); ?> <span class="alafi-cart-count">0</span></a>
        </nav>
    </div>
    <nav class="alafi-nav">
        <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'fallback_cb' => false]); ?>
    </nav>
</header>
<main class="alafi-main">
