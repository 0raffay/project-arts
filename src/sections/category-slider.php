<section class="featured-products">
    <div class="container">
        <div class="section__text text-center">
            <h4 class="section__heading">Categories</h4>
        </div>
        <div class="row">
            <?php
            $categories = Category::fetchAllCategory();
            shuffle($categories);
            $__count = 0;
            foreach ($categories as $category) {
                $categoryName = $category["Category Name"];
                $categoryId = $category["Category Id"];
                if ($__count < 2) {
            ?>
                    <div class="col-md-6 col-12">
                        <a class="categoryCard" href="search.php?query=<?php echo $categoryName; ?>"><?php echo $categoryName; ?></a>
                    </div>

            <?php
                }
                $__count++;
            } ?>

        </div>
    </div>
</section>