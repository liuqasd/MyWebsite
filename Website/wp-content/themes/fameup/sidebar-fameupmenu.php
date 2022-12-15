<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Fameup
 */
if ( ! is_active_sidebar( 'menu-sidebar-content' ) ) {
    return;
}
?>
<div class="bs-widget post">
    <div class="post-inner">
        <?php dynamic_sidebar( 'menu-sidebar-content' ); ?>
    </div>
</div>