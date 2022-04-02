<?php

defined( 'ABSPATH' ) || exit;

/**
 * AJAX filter posts by taxonomy term
 */
function amid_cpt_filter_processor_callback() {

	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'amid_cpt' ) ) {
		die( __( 'Permission denied', 'amid-custom-post-type' ) );
	}

	$terms          = $_POST['params']['terms'] ?? [];
	$all            = (bool) $_POST['params']['all'];
	$page           = intval( $_POST['params']['page'] );
	$posts_per_page = intval( $_POST['params']['quantity'] );
	$current_page   = $page;
	$tax_qry        = [
		'relation' => 'AND',
	];
	$countries      = 'countries';
	$positions      = 'positions';

	if ( array_key_exists( $countries, $terms )) {
		$tax_qry[] = [
			'taxonomy' => $countries,
			'field'    => 'id',
			'terms'    => $terms[ $countries ],
		];
	}
	if ( array_key_exists( $positions, $terms )) {
		$tax_qry[] = [
			'taxonomy' => $positions,
			'field'    => 'id',
			'terms'    => $terms[ $positions ],
		];
	}

	$args = [
		'paged'          => $page,
		'post_type'      => 'speakers',
		'post_status'    => 'publish',
		'posts_per_page' => $posts_per_page,
		'order_by'       => 'date',
		'order'          => 'asc',
	];

	if ( $all ) {
		$args['tax_query'] = $tax_qry;
	}

	$query = new WP_Query( $args );

	ob_start();
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ): $query->the_post();
			$countries     = get_the_terms( $query->post->ID, 'countries' );
			$positions     = get_the_terms( $query->post->ID, 'positions' );
			$country_label = get_term_meta( $countries[0]->term_id, 'country_label', true ); ?>

            <section class="speaker-item <?php echo $country_label; ?>">

                <div class="speaker-item-content">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
                            <figure><?php the_post_thumbnail(); ?></figure>
						<?php } ?>

                        <h2 class="speaker-title"><?php the_title(); ?></h2>
                        <p class="speaker-description">
                                                    <span class="speaker-item-position">
                                                        <?php echo pediatrician_multi_select_taxonomy( $positions ); ?>
                                                    </span>
                            <span class="speaker-item-country">
                                                        <?php echo $countries[0]->name; ?>
                                                    </span>
                        </p>
                    </a>
                </div>

            </section>

		<?php endwhile;
		$message  = __( 'Speakers found: ', 'amid-custom-post-type' ) . $query->found_posts;
		$response = [
			'status'       => 200,
			'found'        => $query->found_posts,
			'total'        => $query->max_num_pages,
			'paged'        => $page,
			'quantity'     => $posts_per_page,
			'current_page' => $current_page,
			'message'      => $message,
			'next'         => $page + 1
		];

		wp_reset_postdata();
	else :
		get_template_part( 'template-parts/content', 'none' );
		$response = [
			'status'  => 201,
			'message' => __( 'No posts found', 'amid-custom-post-type' ),
			'next'    => 0
		];
	endif;

	$response['content'] = ob_get_clean();

	die( json_encode( $response ) );
}

add_action( 'wp_ajax_amid_cpt_filter_query_posts', 'amid_cpt_filter_processor_callback' );
add_action( 'wp_ajax_nopriv_amid_cpt_filter_query_posts', 'amid_cpt_filter_processor_callback' );


/**
 * Shortcode for displaying terms filter and results on page
 */
function amid_cpt_filter( array $attr ): string {

	$attributes = shortcode_atts( array(
		'taxonomy' => [ 'countries', 'positions' ],
		'per_page' => 5,
	), $attr );

	$result = null;
	$terms  = get_terms( $attributes['taxonomy'] );
	if ( count( $terms ) ) :
		ob_start(); ?>
        <div class="archive-speakers-container">

            <aside id="speakers-filter-container" class="speakers-sidebar-container"
                   data-paged="<?= $attributes['per_page']; ?>">

                <form id="speaker-filter" class="speaker-filter-form" name="speakers" method="POST">

					<?php
					$countries = get_terms( array( 'taxonomy' => 'countries' ) );

					if ( ! is_wp_error( $countries ) ): ?>
                        <h2><?= esc_html( pll__( 'Countries' ) ) ?></h2>
                        <div class="speakers-filter-block">
                            <div id="filter-group-countries"
                                 class="speakers-checkbox-countries speakers-group-checkbox">
								<?php
								foreach ( $countries as $country ):
									$countryFlag = get_term_meta( $country->term_id, 'country_label', true ); ?>
                                    <label for="<?php echo $country->term_id; ?>"><input
                                                id="<?php echo $country->term_id; ?>"
                                                name="<?php echo $country->taxonomy; ?>" type="checkbox"
                                                value="<?php echo $country->term_id; ?>"
                                                class="<?php echo $country->slug; ?>"><span><?php echo pediatrician_country_flag_icon( $countryFlag ); ?></span></label>
								<?php endforeach; ?>
                            </div>
                        </div>

					<?php endif;
					$positions = get_terms( array( 'taxonomy' => 'positions' ) );

					if ( ! is_wp_error( $positions ) ): ?>
                        <h2><?= esc_html( pll__( 'Positions' ) ) ?></h2>
                        <div class="speakers-filter-block">
                            <div id="filter-group-positions"
                                 class="speakers-checkbox-positions speakers-group-checkbox">
								<?php foreach ( $positions as $position ): ?>
                                    <label for="<?php echo $position->term_id; ?>"><input
                                                id="<?php echo $position->term_id; ?>"
                                                name="<?php echo $position->taxonomy; ?>" type="checkbox"
                                                value="<?php echo $position->term_id; ?>"
                                                class="<?php echo $position->slug; ?>"><span><?php echo $position->name; ?></span></label>
								<?php endforeach; ?>
                            </div>
                        </div>
					<?php endif; ?>

                </form>
                <div id="status" class="speakers-filter-status"></div>
            </aside>
            <article id="speakers-content-container" class="speakers-content-container">

                <header class="speakers-page-header">
                    <h1><?= esc_html( pll__( 'Speakers' ) ) ?></h1>
                </header>

                <div id="response" class="speakers-container-section"></div>

                <nav class="pagination load-more">
                    <a id="speakers-btn-load" href="#page-2"
                       class="speakers-btn-load"><?= esc_html( pll__( 'Load More' ) ) ?></a>
                </nav>

            </article>

        </div>

		<?php $result = ob_get_clean();
	endif;

	return $result;
}

add_shortcode( 'amid_ajax_cpt_filter', 'amid_cpt_filter' );
