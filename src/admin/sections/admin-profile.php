<div class="admin-profile">
    <div class="text-center">
        <h4 class="fs-30 py-4 border-bottom-hr mb-10 fc-secondary-300 fw-300">Profile</h4>
        <p>You can edit your information here.</p>
    </div>

    <div class="customer-display">
        <div class="row">
            <div class="adminProfile table py-3">
                <div class="admin-profile">
                    <label for="name">Admin Name:</label>
                    <input class="border py-2 px-2 mb-4" value="<?php echo $currentAdmin["Admin Name"] ?>" type="text" id="name" name="name" required>

                    <label for="email">Admin Email:</label>
                    <input class="border py-2 px-2 mb-4" value="<?php echo $currentAdmin["Admin Email"] ?>" type="email" id="email" name="email" required>

                    <label for="phone">Admin Phone:</label>
                    <input class="border py-2 px-2 mb-4" value="<?php echo $currentAdmin["Admin Phone"] ?>" type="tel" id="phone" name="phone" required>

                    <label for="password">Admin Password:</label>
                    <input class="border py-2 px-2 mb-4" value="<?php echo $currentAdmin["Admin Password"] ?>" type="password" id="password" name="password" required>

                    <?php
                    if ($currentAdmin["Rights"] == 1) { ?>
                        <label for="rights">Rights:</label>
                        <input class="border py-2 px-2 mb-4" type="text" readonly value="Super Admin">
                    <?php }
                    ?>
                </div>
                <div class="text-right">
                    <button id="updateBtn" class="btn btn-secondary" style="display:none;">Update</button>
                </div>
                <div id="errorContainer"  class="text-danger py-2"></div>

            </div>
        </div>
    </div>
</div>