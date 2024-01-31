<?php
foreach ($get_members as $key => $value) {
    ?>
    <div class="block">
        <?php
        if ( get_the_post_thumbnail_url( $value->ID ) ) {
            ?>
            <div class="thumb">
                <a
                        href="<?php echo esc_url( get_the_permalink( $value->ID ) ); ?>"
                        aria-label="<?php echo get_the_title(); ?>"
                        target="_blank"
                >
                    <?php echo get_the_post_thumbnail( $value->ID, 'medium' ); ?>
                </a>
            </div>
        <?php } ?>
        <h3 class="title">
            <a href="<?php echo esc_url( get_the_permalink( $value->ID ) ); ?>"
            target="_blank"
            >
                <?php echo esc_html( get_the_title( $value->ID ) ); ?>
            </a>
        </h3>
        <p><?php echo esc_html(  $value->post_excerpt ); ?></p>
    </div>
    <?php
}