<?php
/**
 * CONF Plugin Name Recent Entries.
 *
 * @package   Plugin_Name
 * @author    CONF_Plugin_Author
 * @license   GPL-2.0+
 * @link      CONF_Author_Link
 * @copyright CONF_Plugin_Copyright
 */


// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class Plugin_Name_Recent_Entries extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'plugin_name_recent_entries',
			'description' => __( 'Your site&#8217;s most recent Entries.', 'plugin-name' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'recent-custom-entries', __( 'Recent Entries', 'plugin-name' ), $widget_ops );
		$this->alt_option_name = 'plugin_name_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Entries', 'plugin-name' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$entries_number = ( ! empty( $instance['entries_number'] ) ) ? absint( $instance['entries_number'] ) : 5;
		if ( ! $entries_number )
			$entries_number = 5;
		$display_date   = isset( $instance['display_date'] ) ? $instance['display_date'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 1.0.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$recent = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $entries_number,
			'no_found_rows'       => true,
			'post_type'			  => 'entries',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($recent->have_posts()) {
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="recent-entries">
			<ul>
			<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
				<?php if ( $display_date ) : ?>
					<span class="post-date"><?php echo get_the_date(); ?></span>
				<?php endif; ?>
				</li>
			<?php endwhile; ?>
			</ul>
		</div>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		} else { ?>
		<div class="no-entries">	
			<?php echo __( 'There are no entries to display', 'plugin-name' ); ?>
		</div>
		<?php
		}
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance 					= $old_instance;
		$instance['title'] 			= sanitize_text_field( $new_instance['title'] );
		$instance['entries_number'] = (int) $new_instance['entries_number'];
		$instance['display_date'] 	= isset( $new_instance['display_date'] ) ? (bool) $new_instance['display_date'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 * @return string|void
	 */
	public function form( $instance ) {
		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$entries_number = isset( $instance['entries_number'] ) ? absint( $instance['entries_number'] ) : 5;
		$display_date 	= isset( $instance['display_date'] ) ? (bool) $instance['display_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'plugin-name' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'entries_number' ); ?>"><?php _e( 'Number of entries to show:', 'plugin-name' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'entries_number' ); ?>" name="<?php echo $this->get_field_name( 'entries_number' ); ?>" type="number" step="1" min="1" value="<?php echo $entries_number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $display_date ); ?> id="<?php echo $this->get_field_id( 'display_date' ); ?>" name="<?php echo $this->get_field_name( 'display_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'display_date' ); ?>"><?php _e( 'Display entries date?', 'plugin-name' ); ?></label></p>
<?php
	}
}


/**
 * Register Widgets
 * 
 * @since 1.0.0
 */
function plugin_name_register_widgets() {
	register_widget( 'Plugin_Name_Recent_Entries' );
}
add_action( 'widgets_init', 'plugin_name_register_widgets' );