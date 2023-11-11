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

    toggler({
        button: "[data-search-modal]",
        actionContainer: ".searchModal",
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
            cartTotalAmount();
            if ($(".cart-item-container .cart-item").length == 0) {
                window.location.href = window.location.href.replace(
                    "?openCart",
                    " "
                );
            }
        });
    });

    let setBilling = $("[data-save-billing-details]");
    setBilling.click(function (e) {
        let address = $("[data-address]").val();
        let city = $("[data-city]").val();
        let zip = $("[data-zip]").val();

        setBillingDetails(address, city, zip);
        e.preventDefault();
    });

    let quantityInputs = $(".cart-item-quantity");

    quantityInputs.change(function () {
        let product = $(this).attr("data-product");
        let index = $(this).attr("data-product-index");
        let value = $(this).val();
        let _this = $(this);

        // Pass a callback function to handle the result
        updateProductQuantity(product, index, value, function (errorLevel) {
            if (errorLevel == 0) {
                $(".totalCart a").addClass("disabled");
                _this.next().show();
                $(".d-me").addClass("disabled");
            } else {
                $(".totalCart a").removeClass("disabled");
                _this.next().hide();
                $(".d-me").removeClass("disabled");
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
            // if (window.location.href.indexOf(_thisId) !== -1) {
            //     window.location.href = window.location.href + "&cartOpen";
            // } else {
            window.location.href = window.location.href + "&cartOpen";
            // }
        },
        error: function (xhr, status, error) {
            console.log("Error:", error);
        },
    });
}

if (
    window.location.href.indexOf("&cartOpen") !== -1 ||
    window.location.href.indexOf("?cartOpen") !== -1
) {
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

function cartTotalAmount() {
    let total = 0;

    let allProductPrices = $(".cart-item-price");
    let amountShowContainer = $(".amount");

    allProductPrices.each(function () {
        let inputNearItValue = $(this).parent().next().find("input").val();
        let price = parseInt($(this).text()) * parseInt(inputNearItValue);
        total += price;
    });

    amountShowContainer.html(total);
}
cartTotalAmount();

function editItemQuantity() {
    let inputs = $("input.cart-item-quantity");
    inputs.change(function () {
        let value = $(this).val();
        if (value === "" || value.includes("+") || value.includes("-")) {
            let previousVal = $(this).data("previous-value");
            if (previousVal !== undefined) {
                $(this).val(previousVal);
            } else {
                $(this).val(1);
            }
        } else {
            $(this).data("previous-value", value);
        }
        cartTotalAmount();
    });
}

editItemQuantity();

function setBillingDetails(address, city, zip) {
    $.ajax({
        url: "controllers/set-billing-details.php",
        method: "POST",
        data: { address: address, city: city, zip: zip },
        success: function (response) {
            console.log(response);
            window.location.href = window.location.href;
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

function paymentTabbing($this) {
    if ($this.val() == "debit") {
        $(".payment").show();
        $(".delivery").hide();

        $(".paymentMethodInput").val("Card Payment");
    } else {
        $(".payment").hide();
        $(".delivery").show();
        $(".paymentMethodInput").val("Cash on Delivery");
    }
}

$(".payInputs").change(function () {
    paymentTabbing($(this));
    $(".payInputs").next().removeClass("active");
    $(this).next().addClass("active");
});

// Initialize the tabbing on page load
$(document).ready(function () {
    paymentTabbing($(".payInputs:checked"));
});

function validateForm(options, action) {
    let errorClass = options.errorClass || "error";
    let disableClass = options.disableClass || "disabled";

    let isValid = false;
    let button = $(options.button);
    let inputs = $(options.inputs);

    let email = $(options.email.selector);
    let emailRegex =
        options.email.regex ||
        /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    let telephone = $(options.telephone.selector);
    let telephoneRegex = options.telephone.regex || /^\d{9,}$/;

    let checkValidateType = {
        inputs: "empty",
        email: "email",
        telephone: "telephone",
    };

    function addUtilties() {
        inputs.attr("validation", checkValidateType.inputs);
        email.attr("validation", checkValidateType.email);
        telephone.attr("validation", checkValidateType.telephone);
    }
    addUtilties();

    function checkInputs(_this) {
        let isSpecial = undefined;

        function checkIfSpecialFields(input) {
            inputValidationType = input.attr("validation");
            emailValidationType = email.attr("validation");
            telephoneValidationType = telephone.attr("validation");

            if (inputValidationType == emailValidationType) {
                isSpecial = true;
                validateSpecialFields(email, emailRegex);
            } else if (inputValidationType == telephoneValidationType) {
                isSpecial = true;
                validateSpecialFields(telephone, telephoneRegex);
            } else {
                isSpecial = false;
            }
        }

        function validateSpecialFields(field, regex) {
            let fieldValue = field.val();
            let test = regex.test(fieldValue) && fieldValue !== "";
            if (!test) {
                field.addClass(errorClass);
            } else {
                field.removeClass(errorClass);
            }
        }

        if (_this) {
            checkIfSpecialFields(_this);
            if (!isSpecial) {
                if (_this.val() == "") {
                    _this.addClass(errorClass);
                } else {
                    _this.removeClass(errorClass);
                }
            }
        } else {
            inputs.each(function () {
                checkIfSpecialFields($(this));
                if (!isSpecial) {
                    if ($(this).val() == "") {
                        $(this).addClass(errorClass);
                    } else {
                        $(this).removeClass(errorClass);
                    }
                }
            });
        }
    }

    function checkErrorClass() {
        isValid = inputs
            .toArray()
            .every((input) => !$(input).hasClass(errorClass));

        if (isValid) {
            button.removeClass(disableClass);
        }
    }

    inputs.on("change", function () {
        checkInputs($(this));
        checkErrorClass();
    });

    button.on("click", function (e) {
        e.preventDefault();
        checkInputs();
        checkErrorClass();

        if (isValid) {
            action();
        } else {
            $(this).addClass(disableClass);
        }
    });
}

validateForm(
    {
        button: "[data-order]",
        inputs: "[data-validate-order]",
        email: {
            selector: "[data-validate-email]",
            regex: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/,
        },
        telephone: {
            selector: "[data-telephone-field]",
            regex: /^\d{9,}$/,
        },
        errorClass: "error",
        disableClass: "disabled",
    },
    function () {
        // Show the loader
        $(".loader").show();
        $(".toBeHidden").hide();
        // Use a setTimeout to simulate async behavior, you can adjust the delay as needed
        setTimeout(function () {
            if ($("[data-order]").hasClass("payWithCard")) {
                let hasError = false;
                $(".checkCardInfo").each(function () {
                    let thisValue = $(this).val();
                    if (thisValue === "") {
                        hasError = true;
                        $(this).addClass("error");
                    } else {
                        $(this).removeClass("error");
                    }
                });

                // Check if any error occurred
                if (hasError) {
                    $(".toBeHidden").show();
                    $(".loader").hide();
                } else {
                    actualPlaceOrder();
                    // No errors, proceed to thank you page
                    window.location.href = "thankyou.php"; // Change the URL as needed
                }
            } else {
                // Handle other cases if needed
            }
        }, 1000);
    }
);
validateForm(
    {
        button: "[data-delivery-order]",
        inputs: "[data-validate-order]",
        email: {
            selector: "[data-validate-email]",
            regex: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/,
        },
        telephone: {
            selector: "[data-telephone-field]",
            regex: /^\d{9,}$/,
        },
        errorClass: "error",
        disableClass: "disabled",
    },
    function () {
        $(".loader").show();
        $(".toBeHidden").hide();
        setTimeout(function () {
            actualPlaceOrder();
            window.location.href = "thankyou.php";
        }, 1000);
    }
);

function actualPlaceOrder() {
    let userDetails = {
        phone: $(".userPhoneField").val(),
        address: $(".shippingAddress").val(),
        city: $(".userCity").val(),
        zipCode: $(".zipCode").val(),
    };
    let total = $(".amount").html();
    let orderType = $(".paymentMethodInput").val();

    order(userDetails, orderType, total);
}

$(".checkCardInfo").change(function () {
    if ($(this).val() != "") {
        $(this).removeClass("error");
    } else {
        $(this).addClass("error");
    }
});
function updateProductQuantity(product, index, value, callback) {
    $.ajax({
        url: "controllers/edit-cart-quantity.php",
        method: "POST",
        data: { product: product, index: index, value: value },
        success: function (response) {
            console.log(response);
            let res = JSON.parse(response);
            console.log(res);
            console.log(res.errorLevel);
            callback(res.errorLevel); // Execute the callback with the result
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}
function order(shippingDetails, orderType, total) {
    $.ajax({
        url: "controllers/place-order.php",
        method: "POST",
        data: {
            shipping_detail: shippingDetails,
            order_type: orderType,
            order_total: total,
        },
        success: function (response) {
            console.log("response :", response);
        },
        error: function (xhr, status, error) {
            console.log("error:", error);
        },
    });
}

// $("[placeOrder]").click(function () {
//     // let userDetails = {
//     //     phone: $(".userPhoneField").val(),
//     //     address: $(".shippingAddress").val(),
//     //     city: $(".userCity").val(),
//     //     zipCode: $(".zipCode").val(),
//     // };
//     // let total = $(".amount").html();
//     // let orderType = $(".paymentMethodInput").val();
//     // order(userDetails, orderType, total);
// });

function tabbingWithClasses(options) {
    let container = $(options.container);
    let attribute = options.button.replace(/\[|\]/g, "") || "[data-show]";
    let buttons = options.button ? $(options.button) : $("[data-show]");
    let activeClass = options.activeClass || "active";
    let hide = options.hide || "div";

    buttons.click(function () {
        buttons.removeClass(activeClass);
        $(this).addClass(activeClass);

        let whatToShow = $(this).attr(attribute);
        let whatToShowActually = container.find(whatToShow);
        let whatToHide = container.children(hide);

        whatToHide.hide();
        whatToShowActually.show();

        console.log(whatToHide);
        console.log(whatToShow);
        console.log("clicked");
    });
}

tabbingWithClasses({
    container: ".orderArea",
    hide: "div",
    button: "[data-show-orders]",
    activeClass: "active",
});

function addCategory(value) {
    $.ajax({
        url: "../controllers/add-category.php",
        data: {
            categoryName: value,
        },
        method: "POST",
        success: function (response) {
            $(".closeCat").trigger("click");
            window.location.href = window.location.href;
        },
        error: function (xhr, status, error) {
            console.log("error:", error);
        },
    });
}

let addToCategoryButton = $("[data-save-category]");
addToCategoryButton.click(function () {
    let value = $(".categoryName").val();
    if (value == "") {
        $(".categoryName").addClass("error");
        return;
    }
    addCategory(value);
});

function deleteCategory(value) {
    $.ajax({
        url: "../controllers/delete-category.php",
        data: {
            id: value,
        },
        method: "POST",
        success: function (response) {
            // console.log(response);
            window.location.href = window.location.href;
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

let removeCatButton = $("[removeCat]");

removeCatButton.click(function () {
    let value = $(this).attr("data-id");
    deleteCategory(value);
});

function renameCategory(id, value) {
    $.ajax({
        url: "../controllers/rename-category.php",
        data: {
            id: id,
            value: value,
        },
        method: "POST",
        success: function (response) {
            console.log(response);
            // window.location.href = window.location.href;
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

$(".focusOnCat").click(function () {
    let container = $(this).closest(".list-group-item");
    let input = container.find(".catInput");
    input.removeAttr("readonly");
    input.focus();
    input.change(function () {
        let name = $(this).val();
        let id = $(this).attr("data-id");
        renameCategory(id, name);
    });
});

function sortProducts(keywords) {
    $.ajax({
        url: "controllers/product-search.php",
        method: "POST",
        data: {
            keyword: keywords,
        },
        success: function (response) {
            var products = JSON.parse(response);
            showSearchedProducts(products);
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}
function showSearchedProducts(products) {
    var productsContainer = $(".showSearchedProducts");

    if (products.length === 0) {
        productsContainer.empty();
        productsContainer.html("No results found.");
    } else {
        productsContainer.empty();

        for (let i = 0; i < products.length; i++) {
            var product = products[i];
            var productDiv = $(
                `<a class="d-block col-3 header-search-item" href='single-product.php?id=${product.SKU}'></a>`
            );
            var productImage = $(
                "<img src='assets/images/product-images/" +
                    product.images +
                    "'>"
            );
            var productText = $("<div class='header-search-text'></div>");
            var productName = $(
                "<h5 class='fs-14 fw-400 fc-secondary'>" +
                    product.name +
                    "</h5>"
            );
            var productPrice = $(
                "<h6 class='fs-16 fw-400 fc-secondary'>" +
                    " <span class='amount'>$" +
                    product.price +
                    "</span></h6>"
            );
            productText.append(productName);
            productText.append(productPrice);
            productDiv.append(productImage);
            productDiv.append(productText);
            productsContainer.append(productDiv);
        }
    }
}
let searchInput = $("[header-search]");

searchInput.on("keyup", function () {
    let keywords = $(this).val();

    if (keywords === "") {
        $(".showSearchedProducts").empty();
    } else {
        sortProducts(keywords);
    }
});
function redirectToSearchPage(inputName) {
    let searchQuery = $(inputName).val().trim();

    if (searchQuery !== "") {
        window.location.href =
            "search.php?query=" + encodeURIComponent(searchQuery);
    }
}
function searchBar(searchBarClass, searchButton) {
    $(searchBarClass).on("keyup", function (e) {
        if (e.key === "Enter") {
            redirectToSearchPage(searchBarClass);
        }
    });

    $(searchButton).click(function () {
        redirectToSearchPage(searchBarClass);
    });
}

searchBar("[header-search]", ".searchButton");
searchBar(".mainSearchBar", ".searchButton");

function loginAdmin(email, pass) {
    $.ajax({
        url: "../controllers/admin-login.php",
        method: "POST",
        data: {
            adminEmail: email,
            adminPass: pass,
        },
        success: function (response) {
            if (response === "1") {
                window.location.href = "dashboard.php";
            } else {
                $(".adminLoginError").html(response);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

let adminLoginButton = $("[data-admin-login]");
adminLoginButton.click(function (e) {
    e.preventDefault();
    let email = $(".adminEmail");
    let pass = $(".adminPass");
    email.on("keyup", function () {
        if (email.val() != "") {
            email.removeClass("error");
        }
    });

    pass.on("keyup", function () {
        if (pass.val() != "") {
            pass.removeClass("error");
            return;
        }
    });
    if (email.val() == "") {
        email.addClass("error");
        return;
    }
    if (pass.val() == "") {
        pass.addClass("error");
        return;
    }
    loginAdmin(email.val(), pass.val());
});

function addEmployee(name, email, password, phone, rights) {
    $.ajax({
        url: "../controllers/add-admin.php",
        method: "POST",
        data: {
            adminName: name,
            adminEmail: email,
            adminPhone: phone,
            adminPass: password,
            adminRights: rights,
        },
        success: function (response) {
            if (response == "1") {
                showLoader(
                    ".employeeModal .loader",
                    ".addEmployeeForm",
                    ".element",
                    500
                );
                setTimeout(function () {
                    window.location.href = window.location.href;
                }, 500);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

let addEmployeeButton = $("[data-add-employee]");

addEmployeeButton.click(function () {
    let name = $("[em-name]").val();
    let email = $("[em-email]").val();
    let password = $("[em-password]").val();
    let phone = $("[em-phone]").val();
    let rights = $("[em-rights]").val();

    // let fields = $(name., email, password, phone, rights);
    // let fieldValues = [];
    // console.log(fields);

    // fields.each(function () {
    //     if ($(this).val() === "") {
    //         $(this).addClass("error");
    //     } else {
    //         $(this).removeClass("error");
    //         fieldValues.push($(this).val());
    //     }
    // });

    // if (fields.hasClass("error")) {
    //     return;
    // }
    addEmployee(name, email, password, phone, rights);
});

function deleteAdmin(id) {
    $.ajax({
        url: "../controllers/delete-admin.php",
        method: "POST",
        data: {
            adminId: id,
        },

        success: function (response) {
            window.location.href = window.location.href;
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

let deleteAdminButton = $("[data-delete-admin]");

deleteAdminButton.click(function () {
    let id = $(this).attr("data-id");
    deleteAdmin(id);
});
