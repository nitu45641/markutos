<?php

namespace Markutos\Core\TeamMembers;

defined( 'ABSPATH' ) || exit;
/**
 * Cpt Class.
 * Cpt class for custom post type.
 * @extend Inherite class \Markutos\Base\Cpt Abstract Class
 *
 * @since 1.0.0
 */
class Cpt extends \Markutos\Base\Cpt {

    // set custom post type name
    public function get_name() {
        return 'team_member';
    }

    // set custom post type options data
    public function post_type() {
        $options = $this->user_modifiable_option();

        $labels  = [
            'name'                  => esc_html_x( 'Team Members', 'Post Type General Name', 'markutos' ),
            'singular_name'         => apply_filters( 'team_member_singular_name', $options['team_singular_name'] ),
            'menu_name'             => esc_html__( 'Team Member', 'markutos' ),
            'name_admin_bar'        => esc_html__( 'Team Member', 'markutos' ),
            'archives'              => apply_filters( 'team_member_archive', $options['team_member_archive'] ),
            'attributes'            => esc_html__( 'Team Member Attributes', 'markutos' ),
            'parent_item_colon'     => esc_html__( 'Parent Item:', 'markutos' ),
            'all_items'             => apply_filters( 'all_team_members', $options['team_members_all'] ),
            'add_new_item'          => apply_filters( 'add_new_item_team_member', esc_html__('Add New Member','markutos') ),
            'add_new'               => esc_html__( 'Add New', 'markutos' ),
            'new_item'              => esc_html__( 'New Member', 'markutos' ),
            'edit_item'             => esc_html__( 'Edit New Member', 'markutos' ),
            'update_item'           => esc_html__( 'Update New Member', 'markutos' ),
            'view_item'             => esc_html__( 'View Members', 'markutos' ),
            'view_items'            => esc_html__( 'View Members', 'markutos' ),
            'search_items'          => esc_html__( 'Search Members', 'markutos' ),
            'not_found'             => esc_html__( 'Not found', 'markutos' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'markutos' ),
            'featured_image'        => esc_html__( 'Featured Image', 'markutos' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'markutos' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'markutos' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'markutos' ),
            'insert_into_item'      => esc_html__( 'Insert into Team Member', 'markutos' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this Team Member', 'markutos' ),
            'items_list'            => esc_html__( 'Members list', 'markutos' ),
            'items_list_navigation' => esc_html__( 'Members list navigation', 'markutos' ),
            'filter_items_list'     => esc_html__( 'Filter froms list', 'markutos' ),
        ];
        $rewrite = [
            'slug'       => apply_filters( 'wp_team_member_slug', $options['team_slug'] ),
            'with_front' => true,
            'pages'      => true,
            'feeds'      => false,
        ];

        $args = [
            'label'               => esc_html__( 'Team Members', 'markutos' ),
            'description'         => esc_html__( 'Team Member', 'markutos' ),
            'labels'              => $labels,
            'supports'            => [ 'title', 'editor', 'thumbnail','excerpt', 'author' ],
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_admin_column'   => false,
            'menu_icon'           => 'dashicons-text-page',
            'menu_position'       => 11,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'query_var'           => true,
            'exclude_from_search' => $options['team_exclude_from_search'],
            'capability_type'     => 'post',
            'show_in_rest'        => true,
            'rest_base'           => $this->get_name(),

        ];


        if( current_user_can( 'manage_options' ) ){
            $args['show_in_menu']        = 'dummy-plugin';
        }

        return $args;
    }

    private function user_modifiable_option() {
        $settings_options   = get_option( 'manage_members_options' );
        $options = [
            'team_singular_name'        => esc_html__( 'Team Member', 'markutos' ),
            'team_member_archive'       => esc_html__( 'Team Member Archive', 'markutos' ),
            'team_members_all'          => esc_html__( 'Team Members', 'markutos' ),
            'team_slug'                 => 'team_member',
            'team_exclude_from_search'  => false,
        ];

        if ( !empty( $settings_options['team_slug'] ) ) {
            $options['team_slug'] = str_replace( ' ', '_' , $settings_options['team_slug'] );
        }

        return $options;
    }

}
