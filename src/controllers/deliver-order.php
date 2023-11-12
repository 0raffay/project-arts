<?php
include("../config.php");
include("../functions.php");

$orderId = $_POST["id"];
$value = "delivered";
$currentDate = date('Y-m-d');

$cancelQuery = "UPDATE `order` SET `Order Status` = '$value', `delivery_date` = '$currentDate'  WHERE `Order Id` = '$orderId'";
$result = mysqli_query($connection, $cancelQuery);

if ($result) {
    echo "Order Status Updated";
} else {
    echo "Failed to update Status";
}
?>
