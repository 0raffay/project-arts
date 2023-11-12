<?php include 'config.php'; ?>
<?php include 'functions.php';

$customerId = $currentCustomer["Customer Id"];
$orderNum = $_GET["order_num"];
$orderId = $_GET["order_id"];

if (!isset($orderId)) {
    header("location: index.php");
}
if (!isset($currentCustomer)) {
    header("location: index.php");
}




$query = "SELECT * FROM `order` WHERE `Customer Id` = '$customerId' AND `Order Id` = $orderId";
$returned = returnerBySqlQuery($query);

// print_r($returned);
if ($returned == "0") {
    header("location: index.php");
}



$orderDate = $returned["Order Date"];


$date = DateTime::createFromFormat('m-d-y', $orderDate);

// Format the DateTime object in the desired output format
$outputDate = $date->format("M jS, Y");
$orderStatus = $returned["Order Status"];
$orderAmount = $returned["Order Amount"];
$orderAddress = $returned["Order Address"];
$orderCity = $returned["Order City"];
$orderPhone = $returned["Order Phone"];
$orderItems = explode(",", $returned["Order Items"]);
$orderItemsQuantity = explode(",", $returned["Order Items Quantity"]);
$reason =  $returned["reason"];
$orderEstDate =  $returned["est_delivery_date"];



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
    <title>Order Status | <?php echo $site__name; ?></title>
</head>

