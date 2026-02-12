# Installation Guide

## 1) Theme Setup
1. Upload `wp-content/themes/alafi` and `wp-content/themes/alafi-child`.
2. Activate **Alafi Marketplace Child** (inherits parent updates safely).
3. Go to **Appearance → Menus** and assign Primary/Footer menus.

## 2) Plugin Setup
1. Upload `wp-content/plugins/alafi-marketplace-core`.
2. Activate plugin from **Plugins**.
3. Open **Alafi Marketplace** admin menu to toggle payment methods.

## 3) WooCommerce Baseline
1. Run WooCommerce setup wizard.
2. Create category taxonomy for electronics, fashion, grocery, home, and digital products.
3. Enable product types (simple/variable/downloadable), ratings/reviews, stock control, and SKUs.

## 4) Essential Plugins (Production)
- Login: Google OAuth + OTP auth plugin
- SEO: RankMath/Yoast
- Invoice: PDF invoices plugin
- Push: OneSignal
- Security: Wordfence + reCAPTCHA integration
- Backup: UpdraftPlus/JetBackup
- Analytics: WooCommerce Analytics + GA4 bridge

## 5) Builder Compatibility
- Elementor and Gutenberg supported.
- Global styles controlled with `theme.json` and CSS tokens.
