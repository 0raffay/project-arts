<?php
include("../config.php");
include("../functions.php");

$id = $_POST["id"];
$name = $_POST["value"];
echo $id;
echo $name;
Category::renameCategory($id, $name);
