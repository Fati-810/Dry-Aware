<?php
/*
*	Area Item Post Type Registration
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

if ( ! class_exists( 'Crocal_Area_Post_Type' ) ) {
	class Crocal_Area_Post_Type {

		function __construct() {

			// Adds the area post type and taxonomies
			$this->crocal_ext_area_init();

			// Manage Columns for area overview
			add_filter( 'manage_edit-area_columns',  array( &$this, 'crocal_ext_area_edit_columns' ) );

		}

		function crocal_ext_area_init() {


			$labels = array(
				'name' => esc_html_x( 'Area Items', 'Area General Name', 'crocal-extension' ),
				'singular_name' => esc_html_x( 'Area Item', 'Area Singular Name', 'crocal-extension' ),
				'add_new' => esc_html__( 'Add New', 'crocal-extension' ),
				'add_new_item' => esc_html__( 'Add New Area Item', 'crocal-extension' ),
				'edit_item' => esc_html__( 'Edit Area Item', 'crocal-extension' ),
				'new_item' => esc_html__( 'New Area Item', 'crocal-extension' ),
				'view_item' => esc_html__( 'View Area Item', 'crocal-extension' ),
				'search_items' => esc_html__( 'Search Area Items', 'crocal-extension' ),
				'not_found' =>  esc_html__( 'No Area Items found', 'crocal-extension' ),
				'not_found_in_trash' => esc_html__( 'No Area Items found in Trash', 'crocal-extension' ),
				'parent_item_colon' => '',
			);

			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'show_in_nav_menus' => false,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 5,
				'menu_icon' => 'dashicons-media-text',
				'supports' => array( 'title', 'editor', 'author', 'thumbnail' ),
				'rewrite' => array( 'slug' => 'area-item', 'with_front' => false ),
			  );

			register_post_type( 'area-item' , $args );


		}

		function crocal_ext_area_edit_columns( $columns ) {
			$columns['cb'] = "<input type=\"checkbox\" />";
			$columns['title'] = esc_html__( 'Title', 'crocal-extension' );
			$columns['author'] = esc_html__( 'Author', 'crocal-extension' );
			$columns['date'] = esc_html__( 'Date', 'crocal-extension' );
			return $columns;
		}

	}
	new Crocal_Area_Post_Type;
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
