<?php
include("../config.php");
include("../functions.php");

$id = $_POST["id"];
$name = $_POST["name"];
$message = $_POST["message"];

Feedback::createReview($id, $name, $message);