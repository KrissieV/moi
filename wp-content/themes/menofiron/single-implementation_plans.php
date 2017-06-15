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
<!-- using single-implementation_plans.php -->
<?php $church = get_field('church');

get_template_part( 'template-parts/content', 'pageheader' ); ?>
<?php $counter = 1; ?>
	<div class="page-content">

			<?php
			while ( have_posts() ) : the_post(); ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-md-10 col-md-offset-1">
						<?php the_content(); ?>
					</div>
				</div>
			
			
			<?php 
			// check if the flexible content field has rows of data
			if( have_rows('step_builder') ):

			     // loop through the rows of data
			    while ( have_rows('step_builder') ) : the_row();

			        if( get_row_layout() == 'intro_letter' ): ?>
        				<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
					        	<h2>Dear <?php echo $church[0]->post_title; ?>,</h2>
					        	<?php the_sub_field('content'); ?>
				        	</div>
			        	</div>

			        <?php elseif( get_row_layout() == 'schedule_&_plan' ): ?>
			        	<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
					        	<h2>Step <?php echo $counter; ?>: <strong>Schedule &amp; Plan</strong></h2>
					        	<p>Target Date: Complete by <?php the_sub_field('target_date'); ?></p>
					        	<?php the_sub_field('content'); ?>
					        	<?php $counter++; ?>
				        	</div>
			        	</div>

			        <?php elseif( get_row_layout() == 'recruit_mentors' ): ?>
			        	<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
					        	<h2>Step <?php echo $counter; ?>: <strong>Recruit Mentors</strong></h2>
					        	<p>Target Date: Start recruiting process on <?php the_sub_field('target_date_-_start'); ?><br/>
					        	Target Date: Complete recruiting process by <?php the_sub_field('target_date_-_complete'); ?></p>
					        	<?php the_sub_field('content'); ?>
					        	<p><strong>Mentor Application Deadline is <?php the_sub_field('target_date_-_complete'); ?></strong></p>
					        	<?php $counter++; ?>
				        	</div>
			        	</div>

			        <?php elseif( get_row_layout() == 'recruit_protege' ): ?>
			        	<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
					        	<h2>Step <?php echo $counter; ?>: <strong>Recruit Proteges</strong></h2>
					        	<p>Target Date: Start recruiting process on <?php the_sub_field('target_date_-_start'); ?><br/>
					        	Target Date: Complete recruiting process by <?php the_sub_field('target_date_-_complete'); ?></p>
					        	<?php the_sub_field('content'); ?>
					        	<p><strong>Protege Application Deadline is <?php the_sub_field('target_date_-_complete'); ?></strong></p>
					        	<?php $counter++; ?>
				        	</div>
			        	</div>

			        	<?php elseif( get_row_layout() == 'create_&_submit_mentorprotege_database' ): ?>
			        	<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
					        	<h2>Step <?php echo $counter; ?>: <strong>Create &amp; Submit Database</strong></h2>
					        	<p>Target Date: Complete and submit database on <?php the_sub_field('target_date'); ?></p>
					        	<?php the_sub_field('content'); ?>
					        	<?php $counter++; ?>
				        	</div>
			        	</div>

			        	<?php elseif( get_row_layout() == 'communicate_launch_week_details' ): ?>
			        	<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
					        	<h2>Step <?php echo $counter; ?>: <strong>Communicate Launch Weekend Details</strong></h2>
					        	<p>Target Date: Start communicating details on <?php the_sub_field('target_date'); ?></p>
					        	<?php the_sub_field('content'); ?>
					        	<?php $counter++; ?>
				        	</div>
			        	</div>

			        	<?php elseif( get_row_layout() == 'matching_mentors_and_proteges' ): ?>
			        	<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
					        	<h2>Step <?php echo $counter; ?>: <strong>Matching Mentors and Proteges</strong></h2>
					        	<p>Target Date: Complete the matching process by <?php the_sub_field('target_date'); ?></p>
					        	<?php the_sub_field('content'); ?>
					        	<?php $counter++; ?>
				        	</div>
			        	</div>

			        	<?php elseif( get_row_layout() == 'graduation_ceremony' ): ?>
			        	<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
					        	<h2>Step <?php echo $counter; ?>: <strong>Schedule and Plan Graduation Ceremony</strong></h2>
					        	<p>Target Date: Complete by <?php the_sub_field('target_date'); ?></p>
					        	<?php the_sub_field('content'); ?>
					        	<?php $counter++; ?>
				        	</div>
			        	</div>

			        	<?php elseif( get_row_layout() == 'custom_step' ): ?>
			        	<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
					        	<h2>Step <?php echo $counter; ?>: <strong><?php the_sub_field('step_title'); ?></strong></h2>
					        	<?php if (get_sub_field('target_date_1')) { ?>
									<p>Target Date: <?php the_sub_field('target_date_1_intro_text'); ?> <?php the_sub_field('target_date_1'); ?></p>
					        	<?php } ?>
					        	
					        	<?php if (get_sub_field('target_date_2')) { ?>
									<p>Target Date: <?php the_sub_field('target_date_2_intro_text'); ?> <?php the_sub_field('target_date_2'); ?></p>
					        	<?php } ?>
					        	<?php the_sub_field('content'); ?>
					        	<?php $counter++; ?>
				        	</div>
			        	</div>

			        <?php endif;

			    endwhile;

			else :

			    // no layouts found

			endif; ?>
			</div>

				

			<?php endwhile; // End of the loop.
			?>
</div>
	

<?php

get_footer();
