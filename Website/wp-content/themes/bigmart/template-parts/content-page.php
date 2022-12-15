<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bigmart
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'bigmart'),
            'after' => '</div>',
        ));
        ?>
    </div>

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                    sprintf(
                            wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __('Edit <span class="screen-reader-text">%s</span>', 'bigmart'), array(
                'span' => array(
                    'class' => array(),
                ),
                                    )
                            ), get_the_title()
                    ), '<span class="edit-link">', '</span>'
            );
            ?>
        </footer>
    <?php endif; ?>
</article>
