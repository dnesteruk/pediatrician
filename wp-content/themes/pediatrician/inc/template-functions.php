<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package pediatrician
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pediatrician_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'pediatrician_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pediatrician_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'pediatrician_pingback_header' );

/**
 * The function returns the country icon or nothing
*/
function pediatrician_country_flag_icon(string $class): string {
	if($class === 'flag-ch') {
		return '<img src="' . get_template_directory_uri() . '/assets/images/flag-switzerland.png' . '"';
	}
	if($class === 'flag-de') {
		return '<img src="' . get_template_directory_uri() . '/assets/images/flag-germany.png' . '"';
	}
	return '';
}

/**
 * Splits terms with commas
 */
function pediatrician_multi_select_taxonomy( array $arrObject ): string {
	if ( ! $arrObject ) {
		return __( 'Term not selected', 'pediatrician' );
	}

	$arr = [];
	foreach ( $arrObject as $value ) {
		$arr[] = '<span class="term-item">' . $value->name . '</span>';
	}

	return implode( ', ', $arr );
}

/**
 *
 */
function pediatrician_bulletin_board_code( string $incomingString ): string {
	if ( ! $incomingString ) {
		return __( 'Empty line', 'pediatrician' );
	}

	$bbcode = ['[span]', '[/span]'];
	$tag = ['<span class="color-string">', '</span>'];
	return str_replace($bbcode, $tag, $incomingString);
}