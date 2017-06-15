<?php
/**
 * @package menofiron
 */
?>
<div class="container-fluid">
<div class="row">
<div class="col-xs-12 col-md-10 col-md-offset-1">
<div class="site-login">
	
			<?php if ( is_user_logged_in() ) {
				$current_user = wp_get_current_user();
				$users_church = get_user_meta($current_user->ID,'individual_church');
				echo '<p>Logged in as: ';
				if ($current_user->user_firstname) {
					echo $current_user->user_firstname . ', ';
				}
				echo  $current_user->user_email . '<br/>'; 
				$page = get_page_by_path( $users_church[0], OBJECT , 'churches' );
				?>
				Church: <?php echo $page->post_title; ?></p>
				<?php $user = wp_get_current_user();
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

				<?php if ( in_array( 'director', (array) $user->roles ) || current_user_can( 'manage_options' ) ) { ?>
					<p>&nbsp;</p>
					<h4>Useful Pages</h4>
						<?php if ( in_array( 'director', (array) $user->roles )) { ?>
							<a href="/mentor-application/?church=<?php echo $users_church[0]; ?>">Mentor Application</a><br/>
							<a href="/protege-application/?church=<?php echo $users_church[0]; ?>">Protege Application</a><br/>
						<?php } ?>
					    <a href="/church-partner-standards-expectations/">Church Partner Standards &amp; Expectations</a><br/>

					    <?php
						  
						  $page = get_page_by_path( $users_church[0], OBJECT , 'churches' );
							$terms = get_the_terms( $page->ID, 'status' );
							if ($terms[0]->slug == 'anchor') {
								echo '<a href="/anchor-church-partner-standards-expectations/">Anchor Church Partner Standards &amp; Expectations</a><br/>';
							}


		 	/**
			 * The WordPress Query class.
			 * @link http://codex.wordpress.org/Function_Reference/WP_Query
			 *
			 */
			$args = array(
				
				//Type & Status Parameters
				'post_type'   => 'implementation_plans',
				
				'meta_query' => array(
					array(
						'key' => 'church', // name of custom field
						'value' => '"' . $page->ID . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
						'compare' => 'LIKE'
					)
				)
				
				
			);
		
		$implementationplans = get_posts( $args ); 
		if( $implementationplans ) { ?>
							
							<?php foreach( $implementationplans as $implementationplan ): ?>
							
								
									<a href="<?php echo get_permalink( $implementationplan->ID ); ?>">
										
										Implementation Plan for <?php echo $page->post_title; ?>
									</a>
								
							<?php endforeach; ?>
							
						<?php } else {

						} 
		wp_reset_postdata();
	

						?>
					<?php } ?>
			<?php } else { ?>
				
				
				<?php if (isset($_GET["status"])) {
  if($_GET["status"] == 'failed')
  {
    $status = 'failed';
    echo '<p class="error">Invalid email or password.</p>';
  }
  } ?>
  <?php 
  if(isset($_GET["redirect_to"])) {
	  ;
	  $redirect = $_GET["redirect_to"];
	  $args = array(
		  'label_username' => __( 'Email' ),
		  'label_remember' => __( 'Keep me logged in' ),
		  'label_log_in'   => __( 'Login' ),
		  'redirect'       => $_GET["redirect_to"]
	  );
  } else {
	  $args = array(
		  'label_username' => __( 'Email' ),
		  'label_remember' => __( 'Keep me logged in' ),
		  'label_log_in'   => __( 'Login' ),
	  );
  }
?>
				<?php wp_login_form( $args ); ?>
			 <?php } ?> 
			 <?php if ( ! is_user_logged_in() ) { ?>
				<a href="<?php echo wp_lostpassword_url(); ?>" class="lost_password" title="Lost Password">Lost Password?</a>
				<?php } ?>
			</div><!-- .site-login -->
			</div>
			</div>
			</div>