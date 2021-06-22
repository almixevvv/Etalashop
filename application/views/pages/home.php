<main>
    <!--? slider Area Start-->
    <div class="slider-area ">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-9 col-lg-9">
                            <div class="hero__caption">
                                <h1><span>Growrich Indonesia</span>, Safety Product Specialist!</h1>
                            </div>
                            <!--Hero form -->
                            <form action="#" class="search-box">
                                <div class="search-form">
                                    <a href="<?= base_url('contact') ?>">Contact Us</a>
                                </div>
                            </form>
                            <!-- Hero Pera -->
                            <div class="hero-pera">
                                <p>Have a question?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!--? our info Start -->
    <div class="our-info-area pt-70 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-info mb-30">
                        <div class="info-icon">
                            <span class="flaticon-support"></span>
                        </div>
                        <div class="info-caption">
                            <p>Call Us Anytime</p>
                            <span>+ (62) (021) 6471 2703</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-info mb-30">
                        <div class="info-icon">
                            <span class="flaticon-clock"></span>
                        </div>
                        <div class="info-caption">
                            <p>Sunday CLOSED</p>
                            <span>Mon - Sat 8.00 - 17.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-info mb-30">
                        <div class="info-icon">
                            <span class="flaticon-place"></span>
                        </div>
                        <div class="info-caption">
                            <p>Email Us at</p>
                            <span>sales@growrichindonesia.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- our info End -->
    <!--? Testimonial Start -->
    <style type="text/css">
        .responsive {
            width: 100%;
            height: auto;
            /*border: 1px solid #c7c7c7;*/
            /*border-radius: 10%;*/
        }

        .button-katalog {
            color: white;
            background-color: #e61818;
            border: none;
        }
    </style>

    <div class="testimonial-area testimonial-padding section-bg" data-background="assets/img/gallery/section_bg04.jpg">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-12 col-lg-12">
                    <!-- Section Tittle -->
                    <div class="section-tittle section-tittle2 mb-25">
                        <span>Products</span>
                        <h2>Our Catalog Products</h2>
                    </div>

                    <div class="row">

                        <?php if ($markets->num_rows() != 0) { ?>
                            <?php foreach ($markets->result() as $market) { ?>
                                <div class="col-md-4 mb-30">
                                    <div class="single-testimonial ">
                                        <div class="testimonial-caption">
                                            <div class="testimonial-founder d-md-flex d-sm-flex align-items-center">
                                                <div class="founder-img">
                                                    <a href="<?= base_url('filter?query=' . $market->ID); ?>">
                                                        <center>
                                                            <img src="<?= base_url('assets/img/product/' . $market->IMAGES); ?>" alt="<?= $market->NAME; ?>" class="responsive image-product">
                                                        </center>
                                                        <center>
                                                            <p style="color: #fff;"> <?= $market->NAME; ?> </p>
                                                    </a>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Testimonial End -->

    <!--? Blog Area Start -->
    <div class="home-blog-area section-padding30">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center mb-70">
                        <span>About</span>
                        <h2>GET TO KNOW GROWRICH INDONESIA</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="assets/img/gallery/blog5.png" alt="">
                            </div>
                        </div>
                        <div class="blog-caption">
                            <div class="blog-cap">
                                <ul>
                                    <li><a href="#">COMPANY OVERVIEW</a></li>
                                </ul>
                                <h3><a href="#">Growrich Indonesia is dedicated to helping men and women work safely throughout the world.</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="assets/img/gallery/blog6.png" alt="">
                            </div>
                        </div>
                        <div class="blog-caption">
                            <div class="blog-cap">
                                <ul>
                                    <li><a href="#">FOR INVESTORS</a></li>
                                </ul>
                                <h3><a href="#">We've been at the forefront of safety innovation since developing our Edison Electric Cap Lamp in 1914.</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="assets/img/gallery/blog7.png" alt="">
                            </div>
                        </div>
                        <div class="blog-caption">
                            <div class="blog-cap">
                                <ul>
                                    <li><a href="#">CAREERS</a></li>
                                </ul>
                                <h3><a href="#">Our Employees make the difference thanks to their passion for portecting people in the workplace.</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Area End -->
</main>