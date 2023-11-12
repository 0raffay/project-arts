<?php
if ($employee) {
?>
    <div class="product-section">
        <?php
        include("includes/locked.php");
        ?>
    </div>

<?php return;
} else { ?>


    <div class="position-relative product-section">
        <div class="products-section">
            <div class="text-center">
                <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Products</h4>
            </div>
            <div class="d-flex border-bottom-hr justify-content-between py-2">
                <div class="d-flex align-items-center gap-10">
                    <!-- <form action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="search--bar fw-300 fs-16">
                        <span class="mr-2 addHover"><button type="submit" name="searchProduct">Search</button> <input required style="display: inline; width: auto;" type="text"></span><i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </form>
                <
                 -->
                    <button data-view-all-products class="addHover border-right active">View All</button>
                    <p class="fs-16 border-right"><span class="fc-secondary fw-500">Total No.Of Products:</span> <?php echo count(Product::$instances); ?></p>

                </div>
                <button class="btn btn-primary " data-add-product>Add New Product</button>
            </div>


            <div class="addProduct hidden">
                <div class="form__wrap">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">
                        <div class="row py-4">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="input__wrap">
                                    <label for="">Product Title*</label>
                                    <input required type="text" name="productTitle">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input__wrap">
                                    <label for="">Price*</label>
                                    <input required type="text" name="productPrice">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input__wrap">
                                    <label for="">Brand / Store*</label>
                                    <input required type="text" name="productBrand">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input__wrap">
                                    <label for="">Images*</label>
                                    <input required type="file" multiple="multiple" name="productImages">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input__wrap">
                                    <label for="">Product Category*</label>
                                    <select class="border py-2 px-2 w-100 d-block" required name="productCategory" id="">
                                        <option value="" selected></option>
                                        <?php
                                        $categories = Category::fetchAllCategory();
                                        foreach ($categories as $category) {
                                            $categoryName = $category["Category Name"];
                                            $categoryId = $category["Category Id"];
                                        ?>
                                            <option value="<?php echo $categoryName; ?>"><?php echo $categoryName; ?></option>
                                        <?php   } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input__wrap">
                                    <label for="">Units Available*</label>
                                    <input required name="productQuantity">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="input__wrap">
                                    <label for="">Description*</label>
                                    <textarea name="productDescription" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input__wrap">
                                    <label for="">Add Search Keywords*</label>
                                    <input required name="productKeywords">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input__wrap">
                                    <label for="">Genrate Warranty*</label>
                                    <select required name="productWarranty" id="">
                                        <option value="1">Yes</option>
                                        <option value="">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <button type="submit" name="uploadProduct" class="btn btn-secondary d-block mx-auto">Add Product to Catalogue</button>
                        </div>

                        <?php
                        if (isset($_POST["uploadProduct"])) {
                            Product::uploadProduct($connection);
                        }

                        ?>

                    </form>
                </div>
            </div>

            <div class="allProducts ">
                <?php
                // if (isset($_GET["searchButton"])) {
                //     $userQuery = $_GET["searchProducts"];
                //     Product::sortProducts($connection, $userQuery);
                // }
                ?>

                <div class="row all-product-container py-3">
                    <?php foreach (Product::$instances as $product) { ?>
                        <div class="all-product-item  position-relative col-lg-6 col-md-6 col-sm-12  d-flex align-items-center ">
                            <?php
                            if ($product->stock <= 0) {
                            ?>
                                <div class="product-stock-label admin bg-danger danger mb-10 fs-13 fc-white fw-400">
                                    Out of stock
                                </div>
                            <?php  }
                            ?>
                            <div class="col-lg-3">
                                <div class="img__wrap">
                                    <img src="../assets/images/product-images/<?php echo $product->images; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h6 class="fc-secondary fw-400 fs-20 mb-2 product-title">Title: <?php echo $product->name; ?></h6>
                                <p class="fc-secondary fw-400 fs-16 mb-5"><strong>Price:</strong> PKR. <?php echo $product->price; ?></p>
                                <h6 class="fc-secondary fw-300 fs-16 mb-2"><strong>SKU: </strong><?php echo $product->SKU; ?> </h6>
                                <h6 class="fc-secondary fw-300 fs-16 mb-2"><strong>Category: </strong><?php echo $product->category; ?></h6>
                                <h6 class="fc-secondary fw-300 fs-16 mb-2"><strong>Units: </strong><?php echo $product->stock; ?></h6>
                                <h6 class="fc-secondary fw-300 fs-16 mb-2"><strong>Warrnaty Info: </strong><?php echo $product->warranty; ?></h6>
                            </div>
                            <div class="col-lg-3">
                                <a class="addHover mx-auto d-block text-center" href="?openProductModal&productId=<?php echo "$product->SKU" ?>">Edit</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>




        </div>
    </div>

    <?php
    if (isset($_GET["productId"])) {
        $productId = $_GET["productId"];
        $thisProduct = checkCurrentProduct($productId);
    ?>
        <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="openProductModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-24" id="openProductModal">Edit Product Details</h5>
                        <button type="button" class="btn btn-secondary" id="editProductModalDismissButton" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        <form id="updateProductForm" method="post" enctype="multipart/form-data">
                            <div class="row py-4">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input__wrap">
                                        <label for="">Product Title</label>
                                        <input value="<?php echo $thisProduct->name; ?>" class="edit-productName border py-2 px-2 w-100 d-block" required type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input__wrap">
                                        <label for="">Price</label>
                                        <input value="<?php echo $thisProduct->price; ?>" class="edit-productPrice border py-2 px-2 w-100 d-block" required type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input__wrap">
                                        <label for="">Brand / Store</label>
                                        <input value="<?php echo $thisProduct->brand; ?>" class="edit-productBrand border py-2 px-2 w-100 d-block" required type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input__wrap">
                                        <label for="">Product Category</label>
                                        <select class="border py-2 px-2 w-100 d-block edit-productCat" required id="">
                                            <option value="<?php $thisProduct->category ?>" selected><?php echo $thisProduct->category ?></option>
                                            <?php
                                            $categories = Category::fetchAllCategory();
                                            foreach ($categories as $category) {
                                                $categoryName = $category["Category Name"];
                                                $categoryId = $category["Category Id"];
                                            ?>
                                                <option value="<?php echo $categoryName; ?>"><?php echo $categoryName; ?></option>
                                            <?php   } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input__wrap">
                                        <label for="">Units Available</label>
                                        <input value="<?php echo $thisProduct->stock; ?>" class="edit-productStock border py-2 px-2 w-100 d-block" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input__wrap">
                                        <label for="">Description</label>
                                        <textarea class="border px-2 py-2 w-100 d-block edit-productDesc" id="" cols="30" rows="10">
                                    <?php echo $thisProduct->description; ?>"
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input__wrap">
                                        <label for="">Add Search Keywords</label>
                                        <input value="<?php echo $thisProduct->keywords; ?>" class="edit-productKeywords border py-2 px-2 w-100 d-block" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input__wrap">
                                        <label for="">Edit Warranty</label>
                                        <input value="<?php echo $thisProduct->warranty; ?>" class="edit-productWarranty border py-2 px-2 w-100 d-block" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer d-flex justify-content-between" style="min-height: 70px">

                    <div>
                        <button type="button" class="btn btn-danger deleteProductButton" data-id="<?php echo $thisProduct->SKU; ?>" data-dismiss="modal">Delete Product</button>
                    </div>

                        <button type="button" class="btn btn-secondary updateProductButton" data-id="<?php echo $thisProduct->SKU; ?>" data-dismiss="modal">Update Product</button>
                    </div>
                </div>
            </div>
        </div>
    <?php  } else {
        return;
    }
    ?>



<?php  } ?>