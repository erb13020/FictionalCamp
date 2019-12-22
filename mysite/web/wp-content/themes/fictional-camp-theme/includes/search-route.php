<?php

add_action('rest_api_init', 'campRegisterSearch');

function campRegisterSearch() {
	register_rest_route('camp/v1', 'search', array(
		'methods' => WP_REST_SERVER::READABLE, //CRUD acronym
		'callback' => 'campSearchResults' //
	)); //namespace, route. array
}

function campSearchResults($data) { //this is what the route returns
	$query = new WP_Query(array(
		'post_type' => array('post', 'page', 'counselor', 'activity', 'event'),
		's' => sanitize_text_field($data['term'])
	));

	$results = array(
		'generalInfo' => array(),
		'counselors' => array(),
		'activities' => array(),
		'events' => array()
	);

	while($query->have_posts()) {
		$query->the_post();

		if (get_post_type() == 'post' or get_post_type() == 'page') {
			array_push($results['generalInfo'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'postType' => get_post_type(),
				'authorName' => get_the_author()
			));
		}

		if (get_post_type() == 'counselor') {

			$image = get_field('counselor_picture');
			$image_data = wp_get_attachment_image_url($image, 'thumb');

			array_push($results['counselors'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'image' => $image_data,
                'id' => get_the_ID()
			));
		}

		if (get_post_type() == 'activity') {

			$image = get_field('activity_picture');
			$image_data = wp_get_attachment_image_url($image, 'thumb');

			array_push($results['activities'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'image' => $image_data
			));
		}

		if (get_post_type() == 'event') {

            $eventDate = new DateTime(get_field('event_date', false, false));

			array_push($results['events'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'month' => $eventDate->format('M'),
				'day' => $eventDate->format('d'),
				'description' => wp_trim_words(get_the_content(), 18)
			));
		}

	}

	if ($results['counselors']) {

	    $counselorMetaQuery = array('relation' => 'OR');

        foreach($results['counselors'] as $item) {
            array_push($counselorMetaQuery, array(
                'key' => 'related_counselors', //Give any counselors
                'compare' => 'LIKE', //Who's activity is
                'value' => '"'.$item['id'].'"'
            ));
        }

        $counselorRelationshipQuery = new WP_Query(array(
            'post_type' => 'activity',
            'meta_query' => $counselorMetaQuery
        ));

        while($counselorRelationshipQuery->have_posts()) {
            $counselorRelationshipQuery->the_post();

            if (get_post_type() == 'activity') {

                $image = get_field('activity_picture');
                $image_data = wp_get_attachment_image_url($image, 'thumb');

                array_push($results['activities'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'image' => $image_data
                ));
            }

        }

        $results['activities'] = array_values(array_unique($results['activities'], SORT_REGULAR));
    }


	return $results;
}

?>