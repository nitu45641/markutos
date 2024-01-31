<?php

namespace Markutos\Core\TeamMembers\Pages;

defined( 'ABSPATH' ) || exit;

class Member_Single_Post {

    use \Markutos\Utils\Singleton;

    function __construct() {
        add_action( 'single_template', [$this, 'member_single_page'] );
        add_filter( 'archive_template', [$this, 'member_archive_template'] );
    }

    public function member_archive_template( $template ) {
        if ( is_post_type_archive( 'team_member' ) ) {
            $default_file = \Markutos::core_dir() . 'team-members/views/team-archive-page.php';
            if ( file_exists( $default_file ) ) {
                $template = $default_file;
            }
        }

        return $template;
    }

    public function member_single_page( $single ) {
        global $post;
        if ( $post->post_type == 'team_member' &&  is_singular( 'team_member' ) ) {
            $default_file = \Markutos::core_dir() . 'team-members/views/team-single.php';
            if ( file_exists( $default_file ) ) {
                $single = $default_file;
            }
        }
        return $single;
    }

}
