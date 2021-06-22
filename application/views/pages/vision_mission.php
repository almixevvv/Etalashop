<main>
    <!--? slider Area Start-->
    <div class="slider-area ">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center hero-picture-visimisi" data-background="assets/img/hero/hero_visimisi.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap">
                            <h2>Vision & Mission</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="">Vision & Mission</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!--? About Area Start -->
    <style type="text/css">
        .responsive {
            width: 100%;
            height: auto;
        }
    </style>

    <div class="about-low-area section-padding30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about-caption mb-50">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-35">
                            <h2>Vision</h2>
                        </div>
                        <?php
                        foreach ($about->result() as $data) {
                            if ($data->TYPE == 'VISION') {
                                echo $data->CONTENT;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="about-caption mb-50">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-35">
                            <!-- <span>About Our Company</span> -->
                            <h2>Mission</h2>
                        </div>
                        <?php
                        foreach ($about->result() as $data) {
                            if ($data->TYPE == 'MISSION') {
                                echo $data->CONTENT;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- About Area End -->
</main>