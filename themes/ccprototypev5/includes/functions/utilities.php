<?php
namespace CC;

function get_page_title() {
	if( is_home() ) {
		$title = get_the_title( get_option('page_for_posts', true) );
	} elseif( is_archive() ) {
		if ( is_day() ) {
			$title = 'Daily Archives: ' . get_the_date();
		} elseif ( is_month() ) {
			$title = 'Monthly Archives: ' . get_the_date('F Y');
		} elseif ( is_year() ) {
			$title = 'Yearly Archives: ' . get_the_date('Y');
		} elseif( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif( is_category() ) {
			$title = single_tag_title( '', false );
		} elseif( is_tax() ) {
			global $wp_query;
			
			$taxonomy	= $wp_query->get_queried_object();
			$title		= $taxonomy->name;
		} elseif( is_post_type_archive() ) {
			$title = post_type_archive_title('', false);
		} else {
			$title = 'Archives';
		}
	} elseif( is_search() ) {
		$title = 'Search Results for "' . get_search_query() . '"';
	} elseif( is_404() ) {
		$title = '404 Error';
	} elseif( is_category() ) {
		$title = single_cat_title( '', false );
	} else {
		$title = get_the_title();
	}
	
	return $title;
}