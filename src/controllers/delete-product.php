<?php
include("../config.php");
include("../functions.php");

$sku = $_POST["id"];

Product::deleteProduct($sku);