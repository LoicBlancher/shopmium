<?php

function shopnium_scripts()
{
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

		wp_register_script('slickjs', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.0.0',true);
		wp_enqueue_script('slickjs');

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


//
//
add_shortcode('testimonials','witness_testimonial');

ob_start();

function witness_testimonial($atts){
		$atts = shortcode_atts(array(
				'type' => ''
		), $atts, 'testimonials');

		set_query_var('testimony_type', $atts['type']);
		switch ($atts['type']) {
			case 'witness':
					$loop = new WP_Query(array(
								'orderby'           => 'menu_order title',
								'order'             => 'ASC',
								'post_type'         => 'testimonials',
								'tax_query'         => array( array(
										'taxonomy'  => 'testimonial_categories',
										'field'     => 'slug',
										'terms'     => array( sanitize_title( $atts['type'] ) )
								) )
						)); ?>
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
											 <p class="ms-quotation-testi">&#x0201C;</p>
											 <p class="ms-comment-testi"><?php the_field('comment'); ?></p>
											 <p class="ms-quotation-testi" id="ms-quotation-close">&#x0201C;</p>
											 <h5><?php the_title();?> <span> - <?php the_field('customer_position');?></span></h5>
											 <?php
												$image_brand = get_field('brand_image');
												if( !empty($image_brand ) ): ?>
												 <img src="<?php echo $image_brand ['url']; ?>" alt="<?php echo $image_brand ['alt']; ?>" class="ms-img-brand-testi"/>
												<?php endif; ?>
										</div>
									 <?php endwhile;
									 endif;?>
						</div>
						 <?php wp_reset_postdata();?>
					</div>
				<?php
				return ob_get_clean();
				break;

			case 'media':
				get_template_part('template-parts/testimonials', 'media');
				break;

			default: '';
				break;
		}
}


add_shortcode('download','download_shopmium_resources');
ob_start();

function download_shopmium_resources($atts){
	$atts = shortcode_atts(array(
		'resource' => ''
	), $atts);
	$loop = new WP_Query(array(
			'post_type'         => 'downloads',
			'posts_per_page'    => '6',
			'tax_query'         => array( array(
				'taxonomy'  => 'categories',
				'field'     => 'slug',
				'terms'     => array( sanitize_title( $atts['resource'] ) )
			) )
		) );?>
		<div id="ms-wrapper-resources">
			<ul id="ms-resources-list">
			<?php
				if ( $loop->have_posts() ) :
				 while ( $loop->have_posts() ) : $loop->the_post();?>
					<li id="post-<?php the_ID(); ?>"<?php post_class('resource'); ?>>
							<?php $image = get_field('source_download');
							if( !empty($image) ): ?>
								<a href="<?php echo $image['url'] ?>" download>
								 <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
								 <span class="ms-title-downloads"><?php the_title(); ?></span>
								</a>
							<?php endif;?>
					</li>
				 <?php endwhile;
				endif;
				wp_reset_postdata();?>
			</ul>
		</div>
		<a class="load_more" data-nonce="<?php echo wp_create_nonce('load_posts') ?>" href="javascript:;">
		  <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
		  <?php echo "Cargar más"; ?>
		</a>
		<?php return ob_get_clean();
}

add_action( "wp_ajax_load_more", "load_more_func" );
add_action( "wp_ajax_nopriv_load_more", "load_more_func" );


function load_more_func() {
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "load_posts" ) ) {
      exit("");
    }
  $offset = isset($_REQUEST['offset'])?intval($_REQUEST['offset']):6;
  $posts_per_page = isset($_REQUEST['posts_per_page'])?intval($_REQUEST['posts_per_page']):6;
  $post_type = isset($_REQUEST['post_type'])?$_REQUEST['post_type']:'downloads';

  ob_start();
  $args = array(
        'post_type'=>$post_type,
        'offset' => $offset,
        'posts_per_page' => $posts_per_page,
          );
  $posts_query = new WP_Query( $args );
  if ($posts_query->have_posts()) {
      $result['have_posts'] = true;
      $result['quantity'] = $posts_query->post_count;

      while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
      <li id="post-<?php the_ID(); ?>"<?php post_class('resource affichar'); ?> style="display: none;">
                    <?php $image = get_field('source_download');
                    if( !empty($image) ): ?>
                      <a href="<?php echo $image['url'] ?>" download>
                       <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                       <span class="ms-title-downloads"><?php the_title(); ?></span>
                      </a>
                    <?php endif;?>
                </li>
      <?php endwhile;
    $result['html'] = ob_get_clean();
  } else {
    $result['have_posts'] = false;
  }
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $result = json_encode($result);
            echo $result;
        }
        else {
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }
  die();
}


?>


