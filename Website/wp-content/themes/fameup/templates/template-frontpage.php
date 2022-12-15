<?php /**
 // Template Name: Frontpage
 */
get_header();
?>
<div id="content" class="container home">
	<div class="row">
	<?php  get_template_part('sidebar','frontcontent');
	   get_template_part('sidebar','frontpage'); ?> 
	</div>
</div>
<?php get_footer(); ?>