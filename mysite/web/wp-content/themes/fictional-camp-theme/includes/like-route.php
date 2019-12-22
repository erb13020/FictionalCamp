<?php
add_action('rest_api_init', 'campLikeRoutes');
function campLikeRoutes() {
    register_rest_route('camp/v1', 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'createLike'
    ));
    register_rest_route('camp/v1', 'manageLike', array(
        'methods' => 'DELETE',
        'callback' => 'deleteLike'
    ));
}
function createLike($data) {
    if ( is_user_logged_in() ) {
        $counselor = sanitize_text_field($data['counselorId']);
        $existQuery = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'liked_counselor_id',
                    'compare' => '=',
                    'value' => $counselor
                )
            )
        ));
        if ($existQuery->found_posts == 0 AND get_post_type($counselor) == 'counselor' ) {
            return wp_insert_post(array(
                'post_type' => 'like',
                'post_status' => 'publish',
                'meta_input' => array(
                    'liked_counselor_id' => $counselor
                ),
                'post_title' => get_post_field('post_title', $counselor) . ' User ID# ' . get_current_user_id(),
            ));
        } else {
            die("Invalid counselor id");
        }
    } else {
        die("Please sign in or create an account to like counselors");
    }
}
function deleteLike($data) {
    $likeIdQuery = new WP_Query(array(
        'author' => get_current_user_id(),
        'post_type' => 'like'
    ));
    $likeId = $likeIdQuery->posts[0]->ID;
    if (get_current_user_id() == get_post_field('post_author', $likeId) AND get_post_type($likeId) == 'like') {
        wp_delete_post($likeId, true);
        return 'Congrats, like deleted.';
    } else {
        var_dump($LikeId);
        die("You do not have permission to delete that.");
    }
}