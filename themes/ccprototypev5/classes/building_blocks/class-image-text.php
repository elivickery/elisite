<?php
namespace Building_Blocks;

class Image_Text extends Block {
	protected $counter;
	protected $alignment;
	
	public function __construct() {
		$this->alignment	= get_sub_field('positioning');
		$this->counter		= 0;
		
		if( $this->alignment === 'even' ) {
			$this->counter++;
		}
	}

	protected function body() {
		$rows = get_sub_field('rows');
		
		foreach($rows as $row) {
			$this->show_row($row);
			$this->counter++;
		}
	}
	
	protected function show_row($row) {
		$background = $row['background'];
		$text	= $row['writing'];
		$text	= $text[0];
		$title	= '<h3 class="sub-title">' . $text['title'] . '</h3>';
		$subtitle = '<p class="sub-sub-title"><em>' . $text['subtitle'] . '</em></p>';
		$body	= $text['text'];
		
		$left_class		= '';
		$right_class	= '';

		if( $this->alignment === 'right') {
			$left_class = 'col-md-push-9';
			$right_class = 'col-md-pull-3';
		}

		echo '<div class="item row';

		if($background) { 
			echo ' highlighted'; 
		}

		echo '">';

		echo '<div class="container">';
		echo '<div class="col-xs-12">';

			echo '<div data-mh="bb-image-text-' . $this->unique_id() . '_' . $this->counter . '" class="image col-sm-12 col-md-3 ' . $left_class . '">';
				if( $image = $row['image'] ) {
					echo '<div class="imagediv" style="background:url(' . $image['url'] . ') no-repeat center center;"></div>';
				}
			echo '</div>';
			echo '<div data-mh="bb-image-text-' . $this->unique_id() . '_' . $this->counter . '" class="text col-sm-12 col-md-9 ' . $right_class . '">';
				echo $title . $subtitle . $body;
			echo '</div>';

		echo '</div>';

		echo '</div>';
		echo '</div>';
	}
}
?>