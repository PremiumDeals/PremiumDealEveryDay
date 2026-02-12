<?php
/**
 * WooCommerce integrations and UX enhancements.
 *
 * @package Alafi
 */

if (! defined('ABSPATH')) {
    exit;
}

class Alafi_WooCommerce
{
    public static function init(): void
    {
        add_action('after_setup_theme', [__CLASS__, 'gallery_support']);
        add_filter('woocommerce_product_thumbnails_columns', [__CLASS__, 'thumbnail_columns']);
        add_filter('loop_shop_columns', [__CLASS__, 'shop_columns']);
        add_filter('woocommerce_output_related_products_args', [__CLASS__, 'related_products']);
        add_action('woocommerce_before_shop_loop_item_title', [__CLASS__, 'badge_wrapper_open'], 4);
        add_action('woocommerce_before_shop_loop_item_title', [__CLASS__, 'stock_badge'], 7);
        add_action('woocommerce_before_shop_loop_item_title', [__CLASS__, 'badge_wrapper_close'], 12);
        add_filter('woocommerce_add_to_cart_fragments', [__CLASS__, 'cart_fragment']);
        add_action('woocommerce_review_order_before_submit', [__CLASS__, 'secure_checkout_note']);
    }

    public static function gallery_support(): void
    {
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }

    public static function thumbnail_columns(): int
    {
        return 5;
    }

    public static function shop_columns(): int
    {
        return wp_is_mobile() ? 2 : 5;
    }

    public static function related_products(array $args): array
    {
        $args['posts_per_page'] = 8;
        $args['columns'] = 4;

        return $args;
    }

    public static function badge_wrapper_open(): void
    {
        echo '<div class="alafi-badge-stack">';
    }

    public static function badge_wrapper_close(): void
    {
        echo '</div>';
    }

    public static function stock_badge(): void
    {
        global $product;

        if (! $product instanceof WC_Product) {
            return;
        }

        $label = $product->is_in_stock() ? __('In Stock', 'alafi') : __('Out of Stock', 'alafi');
        $state = $product->is_in_stock() ? 'in-stock' : 'out-of-stock';

        printf('<span class="alafi-stock-pill %s">%s</span>', esc_attr($state), esc_html($label));
    }

    public static function cart_fragment(array $fragments): array
    {
        ob_start();
        ?>
        <span class="alafi-cart-count"><?php echo esc_html(WC()->cart ? WC()->cart->get_cart_contents_count() : 0); ?></span>
        <?php
        $fragments['span.alafi-cart-count'] = ob_get_clean();

        return $fragments;
    }

    public static function secure_checkout_note(): void
    {
        echo '<p class="alafi-secure-checkout">' . esc_html__('🔐 Your payment and personal data are protected by encrypted checkout.', 'alafi') . '</p>';
    }
}
