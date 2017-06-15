<?php
/*
 * Add Church custom post type
 */
function moi_church_plan_init() {
	$labels = array(
		'name'               => _x( 'Churches', 'post type general name', 'men-of-iron-church-login-portal' ),
		'singular_name'      => _x( 'Church', 'post type singular name', 'men-of-iron-church-login-portal' ),
		'menu_name'          => _x( 'Churches', 'admin menu', 'men-of-iron-church-login-portal' ),
		'name_admin_bar'     => _x( 'Church', 'add new on admin bar', 'men-of-iron-church-login-portal' ),
		'add_new'            => _x( 'Add New', 'church', 'men-of-iron-church-login-portal' ),
		'add_new_item'       => __( 'Add New Church', 'men-of-iron-church-login-portal' ),
		'new_item'           => __( 'New Church', 'men-of-iron-church-login-portal' ),
		'edit_item'          => __( 'Edit Church', 'men-of-iron-church-login-portal' ),
		'view_item'          => __( 'View Church', 'men-of-iron-church-login-portal' ),
		'all_items'          => __( 'All Churches', 'men-of-iron-church-login-portal' ),
		'search_items'       => __( 'Search Churches', 'men-of-iron-church-login-portal' ),
		'parent_item_colon'  => __( 'Parent Churches:', 'men-of-iron-church-login-portal' ),
		'not_found'          => __( 'No churches found.', 'men-of-iron-church-login-portal' ),
		'not_found_in_trash' => __( 'No churches found in Trash.', 'men-of-iron-church-login-portal' )
	);
    $args = array(
      'public' => true,
      'labels'  => $labels,
      'supports' => array( 'title','revisions','page-attributes','editor' ),
      'menu_icon' => 'dashicons-admin-home',
      'has_archive' => true,
      'publicly_queryable' => true,
    );
    register_post_type( 'churches', $args );
    $args = array(
      'public' => true,
      'label'  => 'Implementation Plans',
      'supports' => array( 'title','revisions','page-attributes','editor' ),
      'menu_icon' => 'dashicons-list-view',
      'has_archive' => true,
      'publicly_queryable' => true,
    );
    register_post_type( 'implementation_plans', $args );
    
}
add_action( 'init', 'moi_church_plan_init' );



/**
 * Create Status Taxonomy
 */
add_action( 'init', 'create_church_status_tax' );

function create_church_status_tax() {
	register_taxonomy(
		'status',
		'churches',
		array(
			'label' => __( 'Status' ),
			'rewrite' => array( 'slug' => 'status' ),
			'hierarchical' => true,
		)
	);
	register_taxonomy_for_object_type( 'status', 'churches' );
}

/*
 * Function to check if the church exists
 */
function get_church_by_name($churchname) {
	global $wpdb;
    if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $churchname . "'", 'ARRAY_A')) {
        return true;
    } else {
        return false;
    }
}