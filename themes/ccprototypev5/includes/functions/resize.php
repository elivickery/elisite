<?php
namespace CC;

define( 'CC_Resize_Image_Directory', ABSPATH . 'wp-content/uploads/cc_resize' );

/* =Functions
--------------------------------------------------------------- */
function cleanup_thumbnails_on_delete($postid) {
	$filename = wp_get_attachment_metadata($postid);
	$parsed = pathinfo($filename['file']);
	remove_thumbnail($parsed);
}

function cleanup_thumbnails_on_replace($new_guid) {
	$parsed = pathinfo($new_guid);
	remove_thumbnail($parsed);
}

function remove_thumbnail($parsed) {
	$matches = glob( ABSPATH . 'wp-content/uploads/cc_resize/*' );
	
	foreach($matches as $file) {
		if( preg_match('/\/'.$parsed["filename"].'-(\d*?)x(\d*?)/', $file) ) {
			unlink($file);
		}
	}
}

function resize( $url, $args = array() ) {
	$o = new Resize($url, $args);
	return $o->get_resized_image_url();
}

/* =Classes
--------------------------------------------------------------- */
class Resize{
	// Constants
	const IMAGE_DIR = CC_Resize_Image_Directory;
	// Properties
	private
		$source,
		$target,
		$resized,
		$crop,
		$scale,
		$image;

	// Methods
	public function __construct( $url, $args = array() ){
		$this->setup_properties( $url, $args );
		if( isset( $this->resized ) && ! $this->resized_image_exists() ) :
			$this->create_resized_image();
		endif;
	}
	private function setup_properties( $url, $args = array() ){
		$defaults = array(
			'width'   => false,
			'height'  => false,
			'crop'    => true,
			'scale'   => 1,
			'match_ratio' => true
		);
		$args = wp_parse_args( $args, $defaults );

		$this->crop   = $args['crop'  ];
		$this->scale  = $args['scale' ];
		$this->match_ratio = $args['match_ratio'];

		$this->source = array( 'url' => $url );
		$this->image =  wp_get_image_editor( $this->get_source_path() );
		if( ! is_wp_error( $this->image ) ) {
			$this->source = array_merge( $this->source, $this->image->get_size() );
			
			$this->target = array(
				'width'  => $args['width'] * $args['scale'],
				'height' => $args['height'] * $args['scale']
			);

			$this->resized = array(
				'width' => false,
				'height' => false,
			);
		}
	}
	private function resized_image_exists(){
		if( file_exists( $this->get_resized_file_path() ) ) :
			return true;
		else :
			return false;
		endif;
	}
	private function create_resized_image(){
		$image = $this->image;
		if( is_wp_error( $image ) ) :
			trigger_error( 'could not get image editor' );
			return false;
		else :
			$extension = pathinfo( $this->source['url'] );
			if( $extension==='jpg' || $extension==='jpeg' ) {
				$image->set_quality(75);
			}
			$image->resize(
				$this->get_resized_width(),
				$this->get_resized_height(),
				$this->crop
			);
			$image->save( $this->get_resized_file_path() );
		endif;
	}
	private function get_resized_file_path(){
		return self::IMAGE_DIR . '/' . $this->get_resized_file_name();
	}
	private function get_resized_file_name(){
		$source_path_info = pathinfo( $this->source['url'] );
		$file_name = $source_path_info['filename'];
		$file_name .= '-' . $this->get_resized_width();
		$file_name .= 'x' . $this->get_resized_height();
		$file_name .= '.' . $source_path_info['extension'];
		return $file_name;
	}
	private function get_resized_dimensions(){
		$w_ratio = $this->target['width' ] / $this->source['width'];
		$h_ratio = $this->target['height'] / $this->source['height'];
		
		$greater_ratio = ( $w_ratio > $h_ratio ) ? $w_ratio : $h_ratio;
		$lesser_ratio  = ( $h_ratio == $greater_ratio ) ? $w_ratio : $h_ratio;

		if( $this->crop ):
			if( $this->match_ratio && $this->source['width'] < $this->target['width'] ){
				$this->adjust_target( 'width' );
			}
			if( $this->match_ratio && $this->source['height'] < $this->target['height'] ){
				$this->adjust_target( 'height' );
			}
			$d = $this->target;
		else :
			$d = array(
				'width' => $this->source['width'] * $lesser_ratio,
				'height' => $this->source['height'] * $lesser_ratio
			);
		endif;

		$d['width'] = round( $d['width'] );
		$d['height'] = round( $d['height'] );
		$this->resized = array_merge( $this->resized, $d );
		return $d;
	}
	private function adjust_target( $side ){
		$target_start = $this->target[$side];
		$target_final = $this->source[$side];

		$multiplier = $target_final / $target_start;

		$this->target['width'] = $this->target['width'] * $multiplier;
		$this->target['height'] = $this->target['height'] * $multiplier;
	}
	private function get_resized_width(){
		if( ! $this->resized['width'] ):
			$this->get_resized_dimensions();
		endif;
		return $this->resized['width'];
	}
	private function get_resized_height(){
		if( ! $this->resized['height'] ):
			$this->get_resized_dimensions();
		endif;
		return $this->resized['height'];
	}
	private function get_source_path(){
		// if the image is internal, then use the absolute path rather than the url
		if( strpos($this->source['url'], get_bloginfo('url')) === 0 ) {
			return ABSPATH . str_replace(get_bloginfo('url'), '', $this->source['url']);
		}else{
			return $this->source['url'];
		}
	}
	public function get_resized_image_url(){
		$url = '';
		if( isset( $this->resized ) ) {
			$upload_dir = wp_upload_dir();
			$url = $upload_dir['baseurl'] . '/cc_resize/' . $this->get_resized_file_name();
		} else {
			$url = $this->source['url'];
		}

		return set_url_scheme( $url );
	}
}

?>