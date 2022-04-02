<?php
add_action( 'customize_register', 'customizer_init' );
function customizer_init( WP_Customize_Manager $wp_customize ) {
	$transport = 'refresh';
	$panel     = 'panel_theme';

	$wp_customize->add_panel( $panel,
		array(
			'priority'       => 100,
			'title'       => __( 'Theme panel', 'pediatrician' ),
			'description' => __( 'Theme settings', 'pediatrician' ),
		)
	);
	if ( $section = 'footer_section' ) {
		$wp_customize->add_section( $section, [
			'title'    => __( 'Footer', 'pediatrician' ),
			'priority' => 1,
			'panel'    => $panel
		] );
		$wp_customize->add_setting( 'footer_logo_theme', [
			'default'           => get_theme_file_uri( 'assets/images/footer-logo.png' ),
			'sanitize_callback' => 'esc_url_raw',
			'capability'        => 'edit_theme_options',
			'transport'         => $transport,
		] );

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo_theme', array(
			'label' => 'Footer Logo',
			'section' => $section,
			'settings' => 'footer_logo_theme',
			'priority' => 10
		)));
	}
	if ( $section = 'cookie_section' ) {
		$wp_customize->add_section( $section, [
			'title'    => __( 'Сookie', 'pediatrician' ),
			'priority' => 1,
			'panel'    => $panel
		] );
		$wp_customize->add_setting( 'cookie_content', [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => 'edit_theme_options',
			'transport'         => $transport,
		] );
		$wp_customize->add_control( 'cookie_content', [
			'section'  => $section,
			'priority' => 10,
			'label'    => __( 'Сookie text', 'pediatrician' ),
			'type'     => 'textarea',
		] );
	}
}
