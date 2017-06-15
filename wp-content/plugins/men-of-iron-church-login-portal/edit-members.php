<?php 

/*
 * Dynamically populate Director/Mentor/Protege Edit Forms
 * Hook into form submissions to update user information
 */

// add_filter( 'gform_field_value', 'populate_fields', 10, 3 );
// function populate_fields( $value, $field, $name ) {
// 	$userID = $_GET['user_id'];
// 	$usertoedit = get_user_by('ID',$userID);
// 	$usermeta = get_user_meta($userID);
// 	print_r($usermeta);
//     $values = array(
//         'first_name'   => $usermeta['first_name'][0],
//         'last_name'   => $usermeta['last_name'][0],
//         'user_address'   => $usermeta['user_address'][0],
//         'user_email' => $usertoedit->user_email,
//         'role_at_church' => $usermeta['role_at_church'][0],
//     );

//     return isset( $values[ $name ] ) ? $values[ $name ] : $value;
// }

add_filter( 'gform_user_registration_update_user_id_10', 'override_user_id', 10, 4 );
function override_user_id( $user_id, $entry, $form, $feed ) {
	$usertoedit = $_GET['user_id'];
    return is_user_logged_in() ? $usertoedit : false;
}

add_filter( 'gform_user_registration_update_user_id_19', 'override_this_user_id', 10, 4 );
function override_this_user_id( $user_id, $entry, $form, $feed ) {
    $usertoedit = $_GET['user_id'];
    $user_info = get_userdata($usertoedit);
    if (username_exists($user_info->user_login)) {
        return is_user_logged_in() ? $usertoedit : false;
    } else {
        return false;
    }
}

add_shortcode( 'churchname', 'custom_churchname_shortcode' );

function custom_churchname_shortcode() {
  global $_GET;

  $churchname = $_GET['church'];
  $church = get_page_by_path($churchname,ARRAY_A,'churches');

  return $church['post_title'];

}

/* 
 *
 * Dynamically Populate Email Generator Individuals Field
 *	
*/

add_filter( 'gform_pre_render_11', 'populate_individuals' );
add_filter( 'gform_pre_validation_11', 'populate_individuals' );
add_filter( 'gform_pre_submission_filter_11', 'populate_individuals' );
add_filter( 'gform_admin_pre_render_11', 'populate_individuals' );
function populate_individuals( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ( strpos( $field->cssClass, 'individuals-select' ) === false ) {
            continue;
        }

        // you can add additional parameters here to alter the posts that are retrieved
        // more info: [http://codex.wordpress.org/Template_Tags/get_posts](http://codex.wordpress.org/Template_Tags/get_posts)

        $emails = array ();
        $churchname = $_GET['church'];
		
        // if they are users who belong to the church
		$subscribers = get_users();
		$choices = array();

        foreach ( $subscribers as $subscriber ) {
        	$username = $subscriber->first_name.' '.$subscriber->last_name.', '.$subscriber->user_email;
        	$metavalue = get_the_author_meta( 'individual_church', $subscriber->ID);
        	
        	if ($metavalue == $churchname) {
				$choices[] = array( 'text' => $username, 'value' => $subscriber->user_email );
			}
            
        }

        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select Individual(s)';
        $field->choices = $choices;

    }

    return $form;
}

/* 
 *
 * Dynamically Populate Email Generator Page Attachments Field
 *	
*/

add_filter( 'gform_pre_render_11', 'populate_page_attachments' );
add_filter( 'gform_pre_validation_11', 'populate_page_attachments' );
add_filter( 'gform_pre_submission_filter_11', 'populate_page_attachments' );
add_filter( 'gform_admin_pre_render_11', 'populate_page_attachments' );
function populate_page_attachments( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ( strpos( $field->cssClass, 'pages-select' ) === false ) {
            continue;
        }

        // you can add additional parameters here to alter the posts that are retrieved
        // more info: [http://codex.wordpress.org/Template_Tags/get_posts](http://codex.wordpress.org/Template_Tags/get_posts)

     
		
        $args = array(
            'posts_per_page' => -1,
            'post_type' => array('page','implementation_plans'),
        ); 
        $pages = get_posts($args); 
        
      
		$choices = array();
        

        foreach ( $pages as $page ) {
        	   $permalink = get_permalink( $page->ID );
        	
				$choices[] = array( 'text' => $page->post_title, 'value' => $permalink );
			
            
        }

        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select page(s) to attach';
        $field->choices = $choices;

    }

    return $form;
}
/* 
 *
 * Dynamically Populate User Role on Edit User Form
 *  
*/

add_filter( 'gform_pre_render_19', 'populate_edit_user_role' );
add_filter( 'gform_pre_validation_19', 'populate_edit_user_role' );
add_filter( 'gform_pre_submission_filter_19', 'populate_edit_user_role' );
add_filter( 'gform_admin_pre_render_19', 'populate_edit_user_role' );
function populate_edit_user_role( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ( strpos( $field->cssClass, 'user-role' ) === false ) {
            continue;
        }
 
        
        $usertoedit = $_GET['user_id'];
        $choices = array();
        
        $subscriber = get_user_by('ID',$usertoedit);
        if ($subscriber->caps['mentor'] == 1) {
            $choices[] = array('text' => 'Mentor', 'value' => 'mentor', 'isSelected' => TRUE);
        } else {
            $choices[] = array('text' => 'Mentor', 'value' => 'mentor', 'isSelected' => FALSE);
        }
        if ($subscriber->caps['protg'] == 1) {
            $choices[] = array('text' => 'Protege', 'value' => 'protege', 'isSelected' => TRUE);
        } else {
            $choices[] = array('text' => 'Protege', 'value' => 'protege', 'isSelected' => FALSE);
        }


        $field->choices = $choices;

    }

    return $form;
}

