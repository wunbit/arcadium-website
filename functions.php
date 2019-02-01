<?php

add_action( 'wp_enqueue_scripts', 'crypterio_child_enqueue_parent_styles');

function crypterio_child_enqueue_parent_styles() {

	wp_enqueue_style( 'crypterio-style', get_template_directory_uri() . '/style.css', array( 'bootstrap' ), CRYPTERIO_THEME_VERSION, 'all' );
	wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'crypterio-layout' ), CRYPTERIO_THEME_VERSION, 'all' );

}

// Remove WP Bakery Page Builder meta generator
add_action('wp_head', 'myoverride', 1);
function myoverride() {
  if ( class_exists( 'Vc_Manager' ) ) {
    remove_action('wp_head', array(visual_composer(), 'addMetaData'));
  }
}