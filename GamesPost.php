<?php

/*
Plugin Name: Games Post
Version: 1.0
Author: Tomasz Remlein
*/


function custom_games_post_type()
{
    $labels = array(
        'name' => 'Games',
        'singular_name' => 'Game',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('games', $args);
}

add_action('init', 'custom_games_post_type');

function custom_games_taxonomy()
{
    $labels = array(
        'name' => 'Tags',
        'singular_name' => 'Tag',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => false,
    );

    register_taxonomy('tags', 'games', $args);
}

add_action('init', 'custom_games_taxonomy');


function send_request_on_post_save($post_id)
{
    $post_type = get_post_type($post_id);

    if ('games' === $post_type) {
        $post = get_post($post_id);
        $tags = get_the_terms($post_id, 'tags');
        $tag_names = array();

        if ($tags && !is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $tag_names[] = $tag->name;
            }
        }

        $data = array(
            'id' => $post_id,
            'tags' => implode(', ', $tag_names),
            'name' => 'Tomasz Remlein',
        );

        $request_url = 'https://chat.webixa.pl/hooks/648b22e27574ae12c40d683d/QXhPWw27My93Tsk7apXwBh2ucSYjKwmrAbBZESh4ZkroTttC';

        wp_remote_post($request_url, array(
            'body' => json_encode($data),
            'headers' => array('Content-Type' => 'application/json'),
        ));
    }
}

add_action('save_post', 'send_request_on_post_save');

