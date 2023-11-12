<?php include 'config.php'; ?>
<?php include 'functions.php';

if (!isset($_GET["query"])) {
    header("location: index.php");
}

$query;

if (isset($_GET["query"])) {
    $query = $_GET["query"];
    $matchingProducts = json_decode(Product::sortProducts($query));
} else {
    $query = '';
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
    <title>Search | <?php echo $site__name; ?></title>
</head>

<body>


    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->

    <main>
        <section class="searchMain">
            <div class="container">
                <div class="searchbarContainer d-flex jusify-content-between py-2 px-3 w-75 mx-auto border ">
                    <input type="text" value="<?php echo $query; ?>" class="fs-20 w-100 d-block mainSearchBar" placeholder="Type Something...">
                    <button class="searchButton"><i class=" fa-solid fa-magnifying-glass"></i></button>
                </div>

                <div class="row py-5 ">
                    <div class="col-12 mb-3">
                        <h4 class="section__heading text-center fs-20">Showing Results (<?php echo count($matchingProducts); ?>)</h4>
                    </div>
                    <?php
                    if (count($matchingProducts) != 0) {
                        foreach ($matchingProducts as $products) {
                    ?>
                            <?php include('components/card.php'); ?>
                    <?php  }
                    } else {
                        echo "0 results found.";
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