<?php

namespace Markutos\Core\TeamMembers;
use Markutos\Core\TeamMembers\Pages\Member_Single_Post;
use Markutos\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

class Hooks{

    use Singleton;

	public $cpt;
	public $member_type;

	public function init() {
		$this->cpt      		= new Cpt();
		$this->member_type	 	= new MemberType();
		$this->add_single_page_template();
		add_action( 'pre_get_posts' ,array($this,'query_post_type_team_member'), 1, 1 );
		add_action( 'parent_file', array( $this, 'keep_taxonomy_menu_open' ) );
		add_action( 'admin_post_nopriv_team_member_settings', array($this,'save_settings') );
		add_action( 'admin_post_team_member_settings', array($this,'save_settings') );
    }
	public function save_settings() {
		\Markutos\Base\Action::instance()->store( -1, $_POST );
	}

	/**
	 * Open taxonomy inside
	 *
	 * @param string $parent_file Parent File.
	 *
	 * @return string
	 */
	public function keep_taxonomy_menu_open( $parent_file ) {
		global $current_screen;
		$taxonomy            = $current_screen->taxonomy;
		$eligible_taxonomies = array( 'member_type' );

		if ( in_array( $taxonomy, $eligible_taxonomies ) ) {
			$parent_file = 'team_member';
		}

		return $parent_file;
	}

	public function query_post_type_team_member( $query ) {
		if ( ! is_admin() && is_post_type_archive( 'team_member' ) && $query->is_main_query() )
		{
			$query->set( 'posts_per_page', 4 ); 
		}
	}
	
	/**
	 * Add single and archive  page
	 */
	public function add_single_page_template() {
		new Member_Single_Post();
	}

    /**
	 * get user module url
	 *
	 * @return string
	 */
	public static function get_url() {
		return \Markutos::core_url() . 'team-members/';
	}

	/**
	 * get user module directory path
	 *
	 * @return string
	 */
	public static function get_dir() {
		return \Markutos::core_dir() . 'team-members/';
	}
}