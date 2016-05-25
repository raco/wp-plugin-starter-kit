<?php
/**
 * CONF Plugin Name.
 *
 * @package   Plugin_Name_Admin_Pages
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
defined('ABSPATH') or die("Direct access to the script does not allowed");
/*-----------------------------------------*/

class Plugin_Name_Admin_Pages
{

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Slug of the plugin screen.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_screen_hook_suffix = array();

    /**
     * Initialize the plugin by loading admin scripts & styles and adding a
     * settings page and menu.
     *
     * @since     1.0.0
     */
    private function __construct()
    {

        /*
         * @TODO :
         *
         * - Uncomment following lines if the admin class should only be available for super admins
         */
        /* if( ! is_super_admin() ) {
        return;
        } */

        /*
         * Call $plugin_slug from public plugin class.
         */
        $plugin               = Plugin_Name::get_instance();
        $this->plugin_slug    = $plugin->get_plugin_slug();
        $this->plugin_version = $plugin->get_plugin_version();

        // Load admin style sheet and JavaScript.
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_css_js'));

        // Add the plugin admin pages and menu items.
        add_action('admin_menu', array($this, 'add_plugin_admin_menu'));

    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance()
    {

        /*
         * @TODO :
         *
         * - Uncomment following lines if the admin class should only be available for super admins
         */
        /* if( ! is_super_admin() ) {
        return;
        } */

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Register and enqueue admin-specific CSS and JS.
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_css_js()
    {

        if (!isset($this->plugin_screen_hook_suffix)) {
            return;
        }

        $screen = get_current_screen();

        // Main Plugin Page
        if ($this->plugin_screen_hook_suffix['plugin_name'] == $screen->id) {
            /* Admin Styles */
            wp_enqueue_style($this->plugin_slug . '-admin-styles', plugins_url('assets/css/admin.css', __FILE__), array(), $this->plugin_version);

            // Main Admin JS Script
            wp_register_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/admin.js', __FILE__), array('jquery', $this->plugin_slug . '-admin-app'), $this->plugin_version);
            wp_enqueue_script($this->plugin_slug . '-admin-script');

        }

    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu()
    {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *        For reference: http://codex.wordpress.org/Roles_and_Capabilities
         *
         */
        $this->plugin_screen_hook_suffix['plugin_name'] = add_menu_page(
            __('CONF Plugin Name', 'plugin-name'),
            __('CONF Plugin Name', 'plugin-name'),
            'manage_options',
            $this->plugin_slug . '-main-page',
            array($this, 'display_plugin_page_main'),
            'dashicons-layout'
        );

    }

    /**
     * Render the main page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_page_main()
    {
        include_once 'views/main.php';
    }

}
