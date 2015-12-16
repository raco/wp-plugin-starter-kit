<?php
/**
 * CONF Plugin Name.
 *
 * @package   Plugin_Name_Shortcode_Admin
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


<?php

  $entryList = array();
  $sql = 'SELECT * FROM ' . Plugin_Name_DB::get_table_name();
  $entryList = $wpdb->get_results( $sql, 'ARRAY_A' );


  if( empty( $entryList ) ){
    die('It seems that you don\'t have any saved Entries. Please <a href="'.admin_url( 'admin.php?page=' . $this->plugin_slug . '-entry-add' ).'">create a new one</a> and try again');
  }




?>

<script type="text/javascript">
	// executes this when the DOM is ready
	jQuery(function(){

		function popup_insert_shortcode(){

			//default shortocode options
			var default_options = {
				'id' : ''
			};

			// get form id
			var form_id = jQuery('#tinymce-plugin-popup-form');


			var shortcode = '[plugin_shortcode';
			var shortcode_close = '[/plugin_shortcode]';

			for(var key in default_options) {
				//get default value
				var val_default=default_options[key];
				//get value for same option from form
				var val_new = jQuery("[name='sc_attr_"+key+"']", form_id).val();
				if( val_new === '' ){
					alert ('Please, fill in all required options');
					return false;
				}

				//if new value from form isn't the same as default value - insert it into shortcode
				if((val_new!='')&&(val_new!=val_default)){
					shortcode += ' ' + key + '="' + val_new + '"';
				}
			}

			var selected = tinyMCE.activeEditor.selection.getContent();
			var content = selected;

			if( selected ){
				//If text is selected when button is clicked
				//Wrap shortcode around it.
				shortcode += ']'; // close shortcode and add closing shortcode after content
				content = shortcode+content+shortcode_close;
			}else{
				shortcode += '/]';
				content =  shortcode;
			}



			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, content);

			// closes Thickbox
			tb_remove();
		}

		jQuery('#tinymce-plugin-popup-form-submit').bind('click',popup_insert_shortcode);


	});

</script>

<style>
	.tinymce-plugin-form{overflow:hidden!important;}
	.tinymce-plugin-form #TB_ajaxContent{overflow-y:scroll!important;width:100%!important;padding: 0px!important;}
	.tinymce-plugin-popup-inner{padding:0px 10px;}
	.tinymce-plugin-popup-form-wrapper{}
	.tinymce-plugin-popup-form-wrapper .fieldset-wrapper{margin-bottom:10px;}
	.tinymce-plugin-popup-form-wrapper label{line-height: 23px;}
	.tinymce-plugin-popup-form-wrapper label.simple{display:inline;float:none;}
	.tinymce-plugin-popup-form-wrapper textarea{resize:none;width:135px;height:80px;}
	.tinymce-plugin-popup-form-wrapper a{color:#3498DB !important;}
	.tinymce-plugin-popup-form-wrapper a:hover{color:#2980B9 !important;text-decoration: none !important;}
	.tinymce-plugin-popup-form-wrapper fieldset{padding:4px 9px 7px 9px;border:1px solid #BDC3C7;}
	.tinymce-plugin-popup-form-wrapper .field-row{margin:7px 0px;}
	.tinymce-plugin-popup-form-wrapper .field-help{font-size:0.8em}
	.tinymce-plugin-popup-form-wrapper .field-required{color:#E74C3C;}
	.tinymce-plugin-popup-form-wrapper .field-descr{font-size:0.9em}
	.tinymce-plugin-popup-form-wrapper .radio-group-wrapper{max-height: 200px;overflow: auto;padding:10px;background: #ECF0F1;}
	.tinymce-plugin-popup-form-wrapper .radio-group-wrapper .radio-element-wrapper{margin-bottom:5px;color: #34495E}
	.tinymce-plugin-popup-form-wrapper .radio-group-wrapper .radio-element-wrapper:hover{color: #7F8C8D}
</style>


<div id="tinymce-plugin-popup-wrapper">
	<div class="tinymce-plugin-popup-inner">
	  <h2>Insert Shortcode</h2>
	  <div class="tinymce-plugin-popup-form-wrapper">
	    <form id="tinymce-plugin-popup-form">
	      <div class="fieldset-wrapper">
	          <fieldset>
	            <legend>Shortcode Options</legend>
              <div class="field-row">
                <label><span class="field-required">*</span> Entry:<br>
                  <select id="sc_attr_id" name="sc_attr_id">
                    <option value="">Please select..</option>
                    <?php
                    foreach ($entryList as $entry) {
                      ?><option value="<?php echo $entry['id'];?>"><?php echo $entry['title'];?></option>
                    <?php
                    }
                    ?>
                  </select>
                </label>
              </div>
	          </fieldset>
	      </div>
	      <div class="submit">
	        <input type="button" id="tinymce-plugin-popup-form-submit" class="button-primary" value="Insert Shortcode" name="submit" />
	      </div>
	    </form>
	  </div>
	</div>
</div>
