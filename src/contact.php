<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- META TITLE AND DESCRIPTION -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- META TITLE AND DESCRIPTION -->


    <!--==== HEADER STYLES START ====-->
    <?php include('includes/header-styles.php') ?>
    <!--==== HEADER STYLES END ====-->
    <title>Contact | <?php echo $site__name; ?></title>
</head>

<body>

    <!--==== HEADER START ====-->
    <?php include('includes/header.php') ?>
    <!--==== HEADER END ====-->
    <main>
        <section class="contactSection py-5 my-5">
            <div class="container">
                <div class="row center">
                    <div class="col-md-5 col-12 map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d462118.02491053584!2d67.15546194999999!3d25.193202399999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e06651d4bbf%3A0x9cf92f44555a0c23!2sKarachi%2C%20Karachi%20City%2C%20Sindh!5e0!3m2!1sen!2s!4v1699813015816!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-md-7 col-12">
                        <div class="contactForm">
                            <h4 class="text-left fs-24 fw-300 ff-secondary mb-15">Drop Us A Line
                            </h4>
                            <p class="fs-15 fc-secondary-400 fw-300 ff-secondary mb-15">We’re happy to answer any questions you have or provide you with an estimate. Just send us a message in the form below with any questions you may have.

                            </p>
                            <div class="form_wrap">
                                <form action="">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="" class="fs-14 fw-300 ff-secondary mb-1">Name
                                            </label>
                                            <input data-validate-msg type="text" class="ct_name fs-14  border py-2 px-2 mb-2">
                                        </div>
                                        <div class="col-12">
                                            <label for="" class="fs-14 fw-300 ff-secondary mb-1">Email
                                            </label>
                                            <input data-validate-msg data-validate-msg-email type="email" class="ct_email fs-14  border py-2 px-2 mb-2">
                                        </div>
                                        <div class="col-12">
                                            <label for="" class="fs-14 fw-300 ff-secondary mb-1">Phone
                                            </label>
                                            <input data-telephone-msg-field data-validate-msg type="tel" class="ct_phone fs-14  border py-2 px-2 mb-2">
                                        </div>
                                        <div class="col-12">
                                            <label for="" class="fs-14 fw-300 ff-secondary mb-1">Message
                                            </label>
                                            <textarea data-validate-msg class="cta_message fs-14 w-100 d-block mb-2 border py-2 px-2 outline-none" name="" id="" cols="30" rows="10" placeholder="Enter your message" style="outline: none !important;"></textarea>
                                        </div>
                                    </div>
                                    <button data-msg class=" btn btn-secondary d-block mt-3 w-100 mw-100">Submit</button>
                                    <p id="formSubmit" class="py-4" style="display: none;"></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
    <!--==== FOOTER START ====-->
    <?php include('includes/footer.php') ?>
    <!--==== FOOTER END ====-->
</body>

</html>