$(document).ready(function() {
    sliders();
    addToWishList();
})

function sliders () {
    $('.banner-section-slider').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 500,
        cssEase: "linear",
    })
}

function addToWishList () {
    let button = $('.addToWishList') 
    button.click(function() {
        $(this).find("i").toggleClass("ri-heart-line").toggleClass("ri-heart-fill")
    })
}