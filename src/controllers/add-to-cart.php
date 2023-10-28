<?php
include '../config.php';
include '../functions.php';

if (isset($currentCustomer)) {
    $productId = $_POST["_thisId"];
    $thisProduct = checkCurrentProduct($productId);
    $customerId = $currentCustomer['Customer Id'];

    // Fetch the cart data for the current customer
    $query = "SELECT * FROM `cart` WHERE `Customer Id` = '$customerId'";
    $result = mysqli_query($connection, $query);

    // Check if the cart exists for the customer
    if ($result && $result->num_rows > 0) {
        $resultArray = $result->fetch_assoc();
        $previousProducts = $resultArray["Products"];
        $previousProductsQuantity = $resultArray["Product Quantity"];

        if (empty($previousProducts) || $previousProducts == "0") {
            // Cart is empty, so add the current product
            $newProducts = "$productId";
            $newQuantity = 1;

            $query = "UPDATE `cart` SET `Products` = '$newProducts', `Product Quantity` = '$newQuantity' WHERE `Customer Id` = '$customerId'";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                // echo "Couldn't Update Cart";
            }   else {
                // echo "CART WAS UPDATED";
            }
        } else {
            // Cart is not empty, check if the product exists
            $previousProductsArray = explode(",", $previousProducts);
            $previousProductsQuantityArray = explode(",", $previousProductsQuantity);
            $currentProductId = $thisProduct->SKU;

            // Check if the current product exists in the cart
            $productIndex = array_search($currentProductId, $previousProductsArray);

            if ($productIndex !== false) {

                //UPDATE QUANTITY:
                $newQuantity = (int)$previousProductsQuantityArray[$productIndex] + 1;
                $previousProductsQuantityArray[$productIndex] = $newQuantity;
                $incrementedQuantity = implode(",", $previousProductsQuantityArray);
                $query = "UPDATE `cart` SET  `Product Quantity` = '$incrementedQuantity' WHERE `Customer Id` = '$customerId'";
                $result = mysqli_query($connection, $query);
                if(!$result) {
                    // echo "Couldn't Update Quantity";
                } else {
                    // echo "Quantity Updated";
                }

            } else {
                $newProducts = $previousProducts . ",$productId";
                $newQuantity = $previousProductsQuantity . ", 1";

                $query = "UPDATE `cart` SET `Products` = '$newProducts', `Product Quantity` = '$newQuantity' WHERE `Customer Id` = '$customerId'";
                $result = mysqli_query($connection, $query);

                if (!$result) {
                    // echo "Couldn't Update Cart";
                }
            }
        }
    } else {
        // echo "<script>console.error('Cart Is Not Active For Some Reason: Check add-to-cart.php :16');</script>";
    }
} else {
    // echo "THERE IS NO CURRENT CUSTOMER";
}



fetchCartProducts($connection, $currentCustomer);
