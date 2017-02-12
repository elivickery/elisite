<?php

add_filter('wp_terms_checklist_args',			'CC\prevent_category_checkbox_move');

add_filter('body_class',						'CC\add_page_slug_to_body_class');
add_filter('body_class',						'CC\extra_body_classes');

add_filter('get_search_form',					'CC\modify_searchbar_text');

function wpdocs_excerpt_more( $more ) {
    return ' <a href="' . get_permalink() . '">[Read more...]</a>';
}


add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );





?>
