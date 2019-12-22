<?php
/**
 * Plugin Name: Aan Institute Management Solution
 * Description: The plugin Institute Management Solution by SoftSource PK will help you manage your Institute (i.e School, College, Academy etc) data.
 * Version: 1.0
 * Requires at least: 5.0
 * Author: Attiq Ur Rehman
 * Author URI: offshore.jump@gmail.com
 * Text Domain: aur-ims
 * License:     GPL2
 
An Institute Management Solution is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
An Institute Management Solution is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License along with An Institute Management Solution. If not, see {License URI}.
 */

define( 'PLUGIN_DIR', dirname(__FILE__).'/' ); 
require_once(PLUGIN_DIR . "inc/post_types/courses.php");
require_once(PLUGIN_DIR . "inc/post_types/employees.php");
require_once(PLUGIN_DIR . "inc/post_types/general-taxonomies.php");


function aurims_run_init() {
	
	aur_register_courses();
	aur_register_employees();
	aur_register_taxonomies();
	
	flush_rewrite_rules();
	
	if( get_page_by_title( 'Team' ) == NULL ) {
		$createPage = array(
			  'post_title'    => "Team",
			  'post_content'  => 'Starter content',
			  'post_status'   => 'publish',
			  'comment_status' => 'closed',
			  'ping_status'    => 'closed',
			  'post_author'   => 1,
			  'post_type'     => 'page',
			  'post_name'     => "team",
			  'menu_order'     => 0
			);
	
			// Insert the post into the database
			wp_insert_post( $createPage );
	}	
}
add_action( 'init', 'aurims_run_init' );

 
/**
*	Upon Activating of plugin
*
*/
register_activation_hook( __FILE__, 'aurims_activatrion_process' );

if( !function_exists( "aurims_activatrion_process" ) ) {
	function aurims_activatrion_process() {
		// Add New User Role
		add_role( "teacher" , "Teacher" , [ 'read' =>  true, 'edit_posts' => false, 'delete_posts' => false, ]);
		add_role( "parent" , "Parent" , [ 'read' =>  true, 'edit_posts' => false, 'delete_posts' => false, ]);
		add_role( "student" , "Student" , [ 'read' =>  true, 'edit_posts' => false, 'delete_posts' => false, ]);	
	}	
}

 
 
 ?>