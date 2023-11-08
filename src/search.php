<?php include 'config.php'; ?>
<?php include 'functions.php';

$query;

if (isset($_GET["query"])) {
    $query = $_GET["query"];
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
    <title>Home | <?php echo $site__name; ?></title>
</head>

<body>


    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->

    <section class="searchMain">
        <div class="container">
            <div class="searchbarContainer d-flex jusify-content-between py-2 px-3 w-75 mx-auto border ">
                <input type="text"  value="<?php echo $query; ?>" class="fs-20 w-100 d-block searchInput" placeholder="Type Something...">
                <button class="searchButton" type="button"><i class=" fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </section>

    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>