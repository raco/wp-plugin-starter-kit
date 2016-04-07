<?php
/**
 * CONF Plugin Name.
 *
 * @package   Plugin_Name_AJAX
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


/**
 * Register custom post types and taxonomies
 */
class Plugin_Name_CPT {

    /**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
    protected static $instance = null;


    /**
	 * List of all Custom Post Types to be registered
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
    private static $cpt_list = array();

    /**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
    private function __construct() {
        self::load_cpt();
        add_action( 'init', array( $this, 'register_cpt_and_taxonomies') );
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
	 * Assign Custom Post Types to class variable.
	 *
	 * @since     1.0.0
	 */
    private static function load_cpt() {
        $cpt = array(
            'entries' => array(
                'labels' => array(
                    'name'               => _x( 'Entries', 'post type general name', 'plugin-name' ),
                    'singular_name'      => _x( 'Entry', 'post type singular name', 'plugin-name' ),
                    'menu_name'          => _x( 'Entries', 'admin menu', 'plugin-name' ),
                    'name_admin_bar'     => _x( 'Entry', 'add new on admin bar', 'plugin-name' ),
                    'add_new'            => _x( 'Add New', 'entry', 'plugin-name' ),
                    'add_new_item'       => __( 'Add New Entry', 'plugin-name' ),
                    'new_item'           => __( 'New Entry', 'plugin-name' ),
                    'edit_item'          => __( 'Edit Entry', 'plugin-name' ),
                    'view_item'          => __( 'View Entry', 'plugin-name' ),
                    'all_items'          => __( 'All Entry', 'plugin-name' ),
                    'search_items'       => __( 'Search Entry', 'plugin-name' ),
                    'parent_item_colon'  => __( 'Parent Entries:', 'plugin-name' ),
                    'not_found'          => __( 'No Entries found.', 'plugin-name' ),
                    'not_found_in_trash' => __( 'No Entries found in Trash.', 'plugin-name' )
                ),
                'description'        => __( 'Manage your entries', 'plugin-name' ),
                'public'             => false,
                'publicly_queryable' => false,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => false,
                'rewrite'            => array( 'slug' => 'entries' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                'menu_position'      => 25,
                'menu_icon'			 => 'dashicons-layout',
                'supports'           => array( 'title')
            )
        );

        self::$cpt_list = $cpt;
    }





    /**
	 * Register all Custom Post Types and Taxonomies.
	 *
	 * @since     1.0.0
	 */
    public function register_cpt_and_taxonomies(){
        // Register CPT
        foreach( self::$cpt_list as $slug => $args ){
            register_post_type( $slug , $args );
        }
    }



}