/* 
 *
 * Update User Role on User Edit Form submission
 *  
*/
add_action( 'gform_after_submission_19','update_user_role', 10,2);
function update_user_role ($entry,$form) {
    $userid = rgar( $entry, '6' );

    $subscriber = new WP_User($userid);

    if (rgar( $entry, '5.1' ) == 'mentor') {
        $subscriber->add_cap('mentor');
    } else if (rgar( $entry, '5.1' ) !== 'mentor') {
        $subscriber->remove_cap('mentor');
    }
    if (rgar( $entry, '5.2' ) == 'protege') {
        $subscriber->add_cap('protg');
    } else if (rgar( $entry, '5.2' ) !== 'protege') {
        $subscriber->remove_cap('protg');
    }
    if (rgar( $entry, '7.1' ) == 'delete user account') {
        if (rgar( $entry, '8') == 'delete') {
            require_once(ABSPATH.'wp-admin/includes/user.php' );
            wp_delete_user( $userid );
        }
    }

}

add_filter( 'gform_field_value_director_emails', 'populate_director_emails' );
function populate_director_emails( $value ) {

    $church = $_GET['church'];
    $users = get_users();

    $emails = array();
    foreach ($users as $user) {
        $metavalue = get_the_author_meta( 'individual_church', $user->ID);

        if ($church == $metavalue && in_array( 'director', (array) $user->roles )) {
            $emails[] = $user->user_email;
        }

    }
    $email = implode(',',$emails);
   return $email;
}


/* 
 *
 * Generate Email after form submission
 *  
*/
add_action( 'gform_after_submission_11', 'after_email_generator_submission', 10, 2 );
function after_email_generator_submission ($entry,$form) {
    $pageattachments = explode(',', rgar( $entry, '4' ));
    $pages = array();
    foreach ($pageattachments as $pageattachment) {
        array_push($pages, $pageattachment .= '?church='.rgar( $entry, '7' ));
    }
    $pagelinks = implode('<br/>',$pages);

    $emails = array();
    $newemails = array();

    if (rgar( $entry, '6.1' ) == 'Directors') {

        $args = array(
            'role'   => 'director', 
        );
        
        $directors = get_users( $args ); 
        if(!empty($directors ) ) { ?>
            
            <?php foreach( $directors as $director ): 
                
                $directordata = get_user_meta($director->ID );
                if (rgar( $entry, '7' ) == $directordata['individual_church'][0]) {
                    $emails[] = $director->user_email;
                } 
            endforeach;
        } 
        
       
    }
    if (rgar( $entry, '6.2' ) == 'Mentors') {
        $args = array(
            'role'   => 'mentor', 
        );
        
        $directors = get_users( $args ); 
        if(!empty($directors ) ) { ?>
            
            <?php foreach( $directors as $director ): 
                
                $directordata = get_user_meta($director->ID );
                if (rgar( $entry, '7' ) == $directordata['individual_church'][0]) {
                    $emails[] = $director->user_email;
                } 
            endforeach;
        } 
    }
    if (rgar( $entry, '6.3' ) == 'Proteges') {
        
        $args = array(
            'role'   => 'protg', 
        );
        
        $directors = get_users( $args ); 
        
        if(!empty($directors ) ) { ?>
            
            <?php foreach( $directors as $director ): 
                
                $directordata = get_user_meta($director->ID );
                if (rgar( $entry, '7' ) == $directordata['individual_church'][0]) {
                    $emails[] = $director->user_email;
                } 
            endforeach;
        } 
    }
    if (rgar( $entry, '6.4' ) == 'Selected Individual(s)') {
        $individualemails = explode(',',rgar( $entry, '8' ));
        $newemails = unserialize(rgar($entry, '11'));
    }

	$from = rgar( $entry, '1' );
	$subject = rgar( $entry, '10' );
	$body = wpautop(rgar( $entry, '12' )).'<p><strong>Page Attachments</strong></p>'.$pagelinks.'<br/>';
    $email_array = explode(',',implode(',',$emails).','.rgar( $entry, '8' ).','.implode(',',$newemails));
	$sent_emails = array();
    foreach ($email_array as $individual_email) {
        wp_mail( 
            // Send it to yourself, BCC subscribers
            $individual_email, 
            $subject, 
            $body, 
            // extra headers
            array (
                'From: Men of Iron <info@menofiron.org>',
                'Reply-To:' . rgar( $entry, '1' ),
                'Content-type: text/html'
            ) 
            
        );
        array_push($sent_emails,$individual_email);
    }
    // Send Email
     wp_mail( 
            // Send it to yourself
            rgar( $entry, '1' ), 
            $subject, 
            'The following email was sent to these recipients:'.implode(',',$sent_emails).'<br/>'.$body, 
            // extra headers
            array (
                'From: Men of Iron <info@menofiron.org>',
                'Reply-To: info@menofiron.org',
                'Content-type: text/html'
            ) 
        );
}