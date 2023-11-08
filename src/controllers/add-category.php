<?php
    include("../config.php");
    include("../functions.php");

    $name = $_POST["categoryName"];
    Category::createCategory($name);
