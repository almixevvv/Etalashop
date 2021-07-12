<style>
  a {
    cursor: pointer;
  }

  #paymentModal {
    display: none;
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: rgba(255, 255, 255, .8) url('../assets/images/loader.gif') 50% 50% no-repeat;
  }

  body.loading #paymentModal {
    overflow: hidden;
  }

  body.loading #paymentModal {
    display: block;
  }

  .notes-text{
    font-size: 14px;
    color: #b8b7b4;
  }
</style>


<div class="trans-container">

  <div class="trans-inner-container">

    <!-- FILTER BUTTON -->
    <div class="row" id="trans-filter-separator-desktop">

      <div class="trans-filter-container-left">
        <span>Search by Status:</span>
      </div>

      <div class="trans-filter-container-right" id="trans-scrollbar">

        <div class="trans-filter-button<?= ($this->input->get('transaction') == 'created' ? '-active' : ''); ?>">
          <a href="<?= ($this->input->get('transaction') == 'created' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=created')); ?>">
            <span class="text-uppercase <?= ($this->input->get('transaction') == 'created' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Created</span>
          </a>
        </div>

        <div class="trans-filter-button<?= ($this->input->get('transaction') == 'updated' ? '-active' : ''); ?>">
          <a href="<?= ($this->input->get('transaction') == 'updated' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=updated')); ?>">
            <span class="text-uppercase <?= ($this->input->get('transaction') == 'updated' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Updated</span>
          </a>
        </div>

        <div class="trans-filter-button<?= ($this->input->get('transaction') == 'confirmed' ? '-active' : ''); ?>">
          <a href="<?= ($this->input->get('transaction') == 'confirmed' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=confirmed')); ?>">
            <span class="text-uppercase <?= ($this->input->get('transaction') == 'confirmed' ? 'trans-filter-active' : 'main-color'); ?>">Confirm Payment</span>
          </a>
        </div>


        <div class="trans-filter-button<?= ($this->input->get('transaction') == 'paid' ? '-active' : ''); ?>">
          <a href="<?= ($this->input->get('transaction') == 'paid' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=paid')); ?>">
            <span class="text-uppercase <?= ($this->input->get('transaction') == 'paid' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Paid</span>
          </a>
        </div>


        <div class="trans-filter-button<?= ($this->input->get('transaction') == 'canceled' ? '-active' : ''); ?>">
          <a href="<?= ($this->input->get('transaction') == 'canceled' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=canceled')); ?>">
            <span class="text-uppercase <?= ($this->input->get('transaction') == 'canceled' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Canceled</span>
          </a>
        </div>


        <div class="trans-filter-button<?= ($this->input->get('transaction') == 'done' ? '-active' : ''); ?>">
          <a href="<?= ($this->input->get('transaction') == 'done' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=done')); ?>">
            <span class="text-uppercase <?= ($this->input->get('transaction') == 'done' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Done</span>
          </a>
        </div>

      </div>

    </div>
    <!-- EoL FILTER BUTTON -->

    <!-- FILTER BUTTON MOBILE -->
    <div class="row" id="trans-filter-separator-mobile">

      <div class="row">
        <div class="col-12 pl-1 pr-1">
          <span>Search by Status:</span>
        </div>
      </div>

      <div class="row" style="width: 99%;">
        <div class="col-12 pl-1 pr-1 pt-2" id="trans-scrollbar">

          <div class="trans-filter-button<?= ($this->input->get('transaction') == 'created' ? '-active' : ''); ?>">
            <a href="<?= ($this->input->get('transaction') == 'created' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=created')); ?>">
              <span class="text-uppercase <?= ($this->input->get('transaction') == 'created' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Created</span>
            </a>
          </div>

          <div class="trans-filter-button<?= ($this->input->get('transaction') == 'updated' ? '-active' : ''); ?>">
            <a href="<?= ($this->input->get('transaction') == 'updated' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=updated')); ?>">
              <span class="text-uppercase <?= ($this->input->get('transaction') == 'updated' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Updated</span>
            </a>
          </div>

          <div class="trans-filter-button<?= ($this->input->get('transaction') == 'confirmed' ? '-active' : ''); ?>">
            <a href="<?= ($this->input->get('transaction') == 'confirmed' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=confirmed')); ?>">
              <span class="text-uppercase <?= ($this->input->get('transaction') == 'confirmed' ? 'trans-filter-active' : 'main-color'); ?>">Confirm Payment</span>
            </a>
          </div>


          <div class="trans-filter-button<?= ($this->input->get('transaction') == 'paid' ? '-active' : ''); ?>">
            <a href="<?= ($this->input->get('transaction') == 'paid' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=paid')); ?>">
              <span class="text-uppercase <?= ($this->input->get('transaction') == 'paid' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Paid</span>
            </a>
          </div>


          <div class="trans-filter-button<?= ($this->input->get('transaction') == 'canceled' ? '-active' : ''); ?>">
            <a href="<?= ($this->input->get('transaction') == 'canceled' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=canceled')); ?>">
              <span class="text-uppercase <?= ($this->input->get('transaction') == 'paid' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Canceled</span>
            </a>
          </div>


          <div class="trans-filter-button<?= ($this->input->get('transaction') == 'done' ? '-active' : ''); ?>">
            <a href="<?= ($this->input->get('transaction') == 'done' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=done')); ?>">
              <span class="text-uppercase <?= ($this->input->get('transaction') == 'done' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Done</span>
            </a>
          </div>

        </div>

      </div>

    </div>
    <!-- EoL FILTER BUTTON MOBILE -->

    <!-- Main Transaction Loop -->
    <?php if ($masterData->num_rows() == 0) { ?>
      <div class="row">
        <div class="col-12">
          <div class="d-flex justify-content-center">
            <span>
              <h3 class="pt-2 pt-md-4 pt-lg-4 pt-xl-4 pb-2 pb-md-4 pb-lg-4 pb-xl-4 text-uppercase " style="color: rgba(49,53,59,.44);">No Order History</h3>
            </span>
          </div>
        </div>
      </div>
    <?php } else { ?>

      <?php foreach ($masterData->result() as $master) { ?>
        <div class="trans-main-container">

          <div class="row container-border-main">
            <div class="col-12">


              <!-- TRANS DATE -->
              <div class="row container-border-date">
                <div class="col-12 col-md-5 col-lg-5 col-xl-5 pb-1 pb-md-1 pb-lg-1 pb-xl-1">
                  <span><?= $master->ORDER_DATE; ?></span>
                </div>
              </div>
              <!-- END OF TRANS DATE -->

              <!-- MAIN TRANS PART -->
              <div class="row container-border-order-number">

                <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order">
                  <div class="row">
                    <div class="col-12">
                      <span>ORDER NUMBER</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <span class="main-color font-weight-bold"><?= $master->ORDER_NO; ?></span>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order">
                  <div class="row">
                    <div class="col-12">
                      <span>ORDER STATUS</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <span class="main-color font-weight-bold"><?= $master->STATUS_ORDER; ?></span>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order-last">
                  <div class="row">
                    <div class="col-12">
                      <span>TRANSACTION TOTAL</span>
                    </div>
                    <div class="col-12">
                      <span class="main-color font-weight-bold">IDR <?= number_format($master->TOTAL_ORDER + $master->TOTAL_POSTAGE, 2, '.', ','); ?></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <span>SHIPPING COST</span>
                    </div>
                    <div class="col-12">
                      <span class="main-color font-weight-bold">IDR <?= number_format($master->TOTAL_POSTAGE, 2, '.', ','); ?></span>
                    </div>
                  </div>
                </div>

              </div>

              <?php $userHistory = $this->profiles->getOrderDetails($master->ORDER_NO); ?>

              <?php foreach ($userHistory->result() as $history) { ?>
                <div class="row container-border-order-number pt-0 pt-md-2 pt-lg-2 pt-xl-2">

                  <div class="col-12 col-md-8 col-lg-8 col-xl-8 container-border-order">

                    <div class="row">

                      <div class="col-4 col-md-3 col-lg-3 col-xl-2 mt-2 mt-md-2 mt-lg-2 mt-xl-2">
                        <a href="<?= base_url('product_detail?id=' . $history->PRODUCT_ID); ?>">

                          <img src="<?= base_url('assets/uploads/products/' . $history->PRODUCT_IMAGE); ?>" alt="<?= $history->PRODUCT_NAME; ?>" onerror="this.onerror=null;this.src=' . '\'' . base_url('assets/images/no-image-icon.png') . ' \'' . '" class="transaction-image">

                        </a>
                      </div>

                      <div class="col-8 col-md-9 col-lg-9 col-xl-9 mt-2 mt-md-2 mt-lg-2 mt-xl-2">
                        <div class="row">
                          <div class="col-12">
                            <a href="<?= base_url('product_detail?id=' . $history->PRODUCT_ID); ?>">
                              <span class="text-capitalize" style="color: #212529;">
                                <?= ucwords(mb_strimwidth($history->PRODUCT_NAME, 0, 100, "...")); ?>
                              </span>
                            </a>
                          </div>
                        </div>

                        <div class="row pt-2">
                          <div class="col-6">
                            <span class="main-color font-weight-bold">
                              IDR <?= number_format(($history->PRODUCT_PRICE / $history->PRODUCT_QUANTITY), 2, '.', ','); ?>
                            </span>
                          </div>

                          <div class="col-6">
                            <span class="main-color">
                              <?= number_format($history->PRODUCT_QUANTITY) . ' pc'; ?>
                            </span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-3 mt-md-2 mt-lg-2 mt-xl-2">

                    <div class="row">

                      <div class="col-12">

                        <div class="row">
                          <div class="col-12">
                            <span>TOTAL PRICE</span>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <span class="main-color font-weight-bold">
                              IDR <?= number_format($history->PRODUCT_PRICE, 2, '.', '.'); ?>
                            </span>
                          </div>
                        </div>

                      </div>

                    </div>

                    <div class="row mt-3">

                      <div class="col-12">

                        <div class="row">
                          <div class="col-12">
                            <span>INQUIRY</span>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <?php if ($history->PRODUCT_NOTES == null) { ?>
                              <span class="main-color font-weight-bold notes-text"> - </span>
                            <?php } else { ?>
                              <span class="main-color font-weight-bold notes-text"><?= $history->PRODUCT_NOTES; ?></span>
                            <?php } ?>
                          </div>
                        </div>

                      </div>

                    </div>

                  </div>

                </div>
              <?php } ?>

              <div class="row mt-1 mt-md-1 mt-lg-1 mt-xl-1">

                <div class="trans-container-footer-left">
                  <a href="#" data-transaction="<?= $master->ORDER_NO; ?>" data-sender="<?= $this->session->userdata('USERID'); ?>" data-toggle="modal" data-target="#messageModal" style="color: black;">
                    <span><i class="fas fa-comments pr-2"></i> Send Message</span>
                  </a>
                </div>

                <div class="trans-container-footer-right">
                  <span><i class="fas fa-clipboard-list pr-2"></i> Order Detail</span>
                </div>

                <?php
                //DONT'S SHOW THE PAYMENT BUTTON IF THE STATUS IS NEW ORDER AND UPDATED
                if ($master->STATUS_ORDER == 'UPDATED') {

                  $attributes = array('id' => 'myform' . $counter);
                  echo form_open('order/payment', $attributes);

                  //GENERATE RANDOM NUMBER TO HELP CONFIRM THE TRANSFER
                  $transID = rand(100, 1000);
                ?>
                  <div class="trans-container-footer-payment">
                    <a class="proc-payment" data-ordertotal="<?= $master->AMOUNT + $master->TOTAL_POSTAGE; ?>" data-orderid="<?= $master->ORDER_NO; ?>" data-toggle="modal" data-target="#paymentOptions" style="color: black;">
                      <span><i class="fas fa-money-check-alt"></i> Order Payment</span>
                    </a>
                  </div>

                <?php } ?>

                <!-- SHOW IF THE STATUS IS CONFIRMED -->
                <?php if ($master->STATUS_ORDER == 'PAID') { ?>
                  <div class="trans-container-footer-receive">
                    <a href="#" class="receive-button text-secondary" data-id="<?= $master->ORDER_NO; ?>">
                      <span><i class="far fa-check-square pr-2"></i> Receive Order</span>
                    </a>
                  </div>
                <?php } ?>

              </div>


            </div>
          </div>

        </div>
        <?php $counter++; ?>
      <?php } ?>

    <?php } ?>
    <!-- EoL Main Transaction Loop -->

  </div>

