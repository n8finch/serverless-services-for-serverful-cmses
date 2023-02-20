<?php

/**
 * Plugin Name: Breaking News Block and Serverless Plugin
 * Plugin URI: https://github.com/n8finch
 * Description: A serverless breaking news implementation.
 * Author: Nate Finch
 * Author URI: https://n8finch.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add in the Breaking News custom post type.
require_once plugin_dir_path( __FILE__ ) . 'post-types/breaking-news-post-type.php';

/**
 * Sends the post content to our breaking news service.
 *
 * @param int $post_id The ID of the post.
 * @param object $post The post object
 * @param bool $update
 * @return void
 */
function send_news_item_to_serverless( $post_id, $post, $update ) {
	$args = wp_json_encode(
		array(
			'eventId' => "$post_id",
			'content' => $post->post_content,
		)
	);

	// Currently, we're not doing anything with this result.
	// This is the POST endpoint you get from your serverless service.
	$result = wp_remote_post(
		// 'https://youre-serverless-endpoint-here.com/endpoint/',
		'https://duuzcix5c2.execute-api.us-east-1.amazonaws.com/breaking-news',
		array(
			'body' => $args,
			'headers' => [
				'Content-Type' => 'application/json',
			],
		)
	);
	if ( is_wp_error( $result ) ) {
		$error_message = $result->get_error_message();
	} else {
		// Could do something.
	}

}
add_action( 'save_post_breaking-news', 'send_news_item_to_serverless', 10, 3 );


/**
 * Enqueue the scripts we need.
 *
 * @return void
 */
function enqueue_breaking_news() {
	wp_enqueue_script( 'breaking-news', plugin_dir_url( __FILE__ ) . '/breaking-news.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_breaking_news' );


/**
 * Filter breaking news content.
 *
 * @param string $content The post type's content.
 * @return string
 */
function filter_breaking_news_content( $content ) {
	if ( is_singular( 'breaking-news' ) ) {
		global $post;
		return '<div data-post-id="' . $post->ID . '" class="breaking-news-container"></div>';
	}

	return $content;
}
add_filter( 'the_content', 'filter_breaking_news_content' );
