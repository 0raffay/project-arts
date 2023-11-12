<div class="position-relative returns-section">
    <div class="order-section">
        <div class="text-left">
            <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Returns/Warranty Claims:</h4>
        </div>
        <div class="d-flex border-bottom-hr justify-content-between py-3">
            <div class="d-flex align-items-center gap-10">
                <?php $returnsCount = count(Returns::fetchAll()); ?>
                <p class="fs-16 border-right"><span class="fc-secondary fw-500">Total No. Of Returns:</span> <?php echo $returnsCount ?></p>
            </div>
        </div>

        <div class="orderArea">
            <div class="inProcessOrders">
                <?php
                $returns = Returns::fetchAll();
                ?>
                <div class="d-flex mb-10 justify-content-between">
                </div>
                <?php if ($returnsCount <= 0) { ?>
                    <div class="orderHistory d-flex">
                        <p class="text-center pt-5 fs-20 fw-400 fc-secondary-400">There are no returns.</p>
                    </div>
                <?php } else { ?>

                    <h4 class="text-center pb-4">Returns:</h4>
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
                            foreach ($returns as $return) {
                                $returnId = $return["return_id"];
                                $orderNum = $return["order_num"];
                                $returnDate = $return["return_date"];
                                $returnItems = $return["return_item"];
                                $returnItemsQuantity = $return["return_item_quantity"];
                                $returnStatus = $return["return_status"];
                            ?>
                                <tr>
                                    <td>
                                        <?php echo "#" . $orderNum; ?>
                                    </td>
                                    <td>
                                        <?php echo $returnDate; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $product = checkCurrentProduct($returnItems);
                                        $returnAmount = $product->price * $returnItemsQuantity;
                                        ?>
                                        <img class="orderImg" src="../assets/images/product-images/<?php echo $product->images ?>">
                                    </td>
                                    <td>
                                        <?php echo $returnItemsQuantity; ?>
                                    </td>
                                    <td>
                                        <?php echo $currencySymbol . $returnAmount; ?>
                                    </td>
                                    <td class="text-capitilize">
                                        <?php echo $returnStatus; ?>
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