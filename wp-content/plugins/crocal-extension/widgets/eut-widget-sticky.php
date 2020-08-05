<?php
/**
 * Euthemians Sticky
 * A widget that displays a sticky divider.
 * @author		Euthemians Team
 * @URI			http://euthemians.com
 */

class Crocal_Ext_Widget_Sticky extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'eut-sticky-widget',
			'description' => esc_html__( 'Place this widget into any sidebar area, just above the widget which you want to be the first sticky widget element.', 'crocal-extension'),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'eut-sticky-widget',
		);
		parent::__construct( 'eut-sticky-widget', '(Euthemians) ' . esc_html__( 'Sticky Widget', 'crocal-extension' ), $widget_ops, $control_ops );
	}

	function crocal_ext_widget_sticky() {
		$this->__construct();
	}

	function widget( $args, $instance ) {
		echo '<div class="eut-widget widget eut-sticky-widget"></div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $instance;
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
