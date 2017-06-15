<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package menofiron
 */

?>

<div class="col-xs-12 col-md-6">

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); 
		

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php menofiron_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php $terms = wp_get_post_terms( $post->ID, 'status' ); ?>
	<p>Status: <?php echo $terms[0]->name; ?></p>
	<?php the_field('address'); ?><p><?php the_field('phone'); ?></p>
	<p><strong>Notes:</strong><?php the_field('notes'); ?></p>
		<p><a href="/edit-church/?church=<?php echo $post->post_name; ?>" class="button-sm">Edit Church</a></p>
		
		<?php
		 	/**
			 * The WordPress Query class.
			 * @link http://codex.wordpress.org/Function_Reference/WP_Query
			 *
			 */
		 	
			$args = array(
				
				//Type & Status Parameters
				'role'   => 'director',
				
			);
		
		$directors = get_users( $args ); 
		if(!empty($directors ) ) { ?>
			<h6><strong>Director(s):</strong></h6>
			<ul class="director-list">
			<?php foreach( $directors as $director ): 
				
				$directordata = get_user_meta($director->ID );
				if ($post->post_name == $directordata['individual_church'][0]) {
					echo '<li>'.$director->user_firstname.' '.$director->user_lastname.' <a href="/edit-director/?user_id='.$director->ID.'">Edit</a></li>';
				} 
			endforeach; ?>
			</ul>
		<?php } else {
			
		} 
		
		?>

		<p><a href="/add-director/?church=<?php echo $post->post_name; ?>" class="button-sm">Add Director</a></p>
		<hr/>
		<p><a href="/manage-members/?church=<?php echo $post->post_name; ?>" class="button-sm">Manage Members</a>
		<a href="/email-generator/?church=<?php echo $post->post_name; ?>" class="button-sm">Send Email</a>
		<?php
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
						'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
						'compare' => 'LIKE'
					)
				)
				
				
			);
		
		$implementationplans = get_posts( $args ); 
		if( $implementationplans ) { ?>
							
							<?php foreach( $implementationplans as $implementationplan ): ?>
							
								
									<a href="<?php echo get_permalink( $implementationplan->ID ); ?>" class="button-sm">
										
										View Implementation Plan
									</a>
								
							<?php endforeach; ?>
							
						<?php } else {
							echo '<a href="/wp-admin/post-new.php?post_type=implementation_plans" class="button-sm">Build Implementation Plan</a>';
						} 
		wp_reset_postdata();
		?>

		</p>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
</div>

