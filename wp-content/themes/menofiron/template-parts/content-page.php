<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package menofiron
 */

?>
<div class="page-content">

<?php if ( is_user_logged_in() ) {
	echo '<div class="container-fluid"><div class="row"><div class="col-xs-12 col-md-10 col-md-offset-1 logged-in-nav">';
	$current_user = wp_get_current_user();
	$users_church = get_user_meta($current_user->ID,'individual_church');
	$user = wp_get_current_user();
		if ( in_array( 'director', (array) $user->roles ) ) { ?>
		    <a href="/manage-members/?church=<?php echo $users_church[0]; ?>" class="button-sm">Manage Members</a>
		    <a href="/email-generator/?church=<?php echo $users_church[0]; ?>" class="button-sm">Send Email(s)</a>
		<?php } ?>
	<?php if (current_user_can( 'manage_options' )) { ?>
	        <a href="/churches" class="button-sm">Manage Churches</a>
	        <a href="/add-church/" class="button-sm">Add Church</a>
	 <?php } ?>
	
	<a href="/my-account/" class="button-sm">My Account</a>
	<a href="<?php echo wp_logout_url( home_url() ); ?>" class="button-sm">Logout</a>
	</div></div></div>
<?php } ?>

<?php if( have_rows('landing_page_content_builder') ):

					// loop through the rows of data
					while ( have_rows('landing_page_content_builder') ) : the_row();

						if( get_row_layout() == 'copy_panel' ): ?>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12 col-md-8 col-md-offset-2">
									<section class="copy">

										<?php the_sub_field('body_copy'); ?>
									</section>
								</div>
							</div>
						</div>
						<?php endif;


						if( get_row_layout() == 'image_block' ): ?>
							<section class="hero">
							
						<?php
						$image = get_sub_field('hero_image');
						$imageMobile = $image['sizes']['mobile-background'];
						$width = $image['width'];
						$height = $image['height'];
						$ratio = ($height / $width) * 100;
						?>
						<style>
							@media screen and (min-width: 769px) {
								section.hero {
									background-image: url('<?php echo $image[url]; ?>');
								}
							}
							@media screen and (max-width: 768px) {
								section.hero {
									background-image: url('<?php echo $imageMobile; ?>');									
								}
							}

							section.hero::after{
								padding-top: <?php echo $ratio; ?>%;
							}
						</style>
								
								

							</section>
						<?php endif;

						if( get_row_layout() == 'link_grid' ):

							if( have_rows('link_block') ): ?>
								<section class="grid">
									<div class="container-fluid">
										<div class="row">
											<div class="col-xs-12 col-md-10 col-md-offset-1">
								<?php // loop through the rows of data
								while ( have_rows('link_block') ) : the_row(); ?>
									<div class="grid-box">

									
									<?php $image = get_sub_field('link_block_header_image'); ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
									<div class="box-content">
										<?php the_sub_field('link_block_text'); ?>
									</div>
									<a href="<?php the_sub_field('page_link'); ?>" class="button">
										<?php the_sub_field('link_text'); ?>
									</a>
									
									</div>

								<?php endwhile; ?>
								</div>
								</div>
								</div>
							</section>

							<?php else :

								// no rows found

							endif;

						endif;


					endwhile;

				else :

					// no layouts found

				endif;
			?>
<div class="container-fluid">
<div class="row">
<?php if (have_rows('sidebar_builder')) { ?>
	<div class="col-xs-12 col-md-7 col-md-offset-1">
<?php } else { ?>
	<div class="col-xs-12 col-md-8 col-md-offset-2">
<?php } ?>
	
		<?php
			the_content();



			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'menofiron' ),
				'after'  => '</div>',
			) );
		?>
	

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer col-xs-12 col-md-8 col-md-offset-2">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'menofiron' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
		
	<?php endif; ?>
	</div>
	<?php

// check if the flexible content field has rows of data
if( have_rows('sidebar_builder') ): ?>
<div class="col-xs-12 col-md-3 sidebar">
    <?php  // loop through the rows of data
    while ( have_rows('sidebar_builder') ) : the_row(); ?>

        <?php if( get_row_layout() == 'button' ): ?>
			<a href="<?php the_sub_field('link'); ?>" class="button">
        	<?php the_sub_field('text'); ?>
        	</a>

        <?php elseif( get_row_layout() == 'text_content' ):  ?>
			<?php the_sub_field('text'); ?>
        	<?php $file = get_sub_field('file'); ?>

        <?php elseif( get_row_layout() == 'text_content' ):  ?>

        	<?php $image = get_sub_field('image'); ?>
        	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['url']; ?>" />

	<?php endif; ?>

    <?php endwhile; ?>
</div>
<?php else : 

    // no layouts found

endif; ?>
</div>
</div>
</div>
