<?php

defined( 'ABSPATH' ) || die();


$get_members = Markutos\Utils\Helper::instance()->manage_teams(
    array(
        'post_type' 			=> 'team_member',
        'post_status'           => 'publish',
        'offset'                => 0,
        'limit'                 => 4
    ));
if ( empty($get_members)) {
    return esc_html__('No member found','markutos');
}

get_header();
?>
<div class="wrapper">
    <?php
        if ( file_exists( \Markutos::core_dir() . "templates/team-members/parts.php" ) ) {
            include_once \Markutos::core_dir() . "templates/team-members/parts.php";
        }
    ?>
</div>
<div class="pagination">
<?php 
echo paginate_links( array(
  //  'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'     => '?paged=%#%',
    'current'    => max( 1, 2 ),
    'total'      => 3,
    'mid_size'   => 1,
    'prev_text'  => __( '«' ),
    'next_text'  => __( '»' ),
    'type'       => 'list'
) );
?>
</div>
<?php
get_footer();