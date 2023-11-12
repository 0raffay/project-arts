<section class="trending-products">
    <div class="container position-relative">
        <div class="section__text text-center">
            <h4 class="section__heading fw-300">Trending Products</h4>
        </div>
        <div class="trendingSlider">
            
            <?php
            $shuffledProducts = Product::$instances;
            shuffle($shuffledProducts);

            $_count =  0;
            foreach ($shuffledProducts as $products) {
                $productIds = $products->SKU;
                checkCurrentProduct($productIds);
                if ($_count <= 8) { ?>
                    <?php include('components/card.php'); ?>
            <?php  }
                $_count++;
            }
            ?>

        </div>

        <div class="tren">
            <button class="prev"><i class="ri-arrow-left-s-line"></i></button>
            <button class="next"><i class="ri-arrow-right-s-line"></i></button>
        </div>
    </div>
</section>