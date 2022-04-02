<?php
/**
 * Adding a field to the country term edit screen
 */
add_action( 'countries_edit_form_fields', 'amid_countries_edit_term_fields', 10, 2 );

function amid_countries_edit_term_fields( $term, $taxonomy ) {

	$value = get_term_meta( $term->term_id, 'country_label', true );

	echo '<tr class="form-field">
	<th>
		<label for="country_label">Text Field</label>
	</th>
	<td>
		<input name="country_label" id="country_label" type="text" value="' . esc_attr( $value ) . '" />
		<p class="description">Term label field.</p>
	</td>
	</tr>';
}

/**
 * Save the field
 */
add_action( 'created_countries', 'amid_countries_save_term_field' );
add_action( 'edited_countries', 'amid_countries_save_term_field' );

function amid_countries_save_term_field( $term_id ) {

	update_term_meta(
		$term_id,
		'country_label',
		sanitize_text_field( $_POST['country_label'] )
	);

}
