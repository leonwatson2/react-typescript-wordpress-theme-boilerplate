<?php

function boilerplate_load_assets() {
  wp_enqueue_script('ourmainjs', get_theme_file_uri('/build/index.js'), array('wp-element'), '1.0', true);
  wp_enqueue_style('ourmaincss', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'boilerplate_load_assets');

function boilerplate_add_support() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}

/* Custom Post Type Start */

function add_episode_post_type() {
	register_post_type( 'Episodes',
	// CPT Options
	
	array(
		'labels' => array(
		 'name' => __( 'Episodes' ),
		 'singular_name' => __( 'Episode' )
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'rewrite' => array('slug' => 'episode'),
		'map_meta_cap' => true
	 )
	);
	}
	// Hooking up our function to theme setup
	add_action( 'init', 'add_episode_post_type' );
	add_filter( 'acf/settings/rest_api_format', function () {
    return 'standard';
} );

//Remove from the Side Menu
add_action( 'admin_menu', 'remove_default_post_type' );
 
function remove_default_post_type() {
	remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  // remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings
}


add_action('after_setup_theme', 'boilerplate_add_support');