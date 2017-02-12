<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-lg-12">
			<div class="blogwrap">
			<?php if( !post_password_required($post->ID) ) { ?>
				<?php while ( have_posts() ) { ?>
					<?php the_post(); ?>
					<?php get_template_part('content', 'single'); ?>
				<?php } ?>
			<?php } else { ?>
				<?php echo get_the_password_form(); ?>
			<?php } ?>
			</div>
		</div>

	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>