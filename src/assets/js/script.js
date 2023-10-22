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

function tabbing(
    buttonClassByContainer,
    panelClassByContainer,
    utilityClassToAdd
) {
    let activeClass = utilityClassToAdd ? utilityClassToAdd : "active";
    let buttons = $(buttonClassByContainer);
    let panels = $(panelClassByContainer);

    panels.not(panels.eq(0)).hide();

    buttons.click(function () {
        let itsIndex = $(this).index();
        if (panels.eq(itsIndex).length != 0) {
            buttons.removeClass(activeClass);
            $(this).addClass(activeClass);
            panels.hide();
            panels.eq(itsIndex).show().addClass(activeClass);
        } else {
            $(this).addClass("disabled");
        }
    });
}

tabbing(".tabbingButtons button", ".tabbingPanels .tabbingPanel");

function handleEditDetail() {
    let editedInputValue;
    let editedInput;
    let buttons = $("[data-edit-details]");

    let inputs = $(".customer-details .wrap input");
    let inputValues = [];

    inputs.each(function () {
        inputValues.push($(this).val());
    });

    buttons.click(function (e) {
        e.preventDefault();
        let nearInput = $(this).closest(".wrap").find("input");
        let nearInputValue = nearInput.val();
        editedInput = nearInput;
        editedInputValue = nearInputValue;
        console.log(editedInput);

        nearInput.removeAttr("readonly");
        nearInput.focus();
        nearInput.val("");

        editedInput.blur(function () {
            let inputValue = $(this).val();
            if ($(this).attr("type") === "email") {
                let emailRegex =
                    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if (!emailRegex.test(inputValue)) {
                    $(this).val(editedInputValue);
                }
            } else if (inputValue === "") {
                $(this).val(editedInputValue);
            }

            //ADD FUNCTIONALITY OF SAVE BUTTON HERE
            let changesDetected = false;
            inputs.each(function (index) {
                if ($(this).val() !== inputValues[index]) {
                    changesDetected = true;
                    return false; 
                }
            });

            if (changesDetected) {
                $(".saveButton").show();
            } else {
                $(".saveButton").hide();
            }
        });
    });
}

handleEditDetail();
