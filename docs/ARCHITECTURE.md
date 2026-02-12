# Alafi Marketplace Architecture

## Stack
- **CMS/Core:** WordPress 6.5+
- **Commerce Engine:** WooCommerce
- **Theme Layer:** `wp-content/themes/alafi`
- **Extensions Layer:** `wp-content/plugins/alafi-marketplace-core`
- **Frontend:** Mobile-first HTML5 + utility-friendly CSS + vanilla JS enhancements
- **APIs:** WP REST API namespace `alafi/v1`

## Feature Mapping
- User dashboard, wallet bootstrap, and quick order history via shortcode `[alafi_dashboard]`.
- AJAX-ready cart fragments + secure checkout message integrated through WooCommerce hooks.
- Multi-gateway governance from admin menu (`Alafi Marketplace`) where Cashfree/Razorpay/Stripe/PayPal/UPI/COD can be toggled.
- Pincode serviceability and ETA endpoint via `/wp-json/alafi/v1/pincode/{code}`.
- AI recommendations placeholder endpoint via `/wp-json/alafi/v1/recommendations`.
- PWA support through manifest + service worker registration.

## Production Recommendations
1. Use dedicated plugins for Google login + OTP login (e.g. miniOrange / Firebase OTP provider).
2. Enable enterprise security plugins (Wordfence/Sucuri), reCAPTCHA on login/checkout, and rate limiting.
3. Add transactional providers (MSG91/Twilio) for SMS alerts and abandoned cart recovery.
4. Connect Shiprocket plugin and map WooCommerce shipping zones to pincode API output.
5. Configure object cache + CDN for high catalog performance.
