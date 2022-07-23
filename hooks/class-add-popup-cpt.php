<?php

/**
 * Create A Custom Post Type Sections To Add Block Settings
 */

class Add_Popup_Cpt{
    public static $imgUrl;
    public static $popupHeading;
    public static $popupPara;
    public static $popupRedirectUrl;
    public static $popupRedirectUrlType;
    public static $locationShortcode;
    public static $imageSize = "210 x 210";
    public static $popupTitle;
    public static $popupButtonName;
    public $id;
    public $errorMsg;
    
    function __construct(){
        add_action("init",[$this,"create_custom_post_type"]);
        add_action("add_meta_boxes",[$this,'add_custom_fields'],2);
        add_action("save_post",[$this,"save_fields"]);
        add_action('save_post',array($this,"set_post_title"));
        add_action('save_post',array($this,"save_fields_to_database"));
        add_action('delete_post',array($this,"delete_popup"));
        add_action('admin_notices',array($this,"render_error_messages"));
        $this->errorMsg = new Add_Msg;
    }

    function render_error_messages() {
        $this->errorMsg->render_err_msgs();
    }

    function create_custom_post_type() {
        $labels = array(
            'name' => _x( 'popups', 'Post Type General Name', 'textdomain' ),
            'singular_name' => _x( 'Popup', 'Post Type Singular Name', 'textdomain' ),
            'menu_name' => _x( 'popups', 'Admin Menu text', 'textdomain' ),
            'name_admin_bar' => _x( 'popups', 'Add New on Toolbar', 'textdomain' ),
            'archives' => __( 'Popup Archives', 'textdomain' ),
            'attributes' => __( 'Popup Attributes', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Popup:', 'textdomain' ),
            'all_items' => __( 'All popups', 'textdomain' ),
            'add_new_item' => __( 'Add New Popup', 'textdomain' ),
            'add_new' => __( 'Add New', 'textdomain' ),
            'new_item' => __( 'New Popup', 'textdomain' ),
            'edit_item' => __( 'Edit Popup', 'textdomain' ),
            'update_item' => __( 'Update Popup', 'textdomain' ),
            'view_item' => __( 'View Popup', 'textdomain' ),
            'view_items' => __( 'View popups', 'textdomain' ),
            'search_items' => __( 'Search Popup', 'textdomain' ),
            'not_found' => __( 'Not found', 'textdomain' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
            'featured_image' => __( 'Featured Image', 'textdomain' ),
            'set_featured_image' => __( 'Set featured image', 'textdomain' ),
            'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
            'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
            'insert_into_item' => __( 'Insert into Popup', 'textdomain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Popup', 'textdomain' ),
            'items_list' => __( 'popups list', 'textdomain' ),
            'items_list_navigation' => __( 'popups list navigation', 'textdomain' ),
            'filter_items_list' => __( 'Filter popups list', 'textdomain' ),
        );
        $args = array(
            'label' => __( 'Popup', 'textdomain' ),
            'description' => __( '', 'textdomain' ),
            'labels' => $labels,
            'menu_icon' => 'dashicons-tag',
            'supports' => array( ''),
            'taxonomies' => array(),
            'public' => true,
            'title' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'exclude_from_search' => false,
            'show_in_rest' => true,
            'publicly_queryable' => true,
            'capability_type' => 'post',
        );
        register_post_type( 'bekthemes_popups', $args );
    }
    //add custom fields
    function add_custom_fields(){
		add_meta_box(
			'bekthemes_popups',
			'Bekthemes popup',
			array($this,'custom_fields'),
			'bekthemes_popups',
			'normal',
			'low',
			''
		);
	}

    
    function save_fields($post_id){
        /**
         * Post Heading
         */
        if(isset($_POST['popup_heading'])){
            update_post_meta(
                $post_id ,
                "popup-heading",
                $_POST['popup_heading']
            );
            $this->errorMsg -> empty_fields('Heading','popup_heading');
        }
        /**
         * Post Para
         */
        if(isset($_POST['popup_para'])){
            update_post_meta(
                $post_id ,
                "popup-para",
                $_POST['popup_para']
            );
            $this->errorMsg -> empty_fields('Paragraph','popup_para');
        }
        /**
         * Redirect Url
         */
        if(isset($_POST['popup_redirect_url']) && $_POST['popup_redirect_url'] !== ""){
            update_post_meta(
                $post_id ,
                "popup-redirect-url",
                $_POST['popup_redirect_url']
            );
        }
        /**
         * Url Type
         */
        if(isset($_POST['popup_redirect_url_type']) && $_POST['popup_redirect_url_type'] !== ""){
            update_post_meta(
                $post_id ,
                "popup-redirect-url-type",
                $_POST['popup_redirect_url_type']
            );
        }
        /**
         * Img Url
         */
        if(isset($_POST['img_url']) && $_POST['img_url'] !== ""){
            update_post_meta(
                $post_id ,
                "popup-image",
                $_POST['img_url']
            );
            $this->errorMsg -> empty_fields('Popup Image','img_url');
        }
        /**
         * form id
         */
        if(isset($_POST['location_shortcode']) && $_POST['location_shortcode'] !== ""){
            update_post_meta(
                $post_id ,
                "location-shortcode",
                $_POST['location_shortcode']
            );
            $this->errorMsg -> empty_fields('Form Id','location_shortcode');
        }
        /**
         * Post Title
         */
        if(isset($_POST['popup_title']) && $_POST['popup_title'] !== ""){
            update_post_meta(
                $post_id ,
                "popup-title",
                $_POST['popup_title']
            );
            $this->errorMsg -> empty_fields('Title','popup_title');
        }
        /**
         * button Name
         */
        if(isset($_POST['popup_button_name']) && $_POST['popup_button_name'] !== ""){
            update_post_meta(
                $post_id ,
                "popup-button-name",
                $_POST['popup_button_name']
            );
        }
    }

    function init(){
        add_action( 'admin_notices', [$this,'wpb_admin_notice_warns'] );
    }

    function custom_fields($post){
        self::$popupHeading = get_post_meta($post->ID,'popup-heading',true);
        self::$imgUrl = get_post_meta($post->ID,'popup-image',true);
        self::$popupPara = get_post_meta($post->ID,'popup-para',true);
        self::$popupRedirectUrl = get_post_meta($post->ID,'popup-redirect-url',true);
        self::$popupRedirectUrlType = get_post_meta($post->ID,'popup-redirect-url-type',true);
        self::$locationShortcode = get_post_meta($post->ID,'location-shortcode',true);
        self::$popupTitle = get_post_meta($post->ID,'popup-title',true);
        self::$popupButtonName = get_post_meta($post->ID,'popup-button-name',true);

        //render form html
        BekThemes_Controller::add_view("popup-form");
    }

    function set_post_title($post_id){
        self::$popupTitle = get_post_meta($post_id,'popup-title',true);
        /**
         * unhook this function so it doesn't loop infinitely
         */
        remove_action( 'save_post', [$this,'set_post_title'] );
        
        if(self::$popupTitle){
            wp_update_post( array( 'ID' => $post_id, 'post_title' => self::$popupTitle),true );
        }
        add_action( 'save_post', [$this,'set_post_title'] );
    }

    function save_fields_to_database($post_id){}

    function delete_popup($post_id){}
}


new Add_Popup_Cpt;