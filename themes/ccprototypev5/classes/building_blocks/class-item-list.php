<?php
namespace Building_Blocks;

class Item_List extends Block {
	protected function body() {
		$items = get_sub_field('list_items');
		
		foreach($items as $item) {
			$this->show_item($item);
		}
	}
	
	protected function show_item($item) {
		$text	= $item['writing'];
		$text	= $text[0];
		$title	= $text['title'];
		$body	= $text['text'];
		$image	= '';
		
		echo '<div class="item row">';

		echo '<div class="container">';
		echo '<div class="col-xs-12">';

			echo '<div class="col-sm-12 col-md-4 image">';
				if( $image = $item['image'] ) {
					echo '<a rel="building-blocks" class="th" data-featherlight="image" href="' . \CC\resize( $image['url'], array('height' => 1024) ) . '">';
						echo '<img alt="' . $image['alt'] . '" src="' . $image['url'] . '" />';
					echo '</a>';
				}
			echo '</div>';
			echo '<div class="col-sm-12 col-md-8 text">';
				echo '<h3 class="sub-title">' . $title . '</h3>';
				echo $body;
			echo '</div>';
		echo '</div>';

		echo '</div>';
		echo '</div>';
	}
}
?>