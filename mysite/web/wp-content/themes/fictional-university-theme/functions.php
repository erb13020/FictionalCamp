<?php

function camp_files() {
  wp_enqueue_script('main-camp-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('camp_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'camp_files');

function camp_features() {
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'camp_features');

function camp_adjust_queries($query) {

  if (!is_admin() AND is_post_type_archive('activity') AND $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

	if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array (
              array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => date('Ymd'),
                'type' => 'numeric'
              )
            )
		);
	}
}

add_action ('pre_get_posts', 'camp_adjust_queries');

?>