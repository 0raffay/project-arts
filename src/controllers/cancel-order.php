<?php
include("../config.php");
include("../functions.php");

$orderId = $_POST["orderId"];
$cancelBy = $_POST["cancelBy"];
$cancel = "cancelled";

$cancelQuery = "UPDATE `order` SET `Order Status` = '$cancel', `cancel_by`='$cancelBy' WHERE `Order Id` = '$orderId'";
$result = mysqli_query($connection, $cancelQuery);

if ($result) {
    echo "Order Cancelled";
} else {
    echo "Failed to cancel order";
}
?>
