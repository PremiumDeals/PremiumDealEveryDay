<?php
/**
 * Theme footer.
 *
 * @package Alafi
 */
?>
</main>
<footer class="alafi-footer">
    <div class="alafi-container">
        <?php if (is_active_sidebar('footer-widgets')) : ?>
            <?php dynamic_sidebar('footer-widgets'); ?>
        <?php endif; ?>
        <p><?php echo esc_html(date_i18n('Y')); ?> © <?php bloginfo('name'); ?> — <?php esc_html_e('Premium marketplace powered by WooCommerce.', 'alafi'); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
