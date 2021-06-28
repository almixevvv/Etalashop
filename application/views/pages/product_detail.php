<main>
   <!--? slider Area Start-->
   <div class="slider-area ">
      <div class="single-slider hero-overly slider-height2 d-flex align-items-center hero-picture-detail" data-background="assets/img/hero/hero_detail.jpg">
         <div class="container">
            <div class="row">
               <div class="col-xl-12">
                  <div class="hero-cap">
                     <h2><?php echo $product->row()->NAME; ?></h2>
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="<?= base_url(''); ?>">Home</a></li>
                           <li class="breadcrumb-item"><a href="<?= base_url('product'); ?>">Product</a></li>
                           <li class="breadcrumb-item"><a href=""><?= $product->row()->NAME; ?></a></li>
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
      .img-fluid {
         border: 1px solid #c7c7c7;
      }

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
   </style>

   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" src="<?= $product->row()->IMAGES; ?>" alt="">
                  </div>
                  <div class="blog_details"> 
                     <div class="row text-center mb-5">
                        <?php foreach ($images->result() as $dt2) { ?>
                           <div class="col-md-4 mt-2">
                              <img src="<?= base_url($dt2->IMAGES); ?>" alt="" class="responsive picture-detail img-detail"> 
                           </div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget post_category_widget">
                     <h4 class="widget_title">Product ID</h4>
                     <ul class="list cat-list">
                        <li>
                           <p style="color: #e61818;"><?= $product->row()->ID; ?></p>
                        </li>
                     </ul>
                     <h4 class="widget_title">Name</h4>
                     <ul class="list cat-list">
                        <li>
                           <p style="color: #e61818;"><?= $product->row()->NAME; ?></p>
                        </li>
                     </ul>
                     <h4 class="widget_title">Description</h4>
                     <ul class="list cat-list">
                        <li>
                           <p><?= $product->row()->DESCRIPTION; ?></p>
                        </li>
                     </ul>
                  </aside>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->

</main>