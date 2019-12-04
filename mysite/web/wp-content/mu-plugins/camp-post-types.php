<?php

function camp_post_types() {
	//events post type
  register_post_type('event', array(
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

  //Program
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

  //Activity
    register_post_type('activity', array(
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

}

add_action('init', 'camp_post_types');