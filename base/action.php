<?php

namespace Markutos\Base;

use Markutos\Utils\Singleton;

defined( 'ABSPATH' ) || exit;

class Action {

    use Singleton;

    private $key_option_settings;
    private $form_id;
    private $form_setting;
    private $response = [];

    public function __construct() {
        $this->key_option_settings = 'manage_members_settings';
        $this->response            = [
            'saved'  => false,
            'status' => esc_html__( 'Something went wrong.', 'markutos' ),
            'data'   => [],
        ];
    }

    public function store( $form_id, $form_data ) {

        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
 
        $this->sanitize( $form_data );
        $this->form_id = $form_id;

        if ( $this->form_id == -1 ) {
            $this->update_option_settings();
        }

        return $this->response;
    }

    public function sanitize( $form_setting ) {

        foreach ( $form_setting as $key => $value ) {
            $this->form_setting[sanitize_key( $key )] = $value ;
        }
    }

    public function update_option_settings() {
        $status = update_option( $this->key_option_settings, $this->form_setting );

        if ( $status ) {
            $this->response['saved']  = true;
            $this->response['status'] = esc_html__( 'Settings Updated', 'markutos' );
            $this->response['key']    = $this->key_option_settings;
            $this->response['data']   = $this->form_setting;
        }

		return wp_safe_redirect( 'admin.php?page=settings' );
    }

}
