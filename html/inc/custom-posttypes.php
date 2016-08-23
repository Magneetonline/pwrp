<?php
// Register Custom Post Type
function projecten_posttype() {

	$labels = array(
		'name'                  => _x( 'Projecten', 'Post Type General Name', 'magneet-online' ),
		'singular_name'         => _x( 'project', 'Post Type Singular Name', 'magneet-online' ),
		'menu_name'             => __( 'Projecten', 'magneet-online' ),
		'name_admin_bar'        => __( 'Projecten', 'magneet-online' ),
		'archives'              => __( 'Projecten overzicht', 'magneet-online' ),
		'parent_item_colon'     => __( 'hoofd project', 'magneet-online' ),
		'all_items'             => __( 'Alle projecten', 'magneet-online' ),
		'add_new_item'          => __( 'Voeg nieuw project toe', 'magneet-online' ),
		'add_new'               => __( 'Voeg toe', 'magneet-online' ),
		'new_item'              => __( 'Nieuw project', 'magneet-online' ),
		'edit_item'             => __( 'Pas project aan', 'magneet-online' ),
		'update_item'           => __( 'Update project', 'magneet-online' ),
		'view_item'             => __( 'Bekijk project', 'magneet-online' ),
		'search_items'          => __( 'Doorzoek project', 'magneet-online' ),
		'not_found'             => __( 'Not found', 'magneet-online' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'magneet-online' ),
		'featured_image'        => __( 'Featured Image', 'magneet-online' ),
		'set_featured_image'    => __( 'Set featured image', 'magneet-online' ),
		'remove_featured_image' => __( 'Remove featured image', 'magneet-online' ),
		'use_featured_image'    => __( 'Use as featured image', 'magneet-online' ),
		'insert_into_item'      => __( 'Voeg bij project in', 'magneet-online' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'magneet-online' ),
		'items_list'            => __( 'projecten lijst', 'magneet-online' ),
		'items_list_navigation' => __( 'projecten lijst navigatie', 'magneet-online' ),
		'filter_items_list'     => __( 'Filter projecten lijst', 'magneet-online' ),
	);
	$rewrite = array(
		'slug'                  => 'project',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Project', 'magneet-online' ),
		'description'           => __( 'Projecten!', 'magneet-online' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'custom-fields', 'editor', 'excerpt' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-category',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'project',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'projecten', $args );

}
add_action( 'init', 'projecten_posttype', 0 );