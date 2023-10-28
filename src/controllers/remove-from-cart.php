<?php
include("../config.php");
include("../functions.php");

$productId = $_POST["_thisId"];
$customerId = $currentCustomer['Customer Id'];


$query = "SELECT * FROM `cart` WHERE `Customer Id` = '$customerId'";
$result = mysqli_query($connection, $query);
if ($result && $result->num_rows > 0) {
    $resultArray = $result->fetch_assoc();

    $previousProducts = $resultArray["Products"];
    $previousProductsQuantity = $resultArray["Product Quantity"];

    $previousProductsArray = explode(",", $previousProducts);
    $previousProductsQuantityArray = explode(",", $previousProductsQuantity);

    unset($previousProductsArray[$productId]);
    unset($previousProductsQuantityArray[$productId]);

    $previousProductsArray = array_values($previousProductsArray);
    $previousProductsQuantityArray = array_values($previousProductsQuantityArray);

    $newProducts = implode(",", $previousProductsArray);
    $newQuantity = implode(",", $previousProductsQuantityArray);

    $query = "UPDATE `cart` SET `Products` = '$newProducts', `Product Quantity` = '$newQuantity' WHERE `Customer Id` = '$customerId'";
    $result = mysqli_query($connection, $query);

    if($result) {
        echo "DONE";
    } else {
        echo "NOT DONE";
    }
}
