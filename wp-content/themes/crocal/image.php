<?php get_header(); ?>
<div id="eut-main-content">
	<div class="eut-container">
		<div id="eut-content-area">
			<?php the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="attachment">
					<a class="eut-image eut-image-popup" href="<?php echo wp_get_attachment_url( $post->ID ); ?>"><?php echo wp_get_attachment_image( $post->ID, 'large' ); ?></a>
					<?php if ( has_excerpt() ) { ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div>
					<?php } ?>
					<div class="eut-pagination">
						<ul>
							<li><?php previous_image_link( false, '<i class="eut-icon-nav-left"></i>') ?></li>
							<li><?php next_image_link( false, '<i class="eut-icon-nav-right"></i>') ?></li>
						</ul>
					</div>
				</div>
			</article>
		</div>
	</div>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
