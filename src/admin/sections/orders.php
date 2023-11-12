<div class="position-relative orders-section">
  <div class="order-section">
    <div class="text-left">
      <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Orders/Sales:</h4>
    </div>
    <div class="d-flex border-bottom-hr justify-content-between py-3">
      <div class="d-flex align-items-center gap-10">
        <p class="fs-16 border-right"><span class="fc-secondary fw-500">Total No. Of Orders:</span> <?php echo count(Customer::fetchAllOrders()); ?></p>
      </div>
    </div>

    <div class="ordersAreaButton">
      <div class="row py-4">
        <div class="col-lg-3 pl-2">
          <button data-show-orders=".inProcessOrders" class="btn btn-warning btn-lg active">In Processs</button>
        </div>
        <div class="col-lg-3 pr-2">
          <button data-show-orders=".filledOrders" class="btn alert-primary btn-lg">Shipped Orders</button>
        </div>
        <div class="col-lg-3 pr-2">
          <button data-show-orders=".deliveredOrders" class="btn alert-success btn-lg">Delivered Orders</button>
        </div>
        <div class="col-lg-3 pr-2">
          <button data-show-orders=".cancelOrders" class="btn btn-danger btn-lg">Cancelled Orders</button>
        </div>
      </div>
    </div>

    <div class="orderArea">
      <div class="inProcessOrders">
        <?php
        $orders = Customer::fetchSpecificProducts('Order Status', 'processing');
        $orderCount = count($orders);
        ?>
        <div class="d-flex mb-10 justify-content-between">
          <p class="fs-16">No of Orders: <?php echo $orderCount; ?></p>
        </div>
        <?php if ($orderCount <= 0) { ?>
          <div class="orderHistory d-flex">
            <p class="text-center pt-5 fs-20 fw-400 fc-secondary-400">No orders are in processing.</p>
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
                    <button class="addHover manageOrder" data-toggle="modal" data-target="#manageOrderModal" data-id="<?php echo $orderId ?>">Manage</button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } ?>
      </div>
      <div class="filledOrders hidden">
        <?php
        $orders = Customer::fetchSpecificProducts('Order Status', 'shipped');
        $orderCount = count($orders);
        ?>
        <div class="d-flex mb-10 justify-content-between">
          <p class="fs-16">No of Orders: <?php echo $orderCount; ?></p>
        </div>
        <?php if ($orderCount <= 0) { ?>
          <div class="orderHistory d-flex">
            <p class="text-center pt-5 fs-20 fw-400 fc-secondary-400">No orders are shipped yet.</p>
          </div>
        <?php } else { ?>

          <h4 class="text-center pb-4">Shipped Orders:</h4>
          <table class="table text-left">
            <thead>
              <tr>
                <th>Order #</th>
                <th>Order Date</th>
                <th>Estimated Delivery Date:</th>
                <th>Items</th>
                <th>Total</th>
                <th>Payment Method</th>
                <th>Order Status</th>
                <th class="text-center">Update Delivery Status:</th>
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
                $orderEstiDelivery = $order["est_delivery_date"];
              ?>
                <tr>
                  <td>
                    <?php echo $orderNum; ?>
                  </td>
                  <td>
                    <?php echo $orderDate; ?>
                  </td>
                  <td>
                    <?php echo $orderEstiDelivery; ?>
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
                  <td class="text-primary">
                    <?php echo $orderStatus; ?>
                  </td>
                  <td class="text-center">
                    <button class="addHover btn btn-success" data-delivery-order data-id="<?php echo $orderId ?>">Set Delivered</button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } ?>
      </div>
      <div class="deliveredOrders hidden">
        <?php
        $orders = Customer::fetchSpecificProducts('Order Status', 'delivered');
        $orderCount = count($orders);
        ?>
        <div class="d-flex mb-10 justify-content-between">
          <p class="fs-16">No of Orders: <?php echo $orderCount; ?></p>
        </div>
        <?php if ($orderCount <= 0) { ?>
          <div class="orderHistory d-flex">
            <p class="text-center pt-5 fs-20 fw-400 fc-secondary-400">No orders are delivered yet.</p>
          </div>
        <?php } else { ?>

          <h4 class="text-center pb-4">Delivered Orders:</h4>
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

                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } ?>
      </div>
      <div class="cancelOrders hidden">
        <?php
        $orders = Customer::fetchSpecificProducts('Order Status', 'cancelled');
        $orderCount = count($orders);
        ?>
        <div class="d-flex mb-10 justify-content-between">
          <p class="fs-16">No of Orders: <?php echo $orderCount; ?></p>
        </div>
        <?php if ($orderCount <= 0) { ?>
          <div class="orderHistory d-flex">
            <p class="text-center pt-5 fs-20 fw-400 fc-secondary-400">0 orders were cancelled.</p>
          </div>
        <?php } else { ?>

          <h4 class="text-center pb-4">Cancelled Orders:</h4>
          <table class="table text-left">
            <thead>
              <tr>
                <th>Order #</th>
                <th>Order Date</th>
                <th>Items</th>
                <th>Total</th>
                <th>Payment Method</th>
                <th>Order Status</th>
                <th>Cancelled By</th>
                <!-- <th class="text-center">Info:</th> -->
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
                $orderReason = $order["reason"];
                $orderCancelBy = $order["cancel_by"];
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
                  <td class="text-danger">
                    <?php echo $orderStatus; ?>
                  </td>
                  <td>
                    <?php echo $orderCancelBy; ?>
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

<div class="modal fade" id="manageOrderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-24" id="orderModalLabel">Order Details</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Order details will be dynamically populated here using JavaScript -->
        <h4 class="fs-24 border-bottom-hr pb-2 w-25 mb-10">Customer Info:</h4>
        <div class="row">
          <div class="input__wrap col-md-4 col-6 py-2">
            <label for="">Customer Name</label>
            <input readonly type="text" class="border py-2 px-2  customer_name">
          </div>
          <div class="input__wrap col-md-4 col-6 py-2">
            <label for="">Customer Address</label>
            <input readonly type="text" class="border py-2 px-2  customer_address">
          </div>
          <div class="input__wrap col-md-4 col-6 py-2">
            <label for="">Customer City</label>
            <input readonly type="text" class="border py-2 px-2  customer_city">
          </div>
          <div class="input__wrap col-md-4 col-6 py-2">
            <label for="">Customer Phone</label>
            <input readonly type="text" class="border py-2 px-2  customer_phone">
          </div>
        </div>

        <h4 class="fs-24 border-bottom-hr pb-2 w-25 mb-10 pt-3">Order Info:</h4>
        <div class="row">

          <div class="row col-12 py-2">
            <p class="py-2 col-3"><strong>Order # </strong><span class="manageOrderNo"></span></p>
            <p class="py-2 col-3"><strong>Order Date </strong><span class="manageOrderDate"></span></p>
            <p class="py-2 col-3"><strong>Order Type </strong><span class="manageOrderType"></span></p>
          </div>
          <div class="input__wrap col-md-4 col-6 py-2">
            <label for="">Order Items</label>
            <div class="list-group manageOrderItems">

            </div>
          </div>
          <div class="input__wrap col-md-4 col-6 py-2">
            <label for="">Order Total</label>
            <input readonly type="text" value="" class=" py-2 px-2 order_total">
          </div>
          <div class="input__wrap col-md-4 col-6 py-2">
            <label for="">Order Status</label>
            <select value="" class="order_status w-100 border py-2 px-2">
              <option value="processing" selected>processing</option>
              <option value="shipped">Shipped</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between" style="min-height: 70px">
        <button type="button" class="btn btn-danger" data-cancel-order data-id="" data-cancel-by="admin">Cancel Order</button>
        <button type="button" class="btn btn-secondary hidden updateOrderStatusButton" data-update-order-status data-id="" data-dismiss="modal">Update Order Status</button>
      </div>
    </div>
  </div>
</div>