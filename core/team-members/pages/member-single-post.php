<?php

namespace Markutos\Core\TeamMembers\Pages;

defined( 'ABSPATH' ) || exit;

class Member_Single_Post {

    use \Markutos\Utils\Singleton;

    function __construct() {
        add_action( 'single_template', [$this, 'event_single_page'] );
        add_filter( 'archive_template', [$this, 'event_archive_template'] );
    }

    public function event_archive_template( $template ) {

        if ( is_post_type_archive( 'team_member' ) ) {
            $default_file = \Markutos::plugin_dir() . 'core/team-members/views/event-archive-page.php';
            if ( file_exists( $default_file ) ) {
                $template = $default_file;
            }
        }

        return $template;
    }

    public function event_single_page( $single ) {
        global $post;
        if ( $post->post_type == 'team_member' &&  is_singular( 'team_member' ) ) {
            $default_file = \Markutos::plugin_dir() . 'core/event/views/event-single-page.php';
            if ( file_exists( $default_file ) ) {
                $single = $default_file;
            }
        }
        return $single;
    }

}