<div class="position-relative orders-section">
    <div class="order-section">
        <div class="text-left">
            <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Orders/Sales:</h4>
        </div>
        <div class="d-flex border-bottom-hr justify-content-between py-3">
            <div class="d-flex align-items-center gap-10">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="search--bar fw-300 fs-16">
                        <span class="mr-2 addHover"><button type="submit" name="searchProduct">Search</button> <input required style="display: inline; width: auto;" type="text"></span><i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </form>
                <button data-view-all-products class="addHover border-right active">View All</button>
                <p class="fs-16 border-right"><span class="fc-secondary fw-500">Total No. Of Orders:</span> <?php echo count(Customer::fetchAllOrders()); ?></p>
            </div>
        </div>

        <div class="ordersAreaButton">
            <div class="row py-4">
                <div class="col-lg-6 pl-2">
                    <button data-show-orders=".allOrders" class="btn btn-primary btn-lg active">Orders To Fulfill</button>
                </div>
                <div class="col-lg-6 pr-2">
                    <button data-show-orders=".filledOrders" class="btn btn-primary btn-lg">Fullfilled Orders</button>
                </div>
            </div>
        </div>

        <div class="orderArea">
            <div class="allOrders">
                <?php
                $orders = Customer::fetchAllOrders();
                $orderCount = count($orders);
                ?>
                <div class="d-flex mb-10 justify-content-between">
                    <p class="fs-16">No of Orders: <?php echo $orderCount; ?></p>
                </div>
                <?php if ($orderCount <= 0) { ?>
                    <div class="orderHistory d-flex">
                        <p class="text-center pt-5 fs-20 fw-400 fc-secondary-400">No Orders are shipped yet.</p>
                    </div>
                <?php } else { ?>

                    <h4 class="text-center pb-4">Order To Fulfill:</h4>
                    <table class="table text-left">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Placed On</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Payment Method</th>
                                <th>Order Status</th>
                                <th class="text-center">Info:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($orders as $order) {
                                $orderNum = $order["Order Number"];
                                $orderType = $order["Order Type"];
                                $orderAmount = $order["Order Amount"];
                                $orderDate = $order["Order Date"];
                                $orderItems = explode(",", $order["Order Items"]);
                                $orderStatus = $order["Order Status"];
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $orderNum; ?>
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
                                            <img class="orderImg" src="../assets/images/product-images/<?php echo $product->images ?>">
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
                                        <a href="" class="addHover">Manage</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
            <div class="filledOrders hidden">
                <?php
                $orders = Customer::fetchSpecificProducts('Order Status' ,'Delivered');
                $orderCount = count($orders);
                ?>
                <div class="d-flex mb-10 justify-content-between">
                    <p class="fs-16">No of Orders: <?php echo $orderCount; ?></p>
                </div>
                <?php if ($orderCount <= 0) { ?>
                    <div class="orderHistory d-flex">
                        <p class="text-center pt-5 fs-20 fw-400 fc-secondary-400">No orders are placed on the website yet.</p>
                    </div>
                <?php } else { ?>

                    <h4 class="text-center pb-4">Fulfilled Orders:</h4>
                    <table class="table text-left">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Order Date</th>
                                <th>Delivery Date:</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Payment Method</th>
                                <th>Order Status</th>
                                <th class="text-center">Info:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($orders as $order) {
                                $orderNum = $order["Order Number"];
                                $orderType = $order["Order Type"];
                                $orderAmount = $order["Order Amount"];
                                $orderDate = $order["Order Date"];
                                $orderItems = explode(",", $order["Order Items"]);
                                $orderStatus = $order["Order Status"];
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $orderNum; ?>
                                    </td>
                                    <td>
                                        <?php echo $orderDate; ?>
                                    </td>
                                    <td>
                                        <?php echo '24.24.24    '; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $productArray = array();
                                        foreach ($orderItems as $item) {
                                            $productArray[] = checkCurrentProduct($item);
                                        }
                                        foreach ($productArray as $product) { ?>
                                            <img class="orderImg" src="../assets/images/product-images/<?php echo $product->images ?>">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $currencySymbol; ?><?php echo $orderAmount; ?>
                                    </td>
                                    <td>
                                        <?php echo $orderType; ?>
                                    </td>
                                    <td class="text-success">
                                        <?php echo $orderStatus; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="addHover">Manage</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>



    </div>
</div>