<?php
/*
Template Name: Content Only
*/
?>
<?php get_header( 'basic' ); ?>

<?php the_post(); ?>
		<!-- CONTENT -->
		<div id="eut-content" class="clearfix">
			<div class="eut-content-wrapper">
				<!-- MAIN CONTENT -->
				<div id="eut-main-content">
					<div class="eut-main-content-wrapper clearfix">

						<!-- PAGE CONTENT -->
						<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>							
						</div>
						<!-- END PAGE CONTENT -->

					</div>
				</div>
				<!-- END MAIN CONTENT -->
			</div>
		</div>
		<!-- END CONTENT -->

<?php get_footer( 'basic' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
