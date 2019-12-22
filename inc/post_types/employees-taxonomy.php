<?php

if( !function_exists("aur_register_employees_taxonomy")) {
	function aur_register_employees_taxonomy() {
		/**
		 * Taxonomy: emplyee-designation.
		 */
	
		$labels = array(
			"name" 					=> __( "Designations", "aur-ims" ),
			"singular_name" 		=> __( "Designation", "aur-ims" ),
			"add_new_item"			=> __( "Add New Designation", "aur-ims" ),
			"search_items"  		=> __( "Search Designation", "aur-ims" ),
			'parent_item'			=> __( "Parent Designation", "aur-ims" ),
			'edit_item'				=> __( "Edit Designation", "aur-ims" ),
			'update_item'			=> __( "Update Designation", "aur-ims" ),
			'not_found'				=> __( "Designation Not Found", "aur-ims" ),
			'not_found_in_trash'	=> __( "Designation Not found in Trash", "aur-ims" ),
		);
	
		$args = array(
			"label"				=> __( "Designation", "aur-ims" ),
			"labels"			=> $labels,
			"public"			=> true,
			"hierarchical"		=> true,
			"show_ui"			=> true,
			"show_in_menu"		=> true,
			"show_in_nav_menus"	=> true,
			"query_var"			=> true,
			"rewrite"			=> array( 'slug' => 'designation', 'with_front' => true,  'hierarchical' => true, ),
			"show_admin_column" => true,
			"show_in_rest"		=> false,
			"show_tagcloud" 	=> false,
			"rest_base"			=> "",
			"show_in_quick_edit" => false,
		);
		register_taxonomy( "employee-designation", array( "employees" ), $args );

	}
}