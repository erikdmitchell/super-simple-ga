<?php

class SSGA_Admin {

    public function __construct() {
        add_action( 'admin_init', array( $this, 'update_settings' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    public function update_settings() {
        if ( ! isset( $_REQUEST['_ssga_settings'] ) || ! wp_verify_nonce( $_REQUEST['_ssga_settings'], 'update_ssga_settings' ) ) {
            return;
        }

        if ( ! isset( $_REQUEST['ssga_code'] ) ) {
            return;
        }

        update_option( '_ssga_code', $_POST['ssga_code'] );
    }

    public function admin_menu() {
         // This page will be under "Settings"
        add_options_page(
            'Super Simple GA',
            'Super Simple GA',
            'manage_options',
            'ssga-admin',
            array( $this, 'create_admin_page' )
        );
    }

    public function create_admin_page() {
        $code = get_option( '_ssga_code', '' );
        $html = '';

        $html .= '<div class="wrap">';
            $html .= '<h1>Super Simple GA</h1>';

            $html .= '<form method="post" action="">';
                $html .= wp_nonce_field( 'update_ssga_settings', '_ssga_settings' );
                $html .= '<table class="form-table">';
                    $html .= '<tbody>';
                        $html .= '<tr>';
                            $html .= '<th scope="row">GA Code</th>';
                            $html .= '<td><fieldset><legend class="screen-reader-text"><span>GA Code</span></legend>';
                                $html .= '<p>';
                                    $html .= '<textarea name="ssga_code" id="ssga-code" class="ssga-code" rows="10" cols="50">' . $code . '</textarea>';
                                $html .= '</p>';
                            $html .= '</fieldset></td>';
                        $html .= '</tr>';
                    $html .= '</tbody>';
                $html .= '</table>';

                $html .= '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p> ';
            $html .= '</form>';
        $html .= '</div>';

        echo $html;
    }

}

new SSGA_Admin();
