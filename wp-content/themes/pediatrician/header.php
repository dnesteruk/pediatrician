<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header id="header" class="site-header">
    <div id="header-wrapper" class="container-wrapper">
        <div class="container">
            <div class="header-container">

				<?php if ( has_custom_logo() ) : ?>
                    <div class="header-logo">
						<?php the_custom_logo(); ?>
                    </div>
				<?php endif; ?>

                <div id="header-block-navigation" class="header-block-navigation">
                    <div class="header-wrap-navigation">
                        <nav id="site-navigation" class="main-navigation container-navigation">
		                    <?php
		                    wp_nav_menu(
			                    array(
				                    'theme_location'  => 'primary',
				                    'menu_id'         => 'primary-menu',
				                    'menu_class'      => 'primary-menu',
				                    'container_class' => 'primary-menu-container',
				                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				                    'fallback_cb'     => false,
			                    )
		                    );
		                    ?>
                        </nav>

                        <div class="container-register">

                            <a id="header-btn-register" href="#"><?= esc_html( pll__( 'Register' ) ) ?></a>

                        </div>

                        <div class="dropdown dropdown-menu-lang">
                            <a id="current-lang" class="menu-current-lang" href="#" role="button">
			                    <?= pll_current_language( 'slug' ); ?>
                            </a>

                            <ul id="list-lang" class="dropdown-menu menu-list-lang">
			                    <?php pll_the_languages( array( 'hide_current' => 1, 'display_names_as' => 'slug' ) ); ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="header-mobile-navigation" class="header-mobile-navigation">&nbsp;</div>

            </div>
        </div>
    </div>
</header>

<main id="main" class="site-main">