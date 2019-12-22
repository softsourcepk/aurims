<?php

if( !function_exists("register_courses")) {
	function register_courses() {
		//	Labels for Custom Post Type COURSES
		$labels = array(
			'name'                => _x( 'Courses', 'Post Type General Name', 'aur-ims' ),
			'singular_name'       => _x( 'Course', 'Post Type Singular Name', 'aur-ims' ),
			'menu_name'           => __( 'Courses', 'aur-ims' ),
			'parent_item_colon'   => __( 'Parent Course', 'aur-ims' ),
			'all_items'           => __( 'All Courses', 'aur-ims' ),
			'view_item'           => __( 'View Course', 'aur-ims' ),
			'add_new_item'        => __( 'Add New Course', 'aur-ims' ),
			'add_new'             => __( 'Add New', 'aur-ims' ),
			'edit_item'           => __( 'Edit Course', 'aur-ims' ),
			'update_item'         => __( 'Update Course', 'aur-ims' ),
			'search_items'        => __( 'Search Course', 'aur-ims' ),
			'not_found'           => __( 'Course Not Found', 'aur-ims' ),
			'not_found_in_trash'  => __( 'Course Not found in Trash', 'aur-ims' ),
		);
		
		//	Arguments for Custom Post Type	COURSES
		$args = array(
			'label'               => __( 'courses', 'aur-ims' ),
			'description'         => __( 'Courses to Offer', 'aur-ims' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => ['title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',],
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
			'menu_position'       => 5.123,
			'menu_icon'			  => 'dashicons-book-alt',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		
		register_post_type( 'courses', $args );
	}
}