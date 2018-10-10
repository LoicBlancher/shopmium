<div id="modal-demo" class="modal">
  <div class="ms-modal-content">
  	<div id="ms-title-modal-form">
      <h2>Schedule a demo</h2>
      <div class="ms-orange-separator" id="ms-separator-title-modal"></div>
  	</div>
  	  <a href="#" class="ms-close-modal"><i class="fa fa-times" aria-hidden="true"></i></a>
      <?php echo do_shortcode( '[contact-form-7 id="10" title="Demo form"]' ); ?>
  </div>

</div>


<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-3 col-lg-3 ms-wrapper-foot-info">
				<img src="<?php echo get_template_directory_uri(); ?>/core/assets/images/shopmium-a-quotient-brand.png" alt="Shopnium A Quotient Brand">
				<div id="ms-footer-info-content">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. In alias, veniam deserunt sunt nulla aliquid nemo eum ea. Inventore, error.
				</div>
			</div>
			<div class="col-xs-12 col-md-3 col-lg-3 ms-menu-foot-container">
				<h4 class="ms-title-footer-menu">Services</h4>
				<?php footer_services_menu(); ?>
			</div>
			<div class="col-xs-12 col-md-3 col-lg-3 ms-menu-foot-container">
				<h4 class="ms-title-footer-menu">About us</h4>
				<?php footer_aboutus_menu(); ?>
			</div>
			<div class="col-xs-12 col-md-3 col-lg-3 ms-menu-foot-container">
				<h4 class="ms-title-footer-menu">Blog</h4>
				<?php footer_blog_menu(); ?>
			</div>
		</div>
		<div class="row" id="ms-footer-socials">
			<ul>
				<a href="https://www.facebook.com/ShopmiumUK" target="_blank"><li class="ms-wrapper-social-icons"><i class="fa fa-facebook" aria-hidden="true"></i></li></a>
				<a href="https://www.instagram.com/shopmium/" target="_blank"><li class="ms-wrapper-social-icons"><i class="fa fa-instagram" aria-hidden="true"></i></li></a>
				<a href="https://twitter.com/ShopmiumFR" target="_blank"><li class="ms-wrapper-social-icons"><i class="fa fa-twitter" aria-hidden="true"></i></li></a>
				<a href="https://www.youtube.com/user/ShopmiumFR" target="_blank"><li class="ms-wrapper-social-icons"><i class="fa fa-youtube-play" aria-hidden="true"></i></li></a>
			</ul>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>


