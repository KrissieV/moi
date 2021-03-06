<?php

global $gw_activate_template;

extract( $gw_activate_template->result );

$url = is_multisite() ? get_blogaddress_by_id( (int) $blog_id ) : home_url('', 'http');
$user = new WP_User( (int) $user_id );

?>

<h2><?php _e('Your account is now active!'); ?></h2>

<div id="signup-welcome">
	<p>An email has been sent to you with your login and password.</p>
    <p><span class="h3"><?php _e('Username:'); ?></span> <?php echo $user->user_login ?></p>
</div>



<?php if ( $url != network_home_url('', 'http') ) : ?>
    <p class="view"><?php printf( __('Your account is now activated. <a href="%1$s">View your site</a> or <a href="%2$s">Log in</a>'), $url, $url . 'login' ); ?></p>
<?php else: ?>
    <p class="view"><?php printf( __('Your account is now activated. <a href="%1$s">Login</a> or go back to the <a href="%2$s">homepage</a>.' ), network_site_url('login'), network_home_url() ); ?></p>
<?php endif; ?>