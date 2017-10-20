<?php
/**
 * CONF Plugin Name.
 *
 * @package   Plugin_Name
 * @author    CONF_Plugin_Author
 * @license   GPL-2.0+
 * @link      CONF_Author_Link
 * @copyright CONF_Plugin_Copyright
 */

/**
 *-----------------------------------------
 * Do not delete this line
 * Added for security reasons: http://codex.wordpress.org/Theme_Development#Template_Files
 *-----------------------------------------
 */
defined( 'ABSPATH' ) or die( "Direct access to the script does not allowed" );
/*-----------------------------------------*/

class Plugin_Name {

    /**
     * Plugin version name
     *
     * @since   1.0.0
     *
     * @var     string
     */
    private static $VERSION_NAME = 'plugin_name_version';

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   1.0.0
     *
     * @var     string
     */
    private static $VERSION = '1.0.0';

    /**
     * Unique identifier for your plugin.
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * plugin file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    private static $PLUGIN_SLUG = 'plugin-name';

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since     1.0.0
     */
    public function __construct() {

		// Setup constants.
		$this->setup_constants();
		
		// Include plugin files.
		$this->include_files();
		
		// Initialize actions hooks.
		$this->init_hooks();
		
        // Load plugin text domain.
        add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

        // Activate plugin when new blog is added.
        add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

    }
	
	/* Setup plugin constants.
	 *
	 * @access private
	 * @since 1.0.0
	 * @return void
	 */
	private function define_constants() {
		// Plugin version.
		if ( ! defined( 'PLUGIN_NAME_VERSION' ) ) {
			define( 'PLUGIN_NAME_VERSION', '1.0.0' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'PLUGIN_NAME_PLUGIN_DIR' ) ) {
			define( 'PLUGIN_NAME_PLUGIN_DIR', dirname( PLUGIN_NAME_PLUGIN_FILE ) . '/' );
		}

		// Plugin Folder URL.
		if ( ! defined( 'PLUGIN_NAME_PLUGIN_URL' ) ) {
			define( 'PLUGIN_NAME_PLUGIN_URL', plugin_dir_url( PLUGIN_NAME_PLUGIN_FILE ) );
		}		
		
		// Plugin Basename
		if ( ! defined( 'PLUGIN_NAME_PLUGIN_BASENAME' ) ) {
			define( 'PLUGIN_NAME_PLUGIN_BASENAME', plugin_basename( PLUGIN_NAME_PLUGIN_FILE ) );
		}
	}
	
	
	/* Include needed plugin files.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function include_files() {
		require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-settings.php';
		require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/cpt/class-plugin-name-cpt.php';
		require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-recent-entries.php';
		require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-db.php';
		
		// Dashboard and Administrative Functionality.
		if ( is_admin() && ( !defined('DOING_AJAX' ) || !DOING_AJAX ) ) {
			require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-crud-list.php';
			require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-admin.php';
			require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-admin-metaboxes.php';
			require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-admin-pages.php';
			require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-admin-pages-crud.php';
			require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-admin-pages-settings.php';
		}
		
		// Plugin Shortcode.
		require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/shortcode/class-plugin-name-shortcode-admin.php';
		require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/shortcode/class-plugin-name-shortcode-public.php';
		
		// Handle AJAX Calls.
		require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/class-plugin-name-ajax.php';
	}
	
	/**
	 * Init Hooks
	 */
	public function init_hooks() {
		// Plugin settings, custom post type and database.
		add_action( 'plugins_loaded', array( 'Plugin_Name_Settings', 'get_instance' ) );
		add_action( 'plugins_loaded', array( 'Plugin_Name_CPT', 'get_instance' ) );
		add_action( 'plugins_loaded', array( 'Plugin_Name_DB', 'db_check' ) );
		
		// Dashboard and Administrative Functionality.
		if ( is_admin(  ) && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
			add_action( 'plugins_loaded', array( 'Plugin_Name_Admin', 'get_instance' ) );
			add_action( 'plugins_loaded', array( 'Plugin_Name_Admin_Metaboxes', 'get_instance' ) );
			add_action( 'plugins_loaded', array( 'Plugin_Name_Admin_Pages', 'get_instance' ) );
			add_action( 'plugins_loaded', array( 'Plugin_Name_Admin_Pages_CRUD', 'get_instance' ) );
			add_action( 'plugins_loaded', array( 'Plugin_Name_Admin_Pages_Settings', 'get_instance' ) );
		}
		
		// Shortcodes and AJAX.
		add_action( 'plugins_loaded', array( 'Plugin_Name_Shortcode_Admin', 'get_instance' ) );
		add_action( 'plugins_loaded', array( 'Plugin_Name_Shortcode_Public', 'get_instance' ) );
		add_action( 'plugins_loaded', array( 'Plugin_Name_AJAX', 'get_instance' ) );
	}

