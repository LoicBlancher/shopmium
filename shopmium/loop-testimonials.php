<?php
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
?>








