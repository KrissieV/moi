<?php

global $gw_activate_template;

define( 'WP_INSTALLING', true );

$gw_activate_template = new GWActivateTemplate();
$gw_activate_template->template();

class GWActivateTemplate {

    function __construct( $args = array() ) {

        extract( wp_parse_args( $args, array(
            'template_folder' => basename( dirname( __file__ ) )
            ) ) );

        $this->template_folder = $template_folder;

        $this->load_gfur_signup_functionality();
        $this->hooks();

    }

    function load_gfur_signup_functionality() {
        // include GF User Registration functionality
        require_once(GFUser::get_base_path() . 'gravityformsuserregistration/includes/signups.php');
        GFUserSignups::prep_signups_functionality();
    }

    function hooks() {

        add_action('body_class', create_function('$classes', '$classes[] = "gfur-activate"; return $classes;'));

    }

    function do_activate_header() {
        do_action( 'activate_wp_head' );
    }

    function wpmu_activate_stylesheet() {
        ?>
        <style type="text/css">
            #activateform { margin-top: 2em; }
            #submit, #key { width: 90%; font-size: 24px; }
            #language { margin-top: .5em; }
            .error { background: #f66; }
            span.h3 { padding: 0 8px; font-size: 1.3em; font-weight: bold; color: #333; }
        </style>
        <?php
    }

    function has_activation_key() {
        return !empty($_GET['key']) || !empty($_POST['key']);
    }

    function get_activation_key() {

        if( isset( $_GET['key'] ) && $_GET['key'] )
            return $_GET['key'];

        if( isset( $_POST['key'] ) && $_POST['key'] )
            return $_POST['key'];

        return false;
    }

    function is_blog_taken( $result ) {
        return 'blog_taken' == $result->get_error_code();
    }

    function is_blog_already_active( $result ) {
        return 'already_active' == $result->get_error_code();
    }

    function template() {

        do_action( 'activate_header' );

        add_action( 'wp_head', array( $this, 'do_activate_header' ) );
        add_action( 'wp_head', array( $this, 'wpmu_activate_stylesheet' ) );

        get_header();

        ?>

<header class="page-header">
        
        <?php

            if (is_home()) {
                echo '<h1 class="page-title">Blog</h1>';
                echo '<p>The latest news, resources and encouragement from Men of Iron.
</p>';
            } else {
                the_title( '<h1 class="page-title">', '</h1>' );
            }
            if (get_field('title')) { ?>
                <h2 class="title"><?php the_field('title'); ?></h2>
            <?php } ?>

<?php if (has_post_thumbnail()) { ?>
    <?php
    $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
    $imageMobile = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mobile-background' );
    $imageMeta = wp_get_attachment_metadata( get_post_thumbnail_id($post->ID) );
    $width = $imageMeta['width'];
    $height = $imageMeta['height'];
    $ratio = ($height / $width) * 100;
    ?>
    <style>
        @media screen and (min-width: 769px) {
            .page-header {
                background-image: url('<?php echo $image[0]; ?>');
                
            }
        }
        @media screen and (max-width: 768px) {
            .page-header {
                background-image: url('<?php echo $imageMobile[0]; ?>');
                
            }
        }

        .page-header::after{
            padding-top: <?php echo $ratio; ?>%;
        }
    </style>

<?php }
        else {

    } ?>

</header><!-- .page-header -->
<div class="page-content">
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
        <div id="content" class="widecolumn">

            <?php if ( !$this->has_activation_key() ) {
				include('activate-no-key.php');
                

            } else {

                $key = $this->get_activation_key();
                $this->result = GFUserSignups::activate_signup($key);

                if ( is_wp_error( $this->result ) ) {
					include('activate-error.php');
                    

                } else {
					include('activate-success.php');
                    

                }

            } ?>

        </div>
		</div>
	</div>
</div>
</div>

        <script type="text/javascript">
            var key_input = document.getElementById('key');
            key_input && key_input.focus();
        </script>

        <?php

        get_footer();

    }

}

?>