    /**
     * Return the plugin slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_plugin_slug() {
        return self::$PLUGIN_SLUG;
    }

    /**
     * Return the plugin version.
     *
     * @since    1.0.0
     *
     * @return    Plugin version variable.
     */
    public function get_plugin_version() {
        return self::$VERSION;
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Fired when the plugin is activated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses
     *                                       "Network Activate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       activated on an individual blog.
     */
    public static function activate( $network_wide ) {

        if ( function_exists( 'is_multisite' ) && is_multisite() ) {

            if ( $network_wide ) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ( $blog_ids as $blog_id ) {

                    switch_to_blog( $blog_id );
                    self::single_activate();
                }

                restore_current_blog();

            } else {
                self::single_activate();
            }

        } else {
            self::single_activate();
        }

    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses
     *                                       "Network Deactivate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       deactivated on an individual blog.
     */
    public static function deactivate( $network_wide ) {

        if ( function_exists( 'is_multisite' ) && is_multisite() ) {

            if ( $network_wide ) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ( $blog_ids as $blog_id ) {

                    switch_to_blog( $blog_id );
                    self::single_deactivate();

                }

                restore_current_blog();

            } else {
                self::single_deactivate();
            }

        } else {
            self::single_deactivate();
        }

    }

    /**
     * Fired when a new site is activated with a WPMU environment.
     *
     * @since    1.0.0
     *
     * @param    int    $blog_id    ID of the new blog.
     */
    public function activate_new_site( $blog_id ) {

        if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
            return;
        }

        switch_to_blog( $blog_id );
        self::single_activate();
        restore_current_blog();

    }

    /**
     * Get all blog ids of blogs in the current network that are:
     * - not archived
     * - not spam
     * - not deleted
     *
     * @since    1.0.0
     *
     * @return   array|false    The blog ids, false if no matches.
     */
    private static function get_blog_ids() {

        global $wpdb;

        // get an array of blog ids
        $sql = "SELECT blog_id FROM $wpdb->blogs
            WHERE archived = '0' AND spam = '0'
            AND deleted = '0'";

        return $wpdb->get_col( $sql );

    }

    /**
     * Fired for each blog when the plugin is activated.
     *
     * @since    1.0.0
     */
    private static function single_activate() {
        update_option( self::$VERSION_NAME, self::$VERSION );
		
		register_activation_hook( __FILE__, array( 'Plugin_Name_Settings', 'activate' ) );
		register_activation_hook( __FILE__, array( 'Plugin_Name_DB', 'activate' ) );
		
        // @TODO: Define activation functionality here
    }

    /**
     * Fired for each blog when the plugin is deactivated.
     *
     * @since    1.0.0
     */
    private static function single_deactivate() {
        // @TODO: Define deactivation functionality here
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        $domain = self::$PLUGIN_SLUG;
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

        load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
        load_plugin_textdomain( $domain, false, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

    }

}
