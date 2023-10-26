<?php
$promotionTitle = "FINAL CLEARANCE: Take 20% off ‘Sale Must-Haves'";
?>


<header>
    <div class="top--header bg-secondary py-2">
        <h6 class="fw-300 mb-0 fs-16 fc-primary text-center"><?php echo $promotionTitle; ?></h6>
    </div>
    <div class="middle--header border-bottom-hr d-flex justify-content-between">
        <div class="container">
            <div class="d-md-flex py-1 align-items-center justify-content-between">
                <div class="logo">
                    <a href="index.php"><img src="assets/images/logos/logo-white.png" alt="Logo"></a>
                </div>
                <ul class="header--buttons list-unstyled d-md-flex gap-10">
                    <li><a class="fs-20" href=""><i class="ri-question-line"></i></a></li>
                    <li><a class="fs-20" href="login.php"><i class="ri-user-3-line"></i></a></li>
                    <li><a class="fs-20" href=""><i class="ri-heart-line"></i></a></li>
                    <li><a class="fs-20" href="javascript:;" data-cart-button><i class="ri-shopping-cart-line"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom--header  border-bottom-hr">
        <div class="container">
            <div class="d-flex py-3 fw-300 ff-secondary align-items-center justify-content-between">
                <ul class="d-flex gap-20 list-unstyled">
                    <li><a href="index.php">Home</a></li>

                    <li class="li--has-submenu">
                        <a href="javscript:;">Shop By Categories <span class="icon__wrap"><i class="ri-arrow-drop-down-fill"></i></span></a>

                        <div class="submenu--wrapper">
                            <ul class="submenu">
                                <li><a href="">Greeting Cards</a></li>
                                <li><a href="">Wallets</a></li>
                                <li><a href="">Beauty Products</a></li>
                                <li><a href="">Beauty Products</a></li>
                            </ul>
                        </div>
                    </li>


                    <li><a href="">Sale</a></li>
                    <li><a href="">Catalogue</a></li>
                </ul>
                <div class="search--bar d-flex align-items-center border-bottom-hr py-1 fw-300 fs-16">
                    <input type="text" class="mr-3 d-block">
                    <button class="d-flex gap-5 align-items-center">Search<i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>





<div class="modal-wrapper cart">
    <div class="cart-modal">
        <div class="py-4 px-4">
            <div class="position-relative d-flex px-2 mb-20 justify-content-between align-items-center">
                <p class="fs-24 fw-300 text-upper">My Bag (0)</p>
                <button data-cart-button class="btn btn-secondary px-2 py-2">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="py-3">
            <p class="fs-14 fw-300 text-upper">Your Shopping Cart is Empty.</p>
            </div>
        </div>
    </div>
</div>