<?php
include "config.php";
include "functions.php";

$error = "";

if (isset($_SESSION["currentCustomer"])) {
    header("location: customer-profile.php");
} else {
    if (isset($_POST["customerLogin"])) {
        $email = $_POST["customerEmailLogin"];
        $password = $_POST["customerPasswordLogin"];

        $loginStatus = Customer::customerLogin($connection, $email, $password);
        if($loginStatus) {
            header("location: customer-profile.php");
        } else {
            $error = "Please provide correct credentials.";
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
    <title>Login | <?php echo $site__name; ?></title>
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
                        <h1 class="fw-400 text-center fs-45 mb-30">Login</h1>

                        <div class="form__wrap">
                            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <div class="input__wrap">
                                    <label for="">Email*</label>
                                    <input type="email" name="customerEmailLogin">
                                </div>
                                <div class="input__wrap">
                                    <label for="">Password*</label>
                                    <input type="password" name="customerPasswordLogin">
                                </div>
                                <p class="error-statement mb-10">
                                    <?php echo $error;?>
                                </p>
                                <div class="button__wrap">
                                    <button class="btn btn-secondary btn-lg mb-10 fs-20" type="submit" name="customerLogin">Login</button>
                                    <a href="signup.php" class="d-block text-center">Not Registered Yet? Create A New Account</a>
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