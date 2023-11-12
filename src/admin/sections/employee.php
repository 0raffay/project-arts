<?php
if ($employee) {
?>
    <div class="employee-section">
        <?php
        include("includes/locked.php");
        ?>
    </div>

<?php return;
} else { ?>

    <div class="employee-section">
        <?php
        $admins = Admin::fetchAllAdmin();
        ?>
        <div class="text-center">
            <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Employees</h4>
        </div>
        <div class="d-flex border-bottom-hr justify-content-between py-3">
            <div class="d-flex align-items-center justify-content-between gap-10">
                <p class="fs-16 border-right"><span class="fc-secondary fw-500">Total No. Of Employees:</span>
                    <?php
                    if (!is_string($admins)) {
                        echo count($admins);
                    } else {
                        echo "0";
                    }
                    ?></p>
            </div>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">Add New Employee</button>
        </div>

        <div class="customer-display">
            <div class="row">
                <div class="customer-table table py-3">
                    <?php if (!is_string($admins) && count($admins) > 0) { ?>
                        <div class="table-row text-center d-flex align-items-center justify-content-between  pt-4 head">
                            <div class="table-cell flex-1">
                                Employee Name:
                            </div>
                            <div class="table-cell flex-1">
                                Employee Email:
                            </div>
                            <div class="table-cell flex-1">
                                Employee Password:
                            </div>
                            <div class="table-cell flex-1">
                                Employee Phone:
                            </div>
                            <div class="table-cell flex-1">
                                Employee Rights:
                            </div>
                            <div class="table-cell flex-1">
                                Actions
                            </div>
                        </div>

                        <?php
                        foreach ($admins as $admin) {
                        ?>
                            <div class="table-row text-center d-flex align-items-center justify-content-between">
                                <div class="table-cell flex-1">
                                    <?php echo $admin['Admin Name']; ?>
                                </div>
                                <div class="table-cell flex-1">
                                    <?php echo $admin['Admin Email']; ?>
                                </div>
                                <div class="table-cell flex-1">
                                    <?php echo $admin['Admin Password']; ?>
                                </div>
                                <div class="table-cell flex-1">
                                    <?php echo $admin['Admin Phone']; ?>
                                </div>
                                <div class="table-cell flex-1">
                                    <?php
                                    if ($admin["Rights"] == "2") {
                                        echo "Employee Level Access";
                                    } else {
                                        echo "<strong>Super Admin</strong>";
                                    }
                                    ?>
                                </div>
                                <div class="table-cell flex-1">
                                    <button class="text-danger addHover" data-id="<?php echo $admin['Admin Id'] ?>" data-delete-admin>
                                        Delete User
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else {
                        echo "<p class='text-center py-4'>No employees found.</p>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- ADD EMPLOYEE MODAL: -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add a new employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body employeeModal position-relative">
                    <div class="loader center">
                    </div>

                    <div class="addEmployeeForm py-3">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 mb-3">
                                <div class="input__wrap">
                                    <label for="">Employee Name:</label>
                                    <input em-name type="text" id="" class="border employeeName px-2 py-2">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 mb-3">
                                <div class="input__wrap">
                                    <label for="">Employee Email:</label>
                                    <input em-email type="text" id="" class="border employeeEmail  px-2 py-2">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 mb-3">
                                <div class="input__wrap">
                                    <label for="">Employee Password:</label>
                                    <input em-password type="text" id="" class="border employeePassword  px-2 py-2">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 mb-3">
                                <div class="input__wrap">
                                    <label for="">Employee Phone:</label>
                                    <input em-phone type="text" id="" class="border employeePhone  px-2 py-2">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 mb-3">
                                <div class="input__wrap">
                                    <label for="">Employee Access Level:</label>
                                    <select em-rights class="border employeeRights outline-none w-100 d-block  px-2 py-2" name="" id="">
                                        <option value="2">Employee Access</option>
                                        <option value="1">Super Admin Access </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer text-center">
                    <button type="button" data-add-employee class="btn btn-primary d-block mx-auto">Add Employee</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>