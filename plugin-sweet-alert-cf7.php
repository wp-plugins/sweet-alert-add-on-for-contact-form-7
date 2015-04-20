<?php
/*
Plugin Name: Sweet Alert add-on for CF7
Description: Add Sweet Alert script in Contact Form 7 submission process.
Version: 0.1
Author: Antoine Derrien
Author URI: http://clublive.fr
*/

function clublive_scripts_method() {
	wp_enqueue_script(
		'sweet-alert-script',
		plugin_dir_url( __FILE__ ) . 'lib/sweet-alert/js/sweet-alert.min.js'
	);
	wp_enqueue_script(
		'sweet-alert-cf7',
		plugin_dir_url( __FILE__ ) . 'js/sweet-alert-cf7.js',
		array('jquery'),
		false,
		true
	);
	wp_enqueue_style(
		'sweet-alert-styles',
		plugin_dir_url( __FILE__ ) . 'lib/sweet-alert/css/sweet-alert.css'
	);
	wp_enqueue_style(
		'alter-cf7',
		plugin_dir_url( __FILE__ ) . 'css/alter-cf7.css'
	);
}
add_action('wp_enqueue_scripts', 'clublive_scripts_method');

