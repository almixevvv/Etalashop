<div class="detail-container">

  <div class="row">

    <!-- PRODUCT LEFT PART -->
    <div class="col-1 col-md-1 col-lg-1 col-xl-1 order-0 order-md-1 order-lg-1 order-xl-1 d-none d-md-block d-lg-block d-xl-block">
      <?php echo form_open('General/Cart/addtoCart'); ?>

      <?php if (isset($dataproduct->row()->IMAGES1) && strlen($dataproduct->row()->IMAGES1) > 1) { ?>
        <div class="detail-border">
          <center>
            <img data-picture="<?= base_url('assets/uploads/products/') . $dataproduct->row()->IMAGES1; ?>" class="row-images" alt="Product Picture" src="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES1); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png'); ?>' " />
          </center>
        </div>
      <?php } ?>

      <?php if (isset($dataproduct->row()->IMAGES2) && strlen($dataproduct->row()->IMAGES2) > 1) { ?>
        <div class="detail-border">
          <center>
            <img data-picture="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES2); ?>" class="row-images" alt="Product Picture" src="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES2); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png'); ?>' " />
          </center>
        </div>
      <?php } ?>

      <?php if (isset($dataproduct->row()->IMAGES3) && strlen($dataproduct->row()->IMAGES3) > 1) { ?>
        <div class="detail-border">
          <center>
            <img data-picture="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES3); ?>" class="row-images" alt="Product Picture" src="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES3); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png'); ?>' " />
          </center>
        </div>
      <?php } ?>

      <?php if (isset($dataproduct->row()->IMAGES4) && strlen($dataproduct->row()->IMAGES4) > 1) { ?>
        <div class="detail-border">
          <center>
            <img data-picture="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES4); ?>" class="row-images" alt="Product Picture" src="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES4); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png'); ?>' " />
          </center>
        </div>
      <?php } ?>


    </div>
    <!-- END OF PRODUCT LEFT PART -->

    <!-- IMAGE NAVIGATOR MOBILE -->
    <div class="col-12 d-md-none d-lg-none-xl-none order-2">
      <div class="d-flex flex-row">

        <?php if (isset($dataproduct->row()->IMAGES1) && strlen($dataproduct->row()->IMAGES1) > 1) { ?>
          <div class="detail-border">
            <center>
              <img data-picture="<?= base_url('assets/uploads/products/') . $dataproduct->row()->IMAGES1; ?>" class="row-images" alt="Product Picture" src="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES1); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png'); ?>' " />
            </center>
          </div>
        <?php } ?>

        <?php if (isset($dataproduct->row()->IMAGES2) && strlen($dataproduct->row()->IMAGES2) > 1) { ?>
          <div class="detail-border">
            <center>
              <img data-picture="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES2); ?>" class="row-images" alt="Product Picture" src="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES2); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png'); ?>' " />
            </center>
          </div>
        <?php } ?>

        <?php if (isset($dataproduct->row()->IMAGES3) && strlen($dataproduct->row()->IMAGES3) > 1) { ?>
          <div class="detail-border">
            <center>
              <img data-picture="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES3); ?>" class="row-images" alt="Product Picture" src="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES3); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png'); ?>' " />
            </center>
          </div>
        <?php } ?>

        <?php if (isset($dataproduct->row()->IMAGES4) && strlen($dataproduct->row()->IMAGES4) > 1) { ?>
          <div class="detail-border">
            <center>
              <img data-picture="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES4); ?>" class="row-images" alt="Product Picture" src="<?= base_url('assets/uploads/products/' . $dataproduct->row()->IMAGES4); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png'); ?>' " />
            </center>
          </div>
        <?php } ?>

      </div>
    </div>
    <!-- END OF MOBILE IMAGE NAVIGATOR -->

    <!-- PRODUCT CENTER PART -->
    <div class="col-12 col-md-5 col-lg-5 col-xl-5 order-1 order-md-2 order-lg-2 order-xl-3">
      <div class="detail-border">
        <div class="d-flex justify-content-center">
          <img class="detail-main-images" alt="<?= $productName; ?>" src="<?= base_url('assets/uploads/products/') . $dataproduct->row()->IMAGES1; ?>" />
        </div>
      </div>
    </div>

    <!-- END OF PRODUCT CENTER PART -->

    <!-- PRODUCT RIGHT PART -->
    <div class="col-12 col-md-5 col-lg-5 col-xl-5 order-3 order-md-3 order-lg-3 order-xl-3">
      <div class="row detail-border ml-0 mr-0">
        <div class="detail-inner-container">
          <!-- Product Title Part -->
          <span class="detail-title">
            <label class="detail-txt-color text-left text-capitalize"><?= $productName; ?></label>
          </span>

          <!-- Product EXW Price -->
          <div class="exw-container">
            <label class="detail-label">EXW Price:</label>

            <?php foreach ($dataproduct->result() as $qty) { ?>
              <div class="row">
                <div class="col-6 col-md-12 col-lg-6 col-xl-6" style="padding-right: 0!important;">
                  <label class="detail-txt-color detail-exw-size font-weight-bold">
                    <?= $qty->QUANTITY_MIN; ?> ~ <?= $qty->QUANTITY_MAX; ?>
                  </label>
                </div>
                <div class="col-6 col-md-12 col-lg-6 col-xl-6">
                  <label class="detail-txt-color detail-exw-size font-weight-bold">
                    <span class="detail-exw-color">IDR <?php echo number_format($qty->QUANTITY_PRICE, 2, '.', ','); ?></span>/Pcs
                  </label>
                </div>
              </div>
            <?php } ?>
          </div>

          <div class="row mt-4">
            <div class="col-12 col-md-6 col-lg-12">
              <label class="detail-label">Estimated Price :</label>
              <?php if ($dataproduct->row()->QUANTITY_PRICE == 0) { ?>
                <span class="detail-exw-color detail-label">Price Negotiable</span>
              <?php } else { ?>
                <span class="detail-exw-color detail-label font-weight-bold">
                  IDR <span id="estimated-price"><?php echo number_format($dataproduct->row()->QUANTITY_PRICE, 2, '.', ','); ?></span>
                </span>
              <?php } ?>
            </div>

            <div class="col-12 col-md-6 col-lg-12">
              <label class="detail-label">Est. Weight :</label>
              <span class="detail-exw-color font-weight-bold" id="detail-weight">
                <?php if (is_numeric($dataproduct->row()->WEIGHT)) { ?>
                  <?= number_format($dataproduct->row()->WEIGHT, 2, '.', ','); ?> Kg
                <?php } else { ?>
                  <?php echo ('-'); ?>
                <?php } ?>
              </span>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-12 col-md-5 col-lg-5 col-xl-5">
              <label class="detail-label">Description :</label>
            </div>
            <div class="col-12 col-md-9 col-lg-9 col-xl-11" style="overflow:scroll; ">
              <span class="detail-txt-color">
                <?php if (strlen($dataproduct->row()->PRODUCT_DETAIL) == 0) { ?>
                  <label>No Product Description</label>
                <?php } else { ?>
                  <label>
                    <?php echo $dataproduct->row()->PRODUCT_DETAIL; ?>
                  </label>
                <?php } ?>
              </span>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12">
              <label class="detail-label">Quantity</label>
            </div>
          </div>

          <div class="row">

            <div class="col-7 col-md-10 col-lg-7 col-xl-7">
              <div class="input-group mb-3" id="btn-detail-quantity">
                <div class="input-group-prepend">
                  <button class="btn btn-danger" id="xminusone" type="button"><i class="fa fa-minus"></i></button>
                </div>
                <input type="number" name="quantity" id="quantity" class="form-control text-center" aria-describedby="basic-addon1" value="<?= '1' ?>" style="text-align:right;">
                <div class="input-group-append">
                  <button class="btn btn-success" id="xplusone" type="button"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-12">
              <div class="form-group">
                <label class="detail-label" for="customer-notes">Inquiry</label>
                <textarea type="text" name="customer-notes" class="form-control detail-text-box" /></textarea>
              </div>
            </div>

          </div>

          <div class="row" style="margin-top: 1.5em;">

            <div class="col-7 col-md-10 col-lg-7 col-xl-8">
              <button type="submit" class="btn btn-kku" id="btn-addcart">
                Add To Cart&nbsp;<i class="fa fa-shopping-cart"></i>
              </button>
            </div>

          </div>

          <?php
          $productID = array(
            'type'  => 'hidden',
            'name'  => 'product-id',
            'id'    => 'hiddenID',
            'value' => $dataproduct->row()->PRODUCT_ID
          );

          echo form_input($productID);

          ?>

          <?php echo form_close(); ?>

        </div>
      </div>
    </div>
    <!-- END OF PRODUCT RIGHT PART -->
  </div>

  <!-- RECOMENDATION PRODUCT PART -->
  <div class="row mt-4">

    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <span class="detail-txt-color">
        <label>You Might Also Like:</label>
      </span>
    </div>

  </div>

  <!-- <div class="row mt-2">

    <?php
    $counter = 1;
    foreach ($recomended->prslist as $data) {

      if ($counter > 5) {
        break;
      }

      $counter++;
    ?>

      <div class="custom-product-list">
        <div class="card product-list" id="prod_" <?= $data->id; ?>>
          <a href="<?= base_url('product_detail?id=' . $data->id); ?>" style="text-decoration: none;">
            <div class="d-flex justify-content-center">
              <img alt="<?= $data->title; ?>" class="product-image" src="<?= 'http://img1.yiwugo.com/' . $data->picture1; ?>" onerror="this.onerror=null;this.src='.'\''.base_url('assets/images/no-image-icon.png').' \''.'" />
            </div>
            <p class="product-title mt-2"><?= ucwords(mb_strimwidth($data->title, 0, 35, '...')); ?></p>
            <label class="product-label">Estimated Price</label></br>
            <span class="product-price">IDR <?= number_format($data->sellPrice, 2, '.', ','); ?></span>
          </a>
        </div>
      </div>

    <?php } ?>

  </div> -->

</div>

<script type="text/javascript" src="<?php echo base_url('assets/zoom-master/jquery.zoom.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/number-format/jquery.number.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/incube-assets/product-detail.js'); ?>"></script>
<script type="text/javascript">
  $(document).keypress(
    function(event) {
      if (event.which == '13') {
        event.preventDefault();
      }
    });
</script>