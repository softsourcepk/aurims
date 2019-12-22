<?php

if( !function_exists("aur_register_employees_cfs")) {
	function aur_register_employees_cfs() {
		add_action( 'add_meta_boxes', 'aur_add_employees_metabox' );
		add_action( 'save_post',    'aur_save_employees_metabox', 10, 2 );
	}
}

if( !function_exists( "aur_add_employees_metabox" )) {
	function aur_add_employees_metabox() {
		add_meta_box(
			'aur-employees-info',	// Unique ID
			__( 'Employees Information', 'aur-ims' ),	// Title
			'aur_employees_metabox',	// Callback function
			'employees',			// Admin page (or post type)
			'normal',				// Context
			'high'					// Priority
		);	
	}		
}



if ( !function_exists( 'aur_employees_metabox' ) ) {
function aur_employees_metabox( $object, $box ) { ?>
<?php wp_nonce_field( basename( __FILE__ ), 'aur_trailers_embed_nonce' ); ?>
<style>
#employees-table tr td {
	padding: 4px 0;
}
input[type=color], input[type=date], input[type=datetime-local], input[type=datetime], input[type=email], input[type=month], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=time], input[type=url], input[type=week], select, textarea {
	padding: 0 4px !important;
	border-radius: 0 !important;
	font-size: 16px;
}

#employees-table textarea {width:90%; height:120px;}
</style>
<table cellpadding="0" cellspacing="0" width="100%" id="employees-table">
  <tbody>
    <tr>
      <td width="20%"><label for="" style="font-weight:bold;"><?php echo __( "Employee ID: ", "aur-ims" ); ?></label></td>
      <td width="80%"><span style="border:1px solid #ccc; padding:8px; text-align:center; display:block; margin-bottom:5px; width:55px; background:#eee;">
        <?=$object->ID?>
        </span></td>
    </tr>
    <tr>
      <td width="20%"><label for="aur-employee-firstname" style="font-weight:bold;"><?php echo __( "First Name: ", "aur-ims" ); ?></label></td>
      <td width="80%"><input class="aur_textbox" type="text" name="aur-employee-firstname" id="aur-employee-firstname" value="<?php echo __( get_post_meta( $object->ID, 'aur-employee-firstname', true ) ); ?>" style="width:50%; text-transform:uppercase;" /></td>
    </tr>
    <tr>
      <td width="20%"><label for="aur-employee-lastname" style="font-weight:bold;"><?php echo __( "Last Name: ", "aur-ims" ); ?></label></td>
      <td width="80%"><input class="aur_textbox" type="text" name="aur-employee-lastname" id="aur-employee-lastname" value="<?php echo __( get_post_meta( $object->ID, 'aur-employee-lastname', true ) ); ?>" style="width:50%; text-transform:uppercase;" /></td>
    </tr>
    
    <tr>
      <td width="20%"><label for="aur-employee-salary" style="font-weight:bold;"><?php echo __( "Salary: ", "aur-ims" ); ?></label></td>
      <td width="80%"><span style="margin-left:-11px;">$</span>
        <input class="aur_textbox" type="number" name="aur-employee-salary" id="aur-employee-salary" value="<?php echo __( get_post_meta( $object->ID, 'aur-employee-salary', true ) ); ?>" style="width:15%; text-align:center;" /></td>
    </tr>
    
    <tr>
      <td width="20%"><label for="aur-employee-address" style="font-weight:bold; vertical-align:top;"><?php echo __( "Address: ", "aur-ims" ); ?></label></td>
      <td width="80%"><textarea class="aur_textbox" name="aur-employee-address" id="aur-employee-address"><?php echo __( get_post_meta( $object->ID, 'aur-employee-address', true ) ); ?></textarea></td>
    </tr>
    
    
    <!--<tr>
      <td width="20%"><label for="aur-trailer-url" style="font-weight:bold;"><?php//echo __( "Trailer URL: ", "mogreatdane" ); ?></label></td>
      <td width="80%"><input class="aur_textbox" type="number" name="aur-trailer-url" id="aur-trailer-url" value="<?php//echo __( get_post_meta( $object->ID, 'aur-trailer-url', true ) ); ?>" style="width:100%;" /></td>
    </tr>-->
  </tbody>
</table>
<?php }
}







/* Save the meta box's post metadata. */
if ( !function_exists( 'aur_save_employees_metabox' ) ) {
function aur_save_employees_metabox( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['aur_trailers_embed_nonce'] ) || !wp_verify_nonce( $_POST['aur_trailers_embed_nonce'], basename( __FILE__ ) ) )
		return $post_id;


	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	if( $post_type->name === 'employees' ) {		
		/*echo '<pre>';
			print_r(get_post_custom($post_id));
		echo '</pre>';

		/*echo "<pre>";
			print_r(  $post );
		echo "</pre>";*/
	
		/* Check if the current user has permission to edit the post. */
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}
		
		$meta_array = array(
			array(
				"meta_key"		=> "aur-employee-firstname",
				"meta_value"	=> ( isset($_POST['aur-employee-firstname']) ? balanceTags($_POST['aur-employee-firstname']) : '' )
			),
			array(
				"meta_key"		=> "aur-employee-lastname",
				"meta_value"	=> (isset($_POST['aur-employee-lastname'])?balanceTags(strtoupper($_POST['aur-employee-lastname'])):'')
			),
			array(
				"meta_key"		=> "aur-employee-salary",
				"meta_value"	=> ( isset( $_POST['aur-employee-salary'] ) ? balanceTags( $_POST['aur-employee-salary'] ) : '' )
			),
		);
	
		foreach( $meta_array as $meta_arr ) {
			/* Get the posted data and sanitize it for use as an HTML class. */
			$new_meta_value = $meta_arr["meta_value"];
		
			/* Get the meta key. */
			$meta_key = $meta_arr["meta_key"];
		
			/* Get the meta value of the custom field key. */
			$meta_value = get_post_meta( $post_id, $meta_key, true );
		
			/* If a new meta value was added and there was no previous value, add it. */
			if ( $new_meta_value && '' == $meta_value ) {
				add_post_meta( $post_id, $meta_key, $new_meta_value, true );
			}
			/* If the new meta value does not match the old value, update it. */
			elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $post_id, $meta_key, $new_meta_value );
			}
			/* If there is no new meta value but an old value exists, delete it. */
			elseif ( '' == $new_meta_value && $meta_value ) {
				delete_post_meta( $post_id, $meta_key, $meta_value );
			}
		}	
		
	
		
	}
}
}
