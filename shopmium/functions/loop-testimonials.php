<?php  $loop = new WP_Query( array( 'post_type' => 'testimonials'));
		 if ( $loop->have_posts() ) :
		  while ( $loop->have_posts() ) : $loop->the_post(); ?>
			 <?php
			 $image = get_field('customer_image');
			 if( !empty($image) ): ?>
			  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			 <?php endif; ?>
			 <?php the_field('comment'); ?>
			 <h4><?php the_title();?> <span> - <?php the_field('customer_position');?></span></h4>
			 <?php
			 	$image_brand = get_field('brand_image');
			 	if( !empty($image_brand ) ): ?>
			 	 <img src="<?php echo $image_brand ['url']; ?>" alt="<?php echo $image_brand ['alt']; ?>" />
			 	<?php endif; ?>
		 <?php endwhile;
		 endif;?>
 <?php wp_reset_postdata();
