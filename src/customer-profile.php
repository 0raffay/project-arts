<?php
include 'config.php';
include 'functions.php';

if (isset($_POST["logout"])) {
    setcookie("currentCustomer", "", time() - 3600, "/");
    header("location: index.php");
}

if(!isset($currentCustomer)) {
    header("location: index.php");
}


$message = ""; // Initialize the message variable

if (isset($_POST["updateCustomerDetails"])) {
    $name = $_POST['updatedName'];
    $password = $_POST['updatedPassword'];
    $phone = $_POST['updatedPhone'];

    $email = $_POST['updatedEmail'];
    $checkEmailQuery = "SELECT * FROM `customer` WHERE `Customer Email` = '$email' ";
    $emailResult = mysqli_query($connection, $checkEmailQuery);
    if ($emailResult->num_rows > 0) {
        $message = "Email Provided is linked to another account";
    } else {
        $customerId = $currentCustomer["Customer Id"];
        $query = "UPDATE `customer` SET `Customer Name` = '$name', `Customer Email` = '$email', `Customer Password` = '$password', `Customer Phone` = '$phone' WHERE `Customer Id` = '$customerId'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            $message = "Unknown error occurred."; // Corrected the spelling of "message"
        } else {
            $query = "SELECT * FROM `customer` WHERE `Customer Email` = '$email' ";
            $queryResult = mysqli_query($connection, $query);

            $row = $queryResult->fetch_assoc();
            $currentCustomer = $row;

            header("location: " . $_SERVER["PHP_SELF"]);
            $message = "Changes were saved"; // Corrected the spelling of "message"
        }
    }
}
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
    <title>Profile | <?php echo $site__name; ?></title>
</head>

<body>
    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->



    <section class="userProfileSection">
        <div class="container text-right">
            <h1 class="fw-400 text-center fs-45 mb-30">Account Details</h1>

            <div class="d-flex justify-content-between border-bottom-hr align-items-end">
                <div class="tabbingButtons userProfileTabbingButtons">
                    <button class="active">Details</button>
                    <button>Billing Details</button>
                    <button>Order History</button>
                </div>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                </form>
            </div>
            <div class="tabbingPanels py-5">
                <div class="tabbingPanel customer-details">
                    <h4 class="fw-300 pb-3 fs-24 text-center fc-secondary">Details</h4>
                    <div class="customer-details-container">
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <div class="wrap fs-20 mb-10 d-flex justify-content-between border-bottom-hr">
                                <div class="d-flex">
                                    <label class="mr-4 mb-0">Name:</label>
                                    <input name="updatedName" type="text" readonly value="<?php echo $currentCustomer["Customer Name"]; ?>">
                                </div>
                                <div>
                                    <button data-edit-details class="btn btn-secondary">Edit</button>
                                </div>
                            </div>
                            <div class="wrap fs-20 mb-10 d-flex justify-content-between border-bottom-hr">
                                <div class="d-flex">
                                    <label class="mr-4 mb-0">Email:</label>
                                    <input name="updatedEmail" type="email" readonly value="<?php echo $currentCustomer["Customer Email"]; ?>">
                                </div>
                                <div>
                                    <button data-edit-details class="btn btn-secondary">Edit</button>
                                </div>
                            </div>
                            <div class="wrap fs-20 mb-10 d-flex justify-content-between border-bottom-hr">
                                <div class="d-flex">
                                    <label class="mr-4 mb-0">Password:</label>
                                    <input name="updatedPassword" type="password" readonly value="<?php echo $currentCustomer["Customer Password"]; ?>">
                                </div>
                                <div>
                                    <button data-edit-details class="btn btn-secondary">Edit</button>
                                </div>
                            </div>
                            <div class="wrap fs-20 mb-10 d-flex justify-content-between">
                                <div class="d-flex">
                                    <label class="mr-4 mb-0">Phone:</label>
                                    <input name="updatedPhone" type="number" inputmode="numeric" readonly value="<?php echo $currentCustomer["Customer Phone"]; ?>">
                                </div>
                                <div>
                                    <button data-edit-details class="btn btn-secondary">Edit</button>
                                </div>
                            </div>

                            <p class="error-messages py-2 text-left"><?php echo $message; ?></p>
                            <div class="py-3 saveButton hidden">
                                <div class="text-right d-flex justify-content-between">
                                    <button class="btn btn-primary ml-auto" type="submit" name="updateCustomerDetails">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tabbingPanel customer-billing-details">
                    <h4 class="fw-300 pb-3 fs-24 text-center fc-secondary">Billing Address</h4>
                    <div class="row g-3 text-left">
                        <div class="col-md-12 mb-3">
                            <label for="your-name" class="form-label">Your Address:</label>
                            <input type="text" value="<?php echo $currentCustomer["Customer Address"]; ?>" data-address class="form-control" id="your-name" name="address" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="your-surname" class="form-label">City</label>
                            <input type="text" value="<?php echo $currentCustomer["Customer City"]; ?>" data-city class="form-control" id="your-surname" name="city" required>
                        </div>
                        <div class="col-md-12">
                            <label for="your-email" class="form-label">Zip Code</label>
                            <input type="email" data-zip class="form-control" value="<?php echo $currentCustomer["Customer Zipcode"]; ?>" id="your-email" name="zipcode" required>
                        </div>
                        <div class="col-md-12 text-right d-flex align-items-center justify-content-between">
                            <button class="btn btn-primary ml-auto mt-4" data-save-billing-details>Save Details</button>
                        </div>
                    </div>
                </div>
                <div class="tabbingPanel order-history">
                    <h4 class="fw-300 pb-3 fs-24 text-center fc-secondary">Order History</h4>
                    <?php
                    $orders = Customer::fetchOrders();
                    $orderCount = count($orders);
                    ?>
                    <div class="d-flex mb-10">
                        <p class="fs-16">No of Orders: <?php echo $orderCount; ?></p>
                    </div>

                    <?php if ($orderCount <= 0) { ?>
                        <div class="orderHistory">
                            <p class="text-center pt-5 fs-20 fw-400 fc-secondary-400">You have no orders.</p>
                        </div>
                    <?php } else { ?>
                        <table class="table text-left">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Placed On</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                    <th>Order Status</th>
                                    <th class="text-center">Manage:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($orders as $order) {
                                    $orderId = $order["Order Id"];
                                    $orderNum = $order["Order Number"];
                                    $orderType = $order["Order Type"];
                                    $orderAmount = $order["Order Amount"];
                                    $orderDate = $order["Order Date"];
                                    $orderItems = explode(",", $order["Order Items"]);
                                    $orderStatus = $order["Order Status"];
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo "#".$orderNum; ?>
                                        </td>
                                        <td>
                                            <?php echo $orderDate; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $productArray = array();
                                            foreach ($orderItems as $item) {
                                                $productArray[] = checkCurrentProduct($item);
                                            }

                                            foreach ($productArray as $product) { ?>
                                                <img class="orderImg" src="assets/images/product-images/<?php echo $product->images ?>">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $currencySymbol; ?><?php echo $orderAmount; ?>
                                        </td>
                                        <td>
                                            <?php echo $orderType; ?>
                                        </td>
                                        <td>
                                            <?php echo $orderStatus; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="order-status.php?order_id=<?php echo $orderId?>&order_num=<?php echo $orderNum;?>" class="addHover">View</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>

        </div>


    </section>

    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>