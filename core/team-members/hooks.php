<?php

namespace Markutos\Core\TeamMembers;
use Markutos\Core\TeamMembers\Pages\Member_Single_Post;
use Markutos\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

class Hooks{

    use Singleton;

	public $cpt;
	public $actionPost_type = ['team_member'];
	public function init() {
		$this->cpt      = new Cpt();
		$this->add_single_page_template();
		add_action( 'pre_get_posts' ,array($this,'query_post_type_team_member'), 1, 1 );
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