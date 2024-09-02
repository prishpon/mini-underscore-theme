<?php
// Register post type News
function drums_news_post_type() {
    $labels = array(
      'name'                  => _x( 'News', 'Post type general name', 'drums' ),
      'singular_name'         => _x( 'News', 'Post type singular name', 'drums' ),
      'menu_name'             => _x( 'News', 'Admin Menu text', 'drums' ),
      'name_admin_bar'        => _x( 'News', 'Add New on Toolbar', 'drums' )
    );
  
    $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true, 
      'rewrite'            => array( 'slug' => 'news' ), 
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 20,
      'supports'           => array(
        'title', 'editor',
        'thumbnail','featured-image', 'excerpt', 'custom-fields'
      ),
      'show_in_rest'       => true,
      'description'        => __('A custom post type for News', 'drums'),
      'taxonomies'         => [ 'category' ],
    );

    register_post_type( 'news', $args );

    register_taxonomy('category', 'news', [
        'label' => __('Category', 'drums'),
        'rewrite' => ['slug' => 'category'],
        'show_in_rest' => true
      ]);
}


add_action( 'init', 'drums_news_post_type' );