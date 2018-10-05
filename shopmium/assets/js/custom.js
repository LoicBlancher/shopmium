(function ($, root, undefined) {

    $(function () {

        'use strict';
    });

})(jQuery, this);

jQuery(function ($) {
 $(document).ready(function () {


    $('#ms-slider-testimonials').slick({
      autoplay:false,
      autoplaySpeed:2000,
    });


let modal = document.getElementById('modal-demo');
let btn= document.querySelector(".menu-item-73223>a");
let closeModal = document.getElementsByClassName("ms-close-modal");
btn.onclick = function() {
    modal.style.display = "block";
}

closeModal.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

 });
});

