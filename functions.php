<?php
/*
	* Page Name: 		functions.php
	* Version:			1.0.0
*/
// Functions //



/* -------------- theme support -------------- */
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
load_theme_textdomain('mp', get_template_directory() . '/languages');
add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'image', 'video'));

/* --------------Post Thumbnails Add-------------- */

add_theme_support('post-thumbnails');
set_post_thumbnail_size(600, 337, true);
add_image_size('single-thumbnail', 600, 337, true);


// // register menu  
// function register_my_menus()
// {
//     register_nav_menus(
//         array(
//             'header-menu' => __('Header Menu'),
//             'footer-menu-1' => __('Footer Menu 1'),
//             'footer-menu-2' => __('Footer Menu 2'),
//             // Add more menus here
//         )
//     );
// }
// add_action('after_setup_theme', 'register_my_menus');






// function mytheme_enqueue_scripts()
// {
//     // Enqueue CSS files
//     wp_enqueue_style('theme', get_template_directory_uri() . '/assets/css/theme.min.css');
//     wp_enqueue_style('basic', get_template_directory_uri() . '/assets/css/basic.min.css');
//     wp_enqueue_style('nav', get_template_directory_uri() . '/assets/css/nav.min.css');
//     wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
//     wp_enqueue_style('custom', get_template_directory_uri() . '/assets/css/custom-css.css');

//     // Enqueue JavaScript files
//     wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '5.1.0', true);
//     wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '5.1.0', true);
//     wp_enqueue_script('basic', get_template_directory_uri() . '/assets/js/basic.min.js', array(), '1.0.0', true);
//     wp_enqueue_script('range', get_template_directory_uri() . '/assets/js/range.min.js', array(), '1.0.0', true);
//     wp_enqueue_script('nav', get_template_directory_uri() . '/assets/js/nav.min.js', array(), '1.0.0', true);
//     wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0.0', true);
//     wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '1.0.0', true);
//     wp_enqueue_script('sweetalert', get_template_directory_uri() . '/assets/js/sweetalert.min.js', array(), '1.0.0', true);
// }

// add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');


// woocommerce support 

function customtheme_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'customtheme_add_woocommerce_support');



//custom post types
require_once('functions/custom.php'); 
require_once('functions/custom-widgets.php'); 
require_once('functions/admin-dashboard-menu.php'); 
require_once('functions/metabox.php');
require_once('functions/ajax-actions.php');
require_once('functions/create-database.php');
require_once('functions/woocommerce-functions.php');
require_once('functions/woocommerce-functions-kamrul.php');



add_action('admin_enqueue_scripts', 'my_admin_enqueue_styles');
function my_admin_enqueue_styles()
{
	// Get the current theme
	$theme = wp_get_theme();

	// Enqueue custom JavaScript
	wp_enqueue_script(
		'scripts-js',
		get_stylesheet_directory_uri() . '/functions/scripts.js',
		array('jquery'),
		$theme->get('Version'),
		true
	);

	// Localize script with ajax_url
	wp_localize_script('scripts-js', 'variables', [
		'ajax_url' => admin_url('admin-ajax.php'),
	]);


	// Enqueue Select2 styles
	wp_enqueue_style(
		'select2-css',
		'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
	);

	// Enqueue Select2 script
	wp_enqueue_script(
		'select2-js',
		'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
		array('jquery'),
		$theme->get('Version'),
		true
	);
}


// require_once('functions/add-image-taxonomy.php');


// Framework //
require_once('lib/framework/ReduxCore/framework.php');
require_once('lib/framework/sample/config.php');

//cmb2
include('metabox/init.php');
include('metabox/functions.php');

add_theme_support('title-tags');