<body>

    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->

    <section>
        <div class="container mt-3 mt-md-5">

            <h2 class="fs-28 fw-500 mb-20">Your Order</h2>

            <div class="row">
                <div class="col-12">
                    <div class="list-group mb-5">
                        <div class="list-group-item p-3 bg-snow" style="position: relative;">
                            <div class="row w-100 no-gutters">
                                <div class="col-6 col-md">
                                    <h6 class="text-charcoal mb-0 w-100">Order Number</h6>
                                    <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">#<?php echo $orderNum; ?></p>
                                </div>
                                <div class="col-6 col-md">
                                    <h6 class="text-charcoal mb-0 w-100">Order Date</h6>
                                    <p class="text-pebble mb-0 w-100 mb-2 mb-md-0"><?php echo $outputDate; ?></p>
                                </div>
                                <div class="col-6 col-md">
                                    <h6 class="text-charcoal mb-0 w-100">Total</h6>
                                    <p class="text-pebble mb-0 w-100 mb-2 mb-md-0"><?php echo $currencySymbol . $orderAmount ?></p>
                                </div>
                                <div class="col-6 col-md">
                                    <h6 class="text-charcoal mb-0 w-100">Shipping Details</h6>
                                    <div class="py-1">
                                        <div class="d-flex">
                                            <p class="fs-14 text-pebble mb-0 w-100 mb-2 mb-md-0">
                                                Address:
                                            </p>
                                            <p class="fs-14 text-pebble mb-0 w-100 mb-2 mb-md-0">
                                                <?php echo $orderAddress; ?>
                                            </p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="fs-14 text-pebble mb-0 w-100 mb-2 mb-md-0">
                                                City:
                                            </p>
                                            <p class="fs-14 text-pebble mb-0 w-100 mb-2 mb-md-0">
                                                <?php echo $orderCity; ?>
                                            </p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="fs-14 text-pebble mb-0 w-100 mb-2 mb-md-0">
                                                Phone:
                                            </p>
                                            <p class="fs-14 text-pebble mb-0 w-100 mb-2 mb-md-0">
                                                <?php echo $orderPhone; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="list-group-item p-3 bg-white">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-12 pr-0 pr-md-3">

                                    <?php
                                    if ($orderStatus == "processing") {
                                    ?>
                                        <div class="alert p-2 alert-warning w-100 mb-0">
                                            <h6 class="text-green mb-0"><b>Processing</b></h6>
                                            <p class="text-green hidden-sm-down mb-0">
                                                Your order is being processed.
                                            </p>
                                        </div>
                                    <?php } else if ($orderStatus == "shipped") { ?>
                                        <div class="alert p-2 alert-primary  w-100 mb-0">
                                            <h6 class="text-green mb-0"><b>Shipped</b></h6>
                                            <p class="text-green hidden-sm-down mb-0">
                                                <?php
                                                $timestamp = strtotime($orderEstDate);

                                                $formattedDate = date("M jS, Y", $timestamp);

                                                ?>
                                                Est. delivery is <?php echo $formattedDate ?>
                                            </p>
                                        </div>
                                    <?php } else if ($orderStatus == "delivered") { ?>
                                        <div class="alert p-2 alert-success w-100 mb-0">
                                            <h6 class="text-green mb-0"><b>Delivered</b></h6>
                                            <p class="text-green hidden-sm-down mb-0">
                                                Your order was Delivered on <?php echo date("d M, Y"); ?>
                                                <br class="d-block">
                                                Thank you for purchasing.
                                            </p>
                                        </div>
                                    <?php } else if ($orderStatus == "cancelled") { ?>
                                        <div class="alert p-2 alert-danger w-100 mb-0">
                                            <h6 class="text-green mb-0"><b>Cancelled</b></h6>
                                            <p class="text-green hidden-sm-down mb-0">
                                                You order was cancelled.
                                                <?php echo $reason; ?>
                                            </p>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="col-12 col-md-12 ">
                                    <?php
                                    foreach (Product::$instances as $product) {
                                        if (in_array($product->SKU, $orderItems)) {
                                            // print_r($productsInCart);
                                            $productIndex  = array_search($product->SKU, $orderItems);
                                            $productQuantity = $orderItemsQuantity[$productIndex];
                                    ?>
                                            <div class="row no-gutters mt-3">
                                                <div class="col-3 col-md-1">
                                                    <img class="img-fluid pr-3" src="assets/images/product-images/<?php echo $product->images; ?>" alt="">
                                                </div>
                                                <div class="col-9 col-md-8 pr-0 pr-md-4">
                                                    <h6 class="text-charcoal mb-2 mb-md-1">
                                                        <a target="_blank" href="single-product.php?id=<?php echo $product->SKU; ?>" class="text-charcoal"><?php echo $product->name; ?></a>
                                                    </h6>
                                                    <ul class="list-unstyled text-pebble mb-2 fs-15">
                                                        <li class="">
                                                            <b>Quantity:</b> <?php echo $productQuantity; ?>
                                                        </li>
                                                        <?php if ($product->warranty !== "") { ?>
                                                            <li class="">
                                                                <b>Warranty Info:</b> <?php echo $product->warranty; ?>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                    <h6 class="text-charcoal text-left mb-0 mb-md-2"><b><?php echo $currencySymbol . ($product->price * $productQuantity); ?></b></h6>
                                                </div>
                                                <div class="col-12 col-md-3 hidden-sm-down">
                                                    <?php
                                                    if ($orderStatus == "processing" || $orderStatus == "shipped") {
                                                    ?>
                                                        <a href="" class="btn btn-primary mb-10 w-100 mb-2">Buy It Again</a>
                                                    <?php }
                                                    if ($product->warranty != "" && $orderStatus == "delivered") {
                                                    ?>
                                                        <button data-toggle="modal" item-quan="<?php echo $productQuantity;?>" data-item="<?php echo $product->SKU;?>" data-target="#returnModal" class="returnButton btn btn-primary mb-10 w-100">Claim Warranty</button>
                                                    <?php }
                                                    if ($orderStatus == "delivered") { ?>
                                                        <button item-quan="<?php echo $productQuantity;?>" data-item="<?php echo $product->SKU;?>" data-toggle="modal" data-target="#returnModal" class="returnButton btn btn-primary mb-10 w-100">
                                                            Return Item
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                    <?php }
                                    } ?>


                                </div>
                            </div>
                        </div>

                        <?php
                        if ($orderStatus == "processing") {
                        ?>
                            <div class="list-group-item">
                                <button class="btn d-block ml-auto  btn-outline-danger" data-cancel-order data-id="<?php echo $orderId; ?>" data-cancel-by="Customer">Cancel Order</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
    </section>

    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-24" id="returnModal">Submit Return</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input class="returnItem" hidden>
                    <input class="returnItemQuantity" hidden>
                    <div class="col-12 d-none">
                        <div class="input__wrap">
                            <label for="">Add a tracking No. (required)</label>
                            <input type="text" class="border py-2 px-2" id="trackingDetails">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="">
                            Write Reason for your return</label>
                        <textarea class="border py-2 px-2 d-block w-100" id="returnDetails"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between" style="min-height: 70px">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary" id="confirmReturnBtn" data-customer-id="<?php echo $customerId; ?>" data-order-num="<?php echo $orderNum; ?>" data-order-id="<?php echo $orderId; ?>">
                    Confirm Return
                </button>


            </div>
        </div>
    </div>
</div>

</html>