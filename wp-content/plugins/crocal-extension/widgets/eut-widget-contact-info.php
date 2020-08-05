<?php
/**
 * Euthemians Contact Info
 * A widget that displays Contact Info e.g: Address, Phone number.etc.
 * @author		Euthemians Team
 * @URI			http://euthemians.com
 */

class Crocal_Ext_Widget_Contact_Info extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'eut-contact-info',
			'description' => esc_html__( 'A widget that displays contact info', 'crocal-extension' ),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'eut-widget-contact-info',
		);
		parent::__construct( 'eut-widget-contact-info', '(Euthemians) ' . esc_html__( 'Contact Info', 'crocal-extension' ), $widget_ops, $control_ops );
	}

	function crocal_ext_widget_contact_info() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		$crocal_eutf_microdata_allowed_html = crocal_ext_get_microdata_allowed_html();

		//Our variables from the widget settings.
		extract( $args );

		//Our variables from the widget settings.
		$contact_info_name = $instance['name'];
		$contact_info_address = $instance['address'];
		$contact_info_phone = $instance['phone'];
		$contact_info_mobile = $instance['mobile'];
		$contact_info_fax = $instance['fax'];
		$contact_info_mail = $instance['mail'];
		$contact_info_web = $instance['web'];
		$microdata = crocal_eutf_array_value( $instance, 'microdata' );

		echo wp_kses( $before_widget, crocal_ext_get_widget_allowed_html() );

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo wp_kses( $before_title, crocal_ext_get_widget_allowed_html() ) . esc_html( $title ) . wp_kses( $after_title, crocal_ext_get_widget_allowed_html() );
		}

		if ( !empty( $microdata ) ) {
			echo '<div itemscope itemtype="http://schema.org/' . esc_attr( $microdata ) . '">';
		}
		?>

		<ul>

			<?php if ( ! empty( $contact_info_name ) ) { ?>
			<li>
				<i class="fas fa-user"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="eut-info-content" itemprop="name">
				<?php } else { ?>
				<div class="eut-info-content">
				<?php } ?>
					<?php echo esc_html( $contact_info_name ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_address ) ) { ?>
			<li>
				<i class="fas fa-home"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="eut-info-content" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<?php } else { ?>
				<div class="eut-info-content">
				<?php } ?>
					<?php echo wp_kses( $contact_info_address, $crocal_eutf_microdata_allowed_html ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_phone ) ) { ?>
			<li>
				<i class="fas fa-phone"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="eut-info-content" itemprop="telephone">
				<?php } else { ?>
				<div class="eut-info-content">
				<?php } ?>
					<?php echo esc_html( $contact_info_phone ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_mobile ) ) { ?>
			<li>
				<i class="fas fa-mobile"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="eut-info-content" itemprop="telephone">
				<?php } else { ?>
				<div class="eut-info-content">
				<?php } ?>
					<?php echo esc_html( $contact_info_mobile ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_fax ) ) { ?>
			<li>
				<i class="fas fa-fax"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="eut-info-content" itemprop="faxNumber">
				<?php } else { ?>
				<div class="eut-info-content">
				<?php } ?>
					<?php echo esc_html( $contact_info_fax ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_mail ) ) { ?>
			<li>
				<i class="fas fa-envelope"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="eut-info-content" itemprop="email">
				<?php } else { ?>
				<div class="eut-info-content">
				<?php } ?>
					<a href="mailto:<?php echo antispambot( $contact_info_mail ); ?>"><?php echo antispambot( $contact_info_mail ); ?></a>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_web ) ) { ?>
			<li>
				<i class="fas fa-link"></i>
				<div class="eut-info-content">
					<a href="<?php echo esc_url( $contact_info_web ); ?>" target="_blank"><?php echo esc_html( $contact_info_web ); ?></a>
				</div>
			</li>
			<?php } ?>
		</ul>


		<?php

		if ( !empty( $microdata ) ) {
			echo '</div>';
		}

		echo wp_kses( $after_widget, crocal_ext_get_widget_allowed_html() );

	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['mobile'] = strip_tags( $new_instance['mobile'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
		$instance['mail'] = strip_tags( $new_instance['mail'] );
		$instance['web'] = strip_tags( $new_instance['web'] );
		$instance['microdata'] = strip_tags( $new_instance['microdata'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'name' => '',
			'address' => '',
			'phone' => '',
			'mobile' => '',
			'fax' => '',
			'mail' => '',
			'web' => '',
			'microdata' => '',
		);

		$crocal_eutf_microdata_allowed_html = crocal_ext_get_microdata_allowed_html();

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Name:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'crocal-extension' ); ?> <?php esc_html_e( '( Allowed tags: span, br )', 'crocal-extension' ); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" style="width:100%;"><?php echo wp_kses( $instance['address'] , $crocal_eutf_microdata_allowed_html ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" value="<?php echo esc_attr( $instance['phone'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mobile' ) ); ?>"><?php esc_html_e( 'Mobile Phone:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'mobile' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mobile' ) ); ?>" value="<?php echo esc_attr( $instance['mobile'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>"><?php esc_html_e( 'Fax:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fax' ) ); ?>" value="<?php echo esc_attr( $instance['fax'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mail' ) ); ?>"><?php esc_html_e( 'Mail:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'mail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mail' ) ); ?>" value="<?php echo esc_attr( $instance['mail'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'web' ) ); ?>"><?php esc_html_e( 'Website:', 'crocal-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'web' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'web' ) ); ?>" value="<?php echo esc_attr( $instance['web'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'microdata' ) ); ?>"><?php echo esc_html__( 'Microdata ( Schema.org ):', 'crocal-extension' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('microdata') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'microdata' ) ); ?>" style="width:100%;">
				<?php $microdata = $instance['microdata']; ?>
				<option value="" <?php selected( '', $microdata ); ?>><?php echo esc_html__( 'None', 'crocal-extension' ); ?></option>
				<option value="Person" <?php selected( 'Person', $microdata ); ?>><?php esc_html_e( 'Person', 'crocal-extension' ); ?></option>
				<option value="Organization" <?php selected( 'Organization', $microdata ); ?>><?php esc_html_e( 'Organization', 'crocal-extension' ); ?></option>
				<option value="Corporation" <?php selected( 'Corporation', $microdata ); ?>><?php esc_html_e( 'Corporation', 'crocal-extension' ); ?></option>
				<option value="EducationalOrganization" <?php selected( 'EducationalOrganization', $microdata ); ?>><?php esc_html_e( 'School', 'crocal-extension' ); ?></option>
				<option value="GovernmentOrganization" <?php selected( 'GovernmentOrganization', $microdata ); ?>><?php esc_html_e( 'Government', 'crocal-extension' ); ?></option>
				<option value="LocalBusiness" <?php selected( 'LocalBusiness', $microdata ); ?>><?php esc_html_e( 'Local Business', 'crocal-extension' ); ?></option>
				<option value="NGO" <?php selected( 'NGO', $microdata ); ?>><?php esc_html_e( 'NGO', 'crocal-extension' ); ?></option>
				<option value="PerformingGroup" <?php selected( 'PerformingGroup', $microdata ); ?>><?php esc_html_e( 'Performing Group', 'crocal-extension' ); ?></option>
				<option value="SportsTeam" <?php selected( 'SportsTeam', $microdata ); ?>><?php esc_html_e( 'Sports Team', 'crocal-extension' ); ?></option>
			</select>
		</p>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
