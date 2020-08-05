<?php
/**
 * Euthemians Instagram Feed
 * A widget that displays latest posts.
 * @author		Euthemians Team
 * @URI			http://euthemians.com
 */

class Crocal_Ext_Widget_Instagram_Feed extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'eut-instagram-feed',
			'description' => esc_html__( 'A widget that displays instagram feed', 'crocal-extension'),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'eut-widget-instagram-feed',
		);
		parent::__construct( 'eut-widget-instagram-feed', '(Euthemians) ' . esc_html__( 'Instagram Feed', 'crocal-extension' ), $widget_ops, $control_ops );
	}

	function crocal_ext_widget_instagram_feed() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		//Our variables from the widget settings.
		extract( $args );

		$username = $instance['username'];
		$limit = $instance['limit'];
		$order_by = $instance['order_by'];
		$order = $instance['order'];
		$target = $instance['target'];
		$cache = $instance['cache'];

		$access_token = $instance['access_token'];
		$user_id = $instance['user_id'];

		if( !isset( $cache ) ) {
			$cache = '';
		}

		if( empty( $limit ) ) {
			$limit = 9;
		}

		echo wp_kses( $before_widget, crocal_ext_get_widget_allowed_html() );

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo wp_kses( $before_title, crocal_ext_get_widget_allowed_html() ) . esc_html( $title ) . wp_kses( $after_title, crocal_ext_get_widget_allowed_html() );
		}

		if ( !empty( $username ) ) {

			$media_array = crocal_ext_get_instagram_array( $username, $limit, $order_by, $order, $cache, $access_token, $user_id );
			$output = '';

			if ( is_wp_error( $media_array ) ) {

			   echo wp_kses_post( $media_array->get_error_message() );

			} else {

			?>
				<ul class="eut-instagram-images">
			<?php
				foreach ($media_array as $item) {
			?>
					<li>
						<div class="eut-item-wrapper">
							<div class="eut-bg-wrapper eut-small-square">
								<div class="eut-bg-image" style="background-image: url(<?php echo esc_url( $item['thumbnail']['url'] ); ?>);"></div>
							</div>
							<a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target ); ?>"></a>
							<img width="150" height="150" src="<?php echo esc_url( $item['thumbnail']['url'] ); ?>"  alt="<?php echo esc_attr( $item['description'] ); ?>" title="<?php echo esc_attr( $item['description'] ); ?>"/>
						</div>
					</li>
			<?php
				}
			?>
				</ul>
			<?php
			}
		}

		echo wp_kses( $after_widget, crocal_ext_get_widget_allowed_html() );
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['limit'] = strip_tags( $new_instance['limit'] );
		$instance['order_by'] = strip_tags( $new_instance['order_by'] );
		$instance['order'] = strip_tags( $new_instance['order'] );
		$instance['target'] = strip_tags( $new_instance['target'] );
		$instance['cache'] = strip_tags( $new_instance['cache'] );
		$instance['access_token'] = strip_tags( $new_instance['access_token'] );
		$instance['user_id'] = strip_tags( $new_instance['user_id'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'username' => '',
			'limit' => '9',
			'order_by' => 'none',
			'order' => 'ASC',
			'target' => '_blank',
			'cache' => '1',
			'access_token' => '',
			'user_id' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = esc_attr($instance['title']);
		$limit = absint($instance['limit']);
		$order_by = esc_attr($instance['order_by']);
		$order = esc_attr($instance['order']);
		$target = esc_attr($instance['target']);
		$cache = esc_attr($instance['cache']);

		$access_token = $instance['access_token'];
		$user_id = $instance['user_id'];
		$username = $instance['username'];
		$access_token_url = "http://euthemians.com/instagram-feed/";

		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'access_token' ) ); ?>"><?php esc_html_e( 'Access Token:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'access_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token' ) ); ?>" value="<?php echo esc_attr( $access_token ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'user_id' ) ); ?>"><?php esc_html_e( 'User ID:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'user_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'user_id' ) ); ?>" value="<?php echo esc_attr( $user_id ); ?>" style="width:100%;" />
		</p>
		<p>
			<a href="<?php echo esc_url( $access_token_url ); ?>" target="_blank"><?php esc_html_e( 'Get Access Token and User ID', 'crocal-extension' ); ?></a>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" value="<?php echo esc_attr( $username ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php echo esc_html__( 'Number of Images:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" value="<?php echo esc_attr( $limit ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"><?php echo esc_html__( 'Order By:', 'crocal-extension' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('order_by') ); ?>" name="<?php echo esc_attr( $this->get_field_name('order_by') ); ?>" style="width:100%;">
				<option value="none" <?php selected('none', $order_by) ?>><?php esc_html_e( 'None', 'crocal-extension' ); ?></option>
				<option value="datetime" <?php selected('datetime', $order_by) ?>><?php esc_html_e( 'Recent', 'crocal-extension' ); ?></option>
				<option value="likes" <?php selected('likes', $order_by) ?>><?php esc_html_e( 'Likes', 'crocal-extension' ); ?></option>
				<option value="comments" <?php selected('comments', $order_by) ?>><?php esc_html_e( 'Comments', 'crocal-extension' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php echo esc_html__( 'Order:', 'crocal-extension' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('order') ); ?>" name="<?php echo esc_attr( $this->get_field_name('order') ); ?>" style="width:100%;">
				<option value="ASC" <?php selected('ASC', $order) ?>><?php esc_html_e( 'Ascending', 'crocal-extension' ); ?></option>
				<option value="DESC" <?php selected('DESC', $order) ?>><?php esc_html_e( 'Descending', 'crocal-extension' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php echo esc_html__( 'Link Target:', 'crocal-extension' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('target') ); ?>" name="<?php echo esc_attr( $this->get_field_name('target') ); ?>" style="width:100%;">
				<option value="_self" <?php selected('_self', $target) ?>><?php esc_html_e( 'Same Page', 'crocal-extension' ); ?></option>
				<option value="_blank" <?php selected('_blank', $target) ?>><?php esc_html_e( 'New Page', 'crocal-extension' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cache' ) ); ?>"><?php echo esc_html__( 'Caching:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id('cache') ); ?>" name="<?php echo esc_attr( $this->get_field_name('cache') ); ?>" type="checkbox" value="1" <?php checked( $cache, 1 ); ?> />
		</p>
		<p>
			<em><?php echo esc_html__( 'Note: Uncheck caching if you want to test your configuration. It is recommended to leave caching enabled to increase performance. Caching timeout is 60 minutes.', 'crocal-extension' ); ?></em>
		</p>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
