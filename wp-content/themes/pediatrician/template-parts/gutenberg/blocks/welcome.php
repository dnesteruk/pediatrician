<?php
/** @var array $block */
$welcome = get_fields(); ?>

<section id="welcome-<?php echo esc_attr( $block['id'] ); ?>" class="block-welcome" data-id="welcome">

    <div class="container-wrapper">
        <div class="container">
            <div class="welcome-container">

                <div class="welcome-image welcome-container-item">
					<?php echo wp_get_attachment_image( $welcome['image'], 'full', false, array( 'class' => 'welcome-image-desktop' ) ); ?>
					<?php echo wp_get_attachment_image( $welcome['image_mobile'], 'full', false, array( 'class' => 'welcome-image-mobile' ) ); ?>
                </div>

                <div class="welcome-text welcome-container-item">

                    <div class="welcome-text-wrap">
                        <header class="welcome-title">
                            <h2><?php echo pediatrician_bulletin_board_code( esc_html($welcome['title']) );; ?></h2>
                        </header>

                        <div class="welcome-description"><?php echo $welcome['description'] ?: ''; ?></div>

                        <div class="welcome-button">
                            <a href="<?php echo $welcome['button']['link'] ?: '#'; ?>"
                               class="link-button"><?php echo $welcome['button']['anchor'] ?: __( 'Learn more', 'daisy' ); ?></a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</section>
