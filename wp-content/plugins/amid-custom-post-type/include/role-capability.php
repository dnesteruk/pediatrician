<?php
/**
 * Roles and Capabilities
 */
defined( 'ABSPATH' ) || exit;

function amid_custom_post_type_capabilities(string $single_name, string $plural_name): array {
	return [
		'publish_' . $plural_name,
		'read_private_' . $plural_name,
		'edit_others_' . $plural_name,
		'edit_private_' . $plural_name,
		'delete_private_' . $plural_name,
		'edit_published_' . $plural_name,
		'edit_' . $plural_name,
		'delete_' . $single_name,
		'delete_' . $plural_name,
		'delete_others_' . $plural_name,
		'delete_private_' . $plural_name,
		'delete_published_' . $plural_name,
		'read_' . $single_name,
	];
}

add_action( 'amid_custom_post_type_activate', 'amid_custom_post_type_speakers_role_activate', 10 );
function amid_custom_post_type_speakers_role_activate() {
	$administrator = get_role( 'administrator' );
	$capabilities  = amid_custom_post_type_capabilities('speaker', 'speakers');
	if ( isset( $administrator ) ) {

		foreach ( $capabilities as $capability ) {
			$administrator->add_cap( $capability );
		}

	}

	flush_rewrite_rules();
}

add_action( 'amid_custom_post_type_activate', 'amid_custom_post_type_sessions_role_activate', 10 );
function amid_custom_post_type_sessions_role_activate() {
	$administrator = get_role( 'administrator' );
	$capabilities  = amid_custom_post_type_capabilities('session', 'sessions');
	if ( isset( $administrator ) ) {

		foreach ( $capabilities as $capability ) {
			$administrator->add_cap( $capability );
		}

	}

	flush_rewrite_rules();
}

add_action( 'amid_custom_post_type_deactivation', 'amid_custom_post_type_speakers_role_deactivation', 10 );
function amid_custom_post_type_speakers_role_deactivation() {
	$administrator = get_role( 'administrator' );
	$capabilities  = amid_custom_post_type_capabilities('speaker', 'speakers');
	if ( isset( $administrator ) ) {

		foreach ( $capabilities as $capability ) {
			$administrator->remove_cap( $capability );
		}

	}

	flush_rewrite_rules();
}

add_action( 'amid_custom_post_type_deactivation', 'amid_custom_post_type_sessions_role_deactivation', 10 );
function amid_custom_post_type_sessions_role_deactivation() {
	$administrator = get_role( 'administrator' );
	$capabilities  = amid_custom_post_type_capabilities('session', 'sessions');
	if ( isset( $administrator ) ) {

		foreach ( $capabilities as $capability ) {
			$administrator->remove_cap( $capability );
		}

	}

	flush_rewrite_rules();
}
