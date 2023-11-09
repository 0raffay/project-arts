<?php
include "../config.php";
include "../functions.php";
$email = $_POST["adminEmail"];
$pass = $_POST["adminPass"];

$loginResult = Admin::login($email, $pass);

if (isset($currentAdmin)) {
    echo "1"; 
} else {
    echo $loginResult;
}
