<?php
namespace Building_Blocks;

class Gallery extends Block {
	protected $image_size;
	
	public function __construct() {
		$this->image_size = get_sub_field('image_size');
	}

	protected function body() {
		$gallery_images = get_sub_field('images');
		$i = 1;

		switch ($this->image_size) {
			case 'small':
				$gallery = array(
					'aspect_ratio'		=>	1,
					'small_row_items'	=>	12,
					'medium_row_items'	=>	6,
					'large_row_items'	=>	3,
				);
				break;
			case 'large':
				$gallery = array(
					'aspect_ratio'		=>	1,
					'small_row_items'	=>	12,
					'medium_row_items'	=>	12,
					'large_row_items'	=>	6,
				);
				break;
			//medium is default
			default:
				$gallery = array(
					'aspect_ratio'		=>	1,
					'small_row_items'	=>	12,
					'medium_row_items'	=>	6,
					'large_row_items'	=>	4,
				);
				break;
		}
		$width		= 1200 / $gallery['large_row_items'];
		$height		= $width * $gallery['aspect_ratio'];
		$img_sizes	= array(
			'full'		=> array('height' => 1024),
			'lowres'	=> array('width' => $width, 'height' => $height),
			'highres'	=> array('width'=> $width * 2, 'height' => $height * 2),
			'preload'	=> array('width' => $width * 0.5, 'height' => $height * 0.5)
		);
		
		echo '<div class="container">';

		echo '<div class="row">';

		foreach($gallery_images as $image) {	
			echo '<div class="image-' . $i . ' col-sm-12 col-md-' . $gallery['medium_row_items'] . ' col-lg-' . $gallery['large_row_items'] . '">';	
				echo '<a class="th" rel="building-blocks" data-featherlight="image" href="' . \CC\resize($image['url'], $img_sizes['full']) . '">';
					echo '<img alt="' . $image['alt'] . '" src="' . $image['url'] . '" />';
				echo '</a>';
			echo '</div>';

			if($i % 4 == 0) {
				echo '</div><div class="row">';
			}

			$i++;
		}

		echo '</div>';

		echo '</div>';

	}
}
?>