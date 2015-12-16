<?php
/**
 * CONF Plugin Name.
 *
 * @package   Plugin_Name_List
 * @author    CONF_Plugin_Author
 * @license   GPL-2.0+
 * @link      CONF_Plugin_Author_Link
 * @copyright CONF_Plugin_Copyright
 */
?>

<?php
/**
*-----------------------------------------
* Do not delete this line
* Added for security reasons: http://codex.wordpress.org/Theme_Development#Template_Files
*-----------------------------------------
*/
defined('ABSPATH') or die("Direct access to the script does not allowed");
?>

<div class="wrap">

	<h1>
		<?php echo esc_html( get_admin_page_title() ); ?>
		<a href="<?php echo admin_url( 'admin.php?page=' . $this->plugin_slug . '-entry-add' ) ?>" class="page-title-action"><?php _e('Add New','plugin-name');?></a>
	</h1>


	<form id="plugin-name-filter" method="post">

		<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>">

		<?php $plugin_name_list_table->display(); ?>

	</form>

</div>
