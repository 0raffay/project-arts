<?php
include "config.php";
include "functions.php";


$error;
if (isset($currentCustomer)) {
    header("location: customer-profile.php");
} else {
    if (isset($_POST["customerSignup"])) {

        // Name:
        $name = $_POST["customerNameSignUp"];
        // Number
        $number = $_POST["customerNumberSignUp"];
        // Address:
        $address = $_POST["customerAddressSignUp"];

        // Password:
        $password = $_POST["customerPasswordSignUp"];

        // Email:
        $email = $_POST["customerEmailSignUp"];

        $query = "SELECT * FROM `customer` WHERE `Customer Email` = '$email' ";
        $result = mysqli_query($connection, $query);
        if ($result->num_rows > 0) {
            $error = "Another account is already linked to this email address.";
        } else {
            new Customer($connection, $name, $email, $password, $address, $password);
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
    <title>Signup | <?php echo $site__name; ?></title>
</head>

<body>
    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->

    <main id="loginMain">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col-lg-6 mx-auto">
                    <div class="form__wrap">
                        <h1 class="fw-400 text-center fs-45 mb-30">Signup</h1>
                        <div class="form__wrap">
                            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input__wrap">
                                            <label for="">Your Name*</label>
                                            <input name="customerNameSignUp" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input__wrap">
                                            <label for="">Your Phone Number (optional)</label>
                                            <input name="customerNumberSignUp" type="number" inputmode="numeric">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input__wrap">
                                            <label for="">Your Address (optional)</label>
                                            <input name="customerAddressSignUp" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="input__wrap">
                                    <label for="">Email*</label>
                                    <input name="customerEmailSignUp" type="email">
                                </div>
                                <div class="input__wrap">
                                    <label for="">Password*</label>
                                    <input name="customerPasswordSignUp" type="password">
                                </div>
                                <p class="error-statement mb-20">
                                    <?php
                                    if (isset($error)) {
                                        echo $error;
                                    }
                                    ?>
                                </p>
                                <div class="button__wrap">
                                    <button class="btn btn-secondary btn-lg mb-10 fs-20" type="submit" name="customerSignup">Signup</button>
                                    <a href="login.php" class="d-block text-center">Already Have An Account? Login.</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>