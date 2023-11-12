<?php

include("../config.php");
include("../functions.php");

$thisId = $_POST["id"];

$_returned = Customer::fetchSpecificProducts('Order Id',$thisId);
$returned = $_returned[0];

$orderItems = explode(",", $returned["Order Items"]);
$orderItemsQuantity = explode(",", $returned["Order Items Quantity"]);

$customerId = $returned["Customer Id"];
$customerQuery = "SELECT * FROM `customer` WHERE `Customer Id` = $customerId";

$customerData = returnerBySqlQuery($customerQuery);

$customerName = $customerData["Customer Name"];
$customerAddress = $returned["Order Address"];
$customerCity = $returned["Order City"];
$customerPhone = $returned["Order Phone"];

$orderTotal = $returned["Order Amount"];
$orderStatus = $returned["Order Status"];
$orderNum = $returned["Order Number"];
$orderDate = $returned["Order Date"];
$orderType = $returned["Order Type"];
$orderId = $returned["Order Id"];

$data_array = array(
    "customerName"=>$customerName,
    "customerAddress"=>$customerAddress,
    "customerCity"=>$customerCity,
    "customerPhone"=>$customerPhone,
    "orderItems"=>$orderItems,
    "orderItemsQuantity"=>$orderItemsQuantity,
    "orderTotal"=>$orderTotal,
    "orderStatus"=>$orderStatus,
    "orderNum"=>$orderNum,
    "orderDate"=>$orderDate,
    "orderType"=>$orderType,
    "orderId"=>$orderId
);


print_r(json_encode($data_array));



// print_r(json_encode($returned));


