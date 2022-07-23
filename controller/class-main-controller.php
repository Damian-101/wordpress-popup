<?php
class BekThemes_Controller {
    public static function add_view($fileName){
        require_once(POPUP_PLUGIN_DIR_PATH . "view/$fileName.php");
    }
}

/**
 * Popup
 */
require_once(POPUP_PLUGIN_DIR_PATH . "hooks/class-add-popup-cpt.php");
require_once(POPUP_PLUGIN_DIR_PATH . "controller/class-popups-controller.php");