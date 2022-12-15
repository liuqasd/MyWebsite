<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Fameup
 */
if ( ! is_active_sidebar( 'front-page-content' ) ) {
	return;
}
?>
<div class="<?php if( !is_active_sidebar('front-page-sidebar')) { echo "col-md-12"; } else { echo "col-md-9"; } ?> col-sm-9">
		<?php dynamic_sidebar( 'front-page-content' ); ?>
</div>