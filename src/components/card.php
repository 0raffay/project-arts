<div class="col-lg-3 col-md-6 col-sm-12">
    <div class="product-card">
        <div class="img__wrap" onclick="window.location.href='single-product.php?id=<?php echo $products->SKU; ?>';">
            <img src="assets/images/product-images/<?php echo $products->images ?>"></a>
        </div>
        <div class="product-card-text py-3">

            <h6 class="product-brand fw-300 fs-13 fc-secondary-400"><?php echo $products->brand; ?></h6>
            <h4 class="product-title fw-400 fs-16 py-1 fc-secondary ff-secondary"><?php echo $products->name ?></h4>
            <h5 class="product-price fw-300 fs-16"><?php echo $currencySymbol . $products->price ?></h5>

        </div>
        <div class="product-card-footer">
            <div class="d-flex align-items-center justify-content-between pr-1">
                <a class="btn btn-primary" href="single-product.php?id=<?php echo $products->SKU; ?>">Buy Now</a>
                <button class="addToWishList"><span class="icon__wrap fs-20"><i class="ri-heart-line"></i></span></button>
            </div>
            <div class="product-stars">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 100 100">
                    <polygon points="50,10 61.803,43.301 96.602,43.301 68.398,66.699 80.201,100 50,77.601 19.799,100 31.602,66.699 3.398,43.301 38.197,43.301" fill="#000" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 100 100">
                    <polygon points="50,10 61.803,43.301 96.602,43.301 68.398,66.699 80.201,100 50,77.601 19.799,100 31.602,66.699 3.398,43.301 38.197,43.301" fill="#000" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 100 100">
                    <polygon points="50,10 61.803,43.301 96.602,43.301 68.398,66.699 80.201,100 50,77.601 19.799,100 31.602,66.699 3.398,43.301 38.197,43.301" fill="#000" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 100 100">
                    <polygon points="50,10 61.803,43.301 96.602,43.301 68.398,66.699 80.201,100 50,77.601 19.799,100 31.602,66.699 3.398,43.301 38.197,43.301" fill="#000" />
                </svg>
            </div>
        </div>
    </div>
</div>