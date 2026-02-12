<?php
/**
 * Main fallback template.
 *
 * @package Alafi
 */

get_header();
?>
<section class="alafi-container py-8">
    <?php if (have_posts()) : ?>
        <div class="grid gap-6 md:grid-cols-3">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('alafi-card'); ?>>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
                </article>
            <?php endwhile; ?>
        </div>
        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <p><?php esc_html_e('No content found.', 'alafi'); ?></p>
    <?php endif; ?>
</section>
<?php
get_footer();
