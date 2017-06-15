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
	<div id="page-feature-group" class="parallax__group">
		<div class="parallax__layer parallax__layer--fore">
	        <div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-md-8 col-md-offset-2 content_image_block__copy">

						<h1>
							<?php the_title(); ?>
						</h1>

					</div>
				</div>
			</div>
	      </div>
	      <div class="parallax__layer parallax__layer--base">
	        	<div class="line-decoration"></div>
	      	</div>
	      	<?php if (has_post_thumbnail()) { ?>
	      		<?php 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
					$imageMobile = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mobile-background' );
					$imageMeta = wp_get_attachment_metadata( get_post_thumbnail_id($post->ID) );
					$width = $imageMeta['width'];
					$height = $imageMeta['height'];
					$ratio = ($height / $width) * 100;
					print_r($image);	
				?>
				<style>
			        @media screen and (min-width: 769px) {
			        	#page-feature-group .image-block {
			        		background-image: url('<?php echo $image[0]; ?>');
			        	}
			        }
			        @media screen and (max-width: 768px) {
			        	#page-feature-group .image-block {
			        		background-image: url('<?php echo $imageMobile[0]; ?>');
			        	}
			        }
		        	
		        	#page-feature-group .image-block::after,#page-feature-group::after {
		        		padding-top: <?php echo $ratio; ?>%;
		        	}
		        </style>
		      
		      
		      <div class="parallax__layer parallax__layer--back">
		            
			        <div class="image-block"></div>
		    	
		      </div>
	      	<?php } ?>
			
	    </div>

<div class="parallax__group">

			<?php
			while ( have_posts() ) : the_post();

			if(is_page('login')) {
				get_template_part('template-parts/content','login');
			} else if(is_page('register') && is_user_logged_in()) {
				get_template_part( 'template-parts/content', 'register' );
			} else {
				get_template_part( 'template-parts/content', 'page' );
			}; 

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
</div>
	

<?php

get_footer();
