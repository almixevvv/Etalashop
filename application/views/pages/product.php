<main>
    <!--? slider Area Start-->
    <div class="slider-area ">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/sub_hero.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap">
                            <h2>Products</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Home</a></li>
                                    <li class="breadcrumb-item">
                                        <?php if (@$key == "INDUSTRIAL") : ?>
                                            <a href="<?php echo base_url(); ?>filter?query=INDUSTRIAL">Industrial Safety Range</a>
                                        <?php elseif (@$key == "HEALTH") : ?>
                                            <a href="<?php echo base_url(); ?>filter?query=HEALT">Health Safety Range</a>
                                        <?php elseif (@$key == "TRAFFIC") : ?>
                                            <a href="<?php echo base_url(); ?>filter?query=TRAFFIC">Traffic Safety Range</a>
                                        <?php else : ?>
                                            <a href="">Product</a>
                                        <?php endif; ?>
                                    </li>
                                    <?php if (@$cat != NULL) : ?>
                                        <li class="breadcrumb-item">
                                            <a href=""><?php echo $cat ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!--================Blog Area =================-->
    <style type="text/css">
        .responsive {
            width: 100%;
            height: auto;
            border: 1px solid #c7c7c7;
        }

        .p_product {
            font-weight: bold;
            margin-bottom: 1px;
            text-align: left;
        }

        .p_desc {
            text-align: left;
        }

        .product_left_sidebar .widget_title {
            font-size: 20px;
            margin-bottom: 40px;
        }

        .product_left_sidebar .widget_title::after {
            content: "";
            display: block;
            padding-top: 15px;
            border-bottom: 1px solid #f0e9ff;
        }

        .product_left_sidebar .single_sidebar_widget {
            background: #fbf9ff;
            padding: 30px;
            margin-bottom: 30px;
        }

        .product_left_sidebar .single_sidebar_widget .btn_1 {
            margin-top: 0px;
        }

        .product_left_sidebar .search_widget .form-control {
            height: 50px;
            border-color: #f0e9ff;
            font-size: 13px;
            color: #999999;
            padding-left: 20px;
            border-radius: 0;
            border-right: 0;
        }

        .product_left_sidebar .search_widget .form-control::placeholder {
            color: #999999;
        }

        .product_left_sidebar .search_widget .form-control:focus {
            border-color: #f0e9ff;
            outline: 0;
            box-shadow: none;
        }

        .product_left_sidebar .search_widget .input-group button {
            background: #f15f22;
            border-left: 0;
            border: 1px solid #f0e9ff;
            padding: 4px 15px;
            border-left: 0;
            cursor: pointer;
        }

        .product_left_sidebar .search_widget .input-group button i {
            color: #fff;
        }

        .product_left_sidebar .search_widget .input-group button span {
            font-size: 14px;
            color: #999999;
        }

        .product_left_sidebar .newsletter_widget .form-control {
            height: 50px;
            border-color: #f0e9ff;
            font-size: 13px;
            color: #999999;
            padding-left: 20px;
            border-radius: 0;
        }

        .product_left_sidebar .newsletter_widget .form-control::placeholder {
            color: #999999;
        }

        .product_left_sidebar .newsletter_widget .form-control:focus {
            border-color: #f0e9ff;
            outline: 0;
            box-shadow: none;
        }

        .product_left_sidebar .newsletter_widget .input-group button {
            background: #fff;
            border-left: 0;
            border: 1px solid #f0e9ff;
            padding: 4px 15px;
            border-left: 0;
        }

        .product_left_sidebar .newsletter_widget .input-group button i,

        .product_left_sidebar .newsletter_widget .input-group button span {
            font-size: 14px;
            color: #fff;
        }

        .product_left_sidebar .post_category_widget .cat-list li {
            border-bottom: 1px solid #f0e9ff;
            transition: all 0.3s ease 0s;
            padding-bottom: 12px;
        }

        .product_left_sidebar .post_category_widget .cat-list li:last-child {
            border-bottom: 0;
        }

        .product_left_sidebar .post_category_widget .cat-list li a {
            font-size: 14px;
            line-height: 20px;
            color: #888888;
        }

        .product_left_sidebar .post_category_widget .cat-list li a p {
            margin-bottom: 0px;
        }

        .product_left_sidebar .post_category_widget .cat-list li+li {
            padding-top: 15px;
        }

        .product_left_sidebar .popular_post_widget .post_item .media-body {
            justify-content: center;
            align-self: center;
            padding-left: 20px;
        }

        .product_left_sidebar .popular_post_widget .post_item .media-body h3 {
            font-size: 16px;
            line-height: 20px;
            margin-bottom: 6px;
            transition: all 0.3s linear;
        }

        .product_left_sidebar .popular_post_widget .post_item .media-body a:hover {
            color: #fff;
        }

        .product_left_sidebar .popular_post_widget .post_item .media-body p {
            font-size: 14px;
            line-height: 21px;
            margin-bottom: 0px;
        }

        .product_left_sidebar .popular_post_widget .post_item+.post_item {
            margin-top: 20px;
        }

        .product_left_sidebar .tag_cloud_widget ul li {
            display: inline-block;
        }

        .product_left_sidebar .tag_cloud_widget ul li a {
            display: inline-block;
            border: 1px solid #eeeeee;
            background: #fff;
            padding: 4px 20px;
            margin-bottom: 8px;
            margin-right: 3px;
            transition: all 0.3s ease 0s;
            color: #888888;
            font-size: 13px;
        }

        .product_left_sidebar .tag_cloud_widget ul li a:hover {
            background: #f15f22;
            color: #fff !important;
            -webkit-text-fill-color: #fff;
            text-decoration: none;
            -webkit-transition: 0.5s;
            transition: 0.5s;
        }

        .product_left_sidebar .instagram_feeds .instagram_row {
            display: flex;
            margin-right: -6px;
            margin-left: -6px;
        }

        .product_left_sidebar .instagram_feeds .instagram_row li {
            width: 33.33%;
            float: left;
            padding-right: 6px;
            padding-left: 6px;
            margin-bottom: 15px;
        }

        .product_left_sidebar .br {
            width: 100%;
            height: 1px;
            background: #eee;
            margin: 30px 0px;
        }

        .active-category {
            color: #e61818;
        }
    </style>

    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <div class="product_left_sidebar">

                        <aside class="single_sidebar_widget post_category_widget" id="division-filter">
                            <h4 class="widget_title">Markets</h4>
                            <ul class="list cat-list">
                                <?php foreach ($division->result() as $dt2) { ?>
                                    <li>
                                        <a href="<?= base_url('filter?market=' . $dt2->ID); ?>" class="d-flex">
                                            <p class="<?= ($this->input->get('market') == $dt2->ID ? 'active-category' : ''); ?>"><?= $dt2->NAME; ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget" id="category-filter" style="<?php echo $display ?>">
                            <h4 class="widget_title">Product Category</h4>
                            <ul class="list cat-list">
                                <?php foreach ($category->result() as $dt3) { ?>
                                    <li>
                                        <a href="<?= base_url('filter?category=' . $dt3->ID . '&name=' . $dt3->NAME); ?>" class="d-flex">
                                            <p class="<?= ($this->input->get('name') == $dt3->NAME ? 'active-category' : ''); ?>"><?= $dt3->NAME; ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>

                            <form action="#">
                                <div class="form-group">
                                    <input type="email" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Subscribe</button>
                            </form>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="blog_right_sidebar">
                        <div class="row">
                            <?php if ($product->num_rows() == 0) { ?>
                                <div class="col-12 mb-2">
                                    <div class="alert alert-danger text-center" role="alert">No Products Available</div>
                                </div>
                            <?php } else if ($product->num_rows() > 0) { ?>
                                <?php foreach ($product->result() as $dt) { ?>
                                    <div class="col-md-3 mb-2">
                                        <div class="row text-center mb-2 px-2">
                                            <div class="col-12">
                                                <a href="<?= base_url('detail?code=' . $dt->ID . '&name=' . $dt->NAME); ?>">
                                                    <img src="<?= $dt->IMAGES; ?>" alt="<?= $dt->NAME; ?>" class="responsive">
                                                </a>
                                            </div>
                                            <div class="col-12">
                                                <a href="<?= base_url('detail?code=' . $dt->ID . '&name=' . $dt->NAME); ?>">
                                                    <p class="p_product"><?= $dt->ID; ?></p>
                                                </a>
                                            </div>
                                            <div class="col-12">
                                                <p class="p_desc"><?= $dt->NAME; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
</main>