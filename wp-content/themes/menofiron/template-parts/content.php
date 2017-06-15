<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package menofiron
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php menofiron_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	
		<?php if (is_single() && has_post_thumbnail( )) { ?>
			<div class="featured-image">
			<?php the_post_thumbnail( 'full' ); ?>
			</div>
			<?php } ?>
	
	<div class="entry-content">
		<?php if (is_home()) {
			the_excerpt();
		} else {

		
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'menofiron' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'menofiron' ),
				'after'  => '</div>',
			) );
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php menofiron_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

