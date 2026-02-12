<?php
/**
 * Core marketplace plugin implementation.
 */

if (! defined('ABSPATH')) {
    exit;
}

class Alafi_Core
{
    public static function init(): void
    {
        add_action('init', [__CLASS__, 'register_shortcodes']);
        add_action('admin_menu', [__CLASS__, 'admin_menu']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
        add_action('woocommerce_created_customer', [__CLASS__, 'bootstrap_wallet']);
        add_filter('woocommerce_payment_gateways', [__CLASS__, 'filter_gateways']);
        add_action('woocommerce_checkout_update_order_meta', [__CLASS__, 'store_checkout_metadata']);
    }

    public static function register_shortcodes(): void
    {
        add_shortcode('alafi_dashboard', [__CLASS__, 'dashboard_shortcode']);
        add_shortcode('alafi_pincode_checker', [__CLASS__, 'pincode_checker_shortcode']);
    }

    public static function admin_menu(): void
    {
        add_menu_page(
            __('Alafi Marketplace', 'alafi'),
            __('Alafi Marketplace', 'alafi'),
            'manage_woocommerce',
            'alafi-marketplace',
            [__CLASS__, 'settings_page'],
            'dashicons-store',
            56
        );
    }

    public static function register_settings(): void
    {
        register_setting('alafi_marketplace', 'alafi_enabled_gateways', [
            'type' => 'array',
            'default' => ['cashfree', 'razorpay', 'stripe', 'paypal', 'cod'],
        ]);
    }

    public static function settings_page(): void
    {
        $gateways = ['cashfree', 'razorpay', 'stripe', 'paypal', 'upi', 'cod'];
        $enabled = (array) get_option('alafi_enabled_gateways', []);
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Alafi Marketplace Controls', 'alafi'); ?></h1>
            <form method="post" action="options.php">
                <?php settings_fields('alafi_marketplace'); ?>
                <table class="form-table">
                    <tr>
                        <th><?php esc_html_e('Enabled Payment Gateways', 'alafi'); ?></th>
                        <td>
                            <?php foreach ($gateways as $gateway) : ?>
                                <label style="display:block;margin-bottom:8px;">
                                    <input type="checkbox" name="alafi_enabled_gateways[]" value="<?php echo esc_attr($gateway); ?>" <?php checked(in_array($gateway, $enabled, true)); ?> />
                                    <?php echo esc_html(strtoupper($gateway)); ?>
                                </label>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                </table>
                <?php submit_button(__('Save Configuration', 'alafi')); ?>
            </form>
        </div>
        <?php
    }

    public static function filter_gateways(array $methods): array
    {
        $enabled = (array) get_option('alafi_enabled_gateways', []);

        return array_values(array_filter($methods, static function ($gateway_class) use ($enabled): bool {
            $slug = strtolower(str_replace(['WC_Gateway_', '_'], ['', '-'], $gateway_class));

            foreach ($enabled as $allowed) {
                if (str_contains($slug, $allowed)) {
                    return true;
                }
            }

            return false;
        }));
    }

    public static function bootstrap_wallet(int $customer_id): void
    {
        if (! get_user_meta($customer_id, 'alafi_wallet_balance', true)) {
            update_user_meta($customer_id, 'alafi_wallet_balance', 0);
        }
    }

    public static function store_checkout_metadata(int $order_id): void
    {
        if (! empty($_POST['billing_phone'])) {
            update_post_meta($order_id, '_alafi_sms_optin', 'yes');
        }
    }

    public static function dashboard_shortcode(): string
    {
        if (! is_user_logged_in()) {
            return '<p>Please login to view your dashboard.</p>';
        }

        $user_id = get_current_user_id();
        $orders = wc_get_orders(['customer_id' => $user_id, 'limit' => 5]);
        $wallet = (float) get_user_meta($user_id, 'alafi_wallet_balance', true);

        ob_start();
        ?>
        <section class="alafi-dashboard">
            <h2><?php esc_html_e('My Dashboard', 'alafi'); ?></h2>
            <p><?php echo esc_html(sprintf(__('Wallet Balance: %s', 'alafi'), wc_price($wallet))); ?></p>
            <h3><?php esc_html_e('Recent Orders', 'alafi'); ?></h3>
            <ul>
                <?php foreach ($orders as $order) : ?>
                    <li>#<?php echo esc_html($order->get_order_number()); ?> - <?php echo wp_kses_post($order->get_formatted_order_total()); ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
        <?php

        return (string) ob_get_clean();
    }

    public static function pincode_checker_shortcode(): string
    {
        return '<form data-pincode-checker><input name="pincode" maxlength="6" placeholder="Enter Pincode" required /><button type="submit">Check</button><p data-pincode-result></p></form>';
    }
}
