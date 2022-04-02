<?php
get_header(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-speaker-container' ); ?> data-id="speaker">
        <div class="container-wrapper">
            <div class="container">
                <div class="speaker-wrap-content">

                    <div class="speaker-archive-link">
                        <a href="<?php echo get_post_type_archive_link( 'speakers' ); ?>">
                            <span> <img src="<?php echo get_template_directory_uri() . '/assets/images/speaker-arrow-left.svg'; ?>"></span>
							<?php echo esc_html( pll__( 'All speakers' ) ); ?>
                        </a>
                    </div>

					<?php
					while ( have_posts() ) :
						the_post();

						the_title( '<h1 class="speaker-post-title">', '</h1>' );

						the_content();

					endwhile;
					?>

                </div>

				<?php get_template_part( 'inc/speaker-after-content' ); ?>

            </div>
        </div>
    </article>

<?php
get_footer();
