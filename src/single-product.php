<?php
include 'config.php';
include 'functions.php';

$products = Product::$instances;
$productId = $_GET["id"];
checkCurrentProduct($productId);

// print_r($currentProduct);

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
    <?php include('includes/header-styles.php'); ?>
    <!--==== HEADER STYLES END ====-->
    <title><?php echo $currentProduct->name . " | " . $site__name; ?></title>
</head>

<body>
    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->


    <main id="single-product-main" class="py-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-6 ">
                    <div class="product-gallery">
                        <img src="assets/images/product-images/<?php echo  $currentProduct->images; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-info">

                        <?php
                        if ($currentProduct->stock == "0") { ?>

                            <div class="product-stock-label bg-danger danger mb-10 fs-13 fc-white fw-400">
                                Out of stock
                            </div>
                        <?php  } else { ?>
                            <div class="product-stock-label mb-10 fs-13 fc-white fw-400">
                                In Stock
                            </div>
                        <?php } ?>

                        <h6 class="product-title fs-24 mb-10 fw-300 fc-secondary">
                            <!-- Forest Green Pullover Sweatshirt -->
                            <?php echo $currentProduct->name; ?>
                        </h6>
                        <p class="product-price fs-24 mb-10 fw-300 fc-secondary"><?php echo $currencySymbol . $currentProduct->price; ?></p>
                        <?php
                        if (!$currentProduct->stock == "0") { ?>
                            <p class="small-product-stock-label fs-13 fw-300 mb-5 fc-secondary pb-2 border-bottom-hr">Hurry Only <?php echo $currentProduct->stock; ?> Left In Stock!</p>
                        <?php } ?>
                        <div class="product-policy py-3 pb-4">
                            <a href="policy" class="addHover fc-secondary-400 mr-4"><i class="fa-solid fa-cart-shopping mr-2"></i>Delivery And Return</a>
                        </div>

                        <form action="POST" class="mb-20">
                            <div class="row">
                                <div class="col-12 mb-10">
                                    <i class="product-note fw-300 fc-secondary-400 fs-16 d-block">* Please note that color may differ slightly from how it appears on your screen
                                        due to varying monitor</i>
                                </div>
                                <div class="col-12">

                                    <?php
                                    if ($currentProduct->stock == "0") { ?>
                                        <p class="text-danger pb-3">This product is out of stock. Sorry for the inconvenience</p>
                                        <button class="btn bg-danger fc-white btn-lg disabled">Out of Stock !</button>
                                    <?php  } else { ?>
                                        <button type="submit" class="btn btn-secondary btn-lg" data-add-to-cart data-product-id="<?php echo $productId; ?>">ADD TO CART</button>
                                    <?php } ?>

                                </div>
                            </div>
                        </form>


                        <p class="fw-300 fc-secondary"><i style="color: #25A799" class="fa-solid fa-shield-halved mr-2"></i>All Payments Are Secured.</p>
                        <div class="product-description pt-3 pb-4">
                            <h6 class="product-description-title fw-300 fs-24 fc-secondary mb-2">Product Description</h6>
                            <div class="product-description-content fw-300 fc-secondary-400">
                                <?php echo $currentProduct->description; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="product-feedback">
        <div class="container">
            <button class="pb-1 fc-secondary fs-24 fw-400 border-bottom-hr">Product Feedback</button>
            <div class="product-feedback-head d-flex align-items-center justify-content-between fs-23 fw-300 fc-secondary py-3">
                Customer Reviews
                <button class="btn btn-primary">Write A Review</button>
            </div>
            <div class="feedback-content py-5 mb-4 border-bottom-hr">
                <p>No reviews yet.</p>
            </div>
        </div>
    </div>


    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>