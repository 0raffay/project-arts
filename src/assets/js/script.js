$(document).ready(function () {
    sliders();
    addToWishList();
    dashboard();
    toggler({
        button: "[data-cart-button]",
        actionContainer: ".cart",
        actionClass: "active",
        preventDefault: true,
        removeAction: { eventTrigger: window.body, event: "click" },
    });
    handleEditDetail();
    adminSectionsHideShow();
    tabbing(".tabbingButtons button", ".tabbingPanels .tabbingPanel");

    let addToCartButton = $("[data-add-to-cart");
    addToCartButton.click(function (e) {
        e.preventDefault();
        let id = $(this).attr("data-product-id");
        addToCart(id);
    });

    let removeFromCartButton = $("[data-remove-from-cart]");

    removeFromCartButton.click(function () {
        let item = $(this).closest(".cart-item");
        let id = $(this).attr("data-id");

        removeFromCart(id, function () {
            item.remove(); 
            if($('.cart-item-container .cart-item').length == 0) {
                window.location.href = window.location.href.replace("?openCart", " "); 
            }
        });
    });
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

function toggler(options) {
    const button = $(options.button);
    const action = $(options.actionContainer);
    const classToAdd = options.actionClass || "active";

    if (options.removeAction) {
        let _eventTrigger = $(options.removeAction.eventTrigger);
        let event = options.removeAction.event;

        _eventTrigger.on(event, function () {
            action.removeClass(classToAdd);
        });
    }

    button.click(function (e) {
        console.log("workign");
        if (options.preventDefault) {
            e.preventDefault();
        }
        button.toggleClass(classToAdd);
        action.toggleClass(classToAdd);
    });
}

function adminSectionsHideShow() {
    let divToAppenedIn = $(".showAdminSections");
    let buttons = $("[data-show");

    buttons.click(function () {
        buttons.removeClass("active");
        $(this).addClass("active");

        let whatToShow = $(this).attr("data-show");
        let whatToShowActually = divToAppenedIn.find(whatToShow);
        let whatToHide = divToAppenedIn.children("div");
        showLoader(".loader", whatToHide, whatToShowActually, 500);
    });
}

function addToCart(_thisId) {
    $.ajax({
        url: "controllers/add-to-cart.php",
        method: "POST",
        data: { _thisId },
        success: function (response) {
            console.log("Success:", response);
            window.location.href = window.location.href + "?cartOpen";
        },
        error: function (xhr, status, error) {
            console.log("Error:", error);
        },
    });
}

if (window.location.href.indexOf("?cartOpen") !== -1) {
    $(".cart").addClass("active");
}

function removeFromCart(_thisId, action) {
    $.ajax({
        url: "controllers/remove-from-cart.php",
        method: "POST",
        data: { _thisId },
        success: function (response) {
            console.log("success", response);
            action();
        },
        error: function (xhr, status, error) {
            console.log("Error:", error);
        },
    });
}
