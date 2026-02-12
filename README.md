# Alafi — Premium Multi-Category WooCommerce Marketplace

Alafi is a production-structured WordPress + WooCommerce marketplace starter designed for large multi-category commerce (electronics, fashion, grocery, digital goods, and more).

## Deliverables Included
- ✅ Parent theme: `wp-content/themes/alafi`
- ✅ Child theme: `wp-content/themes/alafi-child`
- ✅ Core marketplace plugin: `wp-content/plugins/alafi-marketplace-core`
- ✅ Demo catalog/page data: `demo-data/`
- ✅ Documentation:
  - `docs/ARCHITECTURE.md`
  - `docs/INSTALL_GUIDE.md`
  - `docs/PAYMENT_SETUP.md`
  - `docs/OPERATIONS.md`

## Core Implemented Capabilities
- Mobile-first premium UI (Amazon-like dense grid, Flipkart-like filters sidebar area)
- WooCommerce enhancements (AJAX cart fragments, related products tuning, stock badges)
- REST API endpoints for pincode checks + recommendation feed
- Admin-controlled payment gateway toggles (Cashfree/Razorpay/Stripe/PayPal/UPI/COD)
- Wallet bootstrap and customer dashboard shortcode
- PWA manifest + service-worker registration
- Dark mode and voice-search hooks

## Enterprise Integrations Ready
The architecture is prepared for production plugins/services:
- Google login + OTP login providers
- Shiprocket shipping automation
- PDF invoices
- SMS providers for order alerts
- SEO + schema + blog growth stack
- Firewall, reCAPTCHA, and backup tooling

## Quick Start
1. Install WordPress + WooCommerce.
2. Copy folders under `wp-content/` into your site.
3. Activate **Alafi Marketplace Child** + **Alafi Marketplace Core** plugin.
4. Import `demo-data/products.csv` with WooCommerce product importer.
5. Follow `docs/INSTALL_GUIDE.md` and `docs/PAYMENT_SETUP.md`.

## Notes
- This repository provides production-grade architecture and modular code organization.
- Final go-live should include real API credentials, CDN/cache setup, SMTP/SMS configuration, and staging QA.
