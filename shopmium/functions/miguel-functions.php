<?php

function shopnium_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('iconsshopnium', get_stylesheet_directory_uri() . '/assets/js/all.js', array('jquery'), '1.0.0',true);
        wp_enqueue_script('iconsshopnium');

        wp_register_script('slickjs', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.0.0',true);
        wp_enqueue_script('slickjs');

        wp_register_script('customjs', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0.0',true);
        wp_enqueue_script('customjs');

    }
}


add_action('init', 'shopnium_scripts'); // Add Custom Scripts to wp_head

function shopmium_styles()
{

	wp_register_style('custommig', get_stylesheet_directory_uri() . '/assets/scss/miguel.css', array(), '1.0', 'all');
	wp_enqueue_style('custommig'); // Enqueue it!

    wp_register_style('slickt', get_stylesheet_directory_uri() . '/assets/scss/slick-theme.css', array(), '1.0', 'all');
    wp_enqueue_style('slickt'); // Enqueue it!

    wp_register_style('slicks', get_stylesheet_directory_uri() . '/assets/scss/slick.css', array(), '1.0', 'all');
    wp_enqueue_style('slicks'); // Enqueue it!

}

add_action('wp_enqueue_scripts', 'shopmium_styles');



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


// Ms - Custom post Downloads
function custom_post_downloads() {
    $labels = array(
        'name'                => _x( 'Downloads', 'Post Type General Name', 'uncode' ),
        'singular_name'       => _x( 'Download', 'Post Type Singular Name', 'uncode' ),
        'menu_name'           => __( 'Downloads', 'uncode' ),
        'parent_item_colon'   => __( 'Download parent:', 'uncode' ),
        'all_items'           => __( 'All Resources', 'uncode' ),
        'view_item'           => __( 'View Resource', 'uncode' ),
        'add_new_item'        => __( 'Add Resource', 'uncode' ),
        'add_new'             => __( 'Add New', 'uncode' ),
        'edit_item'           => __( 'Edit Resource', 'uncode' ),
        'update_item'         => __( 'Update Resource', 'uncode' ),
        'search_items'        => __( 'Search Resource', 'uncode' ),
        'not_found'           => __( 'Not Found', 'uncode' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'uncode' ),
    );


    $args = array(
        'label'               => __( 'downloads', 'uncode' ),
        'description'         => __( 'Shopmium Resource Downloads', 'uncode' ),
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

    register_post_type( 'downloads', $args );
}

add_action('init','custom_post_downloads',0);

// Ms - Custom Taxonomy Downloads

function create_categories_downloads()
{
    $labels = [
        'name'              => _x('Categories', 'taxonomy general name'),
            'singular_name'     => _x('Category', 'taxonomy singular name'),
            'search_items'      => __('Search Category'),
            'all_items'         => __('All Categories'),
            'parent_item'       => __('Parent Category'),
            'parent_item_colon' => __('Parent Category:'),
            'edit_item'         => __('Edit Category'),
            'update_item'       => __('Update Category'),
            'add_new_item'      => __('Add New Category'),
            'new_item_name'     => __('New Category Name'),
            'menu_name'         => __('Categories'),
            ];
            $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'categories'],
];
register_taxonomy('categories', ['downloads'], $args);
}
add_action('init', 'create_categories_downloads');




add_shortcode('testimonials','witness_testimonial');
function witness_testimonial($atts){
    $atts = shortcode_atts(array(
        'type' => ''
    ), $atts);
    $loop = new WP_Query(array(
            'orderby'           => 'menu_order title',
            'order'             => 'ASC',
            'post_type'         => 'testimonials',
            'tax_query'         => array( array(
                'taxonomy'  => 'testimonial_categories',
                'field'     => 'slug',
                'terms'     => array( sanitize_title( $atts['type'] ) )
            ) )
        ) );?>
        <div id="ms-wrapper-testimonials-section">
        	<div id="ms-slider-testimonials">
        			<?php if ( $loop->have_posts() ) :
        					while ( $loop->have_posts() ) : $loop->the_post(); ?>
        					<div id="ms-content-testi">
        						 <?php
        						 $image = get_field('customer_image');
        						 if( !empty($image) ): ?>
        							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="ms-image-customer-testi"/>
        						 <?php endif; ?>
        						 <?php the_field('comment'); ?>
        						 <h4><?php the_title();?> <span> - <?php the_field('customer_position');?></span></h4>
        						 <?php
        							$image_brand = get_field('brand_image');
        							if( !empty($image_brand ) ): ?>
        							 <img src="<?php echo $image_brand ['url']; ?>" alt="<?php echo $image_brand ['alt']; ?>" />
        							<?php endif; ?>
        					</div>
        				 <?php endwhile;
        				 endif;?>
        	</div>
        	 <?php wp_reset_postdata();?>
        </div>
<?php }


add_shortcode('download','download_shopmium_resources');
function download_shopmium_resources($atts){
    $atts = shortcode_atts(array(
        'resource' => ''
    ), $atts);
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $loop = new WP_Query(array(
            'orderby'           => 'menu_order title',
            'order'             => 'ASC',
            'post_type'         => 'downloads',
            'posts_per_page'    => 6,
            'paged'             => $paged,
            'tax_query'         => array( array(
                'taxonomy'  => 'categories',
                'field'     => 'slug',
                'terms'     => array( sanitize_title( $atts['resource'] ) )
            ) )
        ) );?>
        <div class="ms-container-resourced">
           <?php

            if ( $loop->have_posts() ) :
             while ( $loop->have_posts() ) : $loop->the_post();?>
				<div class="ms-wrapper-resourced">
	                <?php $image = get_field('source_download');
	                if( !empty($image) ): ?>
	               	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
	               	<span class="ms-title-downloads"><a href="<?php echo $image['url'] ?>" download><?php the_title(); ?></span>
	                <?php endif;?>
				</div>
             <?php endwhile;
             $total_pages = $loop->max_num_pages;

                 if ($total_pages > 1){

                     $current_page = max(1, get_query_var('paged'));?>
					 <div class="ms-paginator-resources">
	                     <?php
	                     	  echo paginate_links(array(
	                         'base' => get_pagenum_link(1) . '%_%',
	                         'format' => '/page/%#%',
	                         'current' => $current_page,
	                         'total' => $total_pages,
	                         'prev_text'    => __('« prev'),
	                         'next_text'    => __('next »'),
	                     ));?>
					 </div>
                 <?php }
            endif;
            wp_reset_postdata();?>
        </div>
<?php
}

?>
