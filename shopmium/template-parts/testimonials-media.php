<?php
/**
 * Template part for wrap the loops of media testimonialsp
 *
 * @developer @krobing
 * @author Gradiweb, All rights reserved
 * @link https://www.gradiweb.com
 * @license private
 * @copyright 2018 Gradiweb,
 */

global $wp_query;
$vars = $wp_query->query_vars;

$paged = ($vars['paged']) ? $vars['paged'] : 1;
?>
<div id="index-<?php echo rand() ?>" class="rp-media-testimonials-wrapper">
	<?php  $loop = new WP_Query([
		'orderby' => 'menu_order title',
		'order' => 'ASC',
		'post_type' => 'testimonials',
		'posts_per_page'    => 6,
		'paged'             => $paged,
		'tax_query' => array([
			'taxonomy'  => 'testimonial_categories',
	        'field'     => 'slug',
	        'terms'     => [sanitize_title($vars['testimony_type'])]
		])
	]); set_query_var('loop', $loop); ?>
	<div class="rp-results-wrapper">
		<?php get_template_part('template-parts/testimonials', 'medialist'); ?>
	</div>
</div>
