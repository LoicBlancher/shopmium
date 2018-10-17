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

$paged = ($vars['paged']) ? absint($vars['paged']) : 1;

if ( isset($loop) && $loop instanceof WP_Query && $loop->have_posts() ) : ?>
<ul class="rp-media-testimonials-grid no-list lg-block-grid-6">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<li class="rp-media-testimonials-item">
		<a href="<?php the_field('testimony_url') ?>">
			<?php $image = get_field('brand_image');
			if( !empty($image) ) { ?>
				<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt']; ?>" />
			<?php }; ?>
		</a>
	</li>
	<?php endwhile; ?>
</ul>

<?php $total_pages = $loop->max_num_pages;
	if ($total_pages > 1) {
 	$current_page = max(1, $paged); ?>
	 <div class="rp-paginator-resources">
		 <?php
			paginate_links_custom([
				'format' => '?page=%#%',
				'current' => $current_page,
				'total' => $total_pages,
				'prev_next' => false,
				'custom_class' => 'pagination-with-dots'
		 ]);?>
	 </div>
<?php } endif; wp_reset_postdata(); ?>
