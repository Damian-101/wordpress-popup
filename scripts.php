<?php
class BekThemes_Scripts {
    function __construct(){
        add_action("wp_enqueue_scripts",array($this,"scripts"));
        add_action("admin_enqueue_scripts",array($this,"add_admin_scripts"));
    }
    
    function scripts(){
        // wp_enqueue_style("bekthemes-popup-css",plugin_dir_url(__FILE__) . "view/css/index.css");
        wp_enqueue_script("bekthemes-popup-js",plugin_dir_url(__FILE__) . "view/js/popup.js");
    }
    function add_admin_scripts(){
        wp_enqueue_script("bekthemes-popup-custom-post-types",plugin_dir_url(__FILE__) . "view/js/popup-custom-post-type.js");
        wp_localize_script( "bekthemes-popup-custom-post-types", "post_count", [wp_count_posts('post')] );
        wp_enqueue_style("bekthemes-cpt",plugin_dir_url(__FILE__) . "view/css/custom-post-type.css");
    }
}

new BekThemes_Scripts;