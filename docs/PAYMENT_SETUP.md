# Payment Setup Guide

## Gateway Priority
1. Cashfree (Primary)
2. Razorpay
3. Stripe
4. PayPal
5. UPI
6. COD

## Steps
1. Install official WooCommerce gateway plugins for each provider.
2. Enter API keys/webhook secrets from each provider dashboard.
3. In **WP Admin → Alafi Marketplace**, enable/disable gateways per business region.
4. Ensure webhook endpoints are reachable over HTTPS and verify signature validation.
5. Test:
   - Success payment
   - Failure + retry
   - Refund
   - COD order flow

## Compliance
- Force HTTPS
- Enable PCI-conscious checkout (hosted fields if possible)
- Store minimal PII + enforce GDPR policies
