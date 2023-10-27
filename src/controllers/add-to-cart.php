<?php
include '../config.php';
include '../functions.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($currentCustomer)) {
        $customerId = $currentCustomer['Customer Id'];
        print_r($customerId);
        $query = "SELECT * FROM `cart` WHERE `Customer Id` = '$customerId'";
        $result = mysqli_query($connection, $query);
        if ($result && $result->num_rows > 0) {
            function insertIntoCartTable($connection,$customerId, $currentProductString, $currentCustomer)
            {
                $insertQuery = "UPDATE `cart` SET `Products` = '$currentProductString' WHERE `Customer Id` = '$customerId'";
                $insertResult = mysqli_query($connection, $insertQuery);
                if ($insertResult) {
                    echo "UPDATED CART";
                    Customer::updateCart($connection, $customerId, $currentCustomer);
                } else {
                    echo "CART NOT UPDATED";
                }
            }
            $cartProducts = array();
            if (isset($currentProduct)) {
                $cartProducts[] = $currentProduct;
                $productString = json_encode($cartProducts, true);
                insertIntoCartTable($connection,$customerId, $productString,$currentCustomer);
            } else {
                $productId = $_POST["_thisId"];
                checkCurrentProduct($productId);
                $cartProducts[] = $currentProduct;
                $productString = json_encode( $cartProducts, true);
                insertIntoCartTable($connection,$customerId, $productString, $currentCustomer);
                print_r($currentCustomer);
            }
        } else {
            echo "<script>console.error(Cart Is Not Active For Some Reason: Check add-to-cart.php :16);</script>";
        }
    } else {
        print_r("THERE IS NO CURRENT CUSTOMER;");
    }
} else {
    echo "INVALID REQUEST SUBMISSION";
}
