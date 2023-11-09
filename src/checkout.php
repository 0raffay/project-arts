<?php
include 'config.php';
include 'functions.php';
if ($currentCustomer == null || $productsInCart == null || $productsInCart == "") {
    header("location: index.php");
}

$userName = $currentCustomer["Customer Name"];
$userEmail = $currentCustomer["Customer Email"];
$userPhone = $currentCustomer["Customer Phone"];
$userAddress = $currentCustomer["Customer Address"];
$userCity = $currentCustomer["Customer City"];
$userZip = $currentCustomer["Customer Zipcode"];
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- META TITLE AND DESCRIPTION -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- META TITLE AND DESCRIPTION -->


    <!--==== HEADER STYLES START ====-->
    <?php include('includes/header-styles.php') ?>
    <!--==== HEADER STYLES END ====-->
    <title>Checkout | <?php echo $site__name; ?></title>
</head>

<body class="checkoutBody">
    <div class="loader center"></div>
    <section class="checkout-header py-0 border-bottom-hr">
        <div class="container">
            <div class="py-2 d-flex justify-content-between align-items-center">
                <img src="assets/images/logos/logo-black.png" alt="reload">
                <a href="index.php" class="addHover">Go Back</a>
            </div>
        </div>
    </section>




    <section class="checkout-section my-5 py-5 toBeHidden">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4 ">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fc-secondary">Your cart:</span>
                        <span class="badge badge-secondary py-1 fs-14 badge-pill bg-black">
                            <?php
                            if ($productsInCart != null) {
                                if ($productsInCart[0] == "") {
                                    echo "0";
                                } else {
                                    echo count($productsInCart);
                                }
                            }
                            ?>
                        </span>
                    </h4>
                    <ul class="list-group mb-3">

                        <?php
                        foreach (Product::$instances as $product) {
                            if (in_array($product->SKU, $productsInCart)) {
                                $productIndex  = array_search($product->SKU, $productsInCart);
                                $productQuantity = $productsInCartQuantity[$productIndex];
                        ?>

                                <div class="lh-condensed checkout-cart-item align-items-center list-group-item  d-flex gap-10 border-bottom-hr">
                                    <div class="img__wrap">
                                        <img height="130" src="assets/images/product-images/<?php echo $product->images; ?>" alt="">
                                    </div>
                                    <div class="cart-item-text flex-1">
                                        <h5 class="cart-title mb-1 fs-20 fw-400 fc-black"><?php echo $product->name; ?></h5>
                                        <h6 class="cart-price mb-3 fs-18 fw-400 fc-black"><?php echo $currencySymbol; ?><span class="cart-item-price"><?php echo $product->price; ?></span> </h6>


                                        <div class="d-flex justify-content-between align-items-end">
                                            <div>
                                                <label for="cart-quantity<?php echo $product->SKU; ?>" class="fw-300 mb-1 addHover fs-14 fc-secondary-400">Item Quantity:</label>
                                                <input id="cart-quantity<?php echo $product->SKU; ?>" value="<?php echo $productQuantity; ?>" class="cart-item-quantity">
                                            </div>
                                            <div>
                                                <button data-remove-from-cart data-id="<?php echo $productIndex; ?>" class="text-danger remove-cart-item fw-300 fs-14">Remove Item</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php  } ?>
                        <?php  }
                        ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total amount:</span>
                            <div>
                                <strong><?php echo $currencySymbol; ?></strong>
                                <strong class="amount">0</strong>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1 postion-relative">

                    <div class="">
                        <h4 class="mb-3">Shipping Details</h4>
                        <div>
                            <div class="list-group-item mb-4">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="firstName">Name</label>
                                        <input type="text" data-validate-order value="<?php echo $userName; ?>" class="form-control" id="firstName" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="num">Phone</label>
                                        <input type="number" data-validate-order data-telephone-field value="<?php echo $userPhone; ?>" class="form-control userPhoneField" id="num">
                                        <div class="invalid-feedback">
                                            Please enter a valid Phone Number for shipping updates.
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="address">Address</label>
                                    <input type="text" value="<?php echo $userAddress; ?>" class="form-control shippingAddress" data-validate-order="" id="address" required>
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 mb-4">
                                        <label for="country">Country</label>
                                        <select data-validate-order class="custom-select d-block w-100" id="country" required>
                                            <option value="PK">Pakistan</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="state">State/City</label>
                                        <input type="text" data-validate-order class="form-control userCity" value="<?php echo $userCity; ?>" id="city" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <label for="zip">Zip Code <span class="fc-secondary-400">(Optional)</span></label>
                                        <input type="text" class="form-control zipCode" value="<?php echo $userZip; ?>" id="zip" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Zip code required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="list-group-item mb-3">
                                <h4 class="mb-3">Select Payment Method</h4>
                                <input type="text" class="paymentMethodInput" hidden>
                                <div class="row my-3">
                                    <div class="input__wrap col-6">
                                        <input id="credit" value="debit" name="paymentMethod" hidden type="radio" class="payInputs" checked>
                                        <label class="btn btn-primary active btn-lg " for="credit">Credit Card</label>
                                    </div>
                                    <div class="input__wrap col-6">
                                        <input id="delivery" value="delivery" name="paymentMethod" hidden type="radio" class="payInputs">
                                        <label class="btn btn-primary btn-lg    " for="delivery">Cash On Delivery</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment">
                            <div class="card-payment list-group-item">
                                <div class="row">
                                    <div class="form-group col-12 mb-30">
                                        <div class=" d-flex justify-content-between">
                                            <strong class="fs-20 fw-500">Payment Amount:</strong>
                                            <div>
                                                <strong><?php echo $currencySymbol; ?></strong>
                                                <strong class="amount">0</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 mb-30">
                                        <label or="NameOnCard">Name on card</label>
                                        <input id="NameOnCard" class="form-control checkCardInfo" type="text" maxlength="255"></input>
                                        <div class="invalid-feedback">
                                            Please add a valid Name here.
                                        </div>
                                    </div>
                                    <div class="form-group col-12 mb-30">
                                        <label for="cardNum">Card number</label>
                                        <input id="cardNum" class="checkCardInfo null card-image form-control" type="text"></input>
                                        <div class="invalid-feedback">
                                            Please add a valid Card Number.
                                        </div>
                                    </div>
                                    <div class="expiry-date-group form-group col-lg-6 pr-1 mb-30">
                                        <label for="ExpiryDate">Expiry date</label>
                                        <input id="ExpiryDate" data-format="card-expiry-date" class="form-control checkCardInfo" type="text" placeholder="MM / YY" maxlength="7"></input>
                                        <div class="invalid-feedback">
                                            Please add an Expiry Date.
                                        </div>
                                    </div>
                                    <div class="security-code-group form-group col-lg-6 pl-1 mb-30">
                                        <label for="cvc checkCardInfo">Security code</label>
                                        <div class="input-container">
                                            <input id="cvc" class="checkCardInfo form-control" type="text"></input>
                                            <div class="invalid-feedback">
                                                Please add a valid CVC code.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-secondary btn-lg btn-block payWithCard" placeOrder data-order>Continue to checkout</button>
                            </div>
                        </div>
                        <div class="delivery hidden">
                            <div class="list-group-item">
                                <div class=" d-flex justify-content-between">
                                    <strong class="fs-20 fw-500">Payment Amount:</strong>
                                    <div>
                                        <strong><?php echo $currencySymbol; ?></strong>
                                        <strong class="amount">0</strong>
                                    </div>
                                </div>
                                <p class="pt-4  pb-3 text-center"> You have selected Cash On Delivery as your payment Option.</p>
                                <p class="pb-4 text-center"> You will have to pay <strong><?php echo $currencySymbol; ?></strong><strong class="amount"></strong> when the product arrives at your door step.</p>
                                <button class="btn btn-secondary btn-lg" placeOrder data-delivery-order>Place Your Order.</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("includes/footer-scripts.php"); ?>
    <script src="http://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script>
        $('#cardNum').mask('0000 0000 0000 0000');

        $('#cardNum').on('change', function() {
            // Get the unmasked value
            const unmaskedValue = $(this).cleanVal();

            // Define the minimum length
            const minLength = 16; // Adjust this value as needed

            if (unmaskedValue.length < minLength) {
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });

        $('#NameOnCard').on("change", function() {
            let regex = /^[a-zA-Z]+$/;
            test = regex.test($(this).val())
            if (test) {
                $(this).removeClass("error");
            } else {
                $(this).addClass("error");
            }
        })


        if (typeof $.fn.mask === "function") {
            $('[data-format="card-expiry-date"]').mask("AB/CD", {
                translation: {
                    A: {
                        pattern: /[0-9]/
                    },
                    B: {
                        pattern: /[0-9]/
                    },
                    C: {
                        pattern: /[2-9]/
                    },
                    D: {
                        pattern: /[0-9]/
                    }
                },
                onKeyPress: function(a, b, c, d) {
                    if (!a) return;
                    let m = a.match(/(\d{1})/g);
                    if (!m) return;
                    if (parseInt(m[0]) === 0) {
                        d.translation.B.pattern = /[1-9]/;
                    } else if (parseInt(m[0]) === 1) {
                        d.translation.B.pattern = /[0-2]/;
                    } else if (parseInt(m[0]) > 1) {
                        c.val("0" + m[0] + "/");
                    } else {
                        d.translation.B.pattern = /[0-9]/;
                    }
                    let temp_value = c.val();
                    c.val("");
                    c.unmask().mask("AB/CD", d);
                    c.val(temp_value);
                }
            }).keyup();

            $('[data-format="card-expiry-date"]').on('change', function() {
                const inputValue = $(this).cleanVal(); // Get the unmasked value

                // Check if the date is in the future
                const currentDate = new Date();
                const inputYear = parseInt(inputValue.substring(2, 4));
                const inputMonth = parseInt(inputValue.substring(0, 2));

                const currentYear = currentDate.getFullYear() % 100; // Get the current year as two digits
                const currentMonth = currentDate.getMonth() + 1; // Months are zero-based, so we add 1

                console.log(currentYear);
                console.log(inputYear);

                if (inputYear < currentYear || (inputYear === currentYear && inputMonth < currentMonth)) {
                    // Date is in the past or the current month
                    $(this).addClass('error');
                } else {
                    // Date is in the future
                    $(this).removeClass('error');
                }
            });
        }


        $("#cvc").mask("0000");
    </script>
</body>

</html>