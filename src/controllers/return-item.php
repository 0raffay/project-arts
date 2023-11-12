<?php
include("../config.php");
include("../functions.php");

$customerId = $currentCustomer["Customer Id"];
$orderNum = $_POST["orderNum"]; // Change this line
$orderId = $_POST["orderId"];   // Change this line
$returnStatus = "returned";
$returnDetails = $_POST["returnDetails"];
$returnItem = $_POST["returnItem"];
$returnItemQuantity = $_POST["orderItemQuan"];

$return = Returns::createReturn($orderId, $orderNum, $customerId, $returnItem, $returnItemQuantity, $returnDetails, $returnStatus);

print_r($return);
?>
