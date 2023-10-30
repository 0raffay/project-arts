<?php
include("../config.php");
include("../functions.php");

$address = $_POST["address"];
$city = $_POST["city"];
$zip = $_POST["zip"];
$return = Customer::setBillingDetails($connection, $address, $city, $zip);

echo $return;