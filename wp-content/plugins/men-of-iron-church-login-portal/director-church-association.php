<?php
 /* 
 *
 * Add subscription preferences to user profiles on the backend so an admin can manage when needed.
 *	
*/

add_action( 'show_user_profile', 'menofiron_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'menofiron_show_extra_profile_fields' );

function menofiron_show_extra_profile_fields( $user ) { ?>

	<h3>Church</h3>

	
	<table class="form-table">

		<tr>
			<th><label for="sport">Churches</label></th>

			<td>
				<?php
				
				$posts = get_posts( 'numberposts=-1&post_status=publish&post_type=churches' );
					
		         
		
				$churches = array();
			
				foreach ( $posts as $post ) {
					$churches[] = array( 'text' => $post->post_title, 'value' => $post->post_name );
				}
				$metavalues = get_user_meta($user->ID,'individual_church');
				echo '<p>Select which church this user is a member of.</p>';
                echo '<select name="church" data-placeholder="Click to select..." >';
                foreach($churches as $key => $value) { ?>
                    <option value='<?php echo $value['value']; ?>' <?php if (strpos($metavalues[0],$value['value']) !== false) { echo 'selected="selected"'; } ?>><?php echo $value['text']; ?></option>
                    
                <?php } 
                echo '</select>'; ?>			
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'menofiron_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'menofiron_save_extra_profile_fields' );

function menofiron_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
		
		
        if ($_POST['church']) {
        
        }
        update_user_meta($user_id,'individual_church', $_POST['church']);
}