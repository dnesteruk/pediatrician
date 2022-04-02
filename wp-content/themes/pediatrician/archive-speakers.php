<?php
get_header(); ?>

        <div class="container-wrapper">
            <div class="container archive-container-extra">
	            <?php echo do_shortcode('[amid_ajax_cpt_filter per_page="20"]') ;?>

	            <?php get_template_part( 'inc/speaker-after-content'); ?>
            </div>
        </div>

<?php
get_footer();
