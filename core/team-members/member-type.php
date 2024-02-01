<?php

namespace Markutos\Core\TeamMembers;

defined( 'ABSPATH' ) || exit;

/**
 * Taxonomy Class.
 * Taxonomy class for taxonomy of Event.
 * @extend Inherite class \Markutos\Base\taxonomy Abstract Class
 *
 * @since 1.0.0
 */
class MemberType extends \Markutos\Base\Taxonomy {
    
    // set custom post type name
    public function get_name() {
        return 'member_type';
    }

    public function get_cpt() {
        return 'team_member';
    }

    // Operation custom post type
    public function flush_rewrites() {
    }

    function taxonomy() {
        
        $labels = [
            'name'              => esc_html__( 'Member Type', 'markutos' ),
            'singular_name'     => esc_html__( 'Member Type', 'markutos' ),
            'search_items'      => esc_html__( 'Search Member Type', 'markutos' ),
            'all_items'         => esc_html__( 'All Member Type', 'markutos' ),
            'parent_item'       => esc_html__( 'Parent Member Type', 'markutos' ),
            'parent_item_colon' => esc_html__( 'Parent Member Type:', 'markutos' ),
            'edit_item'         => esc_html__( 'Edit Member Type', 'markutos' ),
            'update_item'       => esc_html__( 'Update Member Type', 'markutos' ),
            'add_new_item'      => esc_html__( 'Add New Member Type', 'markutos' ),
            'new_item_name'     => esc_html__( 'New Member Type Name', 'markutos' ),
            'menu_name'         => esc_html__( 'Member Type', 'markutos' ),
        ];

        $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'public'            => true,
            'show_in_nav_menus' => true,
            'show_in_menu'      => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => [ 'slug' => 'member_type' ],
        ];

        return $args;
    } 
}
