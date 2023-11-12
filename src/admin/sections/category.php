
<?php
if ($employee) {
?>
    <div class="category-section">
        <?php
        include("includes/locked.php");
        ?>
    </div>

<?php return;
} else { ?>


<?php

$categories = Category::fetchAllCategory();
?>

<div class="position-relative category-section">
    <div class="order-section">
        <div class="text-left">
            <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Add Categories</h4>
        </div>
        <div class="d-flex border-bottom-hr justify-content-between py-3">
            <div class="d-flex align-items-center gap-10">
                <p class="fs-16 border-right"><span class="fc-secondary fw-500">Total Categories:</span> <?php echo count($categories); ?></p>
            </div>
            <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">Add a Category</button>
        </div>

        <div class="categoryArea">
            <h4 class="text-center py-4">Categories:</h4>
            <ul class="list-group">

                <?php
                $count = 0;
                foreach ($categories as $category) {
                    $categoryName = $category["Category Name"];
                    $categoryId = $category["Category Id"];
                    $count++;
                ?>
                    <li class="list-group-item d-flex justify-content-between fs-30">
                        <div class="d-flex gap-10">
                            <span class="border-right"><?php echo $count; ?>:</span> <input class="catInput" id="<?php echo $categoryId ?>" data-id="<?php echo $categoryId ?>" type="text" value="<?php echo $categoryName; ?>">
                        </div>
                        <div class="d-flex gap-10 fs-20">
                            <button class="border-right addHover focusOnCat">Rename</button>
                            <button class=" addHover text-danger" removeCat data-id="<?php echo $categoryId ?>">Remove</button>
                        </div>
                    </li>

                <?php   } ?>
                <?php

                if (count($categories) <= 0) {
                    echo "<p class='text-center py-3'>There are 0 Categories</p>";
                }
                ?>



            </ul>
        </div>
    </div>
</div>


<!-- CATEGORY MODAL: -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add a new Category</h5>
                <button type="button" class="close closeCat" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body position-relative">
                <div class="loader center">
                </div>

                <label for="categoryName">Write a Category Name:</label>
                <div class="input__wrap border px-2 py-2">
                    <input type="text" id="categoryName" class="categoryName" name="categoryName">
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" data-save-category class="btn btn-primary">Save Category</button>
            </div>
        </div>
    </div>
</div>

<?php } ?>