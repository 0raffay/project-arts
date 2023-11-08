<?php
    include("../config.php");
    include("../functions.php");

$id = $_POST["id"];
$name = $_POST["name"];
Category::renameCategory($id, $name);
