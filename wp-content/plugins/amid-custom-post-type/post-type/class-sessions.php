<?php

namespace Sessions;

defined( 'ABSPATH' ) || exit;

class Sessions {

	private $post_type_name = 'sessions';
	private $post_type_slug = 'sessions';
	private $post_capability_type = [ 'session', 'sessions' ];


	/**
	 * Class instance
	 *
	 * @var Sessions instance
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
			add_action( 'init', array( $this, 'custom_post_type_sessions' ) );
		}
	}

	/**
	 * Custom Post Type.
	 */
	public function custom_post_type_sessions() {
		$labels = array(
			'name'                     => _x( 'Sessions', 'amid-custom-post-type' ),
			'singular_name'            => _x( 'Session', 'amid-custom-post-type' ),
			'add_new'                  => __( 'Add session', 'amid-custom-post-type' ),
			'add_new_item'             => __( 'Add new session', 'amid-custom-post-type' ),
			'edit_item'                => __( 'Edit session', 'amid-custom-post-type' ),
			'new_item'                 => __( 'New session', 'amid-custom-post-type' ),
			'view_item'                => __( 'View session', 'amid-custom-post-type' ),
			'search_items'             => __( 'Find sessions', 'amid-custom-post-type' ),
			'not_found'                => __( 'No sessions found', 'amid-custom-post-type' ),
			'not_found_in_trash'       => __( 'There are no sessions in the cart', 'amid-custom-post-type' ),
			'parent_item_colon'        => __( 'Parent session', 'amid-custom-post-type' ),
			'all_items'                => __( 'All sessions', 'amid-custom-post-type' ),
			'archives'                 => __( 'Sessions archives', 'amid-custom-post-type' ),
			'menu_name'                => __( 'Sessions', 'amid-custom-post-type' ),
			'name_admin_bar'           => __( 'Sessions', 'amid-custom-post-type' ),
			'view_items'               => __( 'Viewing sessions', 'amid-custom-post-type' ),
			'attributes'               => __( 'sessions Properties', 'amid-custom-post-type' ),
			// media uploader labels
			'insert_into_item'         => __( 'Insert in session', 'amid-custom-post-type' ),
			'uploaded_to_this_item'    => __( 'Loaded for this session', 'amid-custom-post-type' ),
			'featured_image'           => __( 'Image session', 'amid-custom-post-type' ),
			'set_featured_image'       => __( 'Set session image', 'amid-custom-post-type' ),
			'remove_featured_image'    => __( 'Delete session image', 'amid-custom-post-type' ),
			'use_featured_image'       => __( 'Use as session image', 'amid-custom-post-type' ),
			// Gutenberg, WordPress 5.0+
			'item_updated'             => __( 'The session has been updated', 'amid-custom-post-type' ),
			'item_published'           => __( 'Session added', 'amid-custom-post-type' ),
			'item_published_privately' => __( 'Session added privately', 'amid-custom-post-type' ),
			'item_reverted_to_draft'   => __( 'Session saved as draft', 'amid-custom-post-type' ),
			'item_scheduled'           => __( 'Publication of the session is scheduled', 'amid-custom-post-type' ),
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
			'menu_icon'           => 'dashicons-welcome-learn-more',
			'supports'            => array( 'title', 'editor' ),
		);

		register_post_type( $this->post_type_name, $args );
	}

}

