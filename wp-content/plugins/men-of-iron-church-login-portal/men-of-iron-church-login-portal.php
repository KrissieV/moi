<?php
/*
Plugin Name: Men of Iron Custom Church Login Portal
Plugin URI: http://createfervor.com
Description: Custom Membership Plugin Functionality for Men of Iron
Author: Krissie VandeNoord, Fervor Creative
Version: 0.1
Author URI: http://createfervor.com
*/

// Change default email from name
add_filter( 'wp_mail_from_name', 'menofiron_wp_mail_from_name' );
function menofiron_wp_mail_from_name( $original_email_from ) {
	return 'Men of Iron';
}

include( plugin_dir_path( __FILE__ ) . 'KV-membership.php');
include( plugin_dir_path( __FILE__ ) . 'men-of-iron-cpts.php');
include( plugin_dir_path( __FILE__ ) . 'director-church-association.php');
include( plugin_dir_path( __FILE__ ) . 'edit-members.php');
