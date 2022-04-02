<?php
/** @var array $block */
$speaker = get_fields(); ?>

<div id="speaker-<?php echo esc_attr( $block['id'] ); ?>" class="block-speaker">

    <div class="speaker-content">
        <h1 class="speaker-post-title_mobile"><?php the_title(); ?></h1>
        <div class="speaker-description"><?php echo $speaker['description']; ?></div>

        <div class="speaker-photo">
			<?php echo wp_get_attachment_image( $speaker['image'], 'full', false, array( 'class' => 'speaker-image' ) ); ?>
        </div>
    </div>

    <div class="speaker-sessions">
        <h2 class="speaker-sessions-title"><?php echo esc_html( pll__( 'Sessions' ) ) ?></h2>
        <ul>
			<?php foreach ( $speaker['sessions'] as $value ): ?>

                <li><h3><?php echo esc_html( get_the_title( $value['session'] ) ); ?></h3></li>

			<?php endforeach; ?>
        </ul>
    </div>

</div>
