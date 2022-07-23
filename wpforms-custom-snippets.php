<?php
/*
Plugin Name: WPForms Custom Code Snippets
Plugin URI: https://wpforms.com/
Description: Plugin for adding custom code snippets
Author: WPForms Team
Version: 1.0
Author URI: https://wpforms.com/
*/

class Bekthemes_Wpforms extends Bekthemes_Popup{

    function __construct(){
        add_action( 'wpforms_frontend_output_success', [$this,'output_success'],10,3);
    }


    /**
     * Run on Wpforms output success
     */
    function output_success(  $form_data, $fields, $entry_id ) {
        // Reset the fields to blank
        unset(
        $_GET[ 'wpforms_return' ],
        $_POST[ 'wpforms' ][ 'id' ]
        );
    
        $id = $form_data[ 'id' ];
        // Actually render the form.
        unset( $_POST['wpforms']['fields'] );
        wpforms()->frontend->output( $form_data[ 'id' ] );
            $this->add_popup($id);
    }

}

new Bekthemes_Wpforms;