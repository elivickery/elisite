<?php
namespace CC;

function building_blocks() {
	if( have_rows('layouts') ) {
		spl_autoload_register('CC\autoloader');
		$i = 0;
		while( have_rows('layouts') ) {
			the_row();
			$layout = get_row_layout();
			$layout = bb_acf_to_class($layout);
			$block = new $layout();
			$block->display($i);
			$i++;
		}
	}
}

function bb_acf_to_class($field) {
	$blocks_key = array(
		'Block'					=>	'Block',
		'basic_text'			=>	'Basic_Text',
		'multicolumn_text'		=>	'Multicolumns',
		'image_text'			=>	'Image_Text',
		'list'					=>	'Item_List',
		'image_gallery'			=>	'Gallery',
		'button'				=>	'Button'
	);
	
	return 'Building_Blocks\\' . $blocks_key[$field];
}

function class_to_slug($class) {
	$slug = str_replace('_', '-', $class);
	$slug = strtolower($slug);
	
	return $slug;
}

function autoloader($class_name) {
	if( strpos($class_name, 'Building_Blocks') !== FALSE ) {
		$class_name = str_replace('Building_Blocks\\', '', $class_name);
		$class_slug = class_to_slug($class_name);
		$file_name = TEMPLATEPATH . '/classes/building_blocks/class-' . $class_slug . '.php';
		include_once($file_name);
	}
}

?>