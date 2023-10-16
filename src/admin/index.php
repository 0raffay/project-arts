<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--==== HEADER STYLES START ====-->
    <?php include('../includes/header-styles.php') ?>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!--==== HEADER STYLES END ====-->

    <title>Login | <?php echo $site__name . " Admin"; ?></title>
</head>

<body>
    <main id="main">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="logo">
                        <img src="../assets/images/logos/logo-white-lg.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form__wrap">
                        <h1 class="fw-400 text-center fs-45 mb-30">Login</h1>

                        <div class="form__wrap">
                            <form action="POST">
                                <div class="input__wrap">
                                    <label for="">Email*</label>
                                    <input type="email">
                                </div>
                                <div class="input__wrap">
                                    <label for="">Password*</label>
                                    <input type="password">
                                </div>
                                <div class="button__wrap">
                                    <button class="btn btn-secondary btn-lg mb-10 fs-20">Login</button>
                                    <a href="javascript:;" class="d-block text-center">Forgot Your Passoword?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--==== FOOTER START ====-->
    <?php include('../includes/footer-scripts.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>