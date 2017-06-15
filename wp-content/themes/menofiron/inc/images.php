<?php
/**
 * menofiron responsive Images and Image sizes.
 *
 * @package menofiron
 */

 // Remove max_srcset_image_width.
 function remove_max_srcset_image_width( $max_width ) {
     return false;
 }
add_filter( 'max_srcset_image_width', 'remove_max_srcset_image_width' );

add_action( 'after_setup_theme', 'menofiron_custom_image_sizes' );
function menofiron_custom_image_sizes() {
    add_image_size( 'mobile-background', 640 ); // 640 pixels wide (and unlimited height)
}