<?php

namespace Speakers;

defined( 'ABSPATH' ) || exit;

class Speakers {

	private $post_type_name = 'speakers';
	private $post_type_slug = 'speakers';
	private $post_type_tax = [
		'position' => [
			'taxonomy' => 'positions',
			'slug' => 'positions',
			'single_name'  => 'Position',
			'plural_name'  => 'Positions',
		],
		'country' => [
			'taxonomy' => 'countries',
			'slug' => 'countries',
			'single_name'  => 'Country',
			'plural_name'  => 'Countries',
		],
	];
	private $post_capability_type = [ 'speaker', 'speakers' ];


	/**
	 * Class instance
	 *
	 * @var Speakers instance
	 */
	protected static $instance = false;


	/**
	 * Singleton. Get class instance
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Plugin activation.
	 */
	public static function activate() {
		do_action( 'amid_custom_post_type_activate' );
	}

	/**
	 * Plugin deactivation.
	 */
	public static function deactivation() {
		do_action( 'amid_custom_post_type_deactivation' );
	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		if ( ! post_type_exists( $this->post_type_name ) ) {
			add_action( 'init', array( $this, 'custom_post_type_speakers' ) );
		}
	}

	/**
	 * Taxonomy name in singular
	*/
	public static function get_taxonomy_labels(string $single_name, string $plural_name): array {
		return [
			'name'              => _x( $plural_name, 'amid-custom-post-type' ),
			'singular_name'     => _x( $single_name, 'amid-custom-post-type' ),
			'search_items'      => __( 'Search ' . $single_name, 'amid-custom-post-type' ),
			'all_items'         => __( 'All ' . $plural_name, 'amid-custom-post-type' ),
			'parent_item'       => __( 'Parent ' . $single_name, 'amid-custom-post-type' ),
			'parent_item_colon' => __( 'Parent ' . $single_name . ':', 'amid-custom-post-type' ),
			'edit_item'         => __( 'Edit ' . $single_name, 'amid-custom-post-type' ),
			'update_item'       => __( 'Update ' . $single_name, 'amid-custom-post-type' ),
			'add_new_item'      => __( 'Add new ' . $single_name, 'amid-custom-post-type' ),
			'new_item_name'     => __( 'New ' . $single_name, 'amid-custom-post-type' ),
			'menu_name'         => __( $plural_name, 'amid-custom-post-type' ),
		];
	}

	/**
	 * Custom Post Type.
	 */
	public function custom_post_type_speakers() {
		register_taxonomy( $this->post_type_tax['position']['taxonomy'], array( $this->post_type_name ), array(
			'labels'             => self::get_taxonomy_labels($this->post_type_tax['position']['single_name'], $this->post_type_tax['position']['plural_name']),
			'show_ui'            => true,
			'show_in_nav_menus'  => true,
			'show_in_rest'       => true,
			'hierarchical'       => true,
			'publicly_queryable' => true,
			'show_admin_column'  => true,
			'show_in_quick_edit' => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->post_type_tax['position']['slug'] ),
		) );

		register_taxonomy( $this->post_type_tax['country']['taxonomy'], array( $this->post_type_name ), array(
			'labels'             => self::get_taxonomy_labels($this->post_type_tax['country']['single_name'], $this->post_type_tax['country']['plural_name']),
			'show_ui'            => true,
			'show_in_nav_menus'  => true,
			'show_in_rest'       => true,
			'hierarchical'       => true,
			'publicly_queryable' => true,
			'show_admin_column'  => true,
			'show_in_quick_edit' => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->post_type_tax['country']['slug'] ),
		) );

		$labels = array(
			'name'                     => _x( 'Speakers', 'amid-custom-post-type' ),
			'singular_name'            => _x( 'Speaker', 'amid-custom-post-type' ),
			'add_new'                  => __( 'Add speaker', 'amid-custom-post-type' ),
			'add_new_item'             => __( 'Add new speaker', 'amid-custom-post-type' ),
			'edit_item'                => __( 'Edit speaker', 'amid-custom-post-type' ),
			'new_item'                 => __( 'New speaker', 'amid-custom-post-type' ),
			'view_item'                => __( 'View speaker', 'amid-custom-post-type' ),
			'search_items'             => __( 'Find speakers', 'amid-custom-post-type' ),
			'not_found'                => __( 'No speakers found', 'amid-custom-post-type' ),
			'not_found_in_trash'       => __( 'There are no speakers in the cart', 'amid-custom-post-type' ),
			'parent_item_colon'        => __( 'Parent speaker', 'amid-custom-post-type' ),
			'all_items'                => __( 'All speakers', 'amid-custom-post-type' ),
			'archives'                 => __( 'Speakers archives', 'amid-custom-post-type' ),
			'menu_name'                => __( 'Speakers', 'amid-custom-post-type' ),
			'name_admin_bar'           => __( 'Speakers', 'amid-custom-post-type' ),
			'view_items'               => __( 'Viewing speakers', 'amid-custom-post-type' ),
			'attributes'               => __( 'Speakers Properties', 'amid-custom-post-type' ),
			// media uploader labels
			'insert_into_item'         => __( 'Insert in speaker', 'amid-custom-post-type' ),
			'uploaded_to_this_item'    => __( 'Loaded for this speaker', 'amid-custom-post-type' ),
			'featured_image'           => __( 'Image speaker', 'amid-custom-post-type' ),
			'set_featured_image'       => __( 'Set speaker image', 'amid-custom-post-type' ),
			'remove_featured_image'    => __( 'Delete speaker image', 'amid-custom-post-type' ),
			'use_featured_image'       => __( 'Use as speaker image', 'amid-custom-post-type' ),
			// Gutenberg, WordPress 5.0+
			'item_updated'             => __( 'The speaker has been updated', 'amid-custom-post-type' ),
			'item_published'           => __( 'Speaker added', 'amid-custom-post-type' ),
			'item_published_privately' => __( 'Speaker added privately', 'amid-custom-post-type' ),
			'item_reverted_to_draft'   => __( 'Speaker saved as draft', 'amid-custom-post-type' ),
			'item_scheduled'           => __( 'Publication of the speaker is scheduled', 'amid-custom-post-type' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
			'query_var'           => true,
			'rewrite'             => array(
				'slug'       => $this->post_type_slug,
				'with_front' => true
			),
			'capability_type'     => $this->post_capability_type,
			'map_meta_cap'        => true,
			'has_archive'         => true,
			'hierarchical'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-id-alt',
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail' ),
			'taxonomies'          => array(
				$this->post_type_tax['position']['taxonomy'],
				$this->post_type_tax['country']['taxonomy'] ),
		);

		register_post_type( $this->post_type_name, $args );
	}

}
