<?php
/**
 * Euthemians Latest Portfolio
 * A widget that displays latest portfolio.
 * @author		Euthemians Team
 * @URI			http://euthemians.com
 */

class Crocal_Ext_Widget_Latest_Portfolio extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'eut-latest-portfolio',
			'description' => esc_html__( 'A widget that displays latest portfolio items.', 'crocal-extension' ),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 350,
			'id_base' => 'eut-widget-latest-portfolio',
		);
		parent::__construct( 'eut-widget-latest-portfolio', '(Euthemians) ' . esc_html__( 'Latest Portfolio', 'crocal-extension' ), $widget_ops, $control_ops );
	}

	function crocal_ext_widget_latest_portfolio() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		//Our variables from the widget settings.
		extract( $args );

		$categories = $instance['categories'];
		$num_of_posts = $instance['num_of_posts'];
		if ( empty( $num_of_posts ) ) {
			$num_of_posts = 5;
		}

		echo wp_kses( $before_widget, crocal_ext_get_widget_allowed_html() );

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo wp_kses( $before_title, crocal_ext_get_widget_allowed_html() ) . esc_html( $title ) . wp_kses( $after_title, crocal_ext_get_widget_allowed_html() );
		}

		$portfolio_cat = "";
		if( ! empty( $categories ) ) {
			$portfolio_category_list = explode( ",", $categories );
			foreach ( $portfolio_category_list as $category_list ) {
				$category_term = get_term( $category_list, 'portfolio_category' );
				if ( isset( $category_term ) ) {
					$portfolio_cat = $portfolio_cat . $category_term->slug . ', ';
				}
			}
		}
		$args = array(
			'post_type' => 'portfolio',
			'post_status'=>'publish',
			'paged' => 1,
			'portfolio_category' => $portfolio_cat,
			'posts_per_page' => $num_of_posts,
		);

		$query = new WP_Query( $args );
		//Loop portfolio

		if ( $query->have_posts() ) :
		?>
			<ul>
		<?php

		$eut_empty_image_url = CROCAL_EXT_PLUGIN_DIR_URL .'assets/images/empty/thumbnail.jpg';

		while ( $query->have_posts() ) : $query->the_post();

		?>
				<li>
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="eut-bg-wrapper eut-small-square">
								<?php crocal_ext_print_post_bg_image( 'thumbnail' ); ?>
							</div>
							<?php crocal_ext_vce_the_post_thumbnail( 'thumbnail' ); ?>
						<?php } else { ?>
							<img width="80" height="80" src="<?php echo esc_url( $eut_empty_image_url ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
						<?php } ?>
					</a>
				</li>

		<?php
		endwhile;
		?>
			</ul>
		<?php

		else :
		?>

			<?php echo esc_html__( 'No Portfolio Items Found!', 'crocal-extension' ); ?>

		<?php
		endif;
		wp_reset_postdata();

		echo wp_kses( $after_widget, crocal_ext_get_widget_allowed_html() );
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = implode(',',$new_instance['categories']);
		$instance['num_of_posts'] = strip_tags( $new_instance['num_of_posts'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'categories' => '',
			'num_of_posts' => '4',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_of_posts' ) ); ?>"><?php echo esc_html__( 'Number of Portfolio Items:', 'crocal-extension' ); ?></label>
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php echo esc_html__( 'Categories:', 'crocal-extension' ) ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories' ) ); ?>[]" multiple="multiple" style="width:100%;">
				<option value=""><?php echo esc_html__( 'Choose Categories ...', 'crocal-extension' ) ?></option>
			<?php
				$categories = get_terms( 'portfolio_category' );
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
