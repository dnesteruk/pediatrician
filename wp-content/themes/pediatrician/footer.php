<?php
$footerLogo = get_theme_mod( 'footer_logo_theme' ); ?>

</main>

<footer id="footer" class="site-footer">
    <div id="footer-wrapper" class="container-wrapper-sm">
        <div class="container">
            <div class="footer-container">

                <div class="footer-container-navigation">
                    <div class="footer-logo">
						<?php if ( $footerLogo ): ?>
                            <img src="<?php echo get_theme_mod( 'footer_logo_theme' ); ?>" alt="Footer Logo"/>
						<?php endif; ?>
                    </div>

                    <nav id="footer-navigation" class="footer-navigation container-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'footer',
								'menu_id'         => 'footer-menu',
								'menu_class'      => 'footer-menu',
								'container_class' => 'footer-menu-container',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'fallback_cb'     => false,
							)
						);
						?>
                    </nav>

                    <div class="footer-container-register">
                        <a id="footer-btn-register" href="#"><?= esc_html( pll__( 'Register' ) ) ?></a>
                    </div>
                </div>

                <p class="footer-copyright">
                    <img class="svg image"
                         src="<?php echo get_template_directory_uri() . '/assets/images/footer-copyright.svg'; ?>"
                         alt="copyright"/>
                </p>

            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>