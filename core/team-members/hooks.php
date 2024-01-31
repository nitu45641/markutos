<?php

namespace Markutos\Core\TeamMembers;
use Markutos\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

class Hooks{

    use Singleton;

	public $cpt;
	public $actionPost_type = ['team_member'];
	public function init() {
		$this->cpt      = new Cpt();
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