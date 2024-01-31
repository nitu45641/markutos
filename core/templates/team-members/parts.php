<?php
foreach ($get_members as $key => $value) {
    ?>
    <div class="block">
        <?php
            if ( get_the_post_thumbnail_url( $value->ID ) && (!empty($position) && 'top' == $position ) ) {
               echo markutos_member_profile_image( $value->ID , get_the_title() );
            }
        ?>
        <h3 class="title">
            <a href="<?php echo esc_url( get_the_permalink( $value->ID ) ); ?>"
            target="_blank"
            >
                <?php echo esc_html( get_the_title( $value->ID ) ); ?>
            </a>
        </h3>
        <p><?php echo esc_html(  $value->post_excerpt ); ?></p>
        <?php
            if ( get_the_post_thumbnail_url( $value->ID ) && (!empty($position) && 'bottom' == $position ) ) {
                echo markutos_member_profile_image( $value->ID , get_the_title() );
            }
        ?>
    </div>
    <?php
}

    function markutos_member_profile_image( $id,$title ) {
        ?>
        <div class="thumb">
                <a
                    href="<?php echo esc_url( get_the_permalink( $id ) ); ?>"
                    aria-label="<?php echo esc_html($title); ?>"
                    target="_blank"
                >
                    <?php echo get_the_post_thumbnail( $id , 'medium' ); ?>
                </a>
            </div>
        <?php
    }
