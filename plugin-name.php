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

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

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
 require_once( plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-settings.php' );

 register_activation_hook( __FILE__, array( 'Plugin_Name_Settings', 'activate' ) );
 add_action( 'plugins_loaded', array( 'Plugin_Name_Settings', 'get_instance' ) );
/* ----- Module End: Settings ----- */


/*----------------------------------------------------------------------------*
 * Include extensions and CPT
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: CPT ----- */
// require_once( plugin_dir_path( __FILE__ ) . 'includes/cpt/class-plugin-name-cpt.php' );
//  add_action( 'plugins_loaded', array( 'Plugin_Name_CPT', 'get_instance' ) );
/* ----- Module End: CPT ----- */


/*----------------------------------------------------------------------------*
 * Custom DB Tables
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: Database ----- */
// require_once( plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-db.php' );

// register_activation_hook( __FILE__, array( 'Plugin_Name_DB', 'activate' ) );
// add_action( 'plugins_loaded', array( 'Plugin_Name_DB', 'db_check' ) );
 /* ----- Module End: Database ----- */


/*----------------------------------------------------------------------------*
 * Handle AJAX Calls
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: AJAX ----- */
// require_once( plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-ajax.php' );
// add_action( 'plugins_loaded', array( 'Plugin_Name_AJAX', 'get_instance' ) );
/* ----- Module End: AJAX ----- */


/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-plugin-name-public.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'Plugin_Name_Public', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Plugin_Name_Public', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Plugin_Name_Public', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

/* ----- Plugin Module: CRUD ----- */
//	 require_once( plugin_dir_path( __FILE__ ) . 'admin/includes/class-plugin-name-list.php' );
/* ----- Module End: CRUD ----- */

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-plugin-name-admin.php' );
	add_action( 'plugins_loaded', array( 'Plugin_Name_Admin', 'get_instance' ) );

}


/*----------------------------------------------------------------------------*
 * Register Plugin Shortcode
 *----------------------------------------------------------------------------*/

/* ----- Plugin Module: Shortcode ----- */
// Admin Side
// require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcode/class-plugin-name-shortcode-admin.php' );
// add_action( 'plugins_loaded', array( 'Plugin_Name_Shortcode_Admin', 'get_instance' ) );

// Public Side
// require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcode/class-plugin-name-shortcode-public.php' );
// add_action( 'plugins_loaded', array( 'Plugin_Name_Shortcode_Public', 'get_instance' ) );
 /* ----- Module End: Shortcode ----- */
