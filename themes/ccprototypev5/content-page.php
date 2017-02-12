<?php if(get_the_content()) { ?>

<div class="row maincontent">
	<div class="container">
		<div class="col-xs-12">

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/WebPage">
		
		<meta itemprop="datePublished" content="<?php echo get_the_date('Y-m-d'); ?>" />
		<meta itemprop="image" content="<?php wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ) ?>" />
		
		<!-- <header>
			<h1 class="entry-title" itemprop="name headline"><?php the_title(); ?></h1>
		</header> -->



		<section class="entry-content" itemprop="description text">
			
			<section>
				<?php the_content(); ?>
			</section>

		</section>



		</article>

</div>
</div>
</div>
		
<?php } ?>


	
<div class="row buildingblocks">


		<?php CC\building_blocks(); ?>
		
		<div class="container">
		<?php edit_post_link('Edit'); ?>
		</div>

</div>

<?php // comments_template(); ?>
</article>