<?php

$categories = Category::fetchAllCategory();
print_r($categories);
?>

<div class="position-relative category-section">
    <div class="order-section">
        <div class="text-left">
            <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Add Categories</h4>
        </div>
        <div class="d-flex border-bottom-hr justify-content-between py-3">
            <div class="d-flex align-items-center gap-10">
                <p class="fs-16 border-right"><span class="fc-secondary fw-500">Total Categories:</span> <?php echo count(Product::$instances); ?></p>
            </div>
            <button class="btn btn-primary ">Add a Category</button>
        </div>

        <div class="categoryArea">
            <h4 class="text-center py-4">Categories:</h4>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between fs-30">
                    <div class="d-flex gap-10">
                        <span class="border-right">1:</span> <input type="text" value="Bed">
                    </div> 
                    <div class="d-flex gap-10 fs-20">
                        <button class="border-right addHover">Rename</button>
                        <button class=" addHover text-danger">Remove</button>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>