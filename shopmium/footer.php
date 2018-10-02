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
				<li><i class="far fa-address-book"></i></li>
			</ul>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>


