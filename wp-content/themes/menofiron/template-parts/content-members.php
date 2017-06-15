<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package menofiron
 */

?>

<div class="col-xs-12 col-md-8">
<table>
	<thead>
		<tr>
			<td>User</td>
			<td>Email</td>
			<td>Role(s)</td>
			<td>Edit Link</td>
		</tr>
	</thead>
	<tbody>
<?php
$churchname = $_GET['church'];
		
        // if they are users who belong to the church
		$subscribers = get_users();

        foreach ( $subscribers as $subscriber ) {
        	$metavalue = get_the_author_meta( 'individual_church', $subscriber->ID);
        	
        	if ($metavalue == $churchname) {
        		echo '<tr><td>';
				echo $subscriber->first_name.' '.$subscriber->last_name;
				echo '</td><td>';
				echo $subscriber->user_email;
				echo '</td><td>';
				$roles = array();
				if ($subscriber->caps['director'] == 1) {
					array_push($roles, 'Director');
				}
				if ($subscriber->caps['mentor'] == 1) {
					array_push($roles, 'Mentor');
				}
				if ($subscriber->caps['protg'] == 1) {
					array_push($roles, 'Protege');
				}
				$rolelist = implode(', ', $roles);
				echo $rolelist;
				echo '</td>';
				echo '<td><a href="/edit-user/?user_id='.$subscriber->ID.'">Edit</a></td>';
				echo '</tr>';
			}
            
        }
?>
</tbody>
</table>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
</article><!-- #post-## -->
</div>

