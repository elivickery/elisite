<?php
namespace Building_Blocks;

class Button extends Block {
	public function __construct() {
	
	}

	protected function body() {

		echo '<div class="container">';
		echo '<div class="col-xs-12">';

		$text = get_sub_field('text');
		$link = '';
		
		if( $post = get_sub_field('link') ) {
			$link .= get_the_permalink( $post->ID );
		}
		
		$classes = 'button';
		
		echo '<a class="' . $classes . '" href="' . $link . '">';
			echo $text;
		echo '</a>';

		echo '</div>';
		echo '</div>';
		
	}
}
?>