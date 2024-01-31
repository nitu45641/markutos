<?php

defined( 'ABSPATH' ) || die();

if ( get_the_post_thumbnail_url( get_the_ID() ) ) {
    ?>
    <div class="thumb">
        <a
                href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>"
                aria-label="<?php echo get_the_title(); ?>"
                target="_blank"
        >
            <?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
        </a>
    </div>
<?php } ?>
<h3 class="title">
    <a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>"
    target="_blank"
    >
        <?php echo esc_html( get_the_title( get_the_ID() ) ); ?>
    </a>
</h3>
<p><?php echo esc_html(  the_excerpt() ); ?></p>