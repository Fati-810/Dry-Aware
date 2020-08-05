<?php

/*
*	Layout Helper functions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

/**
 * Function to fetch sidebar class
 */
function crocal_eutf_sidebar_class( $sidebar_view = '' ) {

	$crocal_eutf_sidebar_class = "";
	$crocal_eutf_sidebar_extra_content = false;

	if ( 'search_page' == $sidebar_view ) {
		$crocal_eutf_sidebar_id = crocal_eutf_option( 'search_page_sidebar' );
		$crocal_eutf_sidebar_layout = crocal_eutf_option( 'search_page_layout', 'none' );
	} else if ( 'forum' == $sidebar_view ) {
		$crocal_eutf_sidebar_id = crocal_eutf_option( 'forum_sidebar' );
		$crocal_eutf_sidebar_layout = crocal_eutf_option( 'forum_layout', 'none' );
	} else if ( 'shop' == $sidebar_view ) {
		if ( is_search() ) {
			$crocal_eutf_sidebar_id = crocal_eutf_option( 'product_search_sidebar' );
			$crocal_eutf_sidebar_layout = crocal_eutf_option( 'product_search_layout', 'none' );
		} else if ( is_shop() ) {
			$crocal_eutf_sidebar_id = crocal_eutf_post_meta_shop( '_crocal_eutf_sidebar', crocal_eutf_option( 'page_sidebar' ) );
			$crocal_eutf_sidebar_layout = crocal_eutf_post_meta_shop( '_crocal_eutf_layout', crocal_eutf_option( 'page_layout', 'none' ) );
		} else if( is_product() ) {
			$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'product_sidebar' ) );
			$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'product_layout', 'none' ) );
		} else {
			$crocal_eutf_sidebar_id = crocal_eutf_option( 'product_tax_sidebar' );
			$crocal_eutf_sidebar_layout = crocal_eutf_option( 'product_tax_layout', 'none' );
		}
	} else if ( 'event' == $sidebar_view ) {
		if ( is_singular( 'tribe_events' ) ) {
			$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'event_sidebar' ) );
			$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'event_layout', 'none' ) );
		} else {
			$crocal_eutf_sidebar_id = crocal_eutf_option( 'event_tax_sidebar' );
			$crocal_eutf_sidebar_layout = crocal_eutf_option( 'event_tax_layout', 'none' );
		}
	} else if ( is_singular() ) {
		if ( is_singular( 'post' ) ) {
			$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'post_sidebar' ) );
			$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'post_layout', 'none' ) );
		} else if ( is_singular( 'portfolio' ) ) {
			$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'portfolio_sidebar' ) );
			$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'portfolio_layout', 'none' ) );
			$crocal_eutf_sidebar_extra_content = crocal_eutf_check_portfolio_details();
			if( $crocal_eutf_sidebar_extra_content && 'none' == $crocal_eutf_sidebar_layout ) {
				$crocal_eutf_sidebar_layout = 'right';
			}
		} else {
			$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'page_sidebar' ) );
			$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'page_layout', 'none' ) );
		}
	} else {
		$crocal_eutf_sidebar_id = crocal_eutf_option( 'blog_sidebar' );
		$crocal_eutf_sidebar_layout = crocal_eutf_option( 'blog_layout', 'none' );
	}

	if ( 'none' != $crocal_eutf_sidebar_layout && ( is_active_sidebar( $crocal_eutf_sidebar_id ) || $crocal_eutf_sidebar_extra_content ) ) {

		if ( 'right' == $crocal_eutf_sidebar_layout ) {
			$crocal_eutf_sidebar_class = 'eut-right-sidebar';
		} else if ( 'left' == $crocal_eutf_sidebar_layout ) {
			$crocal_eutf_sidebar_class = 'eut-left-sidebar';
		}

	}

	if( !empty( $crocal_eutf_sidebar_class ) ) {
		global $crocal_eutf_options;
		$crocal_eutf_options['has_sidebar'] = "1";
	}

	$crocal_eutf_sidebar_class = apply_filters( 'crocal_eutf_sidebar_class', $crocal_eutf_sidebar_class, $sidebar_view );

	return $crocal_eutf_sidebar_class;

}


