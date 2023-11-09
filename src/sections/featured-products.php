<section class="featured-products pb-0">
    <div class="container">
        <div class="section__text text-center">
            <h4 class="section__heading">Featured Products</h4>
        </div>
        <div class="row">

            <?php
            $count = 0;
            foreach (Product::$instances as $products) {
                $productIds = $products->SKU;
                checkCurrentProduct($productIds);
                // print_r($currentProduct);
                if ($count < 6) {
            ?>
                    <?php include('components/card.php'); ?>
            <?php
                }
                $count++;
            }
            ?>

        </div>
    </div>
</section>