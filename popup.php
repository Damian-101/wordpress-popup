<?php
/**
 * Plugin Name: BekThemes Popup
 * Description: Add A Popup Message To Forms
 * Author: BekThemes
 * Version: 1.0
 * Text Domain: bekthemes-popup
 */

/**
 * Add Constants
 */
require_once(plugin_dir_path(__FILE__) . "constants.php");
require_once(plugin_dir_path(__FILE__) . "scripts.php");

/**
 * Classes
 */
require_once(POPUP_PLUGIN_DIR_PATH . "classes/class-cpt-error-handling.php");

 /**
 * Contollers
 */
require_once(POPUP_PLUGIN_DIR_PATH . "controller/class-main-controller.php");
require_once(POPUP_PLUGIN_DIR_PATH . "wpforms-custom-snippets.php");
