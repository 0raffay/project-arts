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
                        <h4 class="mb-3">Billing address</h4>
                        <div>
                            <div class="list-group-item mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName">Name</label>
                                        <input type="text" data-validate-order value="<?php echo $userName; ?>" class="form-control" id="firstName" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" data-validate-order data-validate-email value="<?php echo $userEmail; ?>" class="form-control" id="email">
                                        <div class="invalid-feedback">
                                            Please enter a valid email address for shipping updates.
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="num">Phone</label>
                                    <input type="number" value="<?php echo $userPhone; ?>" class="form-control" id="num">
                                    <div class="invalid-feedback" data-telephone-field>
                                        Please enter a valid Phone Number for shipping updates.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" data-validate-order value="<?php echo $userAddress; ?>" class="form-control" id="address" required>
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label for="country">Country</label>
                                        <select data-validate-order class="custom-select d-block w-100" id="country" required>
                                            <option value="PK">Pakistan</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="state">State/City</label>
                                        <input type="text" data-validate-order class="form-control" value="<?php echo $userCity; ?>" id="city" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="zip">Zip Code <span class="fc-secondary-400">(Optional)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $userZip; ?>" id="zip" placeholder="" required>
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
                                <form>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class=" d-flex justify-content-between">
                                                <strong class="fs-20 fw-500">Payment Amount:</strong>
                                                <div>
                                                    <strong><?php echo $currencySymbol; ?></strong>
                                                    <strong class="amount">0</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label or="NameOnCard">Name on card</label>
                                            <input id="NameOnCard" class="form-control checkCardInfo" type="text" maxlength="255"></input>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="cardNum">Card number</label>
                                            <input id="cardNum" class="null card-image form-control" type="text"></input>
                                        </div>
                                        <div class="expiry-date-group form-group col-lg-6 pr-1">
                                            <label for="ExpiryDate">Expiry date</label>
                                            <input id="ExpiryDate" class="form-control checkCardInfo" type="text" placeholder="MM / YY" maxlength="7"></input>
                                        </div>
                                        <div class="security-code-group form-group col-lg-6 pl-1">
                                            <label for="SecurityCode checkCardInfo">Security code</label>
                                            <div class="input-container">
                                                <input id="SecurityCode" class="form-control" type="text"></input>
                                            </div>
                                            <div class="cvc-preview-container two-card hide">
                                                <div class="amex-cvc-preview"></div>
                                                <div class="visa-mc-dis-cvc-preview"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-secondary btn-lg btn-block payWithCard" data-order>Continue to checkout</button>
                                </form>
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
                                <button class="btn btn-secondary btn-lg" data-order>Place Your Order.</button>
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
    </script>
</body>

</html>