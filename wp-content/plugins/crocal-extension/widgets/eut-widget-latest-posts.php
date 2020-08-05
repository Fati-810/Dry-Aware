<?php
/**
 * Euthemians Latest Posts
 * A widget that displays latest posts.
 * @author		Euthemians Team
 * @URI			http://euthemians.com
 */

class Crocal_Ext_Widget_Latest_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'eut-latest-news',
			'description' => esc_html__( 'A widget that displays latest posts', 'crocal-extension'),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'eut-widget-latest-posts',
		);
		parent::__construct( 'eut-widget-latest-posts', '(Euthemians) ' . esc_html__( 'Latest Posts', 'crocal-extension' ), $widget_ops, $control_ops );
	}

	function crocal_ext_widget_latest_posts() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		//Our variables from the widget settings.
		extract( $args );

		$show_image = $instance['show_image'];
		$num_of_posts = $instance['num_of_posts'];
		$categories = crocal_eutf_array_value( $instance, 'categories' );
		if( empty( $num_of_posts ) ) {
			$num_of_posts = 5;
		}

		$post_classes = array( 'eut-post-thumb' );
		if ( '1' != $show_image ) {
			$post_classes[]  = 'eut-without-thumb';
		}
		$post_class_string = implode( ' ', $post_classes );


		echo wp_kses( $before_widget, crocal_ext_get_widget_allowed_html() );

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo wp_kses( $before_title, crocal_ext_get_widget_allowed_html() ) . esc_html( $title ) . wp_kses( $after_title, crocal_ext_get_widget_allowed_html() );
		}

		$args = array(
			'post_type' => 'post',
			'post_status'=>'publish',
			'paged' => 1,
			'cat' => $categories,
			'posts_per_page' => $num_of_posts,
		);
		//Loop posts
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
		?>
			<ul>
		<?php

		$crocal_eutf_empty_image_url = CROCAL_EXT_PLUGIN_DIR_URL .'assets/images/empty/thumbnail.jpg';

		while ( $query->have_posts() ) : $query->the_post();

			$crocal_eutf_link = get_permalink();
			$crocal_eutf_target = '_self';

			if ( 'link' == get_post_format() ) {
				$crocal_eutf_link = get_post_meta( get_the_ID(), '_crocal_eutf_post_link_url', true );
				$new_window = get_post_meta( get_the_ID(), '_crocal_eutf_post_link_new_window', true );
				if( empty( $crocal_eutf_link ) ) {
					$crocal_eutf_link = get_permalink();
				}

				if( !empty( $new_window ) ) {
					$crocal_eutf_target = '_blank';
				}
			}

		?>

				<li <?php post_class(); ?>>
					<a href="<?php echo esc_url( $crocal_eutf_link ); ?>" target="<?php echo esc_attr( $crocal_eutf_target ); ?>" title="<?php the_title_attribute(); ?>" class="<?php echo esc_attr( $post_class_string ); ?>">
						<?php if( $show_image && '1' == $show_image ) { ?>
							<?php if ( has_post_thumbnail() ) { ?>
								<?php crocal_ext_vce_the_post_thumbnail( 'thumbnail' ); ?>
							<?php } else { ?>
								<img width="80" height="80" src="<?php echo esc_url( $crocal_eutf_empty_image_url ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
							<?php } ?>
						<?php } ?>
						<div class="eut-news-content">
							<div class="eut-title"><?php the_title(); ?></div>
							<?php if ( function_exists( 'crocal_eutf_visibility' ) && crocal_eutf_visibility( 'blog_date_visibility', '1' ) ) { ?>
							<div class="eut-latest-news-date"><?php echo esc_html( get_the_date() ); ?></div>
							<?php } ?>
						</div>
					</a>
				</li>

		<?php
		endwhile;
		?>
			</ul>
		<?php
		else :
		?>
				<?php echo esc_html__( 'No Posts Found!', 'crocal-extension' ); ?>
		<?php
		endif;

		wp_reset_postdata();

		echo wp_kses( $after_widget, crocal_ext_get_widget_allowed_html() );
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_of_posts'] = strip_tags( $new_instance['num_of_posts'] );
		$instance['show_image'] = strip_tags( $new_instance['show_image'] );
		$instance['categories'] = implode(',',$new_instance['categories']);

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'num_of_posts' => '5',
			'show_image' => '0',
			'categories' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_of_posts' ) ); ?>"><?php echo esc_html__( 'Number of Posts:', 'crocal-extension' ); ?></label>
			<select  name="<?php echo esc_attr( $this->get_field_name( 'num_of_posts' ) ); ?>" style="width:100%;">
				<?php
				for ( $i = 1; $i <= 20; $i++ ) {
				?>
				    <option value="<?php echo esc_attr( $i ); ?>" <?php selected( $instance['num_of_posts'], $i ); ?>><?php echo esc_html( $i ); ?></option>
				<?php
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>"><?php echo esc_html__( 'Show Featured Image:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id('show_image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_image') ); ?>" type="checkbox" value="1" <?php checked( $instance['show_image'], 1 ); ?> />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php echo esc_html__( 'Categories:', 'crocal-extension' ) ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories' ) ); ?>[]" multiple="multiple" style="width:100%;">
				<option value=""><?php echo esc_html__( 'Choose Categories ...', 'crocal-extension' ) ?></option>
			<?php
				$categories = get_terms( 'category' );
				foreach ( $categories as $category ) {
					$selected = '';
					$cats = explode( ',', $instance['categories'] );
					foreach ( $cats as $cat ) {
						if ( $cat == $category->term_id ){
							$selected = $cat;
							break;
						}
					}
				?>
				<option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $category->term_id  ,$selected ); ?> >
					<?php echo esc_html( $category->name ); ?>
				</option>
			<?php
				}
			?>
			</select>
		</p>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
