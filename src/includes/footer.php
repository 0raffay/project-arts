<footer>
    <div class="container">
        <div class="row pb-3 border-bottom-hr">
            <div class="col-lg-6 col-sm-12 mb-40">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <h6 class="fw-300 fs-16 fc-secondary mb-15">SHOP</h6>
                        <ul>
                            <li class="mb-2"><a href="index.php">Home</a></li>
                            <li class="mb-2"><a href="catalogue.php">Shop All</a></li>
                            <li class="mb-2"><a href="about.php">About Us</a></li>
                            <li class="mb-2"><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <h6 class="fw-300 fs-16 fc-secondary mb-15">ORDER</h6>
                        <ul>
                            <li class="mb-2"><a href="customer-profile.php">My Account</a></li>
                            <li class="mb-2"><a href="index.php">Privacy Policy</a></li>
                            <li class="mb-2"><a href="index.php">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12 mb-40">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <h6 class="fw-300 fs-16 fc-secondary mb-15">HERE TO HELP</h6>
                        <p class="fs-13 mb-15 fc-secondary-400" style="line-height: 1.4;">Have a question? You may find an answer in our FAQs. But you can also contact us:</p>
                        <ul>
                            <li class="mb-2"><a href="tel:<?php echo $site__phone; ?>">Call Us: <?php echo $site__phone; ?></a></li>
                            <li class="mb-2"><a href="javascript:;">Mon-Fri: 9:00 AM - 6:00 PM</a></li>
                            <li class="mb-2"><a href="mailto:<?php echo $site__email; ?>">Send us an email</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <h6 class="fw-300 fs-16 fc-secondary mb-15">FOLLOW US</h6>
                        <ul>
                            <li class="mb-2">
                                <span class="icon__wrap fc-secondary"><i class="ri-facebook-line"></i></span>
                                <a href="https://www.facebook.com" target="_blank">facebook</a>
                            </li>
                            <li class="mb-2">
                                <span class="icon__wrap fc-secondary"><i class="ri-instagram-line"></i></span>
                                <a href="https://www.instagram.com" target="_blank">Instagram</a>
                            </li>
                            <li class="mb-2">
                                <span class="icon__wrap fc-secondary"><i class="ri-twitter-line"></i></span>
                                <a href="https://www.twitter.com" target="_blank">Twitter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="flex-1">
                        <div class="logo d-flex align-items-center gap-10">
                            <img src="assets/images/logos/logo-black.png" width="30px" alt="">
                            <p class="fs-14 fw-300 fc-secondary-400">Copyright © <?php echo date('Y') ?> - <?php echo $site__name; ?> - All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="d-flex gap-10">
                            <img src="assets/images/payments/icons.png" height="20" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>





<?php include('includes/footer-scripts.php') ?>