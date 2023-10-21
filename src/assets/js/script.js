$(document).ready(function () {
    sliders();
    addToWishList();
    dashboard();
});

function sliders() {
    $(".banner-section-slider").slick({
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 500,
        cssEase: "linear",
    });
}

function addToWishList() {
    let button = $(".addToWishList");
    button.click(function () {
        $(this)
            .find("i")
            .toggleClass("ri-heart-line")
            .toggleClass("ri-heart-fill");
    });
}

function showLoader(loaderClass, whatToHide, whatToShow, duration) {
    $(whatToHide).hide();
    $(loaderClass).show();

    setTimeout(function () {
        $(loaderClass).hide();
        $(whatToShow).show();
    }, duration);
}

function dashboard() {
    let showProductButton = $("[data-add-product]");
    showProductButton.click(function () {
        if (!$(this).hasClass("active")) {
            viewProductButton.removeClass("active");
            $(this).addClass("active");
            showLoader(".loader", ".allProducts", ".addProduct", 100);
        }
    });

    let viewProductButton = $("[data-view-all-products]");
    viewProductButton.click(function () {
        if (!$(this).hasClass("active")) {
            showProductButton.removeClass("active");
            $(this).addClass("active");
            showLoader(".loader", ".addProduct", ".allProducts", 500);
        }
    });
}
