<?php
/** @var array $block */
$banner = get_fields(); ?>

<section id="banner-<?php echo esc_attr( $block['id'] ); ?>" class="block-banner" data-id="banner">
    <div class="container-wrapper-sm">
        <div class="container">
            <div class="banner-container">

                <div class="banner-background">
                    <div class="banner-background-image">

                        <p class="banner-subtitle"><?php echo pediatrician_bulletin_board_code( esc_html( $banner['subtitle'] ) ); ?></p>

                        <h1 class="banner-title"><?php echo esc_html( $banner['title'] ); ?></h1>

                        <p class="banner-description"><?php echo $banner['description']; ?></p>

                        <div class="banner-btn-register">
                            <a href="#"><?php echo esc_html( pll__( 'Register' ) ) ?></a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        @media (max-width: 575px) {
            .banner-background-image {
                background-image: url('<?php echo $banner['image_mobile']; ?>');
            }
        }

        @media (min-width: 576px) {
            .banner-background-image {
                background-image: url('<?php echo $banner['image']; ?>');
            }
        }
    </style>
</section>
