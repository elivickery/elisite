<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-lg-8" role="main">
			<?php while ( have_posts() ) { ?>
				<?php the_post(); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			<?php } ?>
		</div>
		<div class="col-xs-12 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>