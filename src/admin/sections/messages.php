<div class="position-relative messages-section">
    <div class="message-section">
        <div class="text-left">
            <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Messages:</h4>
        </div>
        <div class="d-flex border-bottom-hr justify-content-between py-3">
            <div class="d-flex align-items-center gap-10">
                <?php $messageCount = count(Messages::fetchMessages()); ?>
                <p class="fs-16 border-right"><span class="fc-secondary fw-500">Total No. Of Messages:</span> <?php echo $messageCount ?></p>
            </div>
        </div>

        <div class="orderArea">
            <div class="inProcessOrders">
                <?php
                $messages = Messages::fetchMessages();
                ?>

                <?php if (empty($messages)) { ?>
                    <div class="orderHistory">
                        <p class="text-center pt-5 fs-20 fw-400 fc-secondary-400">There are no returns.</p>
                    </div>
                <?php } else { ?>
                    <h4 class="text-center pb-4 py-4">Messages:</h4>
                    <table class="message-table">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $index => $message) { ?>
                                <tr class="<?php echo ($index % 2 == 0) ? 'even' : 'odd'; ?>">
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $message["name"]; ?></td>
                                    <td><?php echo $message["email"]; ?></td>
                                    <td><?php echo $message["phone_number"]; ?></td>
                                    <td><?php echo $message["message"]; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>