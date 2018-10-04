<?php

function shopnium_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('iconsshopnium', get_stylesheet_directory_uri() . '/assets/js/all.js', array('jquery'), '1.0.0',true);
        wp_enqueue_script('iconsshopnium');

        wp_register_script('customjs', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0.0',true);
        wp_enqueue_script('customjs');




    }
}


add_action('init', 'shopnium_scripts'); // Add Custom Scripts to wp_head

// Ms - Custom post Testimonials
function custom_post_testimonials() {
    $labels = array(
        'name'                => _x( 'Testimonials', 'Post Type General Name', 'uncode' ),
        'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'uncode' ),
        'menu_name'           => __( 'Testimonials', 'uncode' ),
        'parent_item_colon'   => __( 'Testimonials parent:', 'uncode' ),
        'all_items'           => __( 'All Testimonials', 'uncode' ),
        'view_item'           => __( 'View Testimonial', 'uncode' ),
        'add_new_item'        => __( 'Add Testimonial', 'uncode' ),
        'add_new'             => __( 'Add New', 'uncode' ),
        'edit_item'           => __( 'Edit testimonial', 'uncode' ),
        'update_item'         => __( 'Update testimonial', 'uncode' ),
        'search_items'        => __( 'Search testimonial', 'uncode' ),
        'not_found'           => __( 'Not Found', 'uncode' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'uncode' ),
    );


    $args = array(
        'label'               => __( 'testimonials', 'uncode' ),
        'description'         => __( 'Shopmium Testimonials', 'uncode' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'genres' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => false,
        'capability_type'     => 'page',
    );

    register_post_type( 'testimonials', $args );
}

add_action('init','custom_post_testimonials',0);


add_shortcode('testimonials','carousel_testimonials');
function carousel_testimonials(){
    get_template_part('loop','testimonials');
}

?>
