<?php

namespace Markutos\Base;

use Markutos\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue all css and js file class
 */
class Enqueue {

    use Singleton;


    /**
     * Main calling function
     */
    public function init() {
        // backend asset
        add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_assets') );
        // frontend asset
        add_action( 'wp_enqueue_scripts', array($this, 'frontend_enqueue_assets') );
    }
  

    /**
     * all admin js files function
     */
    public function admin_get_scripts() {
        $script_arr =  array(
			'admin-js'     => array(
                'src'     => \Markutos::assets_url() . 'js/admin.js',
                'version' => \Markutos::get_version(),
                'deps'    => ['jquery'],
            )
		);
        
        return $script_arr;
    }

    /**
     * all admin css files function
     *
     * @param Type $var
     */
    public function admin_get_styles() {
        return array(
            'admin' => array(
                'src'     => \Markutos::assets_url() . 'css/admin.css',
                'version' => \Markutos::get_version(),
            )
        );
    }

    /**
     * Enqueue admin js and css function
     *
     * @param  $var
     */
    public function admin_enqueue_assets() {
        $screen = get_current_screen();
        $pages  = \Markutos\Utils\Helper::admin_unique_id();

        // load js in specific pages
        if ( is_admin() && ( in_array( $screen->id , $pages ) ) ) {

            foreach ( $this->admin_get_scripts() as $key => $value ) {
                $deps       = !empty( $value['deps'] ) ? $value['deps'] : false;
                $version    = !empty( $value['version'] ) ? $value['version'] : false;
                wp_enqueue_script( $key, $value['src'], $deps, $version, true );
            }

            // css

            foreach ( $this->admin_get_styles() as $key => $value ) {
                $deps       = isset( $value['deps'] ) ? $value['deps'] : false;
                $version    = !empty( $value['version'] ) ? $value['version'] : false;
                wp_enqueue_style( $key, $value['src'], $deps, $version, 'all' );
            }

            // localize for admin
            $form_data                          = array();
            $form_data['ajax_url']              = admin_url( 'admin-ajax.php' );
            $form_data['filter_plus_nonce']     = wp_create_nonce( 'filter_plus_nonce' );
            wp_localize_script( 'admin-js', 'filter_admin', $form_data );
        }

    }



    /**
     * all js files function
     */
    public function frontend_get_scripts() {
        $script_arr = array(
			'tmpl-js'     => array(
                'src'     => \Markutos::assets_url() . 'js/jquery.tmpl.min.js',
                'version' => \Markutos::get_version(),
                'deps'    => ['jquery'],
            ),
			'filter-js'     => array(
                'src'       => \Markutos::assets_url() . 'js/search-filter.js',
                'version'   => \Markutos::get_version(),
                'deps'      => ['jquery'],
            ),
			'jquery.range-min'     => array(
                'src'     => \Markutos::assets_url() . 'js/jquery.range-min.js',
                'version' => \Markutos::get_version(),
                'deps'    => ['jquery'],
            )
        );

        return $script_arr;
    }

    /**
     * all css files function
     */
    public function frontend_get_styles() {
        $enqueue =  array(
			'dummy-public-free' => array(
                'src'     => \Markutos::assets_url() . 'css/public.css',
                'version' => \Markutos::get_version(),
            )
        );

        return $enqueue;
    }

    /**
     * Enqueue admin js and css function
     */
    public function frontend_enqueue_assets() {
        // js
        $scripts = $this->frontend_get_scripts();

        foreach ( $scripts as $key => $value ) {
            $deps       = isset( $value['deps'] ) ? $value['deps'] : false;
            $version    = !empty( $value['version'] ) ? $value['version'] : false;
            wp_enqueue_script( $key, $value['src'], $deps, $version, true );
        }

        // css
        $styles = $this->frontend_get_styles();

        foreach ( $styles as $key => $value ) {
            $deps = isset( $value['deps'] ) ? $value['deps'] : false;
            $version    = !empty( $value['version'] ) ? $value['version'] : false;
            wp_enqueue_style( $key, $value['src'], $deps, $version, 'all' );
        }

    }

}


