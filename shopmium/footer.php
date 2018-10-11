<div id="modal-demo" class="modal">
  <div class="ms-modal-content">
  	<div id="ms-title-modal-form">
      <h2>Schedule a demo</h2>
      <div class="ms-orange-separator" id="ms-separator-title-modal"></div>
  	</div>
  	  <span class="ms-close-modal"><i class="fa fa-times" aria-hidden="true"></i></span>
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


<script>
	 jQuery('.load_more:not(.loading)').click(function(e){

      e.preventDefault();

      if(!$(this).hasClass('disabled')) {

        var $load_more_btn = $(this);
        var post_type = 'downloads';
        var offset = $('#ms-resources-list li').length;
        var nonce = $load_more_btn.attr('data-nonce');
        $.ajax({
              type : "post",
              context: this,
              dataType : "json",
              url : "<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php",
          data : {action: "load_more", offset:offset, nonce:nonce, post_type:post_type, posts_per_page:6},
              beforeSend: function(data) {
            $load_more_btn.addClass('loading').html('<i class="fa fa-arrow-circle-down" aria-hidden="true"></i><?php echo pll__( "Cargando..." ); ?>');
              },
              success: function(response) {
            if (response['have_posts'] == 1){
              var $newElems = $(response['html'].replace(/(\r\n|\n|\r)/gm, ''));
console.log($newElems);
              $('#ms-resources-list').append($newElems);
              $('.'+nonce).addClass('downloads');
              $('.'+nonce).fadeIn(1300);
              $('.affichar').fadeIn(1300).removeClass("affichar");
              if (response['quantity'] == 6)
                $load_more_btn.removeClass('loading').html('<i class="fa fa-arrow-circle-down" aria-hidden="true"></i><?php echo pll__( "Cargar Más" ); ?>');
              else
                $load_more_btn.removeClass('loading').addClass('disabled').html('<i class="fa fa-warning" aria-hidden="true"></i><?php echo pll__( "Fin de los recursos" ); ?>');
            } else {
              $load_more_btn.removeClass('loading').addClass('disabled').html('<i class="fa fa-warning" aria-hidden="true"></i><?php echo pll__( "Fin de los recursos" ); ?>');
            }
              }
            });
      }
    });
</script>
