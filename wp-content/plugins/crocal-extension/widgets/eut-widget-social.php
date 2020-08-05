<?php
/**
 * Euthemians Social Networking
 * A widget that displays social networking links.
 * @author		Euthemians Team
 * @URI			http://euthemians.com
 */

class Crocal_Ext_Widget_Social extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'eut-element eut-social',
			'description' => esc_html__( 'A widget that displays social networking links', 'crocal-extension' ),
		);
		$control_ops = array(
			'width' => 400,
			'height' => 600,
			'id_base' => 'eut-widget-social',
		);
		parent::__construct( 'eut-widget-social', '(Euthemians) ' . esc_html__( 'Social Networking', 'crocal-extension' ), $widget_ops, $control_ops );
	}

	function crocal_ext_widget_social() {
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

		$icon_size = crocal_eutf_array_value( $instance, 'icon_size', 'extrasmall' );
		$icon_shape = crocal_eutf_array_value( $instance, 'shape', 'square' );
		$shape_type = crocal_eutf_array_value( $instance, 'shape_type', 'outline' );

		$icon_color = crocal_eutf_array_value( $instance, 'icon_color', 'primary-1' );
		$shape_color = crocal_eutf_array_value( $instance, 'shape_color', 'black' );


		$social_shape_classes = array();
		$social_shape_classes[] = 'eut-' . $icon_size;
		$social_shape_classes[] = 'eut-' . $icon_shape;

		if ( 'no-shape' != $icon_shape ) {
			$social_shape_classes[] = 'eut-with-shape';
			$social_shape_classes[] = 'eut-' . $shape_type;
			if ( 'outline' != $shape_type ) {
				$social_shape_classes[] = 'eut-bg-' . $shape_color;
			} else {
				$social_shape_classes[] = 'eut-text-' . $shape_color;
				$social_shape_classes[] = 'eut-text-hover-' . $shape_color;
			}
		}

		$social_shape_class_string = implode( ' ', $social_shape_classes );

	?>

		<ul>
		<?php
		if ( isset( $crocal_eutf_social_list_extended ) ) {
			foreach ( $crocal_eutf_social_list_extended as $social_item ) {

				$social_item_url = crocal_eutf_array_value( $instance, $social_item['url'] );

				if ( ! empty( $social_item_url ) ) {

					if ( 'skype' == $social_item['id'] ) {
		?>
					<li>
						<a href="<?php echo esc_url( $social_item_url, array( 'skype', 'http', 'https' ) ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?>">
							<i class="eut-text-<?php echo esc_attr( $icon_color ); ?> <?php echo esc_attr( $social_item['class'] ); ?>"></i>
						</a>
					</li>
		<?php
					} else {
		?>
					<li>
						<a href="<?php echo esc_url( $social_item_url ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?>" target="_blank">
							<i class="eut-text-<?php echo esc_attr( $icon_color ); ?> <?php echo esc_attr( $social_item['class'] ); ?>"></i>
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
		$instance['icon_size'] = strip_tags( $new_instance['icon_size'] );
		$instance['icon_color'] = strip_tags( $new_instance['icon_color'] );
		$instance['shape'] = strip_tags( $new_instance['shape'] );
		$instance['shape_type'] = strip_tags( $new_instance['shape_type'] );
		$instance['shape_color'] = strip_tags( $new_instance['shape_color'] );

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
			'icon_size' => 'extrasmall',
			'icon_color' => 'primary-1',
			'shape' => 'square',
			'shape_type' => 'outline',
			'shape_color' => 'black',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$icon_size = crocal_eutf_array_value( $instance, 'icon_size');
		$icon_shape = crocal_eutf_array_value( $instance, 'shape');
		$icon_shape_type = crocal_eutf_array_value( $instance, 'shape_type');
		$icon_color = crocal_eutf_array_value( $instance, 'icon_color' );
		$shape_color = crocal_eutf_array_value( $instance, 'shape_color' );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>"><?php echo esc_html__( 'Icon Size:', 'crocal-extension' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'icon_size' ) ); ?>" style="width:100%;">
				<option value="large" <?php selected( "large", $icon_size ); ?>><?php echo esc_html__( 'Large', 'crocal-extension' ); ?></option>
				<option value="medium" <?php selected( "medium", $icon_size ); ?>><?php echo esc_html__( 'Medium', 'crocal-extension' ); ?></option>
				<option value="small" <?php selected( "small", $icon_size ); ?>><?php echo esc_html__( 'Small', 'crocal-extension' ); ?></option>
				<option value="extrasmall" <?php selected( "extrasmall", $icon_size ); ?>><?php echo esc_html__( 'Extra Small', 'crocal-extension' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>"><?php echo esc_html__( 'Icon Color:', 'crocal-extension' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'icon_color' ) ); ?>" style="width:100%;">
				<?php crocal_eutf_print_media_button_color_selection( $icon_color ); ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'shape' ) ); ?>"><?php echo esc_html__( 'Shape:', 'crocal-extension' ); ?></label>
			<select  name="<?php echo esc_attr( $this->get_field_name( 'shape' ) ); ?>" style="width:100%;">
				<option value="square" <?php selected( "square", $icon_shape ); ?>><?php echo esc_html__( 'Square', 'crocal-extension' ); ?></option>
				<option value="round" <?php selected( "round", $icon_shape ); ?>><?php echo esc_html__( 'Round', 'crocal-extension' ); ?></option>
				<option value="circle" <?php selected( "circle", $icon_shape ); ?>><?php echo esc_html__( 'Circle', 'crocal-extension' ); ?></option>
				<option value="no-shape" <?php selected( "no-shape", $icon_shape ); ?>><?php echo esc_html__( 'None', 'crocal-extension' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'shape_type' ) ); ?>"><?php echo esc_html__( 'Shape Type:', 'crocal-extension' ); ?></label>
			<select  name="<?php echo esc_attr( $this->get_field_name( 'shape_type' ) ); ?>" style="width:100%;">
				<?php crocal_eutf_print_media_button_type_selection( $icon_shape_type ); ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'shape_color' ) ); ?>"><?php echo esc_html__( 'Shape Color:', 'crocal-extension' ); ?></label>
			<select  name="<?php echo esc_attr( $this->get_field_name( 'shape_color' ) ); ?>" style="width:100%;">
				<?php crocal_eutf_print_media_button_color_selection( $shape_color ); ?>
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
