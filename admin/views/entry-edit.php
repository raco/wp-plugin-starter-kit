<?php
/**
 * CONF Plugin Name.
 *
 * @package   Plugin_Name_List
 * @author    CONF_Plugin_Author
 * @license   GPL-2.0+
 * @link      CONF_Author_Link
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


$page_title = 'Add New Entry';
$message_updated_title = 'Entry has been saved!';
if($_GET['id']){
	$page_title = 'Edit Entry';
	$message_updated_title = 'Entry has been updated!';
}
?>


<div class="wrap">
	<div class="updated"><p><?php _e($message_updated_title, 'plugin-name');?></p></div>

	<h2>
		<a href="<?php echo admin_url( 'admin.php?page=' . $this->plugin_slug . '-entries-view' ) ?>" class="page-title-action">&larr; <?php _e('Back','plugin-name');?></a>
		<?php _e($page_title, 'plugin-name') ?>
	</h2>


	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-1">

			<!-- main content -->
			<div id="post-body-content">


				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<div class="inside">
							<p><?php _e('Edit entry form goes here', 'plugin-name');?></p>

						</div><!-- .inside -->

					</div><!-- .postbox -->

				</div><!-- .meta-box-sortables .ui-sortable -->

			</div><!-- post-body-content -->


		</div><!-- #post-body .metabox-holder .columns-1 -->

		<br class="clear">
	</div><!-- #poststuff -->


</div><!-- .wrap -->
