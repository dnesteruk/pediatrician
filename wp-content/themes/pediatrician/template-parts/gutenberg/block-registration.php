<?php
add_action( 'acf/init', 'pediatrician_acf_register_block' );
function pediatrician_acf_register_block() {
	if ( function_exists( 'acf_register_block_type' ) ) {
		$block = [
			[
				'name'            => 'banner',
				'title'           => __( 'Banner', 'daisy' ),
				'description'     => __( 'A custom banner block.', 'pediatrician' ),
			],
			[
				'name'            => 'welcome',
				'title'           => __( 'Welcome', 'daisy' ),
				'description'     => __( 'A custom welcome block.', 'pediatrician' ),
			],
			[
				'name'            => 'speaker',
				'title'           => __( 'Speaker', 'daisy' ),
				'description'     => __( 'A custom speaker block.', 'pediatrician' ),
			],

		];
		pediatrician_acf_register_block_type( $block );
	}
}

function pediatrician_acf_register_block_type( array $arr ): void {
	foreach ( $arr as $value ) {
		acf_register_block_type( array(
			'name'            => $value['name'],
			'title'           => $value['title'],
			'description'     => $value['description'],
			'render_template' => 'template-parts/gutenberg/blocks/' .  $value['name'] . '.php',
			'category'        => 'formatting',
			'mode'            => 'edit',
		) );
	}
}

