<?php
/**
 * CONF Plugin Name.
 *
 * @package   Plugin_Name_Admin
 * @author    CONF_Plugin_Author
 * @license   GPL-2.0+
 * @link      CONF_Plugin_Author_Link
 * @copyright CONF_Plugin_Copyright
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to 'class-plugin-name-public.php'
 */
class Plugin_Name_Admin {

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
	private function __construct() {

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
		$plugin = Plugin_Name_Public::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_css_js' ) );

		// Add the plugin admin pages and menu items.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );


	}



	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
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
	public function enqueue_admin_css_js() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();

		if ( ( ( $this->plugin_screen_hook_suffix['plugin_name'] == $screen->id ) ) || ( $this->plugin_screen_hook_suffix['settings'] == $screen->id ) ) {
			/* Admin Styles */
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Plugin_Name_Public::VERSION );

			// Main Admin JS Script
			wp_register_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery', $this->plugin_slug . '-admin-app' ), Plugin_Name_Public::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-admin-script' );

		}

		/* if ( ( ( $this->plugin_screen_hook_suffix['entries_view'] == $screen->id ) && ( $_GET['action'] == 'edit' ) ) || ( $this->plugin_screen_hook_suffix['entry_add'] == $screen->id ) ) {
			// include scripts and styles for pages: "Entry Edit" and "Entries View"
		}
		*/

	}


	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *        For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 *
		 */
		$this->plugin_screen_hook_suffix['plugin_name'] = add_object_page(
			__( 'CONF Plugin Name', 'plugin-name' ),
			__( 'CONF Plugin Name', 'plugin-name' ),
			'manage_options',
			$this->plugin_slug . '-main-page' ,
			array( $this, 'display_plugin_page_main' ),
			'dashicons-layout'
		);


// Example of custom pages (Entries View and Edit)
/*
		$this->plugin_screen_hook_suffix['entries_view'] = add_object_page(
			__( 'Manage Entries', 'plugin-name' ),
			__( 'Entries', 'plugin-name' ),
			'manage_options',
			$this->plugin_slug . '-entries-view' ,
			array( $this, 'display_plugin_page_entries_view' ),
			'dashicons-layout'
		);


		$this->plugin_screen_hook_suffix['entry_add'] = add_submenu_page(
			$this->plugin_slug . '-entries-view',
			__( 'Add New Entry', 'plugin-name' ),
			__( 'Add New', 'plugin-name' ),
			'manage_options',
			$this->plugin_slug . '-entry-add',
			array( $this, 'display_plugin_page_entry_edit' )
		);
*/


		$this->plugin_screen_hook_suffix['settings'] = add_submenu_page(
			$this->plugin_slug . '-main-page',
			__( 'Settings', 'plugin-name' ),
			__( 'Settings', 'plugin-name' ),
			'manage_options',
			$this->plugin_slug . '-settings',
			array( $this, 'display_plugin_page_main' )
		);


	}

	/**
	 * Render "Manage Entries" page
	 *
	 * @since    1.0.0
	 */
/*
	public function display_plugin_page_entries_view() {
		if( $_GET['action'] == 'edit' ){
			include_once( 'views/entry-edit.php' );
		}else{
			$plugin_name_list_table = new Plugin_Name_List();
			$plugin_name_list_table->prepare_items();

			include_once( 'views/entries-view.php' );
		}
	}
*/


	/**
	 * Render "Add New / Edit" page
	 *
	 * @since    1.0.0
	 */
/*
	public function display_plugin_page_entry_edit() {
		include_once( 'views/entry-edit.php' );
	}
*/


	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_page_main() {
		include_once( 'views/main.php' );
	}


	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_page_settings() {
		include_once( 'views/settings.php' );
	}
	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_slug . '-settings' ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);
	}





}