/**
 * Navigation Bar
 */

if ( !function_exists('crocal_eutf_nav_bar') ) {
	function crocal_eutf_nav_bar( $post_type = 'post', $mode = '' ) {

		global $post;

		$has_nav_section = false;
		$next_title = crocal_eutf_option( $post_type . '_nav_next_title');

		if ( 'product' == $post_type ) {
			$eut_in_same_term = crocal_eutf_option( 'product_nav_same_term' );
			if( $eut_in_same_term ) {
				$eut_in_same_term = true;
			} else {
				$eut_in_same_term = false;
			}
			$prev_post = get_adjacent_post( $eut_in_same_term, '', true, 'product_cat');
			$next_post = get_adjacent_post( $eut_in_same_term, '', false, 'product_cat' );

			if ( crocal_eutf_visibility( 'product_nav_visibility', '1' )  && ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) ) {
				$has_nav_section = true;
			}
		} elseif( 'portfolio' == $post_type ) {
			$eut_nav_term = crocal_eutf_option( 'portfolio_nav_term', 'none' );
			if( 'none' != $eut_nav_term ) {
				$eut_in_same_term = true;
			} else {
				$eut_in_same_term = false;
				$eut_nav_term = 'portfolio_category';
			}
			$prev_post = get_adjacent_post( $eut_in_same_term, '', true, $eut_nav_term );
			$next_post = get_adjacent_post( $eut_in_same_term, '', false, $eut_nav_term );

			$first_post = get_posts( 'post_type="portfolio"&numberposts=1&order=ASC' )[0];
			$latest_post = get_posts( 'post_type="portfolio"&numberposts=1' )[0];

			if ( crocal_eutf_visibility( 'portfolio_nav_visibility', '1' )  && ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) ) {
				$has_nav_section = true;
			}
		} elseif( 'event' == $post_type && crocal_eutf_events_calendar_enabled() ) {
			$prev_post = Tribe__Events__Main::instance()->get_closest_event( $post, 'previous' ) ;
			$next_post = Tribe__Events__Main::instance()->get_closest_event( $post, 'next' ) ;
			if ( crocal_eutf_visibility( 'event_nav_visibility', '1' )  && ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) ) {
				$has_nav_section = true;
			}
		}  else {
			$eut_in_same_term = crocal_eutf_visibility( 'post_nav_same_term', '0' );
			$prev_post = get_adjacent_post( $eut_in_same_term, '', true);
			$next_post = get_adjacent_post( $eut_in_same_term, '', false);

			$first_post = get_posts( 'numberposts=1&order=ASC' )[0];
			$latest_post = get_posts( 'numberposts=1' )[0];

			if ( crocal_eutf_visibility( 'post_nav_visibility', '1' )  && ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) ) {
				$has_nav_section = true;
			}
		}


		if ( 'check' == $mode ) {
			return $has_nav_section;
		}

		$eut_backlink = $eut_backlink_url = $eut_backlink_title = '';

		if ( 'event' == $post_type && crocal_eutf_events_calendar_enabled() ) {
			$eut_backlink_url = tribe_get_events_link();
			$eut_backlink_title = tribe_get_event_label_plural();
		} else {
			$eut_backlink = crocal_eutf_post_meta( '_crocal_eutf_backlink_id', crocal_eutf_option( $post_type . '_backlink_id' ) );
			$eut_backlink = apply_filters( 'wpml_object_id', $eut_backlink, 'page', TRUE  );
			if( !empty( $eut_backlink ) ) {
				$eut_backlink_url = get_permalink( $eut_backlink );
			}
		}

		$layout = crocal_eutf_option( $post_type . '_nav_layout', 'layout-1' );

		if ( $has_nav_section ) {
			if ( 'layout-1' == $layout ) {
			?>
				<div id="eut-<?php echo esc_attr( $post_type ); ?>-bar" class="eut-navigation-bar eut-border eut-border-top eut-border-bottom eut-layout-1">
					<div class="eut-container">
						<div class="eut-bar-wrapper eut-align-center">
							<div class="eut-post-bar-item eut-post-navigation">
								<?php if ( is_a( $prev_post, 'WP_Post' ) ) { ?>
								<a class="eut-nav-item eut-prev" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
									<div class="eut-nav-item-wrapper">
										<div class="eut-arrow eut-icon-nav-left"></div>
										<div class="eut-title"><?php echo get_the_title( $prev_post->ID ); ?></div>
									</div>
								</a>
								<?php } ?>
								<?php if ( !empty( $eut_backlink_url ) ) { ?>
								<a class="eut-backlink eut-pullup-icon" href="<?php echo esc_url( $eut_backlink_url ); ?>">
									<svg class="eut-backlink-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 15 15"><g><rect width="6" height="6"/><rect x="9" width="6" height="6"/><rect x="9" y="9" width="6" height="6"/><rect y="9" width="6" height="6"/></g></svg>
								</a>
								<?php } ?>
								<?php if ( is_a( $next_post, 'WP_Post' ) ) { ?>
								<a class="eut-nav-item eut-next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
									<div class="eut-nav-item-wrapper">
										<div class="eut-title"><?php echo get_the_title( $next_post->ID ); ?></div>
										<div class="eut-arrow eut-icon-nav-right"></div>
									</div>
								</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php
			} elseif ( 'layout-2' == $layout ) {
			?>
				<div id="eut-<?php echo esc_attr( $post_type ); ?>-bar" class="eut-navigation-bar eut-padding-top-4x eut-padding-bottom-4x eut-layout-2">
					<div class="eut-container">
						<div class="eut-bar-wrapper">
							<?php
								if ( is_a( $prev_post, 'WP_Post' ) ) {
									crocal_eutf_print_nav_bar_bg_image( $prev_post->ID );
								} else {
									crocal_eutf_print_nav_bar_bg_image( $latest_post->ID );
								}
							?>
							<?php if ( !empty( $eut_backlink_url ) ) { ?>
							<a class="eut-backlink eut-pullup-icon" href="<?php echo esc_url( $eut_backlink_url ); ?>">
								<svg class="eut-backlink-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 15 15"><g><rect width="6" height="6"/><rect x="9" width="6" height="6"/><rect x="9" y="9" width="6" height="6"/><rect y="9" width="6" height="6"/></g></svg>
							</a>
							<?php } ?>
							<?php
								if ( is_a( $next_post, 'WP_Post' ) ) {
									crocal_eutf_print_nav_bar_bg_image( $next_post->ID );
								} else {
									crocal_eutf_print_nav_bar_bg_image( $first_post->ID );
								}
							?>
						</div>
					</div>
				</div>
			<?php
			} elseif ( 'layout-3' == $layout ) {
			?>
				<div id="eut-<?php echo esc_attr( $post_type ); ?>-bar" class="eut-navigation-bar eut-layout-3">
					<div class="eut-container">
						<div class="eut-bar-wrapper eut-padding-top-4x eut-padding-bottom-4x">
							<?php
								if ( is_a( $next_post, 'WP_Post' ) ) {
									crocal_eutf_print_nav_bar_bg_image( $next_post->ID, $next_title  );
								} else {
									crocal_eutf_print_nav_bar_bg_image( $first_post->ID, $next_title  );
								}
							?>
						</div>
					</div>
				</div>
			<?php
			}
		}
	}
}


