(function ($, root, undefined) {

    $(function () {

        'use strict';
    });

})(jQuery, this);

jQuery(function ($) {
 $(document).ready(function () {


    $('#ms-slider-testimonials').slick({
      autoplay:true,
      autoplaySpeed:8000,
      arrows:false,
      fade:true
    });


let modal = document.getElementById('modal-demo');
let btn= document.querySelector(".menu-item-73223>a");
let closeModal = document.querySelector("span.ms-close-modal");
btn.onclick = function() {
    modal.style.display = "block";
}

closeModal.onclick = function() {
    $(modal).fadeOut(1000);
}

window.onclick = function(event) {
    if (event.target == modal) {
        $(modal).fadeOut(1000);
    }
}








 });
});

