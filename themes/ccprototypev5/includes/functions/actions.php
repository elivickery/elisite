<?php

add_action('init',									'CC\register_main_menu');
add_action('init',									'CC\register_acf_options_pages');
add_action('init',									'CC\register_theme_sidebar');

add_action('wp_enqueue_scripts',					'CC\enqueue_scripts_styles');
add_action('wp_enqueue_scripts',					'CC\localize_data');

add_action('admin_menu',							'CC\add_acf_custom_menus_link');
add_action('admin_menu',							'CC\remove_default_menus_link', 999);

add_action('delete_attachment',						'CC\cleanup_thumbnails_on_delete');

add_action('enable-media-replace-upload-done',		'CC\cleanup_thumbnails_on_replace');

add_action('intermediate_image_sizes_advanced', 	'CC\remove_default_image_sizes');

// add_filter( 'wp_nav_menu_items', 'your_custom_menu_items', 10, 2 );
// function your_custom_menu_items ( $items, $args ) {
//     if ($args->theme_location == 'main-menu') {
//         $homelink = '<li class="menu-item home"><a href="/""><i class="fa fa-home"></i></a></li>';

//         $items = $homelink . $items;
//     }


//     return $items;
// }


add_action( 'init', 'create_portfolio_tax' );

function create_portfolio_tax() {
	register_taxonomy(
		'portfolio_category',
		'portfolio',
		array(
			'label' => __( 'Portfolio Category' ),
			'rewrite' => array( 'slug' => 'portfolio-category' ),
			'hierarchical' => true,
		)
	);
}


add_action( 'init', 'create_portfolio' );
function create_portfolio() {
  register_post_type( 'portfolio',
    array(
      'labels' => array(
        'name' => __( 'Portfolio Items' ),
        'singular_name' => __( 'Portfolio Item' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'thumbnail','editor','excerpt','title' ),
      'rewrite' => array('slug' => 'portfolio'),
    )
  );
}

?>