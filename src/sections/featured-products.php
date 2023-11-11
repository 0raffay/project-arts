<section class="featured-products pb-0">
    <div class="container">
        <div class="section__text text-center">
            <h4 class="section__heading">Featured Products</h4>
        </div>
        <div class="row">
            <?php
            function compareProductUploadDates($a, $b)
            {
                return strtotime($b->uploadDate) - strtotime($a->uploadDate);
            }

            // Assuming Product::$instances is an array of product objects
            usort(Product::$instances, 'compareProductUploadDates');

            // Display the three most recent products
            $count = 0;
            foreach (Product::$instances as $products) {
                $productIds = $products->SKU;
                checkCurrentProduct($productIds);

                if ($count < 8) {
                    include('components/card.php');
                }

                $count++;
            }
            ?>

        </div>
    </div>
</section>