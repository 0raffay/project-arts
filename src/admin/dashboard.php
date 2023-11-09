<?php
include("../config.php");
include('../functions.php');

if(!isset($currentAdmin)) {
    header("location: index.php");
}
//UPLOAD PRODUCT
$_SESSION['productUploadStatus'] = '';
$productUploadStatus =  $_SESSION['productUploadStatus'];

if (isset($_POST['uploadNewProduct'])) {
    $_SESSION['productUploadStatus'] = "";
}

if (isset($_POST["uploadProduct"])) {
    Product::uploadProduct($connection);
}

$customerData = Customer::getAllCustomerData($connection);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!--==== HEADER STYLES START ====-->
    <?php include('../includes/header-styles.php') ?>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

    <link rel="shortcut icon" href="../assets/images/logos/favicon/favicon.ico" type="image/x-icon">
    <!--==== HEADER STYLES END ====-->

    <title>Dashboard | <?php echo $site__name . " Admin"; ?></title>
</head>

<body class="dashboard-body">

    <!-- DASHBOARD HEADER START -->
    <?php include('includes/header.php'); ?>
    <!-- DASHBOARD HEADER END -->


    <main id="wrapper">

        <div class="loader center"></div>
        <div class="row">
            <!-- SIDEBAR START -->
            <div class="col-sm-2 col-lg-2 col-md-2 no-padding">
                <?php include('includes/sidebar.php') ?>
            </div>
            <!-- SIDEBAR END -->

            <!-- SECTIONS START -->
            <div class="col-sm-10 col-lg-10 col-md-10 no-padding dashboard-wrapper">
                <div class="pb-4 px-5 showAdminSections">
                    <?php include('sections/products.php'); ?>
                    <?php include('sections/customer.php'); ?>
                    <?php include('sections/category.php'); ?>
                    <?php include('sections/orders.php'); ?>
                    <?php include('sections/employee.php'); ?>
                </div>
            </div>
            <!-- SECTIONS END -->
        </div>
    </main>


    <!--==== FOOTER START ====-->
    <?php include('../includes/footer-scripts.php') ?>
    <script src="../assets/js/libs.js"></script>
    <script src="../assets/js/script.js"></script>
    <!--==== FOOTER END ====-->
</body>

</html>