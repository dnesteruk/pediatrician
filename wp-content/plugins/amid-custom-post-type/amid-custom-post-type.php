<?php
/**
 * Plugin Name: Amid Custom Post Type
 * Description: Custom post type with filter.
 * Version: 1.0
 * Author: Dmitry Nesteruk
 * Author URI: #
 * Text Domain: amid-custom-post-type
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.0
 *
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'AMID_CPT_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'AMID_CPT_VERSION', '1.0' );
}

use Speakers\Speakers;
use Sessions\Sessions;

require_once __DIR__ . '/post-type/class-speakers.php';
require_once __DIR__ . '/post-type/class-sessions.php';
require_once __DIR__ . '/include/role-capability.php';
require_once __DIR__ . '/include/filter-result.php';
require_once __DIR__ . '/include/taxonomy-fields.php';

register_activation_hook( __FILE__, array( 'Speakers\Speakers', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Speakers\Speakers', 'deactivation' ) );
register_activation_hook( __FILE__, array( 'Sessions\Sessions', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Sessions\Sessions', 'deactivation' ) );

add_action( 'plugins_loaded', 'amid_custom_post_type_load_locale' );
function amid_custom_post_type_load_locale() {
	Speakers::get_instance();
	Sessions::get_instance();

	load_plugin_textdomain( 'amid-custom-post-type', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/**
 * Enqueue scripts and styles.
 */
function amid_scripts() {
	if ( is_post_type_archive( 'speakers' ) ) {
		wp_enqueue_style( 'amid-cpt', plugins_url( '/assets/css/style.css', __FILE__ ), array(), AMID_CPT_VERSION );
		wp_enqueue_script( 'amid-cpt-filter', plugins_url( '/assets/js/filter.js', __FILE__ ), array( 'jquery' ), AMID_CPT_VERSION, true );
		wp_localize_script( 'amid-cpt-filter', 'card_ajax', array(
				'nonce' => wp_create_nonce( 'amid_cpt' ),
				'url'   => admin_url( 'admin-ajax.php' ),
			)
		);
	}
}

add_action( 'wp_enqueue_scripts', 'amid_scripts', 100 );
