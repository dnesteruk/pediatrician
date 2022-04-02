<?php
/**
 * Error protection 500.
 * If the Polylang plugin is disabled, the English version of the translation will be displayed, not an error.
 */
if (!function_exists('pll__')) {
	function pll__($string)
	{
		return $string;
	}
}

if (!function_exists('pll_e')) {
	function pll_e($string)
	{
		echo $string;
	}
}

if (!function_exists('pll_current_language')) {
	function pll_current_language()
	{
		return null;
	}
}

if (!function_exists('pll_the_languages')) {
	function pll_the_languages()
	{
		return null;
	}
}

/**
 * Translation of the template and other texts
 */
add_action('init', 'pediatrician_polylang_strings');
function pediatrician_polylang_strings()
{

	if (!function_exists('pll_register_string')) {
		return;
	}

	pll_register_string(
		'general_register_button',
		'Register',
		'General',
		false
	);

	pll_register_string(
		'speakers_archive_title',
		'Speakers',
		'Speakers',
		false
	);

	pll_register_string(
		'speakers_filter_countries',
		'Countries',
		'Speakers',
		false
	);

	pll_register_string(
		'speakers_filter_positions',
		'Positions',
		'Speakers',
		false
	);

	pll_register_string(
		'speakers_btn_load_more',
		'Load More',
		'Speakers',
		false
	);

	pll_register_string(
		'sessions_post_title',
		'Sessions',
		'Sessions',
		false
	);

	pll_register_string(
		'sessions_post_question',
		'Do you have any questions?',
		'Sessions',
		false
	);

	pll_register_string(
		'sessions_post_contact_us',
		'Contact us',
		'Sessions',
		false
	);

}