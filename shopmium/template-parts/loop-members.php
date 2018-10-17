<?php
/**
 * Template part for loop team members
 *
 * @developer @krobing
 * @author Gradiweb, All rights reserved
 * @link https://www.gradiweb.com
 * @license private
 * @copyright 2018 Gradiweb,
 */
?>
<div id="rp-team-members-wrapper">
	<ul class="rp-slider-team-members">
		<?php  $loop = new WP_Query( array( 'post_type' => 'team_members'));
			if ( $loop->have_posts() ) :
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<li class="rp-team-member-item">
					<?php $image = get_field('member_image');
					if( !empty($image) ): ?>
						<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>
					<h5><?php the_title(); ?></h5>
					<span><?php the_field('member_position');?></span>
					<?php $socials = get_field('member_social');
					if( !empty($socials) ) : ?>
						<a href="<?php echo $socials['linkedin_member'] ?>" target="_blank"><i class="fas fa-linkedin"></i></a>
					<?php endif; ?>
				</li>
		<?php endwhile; endif; ?>
	</ul>
	<?php wp_reset_postdata(); ?>
</div>
