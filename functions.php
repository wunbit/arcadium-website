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

// Add Google Analytics
function ns_google_analytics() { ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-20273659-30"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-20273659-30');
	</script>

  <?php
  }

add_action( 'wp_head', 'ns_google_analytics', 10 );

// Link Featured Image to Post
function wpb_autolink_featured_images( $html, $post_id, $post_image_id ) {

If (! is_singular()) {

$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
return $html;

} else {

return $html;

}

}
add_filter( 'post_thumbnail_html', 'wpb_autolink_featured_images', 10, 3 );
