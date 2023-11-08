<?php
include("../config.php");
include("../functions.php");

$keywords = $_POST["keyword"];

$matchingProducts = Product::sortProducts($keywords);

print_r($matchingProducts);
