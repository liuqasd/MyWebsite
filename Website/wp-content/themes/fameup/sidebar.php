<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Fameup
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

	<div id="sidebar-right" class="bs-sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
