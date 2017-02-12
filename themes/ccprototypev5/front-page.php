<?php get_header();
?>

	<div class="row section" id="portfolio">
		<div class="container">

			<h2>What I'm Working On</h2>

			<?php

			$portfolioitems = get_posts('post_type=portfolio&posts_per_page=6');

			if( $portfolioitems ) {
			    
			    foreach ($portfolioitems as $item) {

			    	if(get_the_post_thumbnail($item->ID)) {

				        echo '<div class="item col-xs-12 col-sm-3 col-md-3 col-lg-3 backstretchable" data-bg="' . get_the_post_thumbnail_url($item->ID) . '">';

							echo '<div class="details">';

						        	echo '<p class="title">' . get_the_title($item->ID) . '</p>';

						    echo '</div>';

				        echo '</div>';

				    }

			    }

			}

			?>			

		</div>
	</div>



<?php get_footer(); ?>
