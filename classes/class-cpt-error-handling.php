<?php

Class Add_Msg{
    public $errorMsgs;
    public $id;
    public $isError;
    function __construct(){
        add_action("save_post",[$this,"save_post_as_draft"]);
    }

    public function add_notice_query_var( $location ) {
        remove_filter( 'redirect_post_location', array( $this, 'add_notice_query_var' ), 99 );
        return add_query_arg( array( $this->id => array_unique($this->errorMsgs) ), $location );
    }


    /**
     * If theres any error in the cpt,save the post as a draft
     */

    public function save_post_as_draft($post_ID){
        remove_action( 'save_post', [$this,'save_post_as_draft'] );
        if($this->isError === true){
            $post = array( 'ID' => $post_ID, 'post_status' => 'draft' );
            wp_update_post($post);
        }
        add_action("save_post",[$this,"save_post_as_draft"]);
    }
    
    public function add_error_msg($id,$errorMsg){
        /**
         * Set Error Messages
         */
        $this->isError = true;
        $this->errorMsgs[] = $errorMsg;
        $this->id = $id;
        /**
         * Add Values To Redirect Url
         */
        add_filter( 'redirect_post_location', array( $this, 'add_notice_query_var' ), 99 );
    }

    public function empty_fields($field_name,$field_post_name){
        if(isset($_POST[$field_post_name]) && $_POST[$field_post_name] === ""){
            $this -> add_error_msg('err','Fill The ' . $field_name . ' Field');
        }
    }

    public function render_err_msgs(){
        $class = 'notice notice-error';
        /**
         * Get All Err Messages
         */
        if(isset($_GET['err'])){
            $errorMsgs = $_GET['err'];
            foreach($errorMsgs as $errorMsg){
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html($errorMsg) ); 
            }
        }
    }

}