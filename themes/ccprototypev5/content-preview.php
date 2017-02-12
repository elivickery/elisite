<article <?php post_class('preview'); ?> id="post-<?php the_ID(); ?>">

	<?php 

	if(has_post_thumbnail($post->ID)) {
		echo '<img src="' . get_the_post_thumbnail_url() . '" />';
	}

	?>

	<header>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p><?php the_time('F j, Y'); ?> by <?php the_author(); ?></p>
	</header>

	<?php the_excerpt(); ?>

</article>