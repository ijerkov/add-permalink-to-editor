<?php

/**
 * Plugin Name: Add Permalink to Post Editor Header
 * Description: Adds a permalink to the post editor header toolbar in the WordPress Gutenberg editor.
 * Author: Ivo Jerkovic
 * Author URI: https://twitter.com/ijerkov
 * Version: 1.0.0
 */

// Add Permalink to Post Editor Header
function add_permalink_to_post_editor_header() {
	global $post, $pagenow;

	if ( is_admin() && $pagenow === 'post.php' && isset( $post )) {
		// Register the script with WordPress and set its dependencies
		wp_register_script(
			'add-permalink-to-editor',
			plugin_dir_url( __FILE__ ) . 'add-permalink-to-editor.js',
			array( 'wp-dom-ready', 'wp-data' ),
			false,
			true
		);

		// Pass the permalink value to the JavaScript file
		wp_localize_script(
			'add-permalink-to-editor',
			'addPermalinkData',
			array( 'permalink' => get_permalink( $post->ID ) )
		);

		// Enqueue the script
		wp_enqueue_script( 'add-permalink-to-editor' );
	}
}

add_action( 'admin_enqueue_scripts', 'add_permalink_to_post_editor_header' );
