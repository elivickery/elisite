<?php
namespace Building_Blocks;

class Multicolumns extends Block {
	protected function body() {
		$columns		= get_sub_field('columns');
		$num_columns	= count($columns);
		$count			= 1;
		$column_width	= 12 / $num_columns;
		
		echo '<div class="container">';

			foreach($columns as $column) {
				$classes = sprintf('multicolumn col-sm-12 col-md-%s', $column_width, $count);
				
				if( $count === $num_columns ) {
					$classes .= ' last';
				}
				
				echo '<div class="' . $classes . '">';
					echo $column['column_text'];
				echo '</div>';
				
				$count++;
			}

		echo '</div>';

	}
}
?>