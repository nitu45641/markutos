<?php

defined( 'ABSPATH' ) || die();

$get_members = Markutos\Utils\Helper::instance()->manage_teams(
    array(
        'post_type' 			=> 'team_member',
        'post_status'           => 'publish',
        'offset'                => 0,
        'limit'                 => empty($limit) ? 3 : $limit
    ));
if ( empty($get_members)) {
    return esc_html__('No member found','markutos');
}


if ( file_exists( \Markutos::core_dir() . "templates/team-members/parts.php" ) ) {
    include_once \Markutos::core_dir() . "templates/team-members/parts.php";
}

if ( !empty($see_all) && 'yes' == $see_all ) {
?>
<div class="see_all">
    <button>
        <a href="<?php echo esc_url( get_post_type_archive_link('team_member') ); ?>">
            <?php echo esc_html__( 'See All','Markutos' ); ?>
        </a>
    </button>
</div>
<?php
}