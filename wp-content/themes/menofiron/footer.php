<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package menofiron
 */

?>

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="line-decoration"></div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-md-10 col-md-offset-1">
					<aside id="secondary" class="widget-area" role="complementary">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</aside><!-- #secondary -->
				</div>
			</div>
		</div>
		<div class="container-fluid credits">
			<div class="row">
				<div class="col-xs-12 col-md-10 col-md-offset-1">
					<p>&copy; 2016 Men of Iron &nbsp;|&nbsp; Creative by <a href="http://createfervor.com" target="_blank" rel="designer">Fervor</a></p>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->

			  </div>
		</main><!-- #main -->
	</div><!-- #primary -->

	</div><!-- #content -->

	
</div><!-- #page -->
<script type='text/javascript'>
window.__lo_site_id = 72183;

	(function() {
		var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
		wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
	  })();
	</script>

<?php wp_footer(); ?>

</body>
</html>
