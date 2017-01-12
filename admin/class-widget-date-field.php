<?php
/**
 *  Adds Date_Field widget.
 */
class Date_Field_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress
	 */
	function __construct() {
		parent::__construct(
			'date_field_widget',
			esc_html__( 'Date Field', 'df' ),
			array( 'description' => esc_html__( 'Date Picker Field', 'df' ) )
		);
	}

	/**
	 * Front End Section of Widget
	 *
	 * @param array $args     Display arguments.
	 * @param array $instance Saved setting for the widget.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Date' : $instance['title'], $instance, $this->id_base );
		$date_format = ! empty( $instance['date_format'] ) ? $instance['date_format'] : 'mm/dd/yy';

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo '<input type="text" class="code-date-field" data-format="' . $date_format . '"/>';
		echo $args['after_widget'];
	}

	/**
	 * Backend Widget Form
	 *
	 * @param array $instance Previosuly saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Date', 'df' );
		$date_format = ! empty( $instance['date_format'] ) ? $instance['date_format'] : 'mm/dd/yy';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '"> ' . esc_attr( 'Title: ', 'df' ) . '</label><br />';
		echo '<input class=widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" type="text" value="' . $title . '">';
		echo '</p>';
		echo '<p>';
		echo '<label for ="' . esc_attr( $this->get_field_id( 'date_format' ) ) . '"> ' . esc_attr( 'Date Format: ', 'df' ) . '</label><br />';
		echo '<select id="' . esc_attr( $this->get_field_id( 'date_format' ) ) . '" name="' . esc_attr( $this->get_field_name( 'date_format' ) ) . '" >';
			echo '<option value="mm/dd/yy" ' . selected( $date_format, 'mm/dd/yy' ) . ' >' . esc_attr( ' mm/dd/yy', 'df' ) . '</option>';
			echo '<option value="yy-mm-dd" ' . selected( $date_format, 'yy-mm-dd"' ) . ' >' . esc_attr( 'ISO 8601 - yy-mm-dd', 'df' ) . '</option>';
			echo '<option value="d M, y" ' . selected( $date_format, 'd M, y' ) . ' >' . esc_attr( 'Short - d M, y', 'df' ) . '</option>';
			echo '<option value="d MM, y" ' . selected( $date_format, 'd MM, y' ) . ' >' . esc_attr( 'Medium - d MM, y', 'df' ) . '</option>';
			echo '<option value="DD, d MM, yy" ' . selected( $date_format, 'DD, d MM, yy' ) . ' >' . esc_attr( 'Full - DD, d MM, yy', 'df' ) . '</option>';
			echo '</select>';
		echo '</p>';
	}

	/**
	 * Update form data as they are saved.
	 *
	 * @param array $new_instance Values to be saved.
	 * @param  array $old_instance old values from database.
	 * @return array new updated instances
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['date_format'] = ( ! empty( $new_instance['date_format'] ) ) ? esc_attr( $new_instance['date_format'] ) : 'mm/dd/yy';
		return $instance;
	}
}
