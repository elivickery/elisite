<?php
namespace Building_Blocks;

class Basic_Text extends Block {
	protected function body() {

		echo '<div class="container">';
		echo '<div class="col-xs-12">';

		the_sub_field('text');

		echo '</div>';
		echo '</div>';
	}
}
?>