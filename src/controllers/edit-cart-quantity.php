<?php

include "../config.php";
include "../functions.php";

$index = $_POST["index"];
$value = $_POST["value"];

Customer::editProductQuantityInCart($connection, $index, $value)

?>