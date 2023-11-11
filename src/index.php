<?php include 'config.php'; ?>
<?php include 'functions.php'; 
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
    <title>Home | <?php echo $site__name; ?></title>
</head>

<body>
 
    
    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->

    <!--==== BANNER SECITON START ====-->
    <?php include('sections/banner-section.php') ?>
    <!--==== BANNER SECITON END ====-->

    <!--==== FEATURED PRODUCTS START ====-->
    <?php include('sections/featured-products.php') ?>
    <!--==== FEATURED PRODUCTS END ====-->



    <!--==== FOLLOW US START ====-->
    <div class="py-4"></div>
    <?php //include('sections/follow-us-section.php') ?>
    <!--==== FOLLOW US END ====-->

    <!--==== BRAND SLIDER START ====-->
    <?php //include('sections/brand-slider.php') ?>
    <!--==== BRAND SLIDER END ====-->

    <!--==== PROMOTION SLIDER START ====-->
    <?php include('sections/promotion-slider.php') ?>
    <!--==== PROMOTION SLIDER END ====-->


    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>