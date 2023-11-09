<?php
include("../config.php");
include("../functions.php");

$name = $_POST["adminName"];
$email = $_POST["adminEmail"];
$pass = $_POST["adminPass"];
$phone = $_POST["adminPhone"];
$rights = $_POST["adminRights"];

$result = Admin::createAdmin($name, $email, $phone,$pass, $rights);

if($result == "New Admin was created") {
    echo "1";
} else {
    echo "0";
}




?>