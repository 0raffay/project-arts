<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>

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
    <title>Home | <?php echo $site__name; ?></title>
</head>

<body>

    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->

    <section class="contactSection">
        <div class="container">
            <div>
                <h1 class="section__heading fs-30">Contact us</h1>
            </div>

            <div class="row center">
                <div class="col-md-6 col-sm-12 center">
                    <div class="contactForm">
                        <h6 class="section__heading fs-20 mb-50">Fill the details</h6>
                        <div class="form__wrap">
                            <div class="util__panel gap-10 mb-20">
                                <div class="w-100">
                                    <label for="">Name</label>
                                    <input type="text">
                                </div>
                                <div class="w-100">
                                    <label for="">Name</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="util__panel gap-10 mb-20">
                                <div class="w-100">
                                    <label for="">Email</label>
                                    <input type="email">
                                </div>
                                <div class="w-100">
                                    <label for="">Phone.No</label>
                                    <input type="number">
                                </div>
                            </div>
                            <div class="messageField mb-20">
                                <textarea id="messageMe" placeholder="Message"></textarea>
                            </div>
                            <div class="contactFormButton">
                                <button>Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>