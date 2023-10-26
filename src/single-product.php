<?php
include 'config.php';
include 'functions.php';

$products = Product::$instances;
$productId = $_GET["id"];
$thisProduct;

foreach($products as $product) {
    if($product->SKU == $productId) {
        $thisProduct = $product;
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
    <?php include('includes/header-styles.php'); ?>
    <!--==== HEADER STYLES END ====-->
    <title><?php echo $thisProduct->name . " | " . $site__name ;?></title>
</head>

<body>
    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->


    <main id="single-product-main" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-6 ">
                    <div class="product-gallery">
                        <img src="assets/images/product-images/<?php echo  $thisProduct->images;?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-info">
                        <div class="product-stock-label mb-10 fs-13 fc-white fw-400">
                            In Stock
                        </div>
                        <h6 class="product-title fs-24 mb-10 fw-300 fc-secondary">
                            <!-- Forest Green Pullover Sweatshirt -->
                            <?php echo $thisProduct->name;?>
                        </h6>
                        <p class="product-price fs-24 mb-10 fw-300 fc-secondary"><?php echo $currencySymbol . $thisProduct->price;?></p>
                        <p class="small-product-stock-label fs-13 fw-300 mb-5 fc-secondary pb-2 border-bottom-hr">Hurry Only <?php echo $thisProduct->stock;?> Left In Stock!</p>
                        <div class="product-policy py-3 pb-4">
                            <a href="policy" class="addHover fc-secondary-400 mr-4"><i class="fa-solid fa-cart-shopping mr-2"></i>Delivery And Return</a>
                            <a href="message" class="addHover fc-secondary-400"><i class="fa-solid fa-message mr-2"></i> Message</a>
                        </div>

                        <form action="POST" class="mb-20">
                            <div class="row">
                                <div class="col-12 mb-30">
                                    <div class="form__wrap">
                                        <label for="notes">Notes</label>
                                        <textarea class="px-3 py-2 ouline-none" name="notes"></textarea>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-flex gap-5 counter-btns justify-content-between">
                                        <button data-decrement class="btn btn-primary py-1 fs-22 fw-700 px-3">-</button>
                                        <input type="number" name="quantity" value="3">
                                        <button data-increment class="btn btn-primary py-1 fs-22 fw-700 px-3">+</button>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <button type="submit" class="btn btn-secondary btn-lg" data-add-to-cart>ADD TO CART</button>
                                </div>
                            </div>
                        </form>

                        <i class="product-note fw-300 fc-secondary-400 fs-16 mb-20 d-block">* Please note that color may differ slightly from how it appears on your screen
                            due to varying monitor</i>
                        <p class="fw-300 fc-secondary"><i style="color: #25A799" class="fa-solid fa-shield-halved mr-2"></i>All Payments Are Secured.</p>
                        <div class="product-description pt-3 pb-4">
                            <h6 class="product-description-title fw-300 fs-24 fc-secondary mb-2">Product Description</h6>
                            <div class="product-description-content fw-300 fc-secondary-400">
                      <?php echo $thisProduct->description;?>
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