if ( !function_exists('crocal_eutf_print_nav_bar_bg_image') ) {
	function crocal_eutf_print_nav_bar_bg_image( $post_id, $text = "" ) {
		if ( has_post_thumbnail( $post_id ) ) {
?>
			<a class="eut-nav-item" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
				<div class="eut-nav-item-wrapper">
					<div class="eut-title">
						<?php if ( !empty( $text ) ) { ?>
							<span class="eut-next"><?php echo esc_html( $text ); ?></span>
						<?php } ?>
						<span class="eut-title-inner"><?php echo get_the_title( $post_id ); ?></span>
					</div>
					<div class="eut-background-wrapper">
						<?php
							$image_size = 'crocal-eut-small-rect-horizontal';
							$post_thumbnail_id = get_post_thumbnail_id( $post_id );
							$attachment_src = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
							$image_src = $attachment_src[0];
						?>
						<div class="eut-bg-image" style="background-image: url(<?php echo esc_url( $image_src ); ?>);"></div>
						<div class="eut-bg-overlay"></div>
					</div>
				</div>
			</a>
<?php
		}
	}
}

/**
 * Social Like
 */
 if ( !function_exists('crocal_eutf_social_like') ) {
	function crocal_eutf_social_like( $post_type = 'post', $mode = '') {
		$post_likes = crocal_eutf_option( $post_type . '_social', '', 'eut-likes' );
		if ( !empty( $post_likes  ) ) {
			global $post;
			$post_id = $post->ID;
			if ( 'icon' == $mode ) {
?>
			<div class="eut-like-counter eut-link-text"><i class="fas fa-heart-o"></i><span><?php echo crocal_eutf_likes( $post_id, 'number' ); ?></span></div>
<?php
			} else {
?>
			<li class="eut-like-counter <?php echo crocal_eutf_likes( $post_id, 'status' ); ?>"><span><?php echo crocal_eutf_likes( $post_id ); ?></span></li>
<?php
			}
		}
	}
}

