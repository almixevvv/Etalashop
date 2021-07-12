  <style>
    .filter-menu {
      color: #18a2b8;
      font-size: .8rem;

    }

    .btn-outline-info:hover .filter-menu {
      color: white;
    }

    .new-order {
      background: linear-gradient(to top left, #ffffff 80%, #2dd6a8 100%);
    }

    .primary-theme-color {
      color: #2db4d6;
    }

    .modal-header {
      background-color: #2dd6a7;
      color: white;
      font-weight: bold;
    }

    .secondary-theme-color {
      color: #00b011;
    }

    #status-color {
      color: #1f8a18;
    }

    .action-button-text {
      font-size: .8rem;
    }
  </style>

  <!-- ORDER PART -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates-cms/frame_side'); ?>
    <!-- EoL Sidebar -->

    <!-- Main Content -->
    <div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">

          <div class="card-header">
            <i class="fas fa-clipboard-list"></i>
            <b>Order Management</b>
          </div>

          <div class="card-body">

            <div class="row">
              <div class="col-12">
                <div>
                  <label class="mb-1">Search by Status :</label>
                </div>
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-12">
                <div class="d-flex justify-content-between">

                  <button class="btn btn-outline-info rounded flex-grow-1 mx-3 ">
                    <a class="filter-menu text-uppercase font-weight-bold" href="#">
                      all
                    </a>
                  </button>

                  <button class="btn btn-outline-info rounded flex-grow-1 mx-3 ">
                    <a class="filter-menu text-uppercase font-weight-bold" href="#">
                      new order
                    </a>
                  </button>

                  <button class="btn btn-outline-info rounded flex-grow-1 mx-3 ">
                    <a class="filter-menu text-uppercase font-weight-bold" href="#">
                      updated
                    </a>
                  </button>

                  <button class="btn btn-outline-info rounded flex-grow-1 mx-3 ">
                    <a class="filter-menu text-uppercase font-weight-bold" href="#">
                      confirmed
                    </a>
                  </button>

                  <button class="btn btn-outline-info rounded flex-grow-1 mx-3 ">
                    <a class="filter-menu text-uppercase font-weight-bold" href="#">
                      paid
                    </a>
                  </button>

                  <button class="btn btn-outline-info rounded flex-grow-1 mx-3 ">
                    <a class="filter-menu text-uppercase font-weight-bold" href="#">
                      canceled
                    </a>
                  </button>

                  <button class="btn btn-outline-info rounded flex-grow-1 mx-3 ">
                    <a class="filter-menu text-uppercase font-weight-bold" href="#">
                      done
                    </a>
                  </button>

                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-12">
                <div class="table-responsive mt-1">

                  <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                      <tr>
                        <th width="4%">No</th>
                        <th width="24%">Order Info</th>
                        <th width="24%">Shipping Info</th>
                        <th width="30%">Order Value</th>
                        <th width="10%">Action</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php $no = 1;
                      foreach ($content->result() as $dt) {
                      ?>
                        <tr>

                          <td id="order_<?= $no; ?>" class="<?= ($dt->VIEW_FLAG == 0 ? 'new-order' : ''); ?>">
                            <?= $no; ?>
                          </td>


                          <td>
                            <div class="row">
                              <div class="col-5">
                                <span class="font-weight-bold">Order No</span>
                              </div>
                              <div class="col-7">
                                <div class="font-weight-bold">: <span class="primary-theme-color"><?= $dt->ORDER_NO; ?></span></div>
                              </div>
                            </div>

                            <div class="row mt-2">
                              <div class="col-5">
                                <span class="font-weight-bold">Order Date</span>
                              </div>
                              <div class="col-7">
                                <div class="font-weight-bold">: <span class="primary-theme-color"><?= date('Y-m-d h:i', strtotime($dt->ORDER_DATE)); ?></span></div>
                              </div>
                            </div>

                            <div class="row mt-2">
                              <div class="col-12">
                                <span class="font-weight-bold" id="status-color"><?= $dt->STATUS_ORDER; ?></span>
                              </div>
                            </div>


                            <div class="row mt-2 <?= ($dt->STATUS_ORDER != 'NEW ORDER' ? 'd-block' : 'd-none'); ?>">
                              <div class="col-12">
                                <button class="btn btn-warning btn-invoice text-white" type="button" data-orderid="<?= $dt->ORDER_NO; ?>">Send Invoice</button>
                                <span class="<?= ($dt->FLAG == 1 ? 'd-block' : 'd-none'); ?>">
                                  <i class="pl-2 fas fa-clipboard-check secondary-theme-color"></i>
                                  <label class="secondary-theme-color">Invoice Sent!</label>
                                </span>
                              </div>
                            </div>

                            <div class="row mt-2 <?= (($dt->STATUS_ORDER != 'NEW ORDER') && ($dt->STATUS_ORDER != 'UPDATED') ? 'd-block' : 'd-none'); ?>">
                              <div class="col-12">
                                <button class="btn btn-success btn-payment text-white" type="button" data-orderid="<?= $dt->ORDER_NO; ?>">Check Payment</button>
                              </div>
                            </div>

                          </td>

                          <td>
                            <div class="row">
                              <div class="col-12">
                                <div class="font-weight-bold"><?= $dt->MEMBER_NAME ?></div>
                                <div class="mt-4">
                                  <div><?= $dt->ADDRESSO_1 . ', ' . $dt->ADDRESSO_2; ?></div>
                                  <div><?= $dt->STATE . ' - ' . $dt->ZIP; ?></div>
                                  <div><?= $dt->COUNTRY_ORDER; ?></div>
                                  <div class="mt-4 font-weight-bold primary-theme-color"><?= $dt->MEMBER_PHONE; ?></div>
                                  <span class="font-weight-bold primary-theme-color"><?= $dt->MEMBER_EMAIL; ?></span>
                                </div>
                              </div>
                          </td>

                          <td>

                            <div class="row">
                              <div class="col-12">
                                <div class="font-weight-bold">(Total Product)</div>
                              </div>
                            </div>

                            <div class="row">
                              <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 font-weight-bold'>Product </div>
                              <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 font-weight-bold' style="color:#2db4d6;text-align: right;"> <?= number_format($dt->AMOUNT, 2); ?></div>
                            </div>

                            <div class="row">
                              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 font-weight-bold'> Shipping Cost </div>
                              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 font-weight-bold' style="color:#2db4d6;text-align: right;"> <?= number_format($dt->TOTAL_POSTAGE, 2); ?> </div>
                            </div>

                            <hr style="border :1px solid; width: 6em;" align="right">

                            <div class="row">
                              <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 font-weight-bold'> Total </div>
                              <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 font-weight-bold' style="color:#2db4d6;text-align: right;"> <?= number_format($dt->AMOUNT + $dt->TOTAL_POSTAGE, 2); ?> </div>
                            </div>

                            <div class="row" style="margin-top: 2em;">
                              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 font-weight-bold' style="color:#2db4d6;"> Last Edit By Admin</div>
                              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 font-weight-bold' style="color:#2db4d6;text-align: right;"> <?= $dt->UPDATED; ?> </div>
                            </div>
                          </td>

                          <td>
                            <div class="row">
                              <div class="col-12">
                                <button class="btn btn-info action-button-text w-100" type="button" data-toggle="modal" data-target="#order-details" data-orderno="<?= $dt->ORDER_NO; ?>" data-rowid="order_<?= $no; ?>">VIEW</button>
                              </div>
                            </div>
                            <div class="mt-2 row">
                              <div class="col-12">
                                <button class="btn btn-danger action-button-text w-100 buttonDelete" type="button" data-orderno="<?= $dt->ORDER_NO; ?>">DELETE</button>
                              </div>
                            </div>
                          </td>

                        </tr>
                      <?php $no++;
                      } ?>
                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

        </div>
      </div>

    </div>
    <!-- EoL Main Content -->

    <?php $this->load->view('pages-cms/modal/modal-orders'); ?>


  </div>
  <!-- EoL ORDER PART -->
  <script src="<?= base_url('assets/incube-assets/orderManagement.1.0.js'); ?>"></script>

  <!-- Sticky Footer -->
  <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright © Incube Solutions <?= date('Y'); ?></span>
      </div>
    </div>
  </footer>
  <!-- EoL Foooter -->