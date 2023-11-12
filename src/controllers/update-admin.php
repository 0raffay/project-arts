<?php
include("../config.php");
include("../functions.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    // Add validation logic here if needed

    // Call the updateDetails function
    $updateResult = Admin::updateDetails($name, $email, $phone, $password);

    if ($updateResult === true) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $updateResult]);
    }
}
