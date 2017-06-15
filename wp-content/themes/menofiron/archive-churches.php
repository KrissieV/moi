<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package menofiron
 */

get_header(); ?>
<!-- using archive-churches.php -->

<div class="line-decoration"></div>


<?php
if ( have_posts() ) : ?>
<header class="page-header">

<h1 class="page-title">Manage Churches</h1>


<?php if (has_post_thumbnail()) { ?>
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
				background-size: cover;
			}
		}
		@media screen and (max-width: 768px) {
			.page-header {
				background-image: url('<?php echo $imageMobile[0]; ?>');
				background-size: cover;
			}
		}

		.page-header::after{
			padding-top: <?php echo $ratio; ?>%;
		}
	</style>

<?php }
		else { ?>
			<style>
		      @media screen and (min-width: 769px) {
			.page-header {
				background-image: url(/wp-content/themes/menofiron/images/placeholder.jpg);
						background-size: cover;
					}
				}
				@media screen and (max-width: 768px) {
			.page-header {
				background-image: url(/wp-content/themes/menofiron/images/m-placeholder.jpg);
						background-size: cover;
					}
				}

				.page-header::after{
					padding-top: <?php echo $ratio; ?>%;
			}
			</style>
	<?php
	} ?>

</header><!-- .page-header -->
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">

			<div class="page-content">
			
			<?php
			while ( have_posts() ) : the_post();

			if ( current_user_can( 'manage_options' ) ) { ?>

			    <?php get_template_part( 'template-parts/content', 'churches' );
			} else {
			    echo '<p>You do not have permission to access this page.</p>';
			}
			

			endwhile; // End of the loop. ?>
			

			<?php the_posts_navigation('prev_text=Page Back&next_text=Page Forward'); ?>
</div><div class="clear"></div>
		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
</div>
</div>
</div>
		

<?php

get_footer();
