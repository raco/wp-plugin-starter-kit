<?php
/**
 * CONF Plugin Name.
 *
 * @package   Plugin_Name_Shortcode_Admin
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
 * Handle Plugin Shortcode Admin Side Features
 */
class Plugin_Name_Shortcode_Admin
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
     * Initialize the class
     *
     * @since     1.0.0
     */
    private function __construct()
    {

        /*
         * Call $plugin_slug from public plugin class.
         */
        $plugin               = Plugin_Name::get_instance();
        $this->plugin_slug    = $plugin->get_plugin_slug();
        $this->plugin_version = $plugin->get_plugin_version();

        // Backend hooks and filters
        if (is_admin()) {

            add_action('admin_enqueue_scripts', array($this, 'tinymce_plugin_css'));

            add_action("admin_head", array($this, 'js_ajax_nonce'));

            add_action('admin_init', array($this, 'register_tinymce_plugin'));

            add_action('wp_ajax_admin_shortcode_popup', array($this, 'ajax_admin_shortcode_popup'));
        }

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

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Register new TinyMCE plugin CSS
     *
     * @since    1.0.0
     */
    public function tinymce_plugin_css()
    {
        wp_enqueue_style($this->plugin_slug . '-tinymce-plugin', plugins_url('tinymce/tinymce-plugin.css', __FILE__), array(), $this->plugin_version);
    }

    /**
     * Add Ajax Nonce to TinyMCE javascript file
     *
     * @since     1.0.0
     */
    public function js_ajax_nonce()
    {
        $ajax_nonce = wp_create_nonce('plugin_name_shortcode_ajax_request');
        ?>
<!-- TinyMCE Shortcode Plugin -->
<script type='text/javascript'>
    var plugin_name_tinymce = {
        'ajax_nonce': '<?php echo $ajax_nonce; ?>',
    };
</script>
<!-- TinyMCE Shortcode Plugin -->
<?php
}

    /**
     * Register new TinyMCE plugin to handle shortcode
     *
     * @since    1.0.0
     */
    public function register_tinymce_plugin()
    {
        if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
            add_filter('mce_external_plugins', array($this, 'tinymce_add_plugin'));
            add_filter('mce_buttons', array($this, 'tinymce_add_buttons'));
        }
    }

    /**
     * Add JS TinyMCE plugin
     *
     * @since    1.0.0
     */
    public function tinymce_add_plugin($plugin_array)
    {
        $plugin_array['plugin_name_tinymce'] = plugins_url('tinymce/tinymce-plugin.js', __FILE__);
        return $plugin_array;
    }

    /**
     * Add TinyMCE plugin buttons
     *
     * @since    1.0.0
     */
    public function tinymce_add_buttons($buttons)
    {
        array_push($buttons, 'plugin_name_tinymce');
        return $buttons;
    }

    /**
     * Handle TinyMCE popup via AJAX
     *
     * @since    1.0.0
     */
    public function ajax_admin_shortcode_popup()
    {
        global $wpdb;

        // Security check
        check_ajax_referer('plugin_name_shortcode_ajax_request', 'nonce');

        include_once dirname(__FILE__) . '/tinymce/tinymce-plugin-popup.php';

        wp_die(); // this is required to terminate immediately and return a proper response
    }

}
