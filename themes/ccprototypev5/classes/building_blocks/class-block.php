<?php
namespace Building_Blocks;

abstract class Block {
	protected $row;

	public function display($row) {
		$this->row = $row;
		$this->opening_wrapper();
		$this->content();
		$this->closing_wrapper();
		$this->unique_id();
	}

	protected function unique_id() {
		if($id = get_sub_field( 'id' )) {

		} else {
			global $wpdb;
			$meta_key = '_layouts_' . $this->row . '_';
			$meta_id = $wpdb->get_var($wpdb->prepare(
				"
					SELECT meta_id
					FROM $wpdb->postmeta
					WHERE meta_key = %s
				",
				$meta_key
			));
			$id = 'bb-' . $meta_id;
		}
		return $id;
	}
	
	protected function opening_wrapper() {
		$classes	= 'building-block';
		$class_name	= str_replace( 'Building_Blocks\\', '', get_class($this) );
		$class_slug	= \CC\class_to_slug($class_name);

		$classes .= ' bb-' . $class_slug;
		
		$id = $this->unique_id();

		$background = get_sub_field('background',$id);

		echo '<section class="' . $classes;

		if($background) { echo ' highlighted'; }

		echo ' " id="' . $id . '">';


	}
	
	protected function closing_wrapper() {
		echo '</section>';

	}
	
	protected function content() {
		$this->title();
		
		echo '<div class="body block">';

			$this->body();

		echo '</div>';

	}
	
	protected function title() {
		if( $title = get_sub_field('title_text') ) {
			echo '<h2 class="title">' . $title . '</h2>';
		}
	}
	
	protected abstract function body();
}
?>