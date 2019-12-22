<?php

if( !function_exists("aur_register_employees")) {
	function aur_register_employees() {
		//	Labels for Custom Post Type EMPLOYEES
		$labels = array(
			'name'                => _x( 'Employees', 'Post Type General Name', 'aur-ims' ),
			'singular_name'       => _x( 'Employee', 'Post Type Singular Name', 'aur-ims' ),
			'menu_name'           => __( 'Employees', 'aur-ims' ),
//			'parent_item_colon'   => __( 'Parent Employee', 'aur-ims' ),
			'all_items'           => __( 'All Employees', 'aur-ims' ),
			'view_item'           => __( 'View Employee', 'aur-ims' ),
			'add_new_item'        => __( 'Add New Employee', 'aur-ims' ),
			'add_new'             => __( 'Add New', 'aur-ims' ),
			'edit_item'           => __( 'Edit Employee', 'aur-ims' ),
			'update_item'         => __( 'Update Employee', 'aur-ims' ),
			'search_items'        => __( 'Search Employee', 'aur-ims' ),
			'not_found'           => __( 'Employee Not Found', 'aur-ims' ),
			'not_found_in_trash'  => __( 'Employee Not found in Trash', 'aur-ims' ),
		);
		
		//	Arguments for Custom Post Type EMPLOYEES
		$args = array(
			'label'               => __( 'employees', 'aur-ims' ),
			'description'         => __( 'Employees of the team', 'aur-ims' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => ['title', 'author', 'thumbnail', 'revisions'],
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => [ 'genres' ],
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5.126,
			'menu_icon'			  => 'dashicons-businessman',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		
		register_post_type( 'employees', $args );

		include_once(dirname(__FILE__).'/employees-taxonomy.php');
		include_once(dirname(__FILE__).'/employees-custom-fields.php');

		aur_register_employees_taxonomy();
		aur_register_employees_cfs();		
	}
}