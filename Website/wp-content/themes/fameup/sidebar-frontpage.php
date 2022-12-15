<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Fameup
 */

if ( ! is_active_sidebar( 'front-page-sidebar' ) ) {
	return;
}
?>
<aside class="col-md-3 col-sm-4">
	<div id="sidebar-right" class="bs-sidebar">
		<?php dynamic_sidebar( 'front-page-sidebar' ); ?>
	</div>
</aside>
