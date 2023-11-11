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

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h6 class="section__heading fs-20 fc-white">Fill the details</h6>
                    <div class=" px-4 py-4 map h-100 bg-subbed border w-100">
                map
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="contactForm">
                        <h6 class="section__heading fs-20">Fill the details</h6>
                        <div class="form__wrap">
                            <div class="util__panel gap-10">
                                <div class="w-100">
                                    <label for="">Name</label>
                                    <input type="text">
                                </div>
                                <div class="w-100">
                                    <label for="">Name</label>
                                    <input type="text">
                                </div>
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