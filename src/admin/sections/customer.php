<div class="customer-section">
    <div class="text-center">
        <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Customers</h4>
    </div>
    <div class="d-flex border-bottom-hr justify-content-between py-3">
        <div class="d-flex align-items-center gap-10">
            <!-- <form action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="search--bar fw-300 fs-16">
                    <span class="mr-2 addHover"><button type="submit" name="searchProduct">Search</button> <input required style="display: inline; width: auto;" type="text"></span><i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </form>
            <button data-view-all-products class="addHover border-right active">View All</button> -->
            <p class="fs-16 border-right"><span class="fc-secondary fw-500">Total No. Of Customers:</span> <?php echo count(Customer::$instances); ?></p>
        </div>
    </div>

    <div class="customer-display">
        <div class="row">
            <div class="customer-table table py-3">
                <?php if ($customerData == "") { ?>
                    <div class="table-row text-center d-flex align-items-center justify-content-between  pt-4 head">
                        <div class="table-cell flex-1">
                            Customer Name:
                        </div>
                        <div class="table-cell flex-1">
                            Customer Email:
                        </div>
                        <div class="table-cell flex-1">
                            Customer Phone:
                        </div>
                        <div class="table-cell flex-1">
                            Customer Address:
                        </div>
                        <div class="table-cell flex-1">
                            Customer Password:
                        </div>
                        <div class="table-cell flex-1">
                            Actions
                        </div>
                    </div>

                    <?php
                    foreach (Customer::$instances as $customer) {
                    ?>
                        <div class="table-row text-center d-flex align-items-center justify-content-between">
                            <div class="table-cell flex-1">
                                <?php echo $customer['Customer Name']; ?>
                            </div>
                            <div class="table-cell flex-1">
                                <?php echo $customer['Customer Email']; ?>
                            </div>
                            <div class="table-cell flex-1">
                                <?php echo $customer['Customer Phone']; ?>
                            </div>
                            <div class="table-cell flex-1">
                                <?php echo $customer['Customer Address']; ?>
                            </div>
                            <div class="table-cell flex-1">
                                <?php echo $customer['Customer Password']; ?>
                            </div>
                            <div class="table-cell flex-1">
                                <button class="addHover border-right">
                                    Edit User
                                </button>
                                <button class="text-danger addHover">
                                    Delete User
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else {
                    echo $customerData;
                }
                ?>


            </div>
        </div>
    </div>


</div>