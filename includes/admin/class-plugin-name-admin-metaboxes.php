<?php
/**
 * CONF Plugin Name Admin Metaboxes.
 *
 * @package   Plugin_Name
 * @author    CONF_Plugin_Author
 * @license   GPL-2.0+
 * @link      CONF_Author_Link
 * @copyright CONF_Plugin_Copyright
 */

 // Exit if accessed directly
 defined( 'ABSPATH' ) || exit;

class Plugin_Name_Admin_Metaboxes {

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
	private function __construct() {
		add_action(  'add_meta_boxes', 			array(  $this, 'add_meta_boxes'  )  );
		add_action(  'save_post', 				array(  $this, 'save_metabox'  ), 1, 2  );
		add_action(  'plugin_name_save_entries', array(  $this, 'save_plugin_name_data'  ), 1, 2  );
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
		if (  null == self::$instance  ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Generate Metabox Fields
	 *
	 * @since     1.0.0
	 * @access 	  public
	 */
	public function metabox_fields() {
		return apply_filters(  'plugin_name_data_fields', array(
			'_text_meta'	=> array(
				'label'			=> __(  'Text Metabox', 'plugin-name'  ),
				'placeholder' 	=> __(  'This is a placeholder inside the text box', 'plugin-name'  ),
				'description'	=> __(  'This is the description below the text box', 'plugin-name'  )
			 ),
			'_checkbox'		=> array(
				'label'			=> __(  'Checkbox', 'plugin-name'  ),
				'type'			=> 'checkbox'
			 ),
			'_checkbox_checked'		=> array(
				'label'			=> __(  'Checkbox Checked by Default', 'plugin-name'  ),
				'type'			=> 'checkbox',
				'default'		=> '1'
			 ),
			'_select_meta'	=> array(
				'label'			=> __(  'Select Any Value', 'plugin-name'  ),
				'type'			=> 'select',
				'options'		=> array(
					'yes'	=> __(  'Enable', 'plugin-name'  ),
					'no'	=> __(  'Disable', 'plugin-name'  ),
					'none'	=> __(  'Do Nothing', 'plugin-name'  ),
				 )
			 ),
			'_file_meta'	=> array(
				'label'			=> __(  'File Upload', 'plugin-name'  ),
				'placeholder'	=> __(  'Upload a file', ''  ),
				'type'			=> 'image'
			 ),
			'_textarea'	=> array(
				'label'			=> __(  'Textarea Input', 'plugin-name'  ),
				'placeholder'	=> __(  'Textarea placeholder', 'plugin-name'  ),
				'description'	=> __(  'Any description here', 'plugin-name'  ),
				'type'			=> 'textarea'
			 ),
		 )  );
	}

	/**
	 *	Add Meta Boxes
	 *
	 * @since     1.0.0
	 * @access 	  public
	 * @return	  void
	 */
	public function add_meta_boxes() {
		add_meta_box(
			'plugin_name_data',
			__(  'Plugin Name Metaboxes'. 'plugin-name'  ),
			array(  $this, 'plugin_name_data'  ),
			'entries',
			'normal',
			'high'
		 );

	}

	/**
	 * Text Input Callback
	 *
	 * @param mixed $key
	 * @param mixed $field
	 * @return void
	 */
	public function callback_text(  $key, $field  ) {
		global $thepostid;

		if (  empty(  $field['value']  )  ) {
			$field['value'] = get_post_meta(  $thepostid, $key, true  );
		}
		?>
		<p class="form-field">
			<label for="<?php echo esc_attr(  $key  ); ?>"><?php echo esc_html(  $field['label']  ) ; ?>:</label>
			<input type="text" name="<?php echo esc_attr(  $key  ); ?>" id="<?php echo esc_attr(  $key  ); ?>" placeholder="<?php echo esc_attr(  $field['placeholder']  ); ?>" value="<?php echo esc_attr(  $field['value']  ); ?>" />
			<?php if (  ! empty(  $field['description']  )  ) : ?>
				<span class="description"><?php echo $field['description']; ?></span>
			<?php endif; ?>
		</p>
		<?php
	}

	/**
	 * Checkbox Input Callback
	 *
	 * @param mixed $key
	 * @param mixed $field
	 */
	public function callback_checkbox(  $key, $field  ) {
		global $thepostid;

		if (  empty(  $field['value']  )  ) {
			$field['value'] = get_post_meta(  $thepostid, $key, true  );
		}
		?>
		<p class="form-field">
			<label for="<?php echo esc_attr(  $key  ); ?>"><?php echo esc_html(  $field['label']  ) ; ?></label>
			<input type="checkbox" class="checkbox" name="<?php echo esc_attr(  $key  ); ?>" id="<?php echo esc_attr(  $key  ); ?>" value="1" <?php checked(  $field['value'], 1  ); ?> />
			<?php if (  ! empty(  $field['description']  )  ) : ?>
				<span class="description"><?php echo $field['description']; ?></span>
			<?php endif; ?>
		</p>
		<?php
	}

	/**
	 * Select Callback
	 *
	 * @param mixed $key
	 * @param mixed $field
	 */
	public function callback_select(  $key, $field  ) {
		global $thepostid;

		if (  empty(  $field['value']  )  ) {
			$field['value'] = get_post_meta(  $thepostid, $key, true  );
		}
		?>
		<p class="form-field">
			<label for="<?php echo esc_attr(  $key  ); ?>"><?php echo esc_html(  $field['label']  ) ; ?>:</label>
			<select name="<?php echo esc_attr(  $key  ); ?>" id="<?php echo esc_attr(  $key  ); ?>">
				<?php foreach (  $field['options'] as $key => $value  ) : ?>
					<option value="<?php echo esc_attr(  $key  ); ?>" <?php if (  isset(  $field['value']  )  ) selected(  $field['value'], $key  ); ?>><?php echo esc_html(  $value  ); ?></option>
				<?php endforeach; ?>
			</select>
			<?php if (  ! empty(  $field['description']  )  ) : ?><span class="description"><?php echo $field['description']; ?></span><?php endif; ?>
		</p>
		<?php
	}

	/**
	 * Multi-Select Callback
	 *
	 * @param mixed $key
	 * @param mixed $field
	 */
	public function callback_multiselect(  $key, $field  ) {
		global $thepostid;

		if (  empty(  $field['value']  )  ) {
			$field['value'] = get_post_meta(  $thepostid, $key, true  );
		}
		?>
		<p class="form-field">
			<label for="<?php echo esc_attr(  $key  ); ?>"><?php echo esc_html(  $field['label']  ) ; ?>:</label>
			<select multiple="multiple" name="<?php echo esc_attr(  $key  ); ?>[]" id="<?php echo esc_attr(  $key  ); ?>">
				<?php foreach (  $field['options'] as $key => $value  ) : ?>
					<option value="<?php echo esc_attr(  $key  ); ?>" <?php if (  ! empty(  $field['value']  ) && is_array(  $field['value']  )  ) selected(  in_array(  $key, $field['value']  ), true  ); ?>><?php echo esc_html(  $value  ); ?></option>
				<?php endforeach; ?>
			</select>
			<?php if (  ! empty(  $field['description']  )  ) : ?>
				<span class="description"><?php echo $field['description']; ?></span>
			<?php endif; ?>
		</p>
		<?php
	}

	/**
	 * Textarea Callback
	 *
	 * @param mixed $key
	 * @param mixed $field
	 */
	public function callback_textarea(  $key, $field  ) {
		global $thepostid;

		if (  empty(  $field['value']  )  ) {
			$field['value'] = get_post_meta(  $thepostid, $key, true  );
		}
		?>
		<p class="form-field">
			<label for="<?php echo esc_attr(  $key  ); ?>"><?php echo esc_html(  $field['label']  ) ; ?>:</label>
			<textarea name="<?php echo esc_attr(  $key  ); ?>" id="<?php echo esc_attr(  $key  ); ?>" cols="50" rows="5" placeholder="<?php echo esc_attr(  $field['placeholder']  ); ?>"><?php echo esc_html(  $field['value']  ); ?></textarea>
			<?php if (  ! empty(  $field['description']  )  ) : ?>
				<span class="description"><?php echo $field['description']; ?></span>
			<?php endif; ?>
		</p>
		<?php
	}

	/**
	 * Image Upload Callback
	 *
	 * @param mixed $key
	 * @param mixed $field
	 */
	public function callback_image(  $key, $field  ) {
		global $thepostid;

		if (  empty(  $field['value']  )  ) {
			$field['value'] = get_post_meta(  $thepostid, $key, true  );
		}
		?>
		<p class="form-field">
			<label for="<?php echo esc_attr(  $key  ); ?>"><?php echo esc_html(  $field['label']  ) ; ?>:</label>
			<input type="text" class="file_url" name="<?php echo esc_attr(  $key  ); ?>" id="<?php echo esc_attr(  $key  ); ?>" placeholder="<?php echo esc_attr(  $field['placeholder']  ); ?>" value="<?php echo esc_attr(  $field['value']  ); ?>" />
			<?php if (  ! empty(  $field['description']  )  ) : ?>
				<span class="description"><?php echo $field['description']; ?></span>
			<?php endif; ?>
			<button class="button upload_image_button" data-uploader_button_text="<?php _e(  'Upload an image', 'plugin-name'  ); ?>"><?php _e(  'Upload', 'plugin-name'  ); ?></button>
		</p>
		<?php
	}

	/**
	 * Plugin Name Data Function
	 *
	 * @access public
	 * @param mixed $post
	 * @return void
	 */
	public function plugin_name_data(  $post  ) {
		global $post, $thepostid;

		$thepostid = $post->ID;

		echo '<div class="plugin_name_meta_data">';

		wp_nonce_field(  'save_meta_data', 'plugin_name_nonce'  );

		do_action(  'plugin_name_entries_data_start', $thepostid  );

		foreach (  $this->metabox_fields() as $key => $field  ) {
			$type = ! empty(  $field['type']  ) ? $field['type'] : 'text';

			if (  method_exists(  $this, 'callback_' . $type  )  ) {
				call_user_func(  array(  $this, 'callback_' . $type  ), $key, $field  );
			} else {
				do_action(  'plugin_name_callback_' . $type, $key, $field  );
			}
		}

		do_action(  'plugin_name_entries_data_end', $thepostid  );

		echo '</div>';
	}

	/**
	 * Save Metabox
	 *
	 * @access public
	 * @param mixed $post_id
	 * @param mixed $post
	 * @return void
	 */
	public function save_metabox(  $post, $post_id  ) {
		if (  ! current_user_can(  'edit_post', $post_id  )  ) {
			return;
		}

		if (  empty(  $post_id  ) || empty(  $post  ) || empty(  $_POST  )  ) {
			return;
		}

		if (  defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE  ) {
			return;
		}

		if (  is_int(  wp_is_post_revision(  $post  )  ) || is_int(  wp_is_post_autosave(  $post  )  )  ){
			return;
		}
		if (  empty(  $_POST['plugin_name_nonce']  ) || ! wp_verify_nonce(  $_POST['plugin_name_nonce'], 'save_meta_data'  )  ) {
			return;
		}
		if (  $post->post_type != 'entries'  ) {
			return;
		}

		do_action(  'plugin_name_save_entries', $post_id, $post  );
	}

	/**
	 * Save Plugin Name Data
	 *
	 * @param $post_id The post ID
	 * @param $post WP_Post
	 */
	public function save_plugin_name_data(  $post_id, $post   ) {
		global $wpdb;

		foreach (  $this->metabox_fields() as $key => $field  ) {

			if (  isset(  $_POST[ $key ]  )  ) {
				if (  is_array(  $_POST[ $key ]  )  ) {
					update_post_meta(  $post_id, $key, array_map(  'sanitize_text_field', $_POST[ $key ]  )  );
				} else {
					update_post_meta(  $post_id, $key, sanitize_text_field(  $_POST[ $key ]  )  );
				}
			} elseif (  ! empty(  $field['type']  ) && $field['type'] == 'checkbox' ) {
				update_post_meta(  $post_id, $key, 0  );
			}
		}
	}
}
