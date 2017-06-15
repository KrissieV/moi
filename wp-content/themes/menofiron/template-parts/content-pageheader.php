
<header class="page-header">
		
		<?php

			if (is_home()) {
				echo '<h1 class="page-title">Blog</h1>';
				echo '<p>The latest news, resources and encouragement from Men of Iron.
</p>';
			} else {
				the_title( '<h1 class="page-title">', '</h1>' );
			}
			if (get_field('title')) { ?>
				<h2 class="title"><?php the_field('title'); ?></h2>
			<?php } ?>
<?php if (is_home()) {

} else if (is_single()) {
	
} else if (has_post_thumbnail()) { ?>
	<?php
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	$imageMobile = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mobile-background' );
	$imageMeta = wp_get_attachment_metadata( get_post_thumbnail_id($post->ID) );
	$width = $imageMeta['width'];
	$height = $imageMeta['height'];
	$ratio = ($height / $width) * 100;
	?>
	<style>
		@media screen and (min-width: 769px) {
			.page-header {
				background-image: url('<?php echo $image[0]; ?>');
				
			}
		}
		@media screen and (max-width: 768px) {
			.page-header {
				background-image: url('<?php echo $imageMobile[0]; ?>');
				
			}
		}

		.page-header::after{
			padding-top: <?php echo $ratio; ?>%;
		}
	</style>

<?php }
		else {

	} ?>

</header><!-- .page-header -->