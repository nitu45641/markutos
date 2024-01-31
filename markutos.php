<?php
/**
 * Plugin Name:       Dummy Plugin
 * Plugin URI:        https://woooplugin.com/dummy-plugin
 * Description:       It is a dummy plugin
 * Version:           1.0.22
 * Requires at least: 5.2
 * Requires PHP:      7.3
 * Author:            Woooplugin
 * Author URI:        https://woooplugin.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       markutos
 * Domain Path:       /languages
 * @package Markutos
 * @category Core
 * @author Markutos
 * @version 1.0.0
 */

use Markutos\Utils\Helper;

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * The Main Plugin Requirements Checker
 *
 * @since 1.0.0
 */
final class Markutos {

	private static $instance;

	/**
     * Current  Version
     *
     * @return string
     */
    public static function get_version() {
        return '1.0.22';
    }

	/**
     * Singleton Instance
     *
     * @return Markutos Plus
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

	/**
     * Setup Plugin Requirements
     *
     * @since 1.0.0
     */
    private function __construct() {
        // Load modules
		add_action( 'plugins_loaded', array( $this, 'initialize_modules' ) , 999 );
    }
	
	/**
	 * Initialize Modules
	 *
	 * @since 1.1.0
	 */
	public function initialize_modules() {
		do_action( 'Markutos-plus/before_load' );
		$this->load_text_domain();
		require_once plugin_dir_path( __FILE__ ) . 'autoloader.php';
		require_once plugin_dir_path( __FILE__ ) . 'wrapper.php';

		// required plugin check
		$this->required_plugin();
		// Load Plugin modules and classes
		\Markutos\Wrapper::instance();
		do_action( 'Markutos-plus/after_load' );
	}

	/**
	 * Check required plugin and throw notice
	 *
	 * @return void
	 */
	public function required_plugin() {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';
		$plugins = array();

		foreach ( $plugins as $key => $value) {
			if ( !is_plugin_active( $value['slug'] ) ) {
				add_action( 'admin_notices', [$this, 'markutos_plugin_notice'] );
			}
		}
	}

	public function markutos_plugin_notice(){
		return esc_html__('Active required Plugin','markutos');
	}

	/**
     * Load Localization Files
     *
     * @since 1.0.0
     * @return void
     */
	public function load_text_domain() {
		load_plugin_textdomain( 'Markutos-plus', false, self::plugin_dir() . 'languages/' );
    }

	/**
	 * Assets Directory Url
	 *
	 * @return void
	 */
	public static function assets_url() {
		return trailingslashit( self::plugin_url() . 'assets' );
	}

	/**
	 * Build Directory Url
	 *
	 * @return void
	 */
	public static function build_url() {
		return trailingslashit( self::plugin_url() . 'build' );
	}

	/**
	 * Assets Folder Directory Path
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function assets_dir() {
		return trailingslashit( self::plugin_dir() . 'assets' );
	}

	/**
	 * Plugin Core File Directory Url
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function core_url() {
		return trailingslashit( self::plugin_url() . 'core' );
	}

	/**
	 * Plugin Core File Directory Path
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function core_dir() {
		return trailingslashit( self::plugin_dir() . 'core' );
	}

	/**
	 * Plugin Url
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function plugin_url() {
		return trailingslashit( plugin_dir_url( self::plugin_file() ) );
	}

	/**
	 * Plugin Directory Path
	*
	* @since 1.0.0
	*
	* @return void
	*/
	public static function plugin_dir() {
		return trailingslashit( plugin_dir_path( self::plugin_file() ) );
	}

	/**
	 * Plugins Basename
	 *
	 * @since 1.0.0
	 */
	public static function plugins_basename(){
		return plugin_basename( self::plugin_file() );
	}

	/**
	 * Plugin File
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function plugin_file(){
		return __FILE__;
	}


}

// Initiate Plugin
Markutos::get_instance();

