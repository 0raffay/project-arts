<?php
include("../config.php");
include("../functions.php");

$orderId = $_POST["orderId"];
$cancelBy = $_POST["cancelBy"];
$cancel = "cancelled";

$cancelQuery = "UPDATE `order` SET `Order Status` = '$cancel', `cancel_by`='$cancelBy' WHERE `Order Id` = '$orderId'";
$result = mysqli_query($connection, $cancelQuery);

if ($result) {
    $orderQuery = "SELECT *  FROM `order` WHERE `Order Id` = '$orderId'";
    $orderResult = mysqli_query($connection, $orderQuery);

    if ($orderResult) {
        $order = $orderResult->fetch_assoc();
    } 

    $orderItems = $order["Order Items"];
    $orderQuantity = $order["Order Items Quantity"];
    $products = explode(",", $orderItems);
    $productQuantity = explode(",", $orderQuantity);

    foreach ($products as $product) {
        $productIndex = array_search($product, $products);
        $thisProductQuantity = $productQuantity[$productIndex];

        $currentQuantityQuery = "SELECT `Product Stock` FROM `products` WHERE `Product SKU` = '$product'";
        $currentQuantityResult = mysqli_query($connection, $currentQuantityQuery);

        if ($currentQuantityResult) {
            $currentQuantityRow = mysqli_fetch_assoc($currentQuantityResult);
            $currentQuantity = $currentQuantityRow['Product Stock'];

            $updatedQuantity = $currentQuantity + $thisProductQuantity;

            $quantityUpdateQuery = "UPDATE `products` SET `Product Stock`='$updatedQuantity' WHERE `Product SKU` = '$product'";
            $quantityUpdateResult = mysqli_query($connection, $quantityUpdateQuery);

            if ($quantityUpdateResult) {
                echo "Product Qantity Was Updated";
            } else {
                echo "0";
            }
        }
    }


    echo "Order Cancelled";
} else {
    echo "Failed to cancel order";
}
