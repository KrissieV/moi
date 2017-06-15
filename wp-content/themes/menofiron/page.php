<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package menofiron
 */

get_header(); ?>
<!-- using page.php -->
	<div class="line-decoration"></div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

			<?php
			while ( have_posts() ) : the_post();

			if(is_page('login')) {
				get_template_part( 'template-parts/content', 'pageheader' );
				get_template_part('template-parts/content','login');
			} else if(is_page('register') && is_user_logged_in()) {
				get_template_part( 'template-parts/content', 'pageheader' );
				get_template_part( 'template-parts/content', 'register' );
			} else {
				get_template_part( 'template-parts/content', 'pageheader' );
				get_template_part( 'template-parts/content', 'page' );
			}; 

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

</article>	

<?php

get_footer();
