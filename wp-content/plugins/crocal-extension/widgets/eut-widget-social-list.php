<?php
/**
 * Euthemians Social List Networking
 * A widget that displays social networking links.
 * @author		Euthemians Team
 * @URI			http://euthemians.com
 */

class Crocal_Ext_Widget_Social_List extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'eut-element eut-social-list',
			'description' => esc_html__( 'A widget that displays social list networking links', 'crocal-extension' ),
		);
		$control_ops = array(
			'width' => 400,
			'height' => 600,
			'id_base' => 'eut-widget-social-list',
		);
		parent::__construct( 'eut-widget-social-list', '(Euthemians) ' . esc_html__( 'List Social Networking', 'crocal-extension' ), $widget_ops, $control_ops );
	}

	function crocal_ext_widget_social_list() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		global $crocal_eutf_social_list_extended;

		//Our variables from the widget settings.
		extract( $args );

		echo wp_kses( $before_widget, crocal_ext_get_widget_allowed_html() );

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo wp_kses( $before_title, crocal_ext_get_widget_allowed_html() ) . esc_html( $title ) . wp_kses( $after_title, crocal_ext_get_widget_allowed_html() );
		}

		$list_type = crocal_eutf_array_value( $instance, 'list_type', 'vertical' );
		$font_size = crocal_eutf_array_value( $instance, 'font_size', 'link-text' );
		$list_align = crocal_eutf_array_value( $instance, 'list_align', 'left' );

		$social_list_classes = array();
		$social_list_classes[] = 'eut-' . $list_type;
		if( 'left' != $list_align ) {
			$social_list_classes[] = 'eut-align-' . $list_align;
		}
		$social_list_class_string = implode( ' ', $social_list_classes );

		$social_font_size_classes = array();
		$social_font_size_classes[] = 'eut-' . $font_size;
		$social_font_size_class_string = implode( ' ', $social_font_size_classes );

	?>

		<ul class="<?php echo esc_attr( $social_list_class_string ); ?>">
		<?php
		if ( isset( $crocal_eutf_social_list_extended ) ) {
			foreach ( $crocal_eutf_social_list_extended as $social_item ) {

				$social_item_url = crocal_eutf_array_value( $instance, $social_item['url'] );

				if ( ! empty( $social_item_url ) ) {

					if ( 'skype' == $social_item['id'] ) {
		?>
					<li>
						<a href="<?php echo esc_url( $social_item_url, array( 'skype', 'http', 'https' ) ); ?>" class="<?php echo esc_attr( $social_font_size_class_string ); ?>">
							<span><?php echo esc_attr( $social_item['title'] ); ?></span>
						</a>
					</li>
		<?php
					} else {
		?>
					<li>
						<a href="<?php echo esc_url( $social_item_url ); ?>" class="<?php echo esc_attr( $social_font_size_class_string ); ?>" target="_blank">
							<span><?php echo esc_attr( $social_item['title'] ); ?></span>
						</a>
					</li>
		<?php
					}
				}
			}
		}
		?>
		</ul>


	<?php

		echo wp_kses( $after_widget, crocal_ext_get_widget_allowed_html() );
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {

		global $crocal_eutf_social_list_extended;
		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['list_type'] = strip_tags( $new_instance['list_type'] );
		$instance['font_size'] = strip_tags( $new_instance['font_size'] );
		$instance['list_align'] = strip_tags( $new_instance['list_align'] );

		if ( isset( $crocal_eutf_social_list_extended ) ) {
			foreach ( $crocal_eutf_social_list_extended as $social_item ) {
				$instance[ $social_item['url'] ] = strip_tags( $new_instance[ $social_item['url'] ] );
			}
		}

		return $instance;
	}

	function form( $instance ) {

		global $crocal_eutf_social_list_extended;

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'list_type' => 'vertical',
			'font_size' => 'link-text',
			'list_align' => 'left',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$list_type = crocal_eutf_array_value( $instance, 'list_type');
		$font_size = crocal_eutf_array_value( $instance, 'font_size');
		$list_align = crocal_eutf_array_value( $instance, 'list_align');

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'list_type' ) ); ?>"><?php echo esc_html__( 'List Type:', 'crocal-extension' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'list_type' ) ); ?>" style="width:100%;">
				<option value="vertical" <?php selected( "vertical", $list_type ); ?>><?php echo esc_html__( 'Vertical', 'crocal-extension' ); ?></option>
				<option value="horizontal" <?php selected( "horizontal", $list_type ); ?>><?php echo esc_html__( 'Horizontal', 'crocal-extension' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'font_size' ) ); ?>"><?php echo esc_html__( 'Font Size:', 'crocal-extension' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'font_size' ) ); ?>" style="width:100%;">
				<option value="link-text" <?php selected( "link-text", $font_size ); ?>><?php echo esc_html__( 'Link Text', 'crocal-extension' ); ?></option>
				<option value="small-text" <?php selected( "small-text", $font_size ); ?>><?php echo esc_html__( 'Small Text', 'crocal-extension' ); ?></option>
				<option value="paragraph-text" <?php selected( "paragraph-text", $font_size ); ?>><?php echo esc_html__( 'Paragraph Text', 'crocal-extension' ); ?></option>
				<option value="leader-text" <?php selected( "leader-text", $font_size ); ?>><?php echo esc_html__( 'Leader Text', 'crocal-extension' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'list_align' ) ); ?>"><?php echo esc_html__( 'Align:', 'crocal-extension' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'list_align' ) ); ?>" style="width:100%;">
				<option value="left" <?php selected( "left", $list_align ); ?>><?php echo esc_html__( 'Left', 'crocal-extension' ); ?></option>
				<option value="center" <?php selected( "center", $list_align ); ?>><?php echo esc_html__( 'Center', 'crocal-extension' ); ?></option>
				<option value="right" <?php selected( "right", $list_align ); ?>><?php echo esc_html__( 'Right', 'crocal-extension' ); ?></option>
			</select>
		</p>
		<p>
				<em><?php echo esc_html__( 'Note: Make sure you include the full URL in the fields below (i.e. http://www.samplesite.com)', 'crocal-extension' ); ?></em>
		</p>

		<?php
		if ( isset( $crocal_eutf_social_list_extended ) ) {
			foreach ( $crocal_eutf_social_list_extended as $social_item ) {
				$social_item_url = crocal_eutf_array_value( $instance, $social_item['url'] );
		?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( $social_item['url'] ) ); ?>"><?php echo esc_html( $social_item['title'] ); ?>:</label>
					<input style="width: 100%;" id="<?php echo esc_attr( $this->get_field_id( $social_item['url'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $social_item['url'] ) ); ?>" value="<?php echo esc_attr( $social_item_url ); ?>" />
				</p>

		<?php
			}
		}
		?>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
