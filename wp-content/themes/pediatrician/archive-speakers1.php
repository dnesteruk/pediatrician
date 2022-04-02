<?php
get_header(); ?>

        <div class="container-wrapper">
            <div class="container archive-container-extra">
                <div class="archive-speakers-container">

                    <aside class="speakers-sidebar-container">

                        <form id="speaker-filter" class="speaker-filter-form" name="speakers" method="POST">

							<?php //get_sidebar();
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
                                                        name="<?php echo $country->slug; ?>" type="checkbox"
                                                        value="<?php echo $country->slug; ?>"><span><?php echo pediatrician_country_flag_icon( $countryFlag ); ?></span></label>
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
                                                        name="<?php echo $position->slug; ?>" type="checkbox"
                                                        value="<?php echo $position->slug; ?>"><span><?php echo $position->name; ?></span></label>
										<?php endforeach; ?>
                                    </div>
                                </div>
							<?php endif; ?>

                        </form>
                    </aside>
                    <article class="speakers-content-container">

                        <header class="speakers-page-header">
                            <h1><?= esc_html( pll__( 'Speakers' ) ) ?></h1>
                        </header>

                        <div class="speakers-container-section">

							<?php
							$args = [
								'post_type'      => 'speakers',
								'post_status'    => 'publish',
								'posts_per_page' => - 1,
								'order_by'       => 'date',
								'order'          => 'asc',
							];

							$query = new WP_Query( $args );
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

								<?php
								endwhile;
								wp_reset_postdata();

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif;
							?>

                        </div>

                        <button>Load more</button>

                    </article>

                </div>

	            <?php get_template_part( 'inc/speaker-after-content'); ?>
            </div>
        </div>

<?php
get_footer();
