<?php
include 'config.php';
include 'functions.php';

if ($currentCustomer == null) {
    header("location: index.php");
}

$userName = $currentCustomer["Customer Name"];
$userEmail = $currentCustomer["Customer Email"] ;
$userAddress = $currentCustomer["Customer Address"];
$userPhone = $currentCustomer["Customer Phone"];

print_r($currentCustomer);

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
    <title>Home | <?php echo $site__name; ?></title>
</head>

<body>
    <section class="checkout-header py-0 border-bottom-hr">
        <div class="container">
            <div class="py-2 d-flex justify-content-between align-items-center">
                <img src="assets/images/logos/logo-black.png" alt="reload">
                <a href="index.php" class="addHover">Go Back</a>
            </div>
        </div>
    </section>


    <section class="checkout-section my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
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
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Name</label>
                                <input type="text" value="<?php echo $userName;?>" class="form-control" id="firstName" placeholder=""  required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" value="<?php echo $userEmail;?>" class="form-control" id="email">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" value="<?php echo $userAddress;?>" class="form-control" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country</label>
                                <select class="custom-select d-block w-100" id="country" required>
                                    <option value="PK">Pakistan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State/City</label>
                                <input type="text" class="form-control" value="" id="city" placeholder="" required>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip Code <span class="fc-secondary-400">(Optional)</span></label>
                                <input type="text" class="form-control" id="zip" placeholder="" required>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <h4 class="mb-3">Payment</h4>

                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="credit">Credit card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="debit">Debit card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="paypal">PayPal</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include("includes/footer-scripts.php"); ?>
</body>

</html>