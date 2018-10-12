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
