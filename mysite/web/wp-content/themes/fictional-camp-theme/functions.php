<?php

add_image_size('thumb', 400, 260, true);

require get_theme_file_path('/includes/like-route.php');
require get_theme_file_path('/includes/search-route.php');

function camp_files() {
  wp_enqueue_script('main-camp-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('camp_main_styles', get_stylesheet_uri());
  wp_localize_script('main-camp-js', 'campData', array(
    'root_url' => get_site_url(),
      'nonce' => wp_create_nonce('wp_rest')
  ));
}

add_action('wp_enqueue_scripts', 'camp_files');

function camp_features() {
  add_theme_support('title-tag');
  add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'camp_features');

function camp_adjust_queries($query) {

  if (!is_admin() AND is_post_type_archive('counselor') AND $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }


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

function camp_custom_rest() {
  //REST API fields go here
  register_rest_field('post', 'authorName', array(
    'get_callback' => function() {return get_the_author();}
  ));
}

add_action('rest_api_init', 'camp_custom_rest');

add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
    $user = wp_get_current_user();

    if ((count($user->roles) == 1) AND $user->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
    $user = wp_get_current_user();

    if (count($user->roles) == 1 AND $user->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}

//Custom Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
    return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'loginStyling');

function loginStyling() {
    wp_enqueue_style('camp_main_styles', get_stylesheet_uri());
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertitle', 'loginTitle');

function loginTitle() {
    return get_bloginfo('name');
}

?>