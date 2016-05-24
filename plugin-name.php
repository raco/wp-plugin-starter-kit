<?php
/**
 * @package   Plugin_Name
 * @author    CONF_Plugin_Author
 * @license   GPL-2.0+
 * @link      CONF_Author_Link
 * @copyright CONF_Plugin_Copyright
 *
 * @wordpress-plugin
 * Plugin Name:       CONF Plugin Name
 * Plugin URI:        CONF_Plugin_Link
 * Description:       Plugin Description
 * Version:           1.0.0
 * Author:            CONF_Plugin_Author
 * Author URI:        CONF_Author_Link
 * Text Domain:       plugin-name
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

/**
 *-----------------------------------------
 * Do not delete this line
 * Added for security reasons: http://codex.wordpress.org/Theme_Development#Template_Files
 *-----------------------------------------
 */
defined('ABSPATH') or die("Direct access to the script does not allowed");
/*-----------------------------------------*/

/*----------------------------------------------------------------------------*
 * * * ATTENTION! * * *
 * FOR DEVELOPMENT ONLY
 * SHOULD BE DISABLED ON PRODUCTION
 *----------------------------------------------------------------------------*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*
 * Plugin Settings
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: Settings ----- */
require_once plugin_dir_path(__FILE__) . 'includes/class-plugin-name-settings.php';

register_activation_hook(__FILE__, array('Plugin_Name_Settings', 'activate'));
add_action('plugins_loaded', array('Plugin_Name_Settings', 'get_instance'));
/* ----- Module End: Settings ----- */

/*----------------------------------------------------------------------------*
 * Include extensions and CPT
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: CPT ----- */
require_once plugin_dir_path(__FILE__) . 'includes/cpt/class-plugin-name-cpt.php';
add_action('plugins_loaded', array('Plugin_Name_CPT', 'get_instance'));
/* ----- Module End: CPT ----- */

/*----------------------------------------------------------------------------*
 * Custom DB Tables
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: Database ----- */
require_once plugin_dir_path(__FILE__) . 'includes/class-plugin-name-db.php';

register_activation_hook(__FILE__, array('Plugin_Name_DB', 'activate'));
add_action('plugins_loaded', array('Plugin_Name_DB', 'db_check'));
/* ----- Module End: Database ----- */

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once plugin_dir_path(__FILE__) . 'includes/class-plugin-name.php';

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook(__FILE__, array('Plugin_Name', 'activate'));
register_deactivation_hook(__FILE__, array('Plugin_Name', 'deactivate'));

add_action('plugins_loaded', array('Plugin_Name', 'get_instance'));

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {

    /* ----- Plugin Module: CRUD ----- */
    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-plugin-name-admin-crud-list.php';
    /* ----- Module End: CRUD ----- */

    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-plugin-name-admin.php';
    add_action('plugins_loaded', array('Plugin_Name_Admin', 'get_instance'));

    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-plugin-name-admin-pages.php';
    add_action('plugins_loaded', array('Plugin_Name_Admin_Pages', 'get_instance'));

    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-plugin-name-admin-pages-crud.php';
    add_action('plugins_loaded', array('Plugin_Name_Admin_Pages_CRUD', 'get_instance'));

    require_once plugin_dir_path(__FILE__) . 'includes/admin/class-plugin-name-admin-pages-settings.php';
    add_action('plugins_loaded', array('Plugin_Name_Admin_Pages_Settings', 'get_instance'));

}

/*----------------------------------------------------------------------------*
 * Register Plugin Shortcode
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: Shortcode ----- */
// Admin Side
require_once plugin_dir_path(__FILE__) . 'includes/shortcode/class-plugin-name-shortcode-admin.php';
add_action('plugins_loaded', array('Plugin_Name_Shortcode_Admin', 'get_instance'));

// Public Side
require_once plugin_dir_path(__FILE__) . 'includes/shortcode/class-plugin-name-shortcode-public.php';
add_action('plugins_loaded', array('Plugin_Name_Shortcode_Public', 'get_instance'));
/* ----- Module End: Shortcode ----- */

/*----------------------------------------------------------------------------*
 * Handle AJAX Calls
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: AJAX ----- */
require_once plugin_dir_path(__FILE__) . 'includes/class-plugin-name-ajax.php';
add_action('plugins_loaded', array('Plugin_Name_AJAX', 'get_instance'));
/* ----- Module End: AJAX ----- */
