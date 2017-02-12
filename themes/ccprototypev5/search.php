<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-lg-8">
			<header>
				<h1 class="entry-title">Search Results for "<?php echo get_search_query();  ?>"</h1>
			</header>

			<?php if ( have_posts() ) { ?>
				<?php while ( have_posts() ) { ?>
					<?php the_post(); ?>
					<?php get_template_part('content', 'preview'); ?>
				<?php } ?>
			<?php } ?>

			<nav id="pagination" role="navigation" aria-label="Paginated Links">
				<?php wp_pagenavi(); ?>
			</nav>
		</div>

		<div class="col-xs-12 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>