<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">

	<article itemprop="description articleBody">
		<section>
			<?php the_content(); ?>
		</section>
		<?php CC\building_blocks(); ?>
		<?php edit_post_link('Edit'); ?>
	</article>


	<?php comments_template(); ?>
</article>