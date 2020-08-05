<?php
	if ( post_password_required() ) {
?>
		<div class="help">
			<p class="no-comments"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'crocal' ); ?></p>
		</div>
<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>

	<!-- Comments -->
	<div id="eut-comments" class="eut-container eut-padding-top-3x eut-padding-bottom-2x eut-border">
		<div class="eut-comments-header eut-margin-bottom-1x eut-align-center">
			<h6 class="eut-comments-number eut-h5">
			<?php comments_number(); ?>
			</h6>
			<nav class="eut-comment-nav eut-link-text eut-heading-color">
				<ul>
			  		<li><?php previous_comments_link(); ?></li>
			  		<li><?php next_comments_link(); ?></li>
			 	</ul>
			</nav>
		</div>
		<ul class="eut-comments-list">
		<?php
			wp_list_comments( array(
				'callback'       => 'crocal_eutf_comments',
				'short_ping'  => true,
			) );
		?>
		</ul>
	</div>
	<!-- End Comments -->

<?php endif; ?>


<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<div id="eut-no-comments">
		<div class="eut-container eut-padding-bottom-2x">
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'crocal' ); ?></p>
		</div>
	</div>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );

		$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'eut-comment-submit-button',
			'title_reply'       => esc_html__( 'Leave a Reply', 'crocal' ),
			'title_reply_to'    => esc_html__( 'Leave a Reply to', 'crocal' ) . ' %s',
			'cancel_reply_link' => esc_html__( 'Cancel Reply', 'crocal' ),
			'label_submit'      => esc_html__( 'Submit Comment', 'crocal' ),
			'submit_button'     => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',

			'comment_field' =>
				'<div class="eut-form-textarea eut-border">'.
				'<textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Your Comment Here...', 'crocal' ) . '" cols="45" rows="15" aria-required="true">' .
				'</textarea></div>',

			'must_log_in' =>
				'<p class="must-log-in">' . esc_html__( 'You must be', 'crocal' ) .
				'<a href="' .  wp_login_url( get_permalink() ) . '">' . esc_html__( 'logged in', 'crocal' ) . '</a> ' . esc_html__( 'to post a comment.', 'crocal' ) . '</p>',

			'logged_in_as' =>
				'<div class="logged-in-as eut-small-text">' .  esc_html__('Logged in as','crocal') .
				'<a class="eut-text-content eut-text-hover-primary-1" href="' . esc_url( admin_url( 'profile.php' ) ) . '"> ' . $user_identity . '</a>. ' .
				'<a class="eut-text-content eut-text-hover-primary-1" href="' . wp_logout_url( get_permalink() ) . '" title="' . esc_attr__( 'Log out of this account', 'crocal' ) . '"> ' . esc_html__( 'Log out', 'crocal' ) . '</a></div>',

			'comment_notes_before' => '',
			'comment_notes_after' => '' ,

			'fields' => apply_filters(
				'comment_form_default_fields',
				array(
					'author' =>
						'<div class="eut-form-input eut-half-size eut-border">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' .
						' placeholder="' . esc_attr__( 'Name', 'crocal' ) . ' ' . ( $req ? esc_attr__( '(required)', 'crocal' ) : '' ) . '" />' .
						'</div>',

					'email' =>
						'<div class="eut-form-input eut-half-size eut-border">' .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' .
						' placeholder="' . esc_attr__( 'E-mail', 'crocal' ) . ' ' . ( $req ? esc_attr__( '(required)', 'crocal' ) : '' ) . '" />' .
						'</div>',

					'url' =>
						'<div class="eut-form-input eut-border">' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"' .
						' placeholder="' . esc_attr__( 'Website', 'crocal' )  . '" />' .
						'</div>',
					)
				),
		);
?>
		<div id="eut-comment-form" class="eut-align-center eut-padding-top-1x eut-padding-bottom-2x">
			<div class="eut-container">
			<?php
				//Use comment_form() with no parameters if you want the default form instead.
				comment_form( $args );
			?>
			</div>
		</div>


<?php endif;

//Omit closing PHP tag to avoid accidental whitespace output errors.