<?php
/**
 * Marketplace home.
 *
 * @package Alafi
 */

get_header();
$featured = wc_get_products(['status' => 'publish', 'limit' => 10, 'featured' => true]);
$recent = wc_get_products(['status' => 'publish', 'limit' => 10, 'orderby' => 'date']);
?>
<section class="alafi-hero">
    <div class="alafi-container">
        <h1><?php esc_html_e('Everything you need, delivered with trust.', 'alafi'); ?></h1>
        <p><?php esc_html_e('Electronics, fashion, groceries, and digital products in one premium marketplace.', 'alafi'); ?></p>
        <div class="alafi-hero-actions">
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="alafi-btn alafi-btn-primary"><?php esc_html_e('Start Shopping', 'alafi'); ?></a>
            <button class="alafi-btn" type="button" data-voice-search><?php esc_html_e('Voice Search', 'alafi'); ?></button>
        </div>
    </div>
</section>

<section class="alafi-container py-8">
    <div class="alafi-section-header">
        <h2><?php esc_html_e('Featured Picks', 'alafi'); ?></h2>
        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php esc_html_e('View all', 'alafi'); ?></a>
    </div>
    <div class="alafi-product-grid">
        <?php foreach ($featured as $product) : ?>
            <?php $GLOBALS['product'] = $product; wc_get_template_part('content', 'product'); ?>
        <?php endforeach; wp_reset_postdata(); ?>
    </div>
</section>

<section class="alafi-container py-8">
    <div class="alafi-section-header">
        <h2><?php esc_html_e('Recently Added', 'alafi'); ?></h2>
    </div>
    <div class="alafi-product-grid">
        <?php foreach ($recent as $product) : ?>
            <?php $GLOBALS['product'] = $product; wc_get_template_part('content', 'product'); ?>
        <?php endforeach; wp_reset_postdata(); ?>
    </div>
</section>
<?php
get_footer();
