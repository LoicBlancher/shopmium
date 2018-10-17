<?
/**
 * Settings for child theme
 *
 * @developer @krobing
 * @author Gradiweb, All rights reserved
 * @link https:www.gradiweb.com
 * @license private
 * @copyright 2018 Gradiweb,
 */

add_action( 'wp_enqueue_scripts', 'ajax_custom_enqueue_scripts' );
function ajax_custom_enqueue_scripts() {
	wp_enqueue_script( 'buildJs', get_stylesheet_directory_uri(). '/dist/js/build.js', array('jquery'), '1.0', true );

	wp_localize_script( 'buildJs', 'customapp', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
}

//
// Rp - Custom post Team Members
//
function custom_post_team_members()
{
	$labels = array(
		'name'                => _x( 'Team Members', 'Post Type General Name', 'uncode' ),
	    'singular_name'       => _x( 'Team Member', 'Post Type Singular Name', 'uncode' ),
	    // 'parent_item_colon'   => __( 'Testimonials parent:', 'uncode' ),
	    'all_items'           => __( 'All Members', 'uncode' ),
	    'view_item'           => __( 'View Member', 'uncode' ),
	    'add_new_item'        => __( 'Add Member', 'uncode' ),
	    'add_new'             => __( 'Add New', 'uncode' ),
	    'edit_item'           => __( 'Edit', 'uncode' ),
	    'update_item'         => __( 'Update', 'uncode' ),
	    'search_items'        => __( 'Search Team Members', 'uncode' ),
	    'not_found'           => __( 'Not Found', 'uncode' ),
	    'not_found_in_trash'  => __( 'Not found in Trash', 'uncode' ),
	);

	$args = array(
		'label'               => __( 'team_members', 'uncode' ),
        'description'         => __( 'Shopmium Team Members', 'uncode' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
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

	register_post_type('team_members', $args);
}
add_action('init', 'custom_post_team_members', 0);

// Add shortcode for team members section
add_shortcode('team_members','team_members_section');
ob_start();
function team_members_section(){
    get_template_part('template-parts/loop','members');
    return ob_get_clean();
}

//
// Custom categories for testimonials kind
//
function create_testimonials_categories()
{
	$labels = array(
		'name'              => _x('Testimony Types', 'taxonomy general name'),
		'singular_name'     => _x('Testimony Type', 'taxonomy singular name'),
		'search_items'      => __('Search Category'),
		'all_items'         => __('All Categories'),
		'parent_item'       => __('Parent Category'),
		'parent_item_colon' => __('Parent Category:'),
		'edit_item'         => __('Edit Category'),
		'update_item'       => __('Update Category'),
		'add_new_item'      => __('Add New Category'),
		'new_item_name'     => __('New Category Name'),
		'menu_name'         => __('Testimony Types'),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'description' 		=> "Categories for testimony types",
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => ['slug' => 'testimony_type'],
	);

	register_taxonomy('testimonial_categories', ['testimonials'], $args);
}
add_action('init', 'create_testimonials_categories', 0);


/**
 * Helper to generate the paginate links
 * @param array $_args
 * @return string html generated
 */
function paginate_links_custom(array $_args = [])
{
	global $wp;
	$custom_class = '';
	extract($_args, EXTR_IF_EXISTS);

	$current_url = home_url(add_query_arg(array(), $wp->request));
	$pagination_args = array_merge([
		'base'            => $current_url. '%_%',
		'format'          => 'page/%#%',
		'current'         => 1,
		'show_all'        => false,
		'prev_next'       => true,
		'type'            => 'array',
		'add_args' => ['nonce' => wp_create_nonce('load_posts'), 'pagename' => $wp->request]
	], $_args);

	$paginate_links = paginate_links($pagination_args);

	if (is_array($paginate_links)) {

		echo "<ul class='pagination {$custom_class}'>";
		if($pagination_args['prev_next']) {
			$prev = get_previous_posts_link('<i class="fa fa-angle-left"></i>');
			if ($prev !== NULL) echo '<li class="page-prev">'.$prev.'</li>';
			else echo '<li class="page-prev"><span class="btn btn-link btn-icon-left btn-disable-hover"><i class="fa fa-angle-left"></i></span></li>';
		}
		foreach ( $paginate_links as $page ) {
		    echo '<li><span class="btn btn-link text-default-color">'. $page .'</span></li>';
		}
		if($pagination_args['prev_next']) {
			$next = get_next_posts_link('<i class="fa fa-angle-right"></i>');
			if ($next !== NULL) echo '<li class="page-next">'.$next.'</li>';
			else echo '<li class="page-next"><span class="btn btn-link btn-icon-right btn-disable-hover"><i class="fa fa-angle-right"></i></span></li>';
		}
		echo "</ul>";
	}
}

// hook ajax action to ajax call
add_action( "wp_ajax_testimonials_action", "paginate_testimonials_action" );
add_action( "wp_ajax_nopriv_testimonials_action", "paginate_testimonials_action" );

function paginate_testimonials_action()
{
	$result = array();
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "load_posts" ) ) {
	 	exit("");
	}
	$paged = get_query_var('paged') ?: ($_REQUEST['page'] ?:1);
	$pagename = get_query_var('pagename') ?: ($_REQUEST['pagename'] ?: '');
	$posts_per_page = isset($_REQUEST['posts_per_page']) ? intval($_REQUEST['posts_per_page']) : 6;
	$taxonomy = isset($_REQUEST['taxonomy']) ? $_REQUEST['taxonomy'] : 'testimonial_categories';
	$testimony_type = isset($_REQUEST['testimony_type']) ? $_REQUEST['testimony_type'] : 'media';

	ob_start();
	$args = [
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'post_type'      => 'testimonials',
		'posts_per_page' => $posts_per_page,
		'paged'          => $paged,
		'tax_query' => array([
			'taxonomy'  => $taxonomy,
	        'field'     => 'slug',
	        'terms'     => [sanitize_title($testimony_type)]
		])
	];
	$posts_query = new WP_Query( $args );
	if ($posts_query->have_posts()) {
		$result['have_posts'] = true;
      	$result['quantity'] = $posts_query->post_count;

      	set_query_var('loop', $posts_query);
      	set_query_var('paged', $paged);
      	set_query_var('pagename', $pagename);
      	get_template_part('template-parts/testimonials', 'medialist');
      	$result['html'] = ob_get_clean();
	}else {
		$result['have_posts'] = false;
	}

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		wp_send_json($result);
    }
    else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
    }

    wp_die();
}
