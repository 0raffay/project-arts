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
    <title>Catalogue | <?php echo $site__name; ?></title>
</head>

<body>


    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->
    <main>

        <section class="catalogueSection">
            <div class="container">
                <h4 class="section__heading text-center">Our Catalogue</h4>
                <p class="text-center">View Our Top Selling Products and Brands</p>
                <hr>

                <div class="row py-4">
                    <?php
                    $shuffledProducts = Product::$instances;
                    shuffle($shuffledProducts);

                    foreach ($shuffledProducts as $products) {
                        $productIds = $products->SKU;
                        checkCurrentProduct($productIds);
                        include('components/card.php');
                    }
                    ?>

                </div>
            </div>
        </section>
    </main>
    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>