<?php
require_once ( get_stylesheet_directory() . '/functions/robin-functions.php' );
require_once ( get_stylesheet_directory() . '/functions/miguel-functions.php' );
add_action('after_setup_theme', 'uncode_language_setup');
function uncode_language_setup()
{
	load_child_theme_textdomain('uncode', get_stylesheet_directory() . '/languages');
}
function theme_enqueue_styles()
{
	$production_mode = ot_get_option('_uncode_production');
	$resources_version = ($production_mode === 'on') ? null : rand();
	$parent_style = 'uncode-style';
	$child_style = array('uncode-custom-style');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/library/css/style.css', array(), $resources_version);
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', $child_style, $resources_version);
	wp_enqueue_style('rp-styles', get_stylesheet_directory_uri() . '/dist/css/app.css', $child_style, $resources_version);
	wp_enqueue_style('ms-styles', get_stylesheet_directory_uri() . '/dist/css/miguel.css', $child_style, $resources_version);
	wp_enqueue_style('slickT', get_stylesheet_directory_uri() . '/dist/css/slick-theme.css', $child_style, $resources_version);
	wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/dist/css/slick.css', $child_style, $resources_version);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
	function footer_services_menu(){
		wp_nav_menu([
		'theme_location'  => 'footer-services',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		 ]);
	}
		function footer_aboutus_menu(){
			wp_nav_menu([
			'theme_location'  => 'footer-aboutus-menu',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => 'menu-{menu slug}-container',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul>%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
			 ]);
		}
		function footer_blog_menu(){
			wp_nav_menu([
			'theme_location'  => 'footer-blog-menu',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => 'menu-{menu slug}-container',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul>%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
			 ]);
		}
	function register_shopmium_menus()
{
	register_nav_menus(array( // Using array to specify more menus if needed
		'footer-services' => __('Footer Services', 'uncode'), // Main Navigation
		'footer-aboutus-menu' => __('Footer About Us', 'uncode'), // Main Navigation
		'footer-blog-menu' => __('Footer Blog', 'uncode'), // Main Navigation
	));
}
 add_action('init', 'register_shopmium_menus');
