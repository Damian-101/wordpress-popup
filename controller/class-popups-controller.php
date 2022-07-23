<?php

/**
 * Add Popup Custom Post Types
 */
// new Add_Popup_Cpt;

class Bekthemes_Popup{
    /**
     * Popup Variables
     */
    public static $image;
    public static $heading;
    public static $paragraph;
    public static $redirect;
    public static $popupId;
    public static $FormId;
    public static $ButtonName;

    /**
     * Get popup values and add it to variables
     */
    public function get_popup_values($formId){
        $args = array (
            'post_type'              => 'bekthemes_popups',  
        );

        $query = new WP_Query( $args ); //popup custom post type 
        if ( $query -> have_posts() ) {
            while ( $query -> have_posts() ) {
                $query->the_post(); 
                /**
                 * Get location shortcodes
                 */
                $locationShortcode = get_post_meta(get_the_ID(), 'location-shortcode', true );
                if($locationShortcode === $formId){
                    /**
                     * Add popup values
                     */
                    self::$FormId = $formId;
                    self::$popupId = get_the_ID();
                    self::$image = get_post_meta( get_the_ID(), 'popup-image', true );
                    self::$heading = get_post_meta( get_the_ID(), 'popup-heading', true );
                    self::$paragraph = get_post_meta( get_the_ID(), 'popup-para', true );
                    self::$redirect = get_post_meta( get_the_ID(), 'popup-redirect-url', true );
                    self::$ButtonName = get_post_meta( get_the_ID(), 'popup-button-name', true );
                }
                
            }
        }
        wp_reset_query();
    }

    public function popupCookies () {
        $cookie_name = 'popupClosed';
        setcookie($cookie_name, 'true');
        return('a');
    }

    /**
     * Render Popup
     */
    public function add_popup($FormId){
        $this->get_popup_values($FormId);
        $popup_name = 'popupClosed' . $FormId;
        /**
         * Render popup html
         */
        if($_COOKIE[$popup_name] === 'false'){
            BekThemes_Controller::add_view("popup");
        }
    }
}


/**
 * Parent Styles
 */

