<?php

namespace Markutos;

use Markutos;

Class Wrapper {

	private static $instance;

	
	/**
	 * __construct function
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Load autoload method.
		Autoloader::run();
		// Core files
		\Markutos\Core\Core::instance()->init();
		// Enqueue Assets
		\Markutos\Base\Enqueue::instance()->init();
		add_action( 'after_setup_theme', array( $this, 'initialize_cpt_modules' ), 11 );


	}

	/**
     * Initialize CPT
     *
     */
    public function initialize_cpt_modules() {
		\Markutos\Core\TeamMembers\Hooks::instance()->init();
	}
	
	/**
	 * Custom css
	 *
	 * @param string $template
	 * @return void
	 */
	public function custom_css() {
		global $custom_css;
			$custom_css = '
				.filter-go-pro {
					color: #086808;
					font-weight: bold;
				}
			';
		
		wp_register_style( 'filter-go-pro', false );
		wp_enqueue_style( 'filter-go-pro' );
		wp_add_inline_style('filter-go-pro',$custom_css);
	}

	/**
	 * Singleton Instance
	 *
	 * @return Bootstrap
	 */
	public static function instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	
}