/**
 * Social Bar
 */

if ( !function_exists('crocal_eutf_social_bar') ) {
	function crocal_eutf_social_bar( $post_type = 'post', $mode = 'layout-1', $display = 'icons' ) {

		$has_nav_section = false;

		$eut_socials = crocal_eutf_option( $post_type . '_social');
		if ( is_array( $eut_socials ) ) {
			$eut_socials = array_filter( $eut_socials );
		} else {
			$eut_socials = '';
		}

		if ( !empty( $eut_socials ) ) {
			$has_nav_section = true;
		}

		if ( 'check' == $mode ) {
			return $has_nav_section;
		}

		if ( $has_nav_section ) {
			global $post;
			$post_id = $post->ID;

			$eut_permalink = get_permalink( $post_id );
			$eut_title = get_the_title( $post_id );
			$eut_email = crocal_eutf_option( $post_type . '_social', '', 'email' );
			$eut_facebook = crocal_eutf_option( $post_type . '_social', '', 'facebook' );
			$eut_twitter = crocal_eutf_option( $post_type . '_social', '', 'twitter' );
			$eut_linkedin = crocal_eutf_option( $post_type . '_social', '', 'linkedin' );
			$eut_pinterest= crocal_eutf_option( $post_type . '_social', '', 'pinterest' );
			$eut_reddit = crocal_eutf_option( $post_type . '_social', '', 'reddit' );
			$eut_tumblr = crocal_eutf_option( $post_type . '_social', '', 'tumblr' );
			$eut_likes = crocal_eutf_option( $post_type . '_social', '', 'eut-likes' );
			$eut_email_string = 'mailto:?subject=' . $eut_title . '&body=' . $eut_title . ': ' . $eut_permalink;

			$crocal_eutf_socials_classes = array( 'eut-bar-socials', 'eut-heading-color' );
			$crocal_eutf_socials_classes[] = 'eut-bar-socials-' . $mode;
			$crocal_eutf_socials_classes = implode( ' ', $crocal_eutf_socials_classes );
		?>
			<?php if( 'layout-1' == $mode ) { ?>
				<div id="eut-<?php echo esc_attr( $post_type ); ?>-social-bar" class="eut-social-bar eut-align-center eut-padding-top-2x eut-padding-bottom-2x eut-border">
			<?php } else if( 'layout-2' == $mode ) { ?>
				<div id="eut-<?php echo esc_attr( $post_type ); ?>-social-bar" class="eut-social-bar eut-link-text eut-border">
					<div class="eut-socials-bar-title eut-text-primary-1"><?php echo esc_html__( 'Share', 'crocal' ); ?></div>
			<?php } else { ?>
				<div class="eut-social-bar">
			<?php } ?>
				<ul class="<?php echo esc_attr( $crocal_eutf_socials_classes ); ?>">
					<?php if( 'icons' == $display ) { ?>
						<?php if ( !empty( $eut_email  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_email_string ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-email"><i class="fas fa-envelope"></i></a></li>
						<?php } ?>
						<?php if ( !empty( $eut_facebook  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-facebook"><i class="fab fa-facebook-f"></i></a></li>
						<?php } ?>
						<?php if ( !empty( $eut_twitter  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-twitter"><i class="fab fa-twitter"></i></a></li>
						<?php } ?>
						<?php if ( !empty( $eut_linkedin  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-linkedin"><i class="fab fa-linkedin-in"></i></a></li>
						<?php } ?>
						<?php if ( !empty( $eut_pinterest  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" data-pin-img="<?php echo esc_url( crocal_eutf_get_thumbnail_url() ); ?>" class="eut-social-share-pinterest"><i class="fab fa-pinterest"></i></a></li>
						<?php } ?>
						<?php if ( !empty( $eut_reddit ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-reddit"><i class="fab fa-reddit"></i></a></li>
						<?php } ?>
						<?php if ( !empty( $eut_tumblr ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-tumblr"><i class="fab fa-tumblr"></i></a></li>
						<?php } ?>
						<?php if ( !empty( $eut_likes  ) ) { ?>
						<li><a href="#" class="eut-like-counter-link <?php echo crocal_eutf_likes( $post_id, 'status' ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>"><i class="fas fa-heart"></i><span class="eut-like-counter"><?php echo crocal_eutf_likes( $post_id, 'number' ); ?></span></a></li>
						<?php } ?>
				<?php } else { ?>
						<?php if ( !empty( $eut_email  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_email_string ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-email eut-heading-color eut-text-hover-primary-1">E-mail</a></li>
						<?php } ?>
						<?php if ( !empty( $eut_facebook  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-facebook eut-heading-color eut-text-hover-primary-1">Facebook</a></li>
						<?php } ?>
						<?php if ( !empty( $eut_twitter  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-twitter eut-heading-color eut-text-hover-primary-1">Twitter</a></li>
						<?php } ?>
						<?php if ( !empty( $eut_linkedin  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-linkedin eut-heading-color eut-text-hover-primary-1">Linkedin</a></li>
						<?php } ?>
						<?php if ( !empty( $eut_pinterest  ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" data-pin-img="<?php echo esc_url( crocal_eutf_get_thumbnail_url() ); ?>" class="eut-social-share-pinterest eut-heading-color eut-text-hover-primary-1">Pinterest</a></li>
						<?php } ?>
						<?php if ( !empty( $eut_reddit ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-reddit eut-heading-color eut-text-hover-primary-1">Reddit</a></li>
						<?php } ?>
						<?php if ( !empty( $eut_tumblr ) ) { ?>
						<li><a href="<?php echo esc_url( $eut_permalink ); ?>" title="<?php echo esc_attr( $eut_title ); ?>" class="eut-social-share-tumblr eut-heading-color eut-text-hover-primary-1">Tumblr</a></li>
						<?php } ?>
						<?php if ( !empty( $eut_likes  ) ) { ?>
						<li><a href="#" class="eut-like-counter-link eut-heading-color eut-text-hover-primary-1 <?php echo crocal_eutf_likes( $post_id, 'status' ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>"><i class="fas fa-heart"></i><span class="eut-like-counter"><?php echo crocal_eutf_likes( $post_id, 'number' ); ?></span></a></li>
						<?php } ?>
				<?php } ?>
				</ul>
			</div>
			<!-- End Socials -->
<?php
		}
	}
}



/**
 * Get Thumbnail
 */

if ( !function_exists('crocal_eutf_get_thumbnail_url') ) {
	function crocal_eutf_get_thumbnail_url( $image_size = 'crocal-eutf-small-square' ) {

		if ( has_post_thumbnail() ) {
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$attachment_src = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
			$image_src = $attachment_src[0];
		} else {
			$image_src = get_template_directory_uri() . '/images/empty/' . $image_size . '.jpg';
		}
		return $image_src ;
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
