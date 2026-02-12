<?php
/**
 * REST API for filters, pincode checks, and AI recommendation placeholders.
 *
 * @package Alafi
 */

if (! defined('ABSPATH')) {
    exit;
}

class Alafi_REST
{
    public static function init(): void
    {
        add_action('rest_api_init', [__CLASS__, 'routes']);
    }

    public static function routes(): void
    {
        register_rest_route('alafi/v1', '/pincode/(?P<code>[0-9]{6})', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'check_pincode'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('alafi/v1', '/recommendations', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'recommendations'],
            'permission_callback' => '__return_true',
        ]);
    }

    public static function check_pincode(WP_REST_Request $request): WP_REST_Response
    {
        $code = $request->get_param('code');
        $serviceable = substr((string) $code, -1) % 2 === 0;

        return new WP_REST_Response([
            'pincode' => $code,
            'serviceable' => $serviceable,
            'eta' => $serviceable ? '2-4 days' : 'Not serviceable',
            'shiprocket_ready' => true,
        ]);
    }

    public static function recommendations(): WP_REST_Response
    {
        $products = wc_get_products([
            'status' => 'publish',
            'limit' => 8,
            'orderby' => 'popularity',
        ]);

        $data = array_map(static function ($product) {
            if (! $product instanceof WC_Product) {
                return [];
            }

            return [
                'id' => $product->get_id(),
                'name' => $product->get_name(),
                'price' => $product->get_price_html(),
                'link' => $product->get_permalink(),
            ];
        }, $products);

        return new WP_REST_Response([
            'engine' => 'rule-based-v1',
            'items' => array_values(array_filter($data)),
        ]);
    }
}
