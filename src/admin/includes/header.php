<?php

if (isset($_POST["logoutAdmin"])) {
    $_POST["logoutAdmin"] = null;
    session_destroy();
    header("location: index.php");
}

$employee = $currentAdmin["Rights"] == 2;

?>

<header class="dashboard--header">
    <div class="container-fluid py-3 border-bottom-hr px-5">
        <div class="row align-items-center justify-content-between">
            <div class="logo col-1">
                <a href="dashboard.php"><img src="../assets/images/logos/logo-black.png" alt="Logo"></a>
            </div>

            <?php
            if (!$employee) {
                $orderData = Customer::fetchAllOrders();
                $totalSales = 0;
                foreach($orderData as $order) {
                    $orderStatus =  $order["Order Status"];
                    if($orderStatus != "cancelled") {
                        $totalSales+= $order["Order Amount"];
                    } 
                }

            ?>
                <div class="row text-center col-6 pt-4">
                    <div class="col-7 ml-auto">
                        <ul class="list-group">
                            <li class="list-group-item bg-secondary fc-white">Total Sales:</li>
                            <li class="list-group-item fw-600"><?php echo $currencySymbol; ?><?php echo $totalSales;?></li>
                        </ul>
                    </div>
                </div>

            <?php  } ?>


            <div class="wrapper col-4  d-flex flex-column  justify-content-center gap-10">

                <div class="headerOptions d-flex align-items-center justify-content-end gap-5">
                    <div class="dashboard--profile mluto">
                        <button data-show=".admin-profile"><i class="ri-user-3-line"></i></button>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-10">
                    <a href="../index.php" class="addHover fs-16">Visit Site</a>

                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" class="w-25">
                        <button name="logoutAdmin" class=" btn btn-primary btn-lg" href="../index.php">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>