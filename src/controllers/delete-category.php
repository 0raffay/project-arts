<?php
include("../config.php");
include("../functions.php");

$id = $_POST["id"];
Category::deleteCategory($id);
