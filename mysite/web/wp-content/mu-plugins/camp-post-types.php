<?php

function camp_post_types() {
	//events post type
  register_post_type('event', array(
      'capability_type' => 'event',
  	'map_meta_cap' => true,
  	'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'events'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    ),
    'menu_icon' => 'dashicons-calendar'
  ));

  //Program post type
    register_post_type('program', array(
  	'supports' => array('title', 'editor'),
    'rewrite' => array('slug' => 'programs'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program'
    ),
    'menu_icon' => 'dashicons-awards'
  ));

  //Activity post type
    register_post_type('activity', array(
        'capability_type' => 'activity',
  	'map_meta_cap' => true,
  	'supports' => array('title', 'editor'),
    'rewrite' => array('slug' => 'activity'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Activities',
      'add_new_item' => 'Add New Activity',
      'edit_item' => 'Edit Activity',
      'all_items' => 'All Activities',
      'singular_name' => 'Activity'
    ),
    'menu_icon' => 'dashicons-universal-access'
  ));

  //Counselors post type
    register_post_type('counselor', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor'),
    'rewrite' => array('slug' => 'counselors'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Counselors',
      'add_new_item' => 'Add New Counselor',
      'edit_item' => 'Edit Counselor',
      'all_items' => 'All Counselors',
      'singular_name' => 'Counselor'
    ),
    'menu_icon' => 'dashicons-buddicons-buddypress-logo'
  ));

    //Like Post Type
    //Counselors post type
    register_post_type('like', array(
        'supports' => array('title'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Likes',
            'add_new_item' => 'Add New Like',
            'edit_item' => 'Edit Like',
            'all_items' => 'All Likes',
            'singular_name' => 'Like'
        ),
        'menu_icon' => 'dashicons-heart'
    ));

    //Slide post type
    register_post_type('slide', array(
        'supports' => array('title'),
        'rewrite' => array('slug' => 'slides'),
        'has_archive' => false,
        'public' => true,
        'labels' => array(
            'name' => 'Slides',
            'add_new_item' => 'Add New Slide',
            'edit_item' => 'Edit Slide',
            'all_items' => 'All Slides',
            'singular_name' => 'Slide'
        ),
        'menu_icon' => 'dashicons-format-video'
    ));

}

add_action('init', 'camp_post_types');