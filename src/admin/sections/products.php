<div class="position-relative product-section">
    <div class="products-section">
        <div class="text-center">
            <h4 class="fs-30 py-4 border-bottom-hr mb-0 fc-secondary-300 fw-300">Products</h4>
        </div>
        <div class="d-flex border-bottom-hr justify-content-between py-2">
            <div class="d-flex align-items-center gap-10">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="search--bar fw-300 fs-16">
                        <span class="mr-2 addHover"><button type="submit" name="searchProduct">Search</button> <input required style="display: inline; width: auto;" type="text"></span><i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </form>
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
                                <select required name="productCategory" id="">
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
                                    <option value="0">No</option>
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
                    <div class="all-product-item col-lg-6 col-md-6 col-sm-12  d-flex align-items-center ">
                        <div class="col-lg-3">
                            <div class="img__wrap">
                                <img src="../assets/images/product-images/<?php echo $product->images; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="fc-secondary fw-400 fs-20 mb-2 product-title">Title: <?php echo $product->name; ?></h6>
                            <p class="fc-secondary fw-400 fs-16 mb-5"><strong>Price:</strong> $<?php echo $product->price; ?></p>
                            <h6 class="fc-secondary fw-300 fs-16 mb-2"><strong>SKU: </strong><?php echo $product->SKU; ?> </h6>
                            <h6 class="fc-secondary fw-300 fs-16 mb-2"><strong>Category: </strong><?php echo $product->category; ?></h6>
                            <h6 class="fc-secondary fw-300 fs-16 mb-2"><strong>Units: </strong><?php echo $product->stock; ?></h6>
                            <h6 class="fc-secondary fw-300 fs-16 mb-2"><strong>Warrnaty Info: </strong><?php echo $product->warranty; ?></h6>
                        </div>
                        <div class="col-lg-3">
                            <button class="addHover mx-auto d-block">Edit</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>




    </div>
</div>