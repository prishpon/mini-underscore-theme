<?php
/**
 * Enqueue scripts and styles.
 */

function drums_child_enqueue_styles() {
	wp_enqueue_style( 
		'drums_child-parent-style', 
		get_parent_theme_file_uri( 'style.css' )
	);
    wp_enqueue_script( 
		'drums_child-parent-script', 
		get_parent_theme_file_uri( '/js/navigation.js' )
	);
    wp_enqueue_style(
        'bootstrap_css',
        '//stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css');

}

add_action( 'wp_enqueue_scripts', 'drums_child_enqueue_styles' );

/*
* Adding new image size for cropping Post Thumbnails
*/

  add_image_size('newsThumb', 490, 328, true);

/*
* Reducing length of generated from content excerpt to 20 words
*/  

function drums_child_excerpt_length($length){
    return 20; 
} 
  
add_filter('excerpt_length', 'drums_child_excerpt_length' );


/**
 * Custom post type news declaration
 */
include get_theme_file_path ( '/inc/cpt-news.php' );

/**
 * Function which creates shortcode for displaying news
 */
include get_theme_file_path ( '/inc/shortcode-news.php' );