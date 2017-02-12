<?php // Template Name: Full-Width ?>

<?php get_header(); ?>


			<?php if( !post_password_required($post->ID) ) { ?>
				<?php while ( have_posts() ) {  ?>
					<?php the_post(); ?>
					<?php get_template_part('content', 'page'); ?>
				<?php } ?>
			<?php } else { ?>
				<?php echo get_the_password_form(); ?>
			<?php } ?>
		

<?php get_footer(); ?>