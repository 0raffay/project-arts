<?php
include "../config.php";
include "../functions.php";

$address = $_POST["shipping_detail"]["address"];
$city = $_POST["shipping_detail"]["city"];
$phone = $_POST["shipping_detail"]["phone"];
$orderType = $_POST["order_type"];
$cartTotal = $_POST["order_total"];
$cart;
$customerId = $currentCustomer["Customer Id"];
function generateRandomOrderNumber()
{
    $orderNumber = '';
    for ($i = 0; $i < 12; $i++) {
        $orderNumber .= rand(0, 9);
    }
    return $orderNumber;
}
$orderNumber = generateRandomOrderNumber();
$cartQuery = "SELECT *  FROM `cart` WHERE `Customer Id` = '$customerId'";
$cartResult = mysqli_query($connection, $cartQuery);

if ($cartResult) {
    $cart = $cartResult->fetch_assoc();
} else {
    echo "Something went wrong";
}

$orderItems = $cart["Products"];
$orderQuantity = $cart["Product Quantity"];

$date = date("d-m-y");

$query = "INSERT INTO `order` (`Order Id`, `Order Number`, `Customer Id`, `Order Type`, `Order Amount`, `Order Date`, `Order Items`, `Order Items Quantity`, `Order Status`) VALUES (NULL, '$orderNumber', '$customerId', '$orderType', '$cartTotal', '$date', '$orderItems', '$orderQuantity', 'In Process')";

$result = mysqli_query($connection, $query);

if ($result) {


    $query = "UPDATE `cart` SET `Products` = '', `Product Quantity` = '' WHERE `Customer Id` = '$customerId'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        echo "Couldn't Update Cart";
    } else {
        echo "CART WAS UPDATED";

        $recentProduct = array(
            "OrderNum" => "$orderNumber",
            "OrderDate" => "$date",
            "deliveryDate" => "24.24.24",
            "orderAmount" => $cartTotal,
            "paymentMethod" => $orderType,
        );

        $_SESSION["recentOrder"] = $recentProduct;
    }
} else {
    echo "Nahi yar";
}