</div>

<!-- Modal section -->
<div class="modal fade" id="messageModal" role="dialog" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
        <div class="message-holder">
          <div class="row mt-1 mb-1">
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <div class="d-flex justify-content-start">
                    <div class="admin-message-window">
                      <span class="font-weight-bold">
                        Admin
                      </span>
                      <br>
                      <span>
                        Heloo, apakah ada update dari status saya?
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ADMIN MESSAGE TIMESTAMP -->
              <div class="row">
                <div class="col-12">
                  <div class="d-flex justify-content-start">
                    <small class="font-italic">
                      <?= date('d-m-Y H:m'); ?>
                    </small>
                  </div>
                </div>
              </div>
              <!-- END OF ADMIN MESSAGE TIMESTAMP -->

            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="sender-messages">Enter Your Messages</label>
          <textarea name="sender-messages" class="form-control" id="sender-messages" rows="3"></textarea>
          <label for="sender-messages">Characters limit <span class="remaining-character">255</span></label>
          <div class="invalid-feedback">
            You've exceeded the characters limit
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <div class="d-flex justify-content-end">
          <div class="d-flex flex-row">
            <button type="button" class="btn btn-kku mt-0 mr-3 w-100" id="submitMessages">Send Message</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- EoL Modal Section -->

<script>
  $('#messageModal').on('show.bs.modal', function(e) {

    //Get the trigger data
    var button = $(e.relatedTarget);
    var recipient = button.data('transaction');

    //Create the URL for Controller
    // var url = baseUrl + 'General/Profile/getMessages?id=' + recipient;

    // $('.modal-body').load(url, function() {
    //   $(".message-holder").animate({
    //     scrollTop: $('.message-holder').prop("scrollHeight")
    //   }, 1000);
    //   $('#messageModal').modal({
    //     show: true
    //   });
    // });

  });
</script>