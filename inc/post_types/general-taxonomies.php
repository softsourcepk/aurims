<?php

if( !function_exists("aur_register_taxonomies")) {
	function aur_register_taxonomies() {
		/**
	 * Taxonomy: course-category.
	 */

	$labels = array(
		"name" 					=> __( "Departments", "aur-ims" ),
		"singular_name" 		=> __( "Department", "aur-ims" ),
		"add_new_item"			=> __( "Add New Department", "aur-ims" ),
		"search_items"  		=> __( "Search Department", "aur-ims" ),
		'parent_item'			=> __( "Parent Department", "aur-ims" ),
		'edit_item'				=> __( "Edit Department", "aur-ims" ),
		'update_item'			=> __( "Update Department", "aur-ims" ),
		'not_found'				=> __( "Department Not Found", "aur-ims" ),
		'not_found_in_trash'	=> __( "Department Not found in Trash", "aur-ims" ),
	);

	$args = array(
		"label"				=> __( "Department", "aur-ims" ),
		"labels"			=> $labels,
		"public"			=> true,
		"hierarchical"		=> true,
		"show_ui"			=> true,
		"show_in_menu"		=> true,
		"show_in_nav_menus"	=> true,
		"query_var"			=> true,
		"rewrite"			=> array( 'slug' => 'departments', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest"		=> false,
		"show_tagcloud" 	=> false,
		"rest_base"			=> "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "departments", array( "courses", "employees" ), $args );
	}
}