<?php

include "../config.php";
include "../functions.php";

$index = $_POST["index"];
$value = $_POST["value"];
$product = $_POST["product"];

Customer::editProductQuantityInCart($connection,$product, $index, $value);


?>