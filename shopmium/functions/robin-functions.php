<?
/**
 * @developer @krobing
 * @author Gradiweb, All rights reserved
 * @link https:www.gradiweb.com
 * @license private
 * @copyright 2018 Gradiweb,
 */

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
function team_members_section(){
    get_template_part('template-parts/loop','members');
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

function paginate_links_custom(array $_args = [])
{
	$pagination_args = array_merge([
		'base'            => get_pagenum_link(1) . '%_%',
		'format'          => 'page/%#%',
		'current'         => 1,
		'show_all'        => false,
		'prev_next'       => false,
		'type'            => 'array'
	], $_args);

	$paginate_links = paginate_links($pagination_args);

	if (is_array($paginate_links)) {

		echo "<ul class='pagination'>";
		$prev = get_previous_posts_link('<i class="fa fa-angle-left"></i>');
		if ($prev !== NULL) echo '<li class="page-prev">'.$prev.'</li>';
		else echo '<li class="page-prev"><span class="btn btn-link btn-icon-left btn-disable-hover"><i class="fa fa-angle-left"></i></span></li>';
		foreach ( $paginate_links as $page ) {
		    echo '<li><span class="btn btn-link text-default-color">'.$page.'</span></li>';
		}
		$next = get_next_posts_link('<i class="fa fa-angle-right"></i>');
		if ($next !== NULL) echo '<li class="page-next">'.$next.'</li>';
		else echo '<li class="page-next"><span class="btn btn-link btn-icon-right btn-disable-hover"><i class="fa fa-angle-right"></i></span></li>';
		echo "</ul>";
	}
}
