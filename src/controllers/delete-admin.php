<?php
include("../config.php");
include("../functions.php");

$id = $_POST["adminId"];

Admin::deleteAdmin($id);
