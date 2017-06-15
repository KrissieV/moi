<?php
/**
 * The template for displaying the home page.
 *
 * This is the template that displays the home page by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package menofiron
 */

get_header(); ?>
		    
<?php $counter = 1; ?>

<?php

// check if the flexible content field has rows of data
if( have_rows('home_page_content_builder') ):

     // loop through the rows of data
    while ( have_rows('home_page_content_builder') ) : the_row();

        if( get_row_layout() == 'content_image_block' ): ?>

        	<div id="group<?php echo $counter ?>" class="panel">


			        <div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1 content_image_block__copy">

								<h1>
									<span><?php the_sub_field('heading_line_one'); ?><br/></span>
									<span><?php the_sub_field('heading_line_two'); ?></span>
								</h1>

								<?php the_sub_field('body_copy'); ?>

								<a class="button-box" href="<?php the_sub_field('button_link'); ?>"><?php the_sub_field('text'); ?></a>

							</div>

					</div>
			      </div>

			      <?php if ($counter == 1) { ?>

<!--				        	<div class="line-decoration"></div>-->
<div class="line-animation-wrapper">
<div class="line-animation">
	<?php include (TEMPLATEPATH . '/images/inline-lineswhite.svg'); ?>
	<script src="wp-content/themes/menofiron/js/vendor/vivus.min.js"></script>

	<script>
		jQuery(document).ready(function() {
			jQuery('.line-animation').css('display','block');
			new Vivus ('lines', {
			type: 'delayed',
			duration: 150,
			start: 'autostart',
			animTimingFunction: Vivus.EASE
			//pathTimingFunction: Vivus.EASE_OUT()

		});
		})
		
	</script>
</div>
</div>



			      <?php } ?>
			      

			        <?php if( get_sub_field('image') ): ?>
						<?php 
							$image = get_sub_field('image'); 
							$width = $image['width'];
							$height = $image['height'];
							$ratio = ($height / $width) * 100;	
						?>
				        <style>
					        @media screen and (min-width: 769px) {
					        	#group<?php echo $counter; ?> .image-block {
					        		background-image: url('<?php echo $image['url']; ?>');
					        	}
					        }
					        @media screen and (max-width: 768px) {
					        	#group<?php echo $counter; ?> .image-block {
					        		background-image: url('<?php echo $image['sizes']['mobile-background']; ?>');
					        	}
					        }
				        	
				        	#group<?php echo $counter; ?> .image-block::after,#group<?php echo $counter; ?>::after {
				        		padding-top: <?php echo $ratio; ?>%;
				        	}
				        </style>
				        <div class="image-block"></div>
			    	<?php endif; ?>

			    </div>
				<?php $counter++; ?>
        <?php elseif( get_row_layout() == 'form_block' ): ?>

        	<div id="group<?php echo $counter++ ?>" class="form_block">
	        	<div class="container-fluid">
	        		<div class="row">
	        			<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					      <?php 
							    $form_object = get_sub_field('form');
							    echo do_shortcode('[gravityform id="' . $form_object['id'] . '" title="false" description="true" ajax="true"]');
							?>
						</div>
					</div>
				</div>
		    </div>

		<?php elseif( get_row_layout() == 'stats_graphic' ): ?>

        	<div id="group<?php echo $counter++ ?>" class="stats_graphic">

		        	<div class="stats">
		        		<div class="men-count counter"><?php the_sub_field('number_of_men'); ?></div>
		        		<div class="churches-count counter"><?php the_sub_field('number_of_churches'); ?></div>
		        		<div class="cities-count counter"><?php the_sub_field('number_of_cities'); ?></div>
		        	</div>
				
		      
		    </div>

		<?php elseif( get_row_layout() == 'churches_map' ): ?>

        	<div id="group<?php echo $counter++ ?>" class="churches_map">
	        	<div class="container-fluid">
		        	<div class="row">
		        		<div class="col-xs-12 col-md-10 col-md-offset-1">
		        			<h2><span><?php the_sub_field('heading_line_one'); ?></span></h2>
		        		</div>
		        	</div>
	        		<div class="row">
	        			<div class="col-xs-12 col-md-7 col-md-offset-1">
	        			<!-- Nav tabs -->
  <ul class="nav nav-pills" role="tablist">
  <li role="presentation" class="active"><a href="#pennsylvania" class="button-sm" aria-controls="pennsylvania" role="tab" data-toggle="pill">Pennsylvania</a></li>
    
    
    <li role="presentation"><a href="#newjersey" class="button-sm" aria-controls="newjersey" role="tab" data-toggle="pill">New Jersey</a></li>
    <li role="presentation"><a href="#ohio" class="button-sm" aria-controls="ohio" role="tab" data-toggle="pill">Ohio</a></li>
    <li role="presentation"><a href="#Florida" class="button-sm" aria-controls="Florida" role="tab" data-toggle="pill">Florida</a></li>
    <li role="presentation"><a href="#kansas" class="button-sm" aria-controls="kansas" role="tab" data-toggle="pill">Kansas</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
    <div role="tabpanel" class="tab-pane active" id="pennsylvania"><?php build_i_world_map(2); ?></div>
    <div role="tabpanel" class="tab-pane" id="newjersey"><?php build_i_world_map(3); ?></div>
    <div role="tabpanel" class="tab-pane" id="ohio"><?php build_i_world_map(5); ?></div>
    <div role="tabpanel" class="tab-pane" id="Florida"><?php build_i_world_map(1); ?></div>
    <div role="tabpanel" class="tab-pane" id="kansas"><?php build_i_world_map(4); ?></div>
    
  </div>
	      					
	      					
	      				</div>
	      				<div class="col-xs-12 col-md-3 sidecopy"><?php the_sub_field('body_copy'); ?></div>
	      			</div>
		      	</div>
		      
		    </div>


        <?php endif;

    endwhile;

else :

    // no layouts found

endif;

?>

<?php get_footer();