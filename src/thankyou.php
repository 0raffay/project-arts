<?php include 'config.php'; ?>
<?php include 'functions.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- META TITLE AND DESCRIPTION -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- META TITLE AND DESCRIPTION -->


    <!--==== HEADER STYLES START ====-->
    <?php include('includes/header-styles.php') ?>
    <!--==== HEADER STYLES END ====-->
    <title>Thank you for placing an order | <?php echo $site__name; ?></title>
</head>

<body>

    <section class="checkout-header py-0 border-bottom-hr">
        <div class="container">
            <div class="py-2 d-flex justify-content-between align-items-center">
                <img src="assets/images/logos/logo-black.png" alt="reload">
                <a href="index.php" class="addHover">Go Back</a>
            </div>
        </div>
    </section>
    <section class="thankyouSection">
        <div class="container">
            <div class="row justify-content-center">
                <div class="my-5 py-5 text-center w-100 px-4">
                    <h2 class="mb-30">Your order has been placed.</h2>
                    <h4 class="fc-secondary fw-400 mb-20">
                        Order Details:
                    </h4>
                    <?php
                    if (isset($_SESSION["recentOrder"])) {
                        $recentOrder = $_SESSION["recentOrder"];
                    ?>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <th>Order No:</th>
                                <td><?php echo $recentOrder["OrderNum"] ?></td>
                            </tr>
                            <tr>
                                <th>Order Placed On:</th>
                                <td><?php echo $recentOrder["OrderDate"]; ?></td>
                            </tr>
                            <tr>
                                <th>Order Amount:</th>
                                <td><?php echo $currencySymbol; ?><?php echo $recentOrder["orderAmount"]; ?></td>
                            </tr>
                            <tr>
                                <th>Payment Method:</th>
                                <td><?php echo $recentOrder["paymentMethod"]; ?></td>
                            </tr>
                        </table>
                    <?php } else {
                        print_r("No recent Order");
                    } ?>

                    <p class="text-center mt-3">You will be able to check details of your order on <a href="customer-profile.php" class="addHover fc-secondary-400">profile page</a></p>
                    <div class="btn-group" style="margin-top:20px;">
                        <a href="index.php" class="btn btn-lg btn-secondary">SHOP MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>