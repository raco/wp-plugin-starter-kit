<?php
/**
 * Represents the view for the plugin settings page.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Plugin_Name_Admin
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
?>

<?php
$settings_tabs = Plugin_Name_Settings::$settings_tabs;
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<h2 class="nav-tab-wrapper">
	<?php foreach( $settings_tabs as $tab_id => $tab ){ ?>
		<a href="#<?php echo $tab_id;?>" class="nav-tab"><?php _e( $tab , 'plugin-name' ); ?></a>
	<?php }?>
	</h2>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables1 ui-sortable1">
					<div class="postbox">
						<div class="inside">
							<?php settings_errors(); ?>

							<form id="plugin-settings-form" action="options.php" method="POST">
								<?php
								settings_fields( Plugin_Name_Settings::$settings_group_id );
								foreach( $settings_tabs as $tab_id => $tab ){
									echo '<div class="table ui-tabs-hide" id="' . $tab_id . '">';
										do_settings_sections( $tab_id );
									echo '</div>';
 								}
								submit_button();
								 ?>
							</form>

						</div>
					</div>
				</div>

			</div><!-- #post-body-content -->

			<!-- sidebar -->
			<?php include_once( '_sidebar-right.php' );?>
			<!-- end sidebar -->

		</div><!-- #post-body-->

		<br class="clear">
	</div>	<!-- #poststuff -->


</div>
