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
<!-- using mentor-application.php -->
<?php get_template_part( 'template-parts/content', 'pageheader' ); ?>

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
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">


<div class="page-content">

			<?php
			while ( have_posts() ) : the_post();
			if (empty($_GET['church'])) {
				echo 'There is no church associated with this form. Visit the <a href="/churches">manage churches page</a> and click "Edit Church" under the church you want to edit.';
			} else {
				
				if (get_church_by_name($_GET['church'])) {
					$churchname = $_GET['church'];
					$church = get_page_by_path($churchname,ARRAY_A,'churches');

					echo '<h2>Editing '. $church['post_title'] .'</h2>';
				  echo do_shortcode('[gravityform id="3" title="false" update="'. $church['ID'] .'"]');
				} else {
				 echo 'There is no church matching this record. Visit the <a href="/churches">manage churches page</a> and click "Edit Church" under the church you want to edit.';
				}

			}

			endwhile; // End of the loop.
			?>
</div>
	</div>
	</div>
	</div>

<?php

get_footer();
