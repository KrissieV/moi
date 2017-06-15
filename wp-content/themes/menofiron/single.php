<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package menofiron
 */

get_header(); ?>

	<div class="line-decoration"></div>
<?php get_template_part( 'template-parts/content', 'pageheader' ); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-7 col-md-offset-1">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() ); ?>


			<?php 

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>

			</div>
			<div class="col-xs-12 col-md-3 sidebar">
	<?php get_sidebar( ); ?>

</div>
			</div>
			</div>

		<?php endwhile; // End of the loop.
		?>



<?php
get_footer();
