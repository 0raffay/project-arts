<?php
include("../config.php");
include("../functions.php");

$orderId = $_POST["id"];
$value = $_POST["value"];

// Get the current date
$currentDate = date('Y-m-d');

// Calculate the future date by adding 4 days to the current date
$futureDate = date('Y-m-d', strtotime($currentDate . ' + 4 days'));

$cancelQuery = "UPDATE `order` SET `Order Status` = '$value', `est_delivery_date` = '$futureDate'  WHERE `Order Id` = '$orderId'";
$result = mysqli_query($connection, $cancelQuery);

if ($result) {
    echo "Order Status Updated";
} else {
    echo "Failed to update Status";
}
?>
