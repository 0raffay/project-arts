<?php
include("../config.php");
include("../functions.php");

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$message = $_POST["message"];

Messages::createMessage($name, $email, $phone, $message);


