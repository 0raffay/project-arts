<?php
include("../config.php");
include("../functions.php");

$sku = $_POST['sku'];
$name = $_POST['name'];
$price = $_POST['price'];
$brand = $_POST['brand'];
$category = $_POST['category'];
$stock = $_POST['stock'];
$description = $_POST['description'];
$keywords = $_POST['keywords'];
$warranty = $_POST['warranty'];

// Perform the update query
$query = "UPDATE `products` SET 
            `Product Name` = '$name',
            `Product Price` = '$price',
            `Product Brand` = '$brand',
            `Product Category` = '$category',
            `Product Stock` = '$stock',
            `Product Description` = '$description',
            `Keywords` = '$keywords',
            `Warranty` = '$warranty'
          WHERE 
            `Product SKU` = '$sku'";

$result = mysqli_query($connection, $query);

if ($result) {
    echo "Product updated successfully!";
}
