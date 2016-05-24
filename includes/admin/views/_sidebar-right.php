<?php
/**
 * Right sidebar for settings page
 *
 * @package   Plugin_Name_Admin
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
?>


<div id="postbox-container-1" class="postbox-container sidebar-right">
    <div class="meta-box-sortables">
        <div class="postbox">
            <h3><span><?php esc_attr_e('Get help', 'plugin-name');?></span></h3>
            <div class="inside">
                <div>
                    <ul>
                        <li><a class="no-underline" target="_blank" href="CONF_Plugin_Link"><span class="dashicons dashicons-admin-home"></span> <?php esc_attr_e('Plugin Homepage', 'plugin-name');?></a></li>
                    </ul>
                </div>
                <div class="sidebar-footer">
                    &copy; <?php echo date('Y'); ?> <a class="no-underline text-highlighted" href="CONF_Author_Link" title="CONF_Plugin_Author" target="_blank">CONF_Plugin_Author</a>
                </div>
            </div>
        </div>
    </div>
</div>
