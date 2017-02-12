<?php
namespace CC;

add_theme_support('post-thumbnails');
add_theme_support('html5', array('search-form', 'comment-form',	'comment-list', 'gallery', 'caption'));

if( !function_exists('wpedev_is_in_development') ) {
	function wpedev_is_in_development() {
		return strpos( get_bloginfo('url'), 'wpengine.com' ) !== false;
	}
}

function enqueue_scripts_styles() {
	$theme_dir	= get_stylesheet_directory_uri();
	$css_dir	= $theme_dir . '/css';
	$js_dir		= $theme_dir . '/js';
	
	wp_register_style('cc-style',				$css_dir .		'/cc-style.css');
	
	wp_register_script('cc-script',				$js_dir .		'/cc-script-dist.js',					array('jquery'),	null,	true);

	wp_register_style('fontawesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	wp_enqueue_style('cc-style');

	wp_enqueue_script('cc-script');

	wp_enqueue_style('fontawesome-css');
}

function localize_data() {
	wp_localize_script('cc-script', 'ajaxURL', admin_url('admin-ajax.php'));
}

function register_main_menu() {
	register_nav_menus( array(
		'main-menu' => 'Main Menu'
	) );
}

function register_theme_sidebar() {
	$sidebar_args = array(
		'name'          =>	__( 'Sidebar' ),
		'id'			=>	'primary-sidebar',
		'description'	=>	'',
		'class'			=>	'',
		'before_widget' =>	'<aside id="%1$s" class="widget %2$s">',
		'after_widget'  =>	'</aside>',
		'before_title'  =>	'<h2 class="widget-title">',
		'after_title'   =>	'</h2>'
	);
	register_sidebar( $sidebar_args );	
}

function register_acf_options_pages() {
	if( function_exists('acf_add_options_page') ) {
		$args = array(
			'page_title'	=> 'Theme Options',
			'menu_slug'		=>	'options-master',
			'position'		=>	'4.1',
			'icon_url'		=>	'dashicons-welcome-view-site'
		);
		$page = acf_add_options_page($args);
		acf_add_options_sub_page( array(
			'title'		=>	'Header',
			'parent'	=>	$page['menu_slug']
		));
		acf_add_options_sub_page( array(
			'title'		=>	'Footer',
			'parent'	=>	$page['menu_slug']
		));
	}
}

function add_acf_custom_menus_link() {
	add_submenu_page('acf-options-header', 'Menus', 'Menus', 'manage_options', 'nav-menus.php');
}

function remove_default_menus_link() {
	remove_submenu_page('themes.php', 'nav-menus.php');
}

function modify_searchbar_text($form) {
	$form = str_replace('Search &hellip;', 'Search', $form);
	return $form;
}

function add_page_slug_to_body_class( $classes ) {
	global $post;
	if ( isset($post) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}

function extra_body_classes($classes) {
	if( is_active_sidebar('primary-sidebar') ) {
		$classes[] = 'has-sidebar';
	}
	return $classes;
}

function prevent_category_checkbox_move($args) {
	$args['checked_ontop'] = false;
	return $args;
}

function remove_default_image_sizes($sizes) {
	unset( $sizes['medium'] );
	unset( $sizes['large'] );

	return $sizes;
}

function wpdocs_excerpt_more( $more ) {
    return ' <a href="' . get_permalink() . '">Read more...</a>';
}


