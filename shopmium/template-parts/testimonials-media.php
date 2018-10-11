<?php
/**
 * Template part for loops the media that speak about shopmium
 *
 * @developer @krobing
 * @author Gradiweb, All rights reserved
 * @link https://www.gradiweb.com
 * @license private
 * @copyright 2018 Gradiweb,
 */

global $wp_query;
$vars = $wp_query->query_vars;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<div id="index-123456789" class="rp-media-testimonials-wrapper isotope-system">
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
		]);
	if ( $loop->have_posts() ) : ?>
	<div class="isotope-wrapper">
		<ul class="rp-media-testimonials-grid isotope-container isotope-layout isotope-pagination">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<li class="rp-media-testimonials-item">
				<a href="<?php the_field('testimony_url') ?>">
					<?php $image = get_field('brand_image');
					if( !empty($image) ): ?>
						<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>
				</a>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
	<?php $total_pages = $loop->max_num_pages;
	if ($total_pages > 1) {
	 	$current_page = max(1, $paged); var_dump($current_page);?>
		 <div class="rp-paginator-resources isotope-footer-inner">
			 <?php
				paginate_links_custom([
				 'current' => $current_page,
				 'total' => $total_pages,
				 'prev_next' => false
			 ]);?>
		 </div>
	<?php } endif; wp_reset_postdata(); ?>
</div>
