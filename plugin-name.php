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

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------*
 * * * ATTENTION! * * *
 * FOR DEVELOPMENT ONLY
 * SHOULD BE DISABLED ON PRODUCTION
 *----------------------------------------------------------------------------*/
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
/*----------------------------------------------------------------------------*/

// Define PLUGIN_NAME_PLUGIN_FILE.
if ( ! defined( 'PLUGIN_NAME_PLUGIN_FILE' ) ) {
	define( 'PLUGIN_NAME_PLUGIN_FILE', __FILE__ );
}

// Include the main Plugin_Name class
if ( ! class_exists( 'Plugin_Name' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-plugin-name.php';
}

/**
 * Main Plugin_Name instance
 *
 * Returns the main instance of Plugin_Name
 * @since 	1.0.0
 * @return	Plugin_Name
 */
function plugin_prefix() {
	return Plugin_Name::get_instance();
}
plugin_prefix();

// Register activation and deactivation hooks
register_activation_hook( __FILE__, array( 'Plugin_Name', 'activate' ) );
register_activation_hook( __FILE__, array( 'Plugin_Name_Settings', 'activate' ) );
register_activation_hook( __FILE__, array( 'Plugin_Name_DB', 'activate' ) );

register_deactivation_hook( __FILE__, array(  'Plugin_Name', 'deactivate' ) );
