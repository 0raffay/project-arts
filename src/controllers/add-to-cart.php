<?php
include '../config.php';
include '../functions.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($currentCustomer)) {
        $productId = $_POST["_thisId"];
        $thisProduct = checkCurrentProduct($productId);

        $customerId = $currentCustomer['Customer Id'];
        $query = "SELECT * FROM `cart` WHERE `Customer Id` = '$customerId'";
        $result = mysqli_query($connection, $query);

        if ($result && $result->num_rows > 0) {
            function insertIntoCartTable($connection, $customerId, $allProducts)
            {
                $insertQuery = "UPDATE `cart` SET `Products` = '$allProducts' WHERE `Customer Id` = '$customerId'";
                $insertResult = mysqli_query($connection, $insertQuery);
                if ($insertResult) {
                    echo "UPDATED CART";
                } else {
                    echo "CART NOT UPDATED";
                }
            }

            $allProducts = array();
            $previousProducts = json_decode($result->fetch_assoc()["Products"], true);

            if ($previousProducts && isset($previousProducts["products"])) {
                // If cart is not empty, add the product to the existing products array.
                $allProducts = $previousProducts;
                $allProducts["products"][] = $thisProduct;
            } else {
                // If cart is empty or has no 'products' key, create a new cart.
                $allProducts = ["products" => [$thisProduct]];
            }
            insertIntoCartTable($connection, $customerId, json_encode($allProducts));
        } else {
            echo "<script>console.error('Cart Is Not Active For Some Reason: Check add-to-cart.php :16');</script>";
        }
    } else {
        print_r("THERE IS NO CURRENT CUSTOMER;");
    }
} else {
    echo "INVALID REQUEST SUBMISSION";
}
