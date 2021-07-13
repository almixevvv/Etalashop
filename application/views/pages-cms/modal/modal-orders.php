<style>
  textarea[name="spc_instruction"] {
    height: 69px !important;
  }

  .custom-select {
    width: 95%;
  }

  #order-details+.font-weight-bold {
    font-size: .8rem;
  }
</style>


<!-- Modal Product Details -->
<div class="modal fade" id="order-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Order Management</h4>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="#">

          <!-- Detail Header -->
          <div class="row">
            <div class="col-lg-12">

              <div class="row">
                <div class="col-2">
                  <span class="font-weight-bold">Order No</span>
                </div>
                <div class="col-4 pl-0">
                  <span class="mr-2">:</span>
                  <span class="primary-theme-color font-weight-bold" id="orderNo">31239054</span>
                </div>

                <div class="col-6">
                  <div class="row">
                    <div class="col-7">
                      <span class="font-weight-bold">Special Instruction</span>
                    </div>
                    <div class="col-5">
                      <span>:</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-6">
                  <div class="row">
                    <div class="col-4">
                      <span class="font-weight-bold">Order Date</span>
                    </div>
                    <div class="col-7 pl-0">
                      <span class="mr-2">:</span>
                      <span class="primary-theme-color font-weight-bold" id="orderDate">20-20-2021 09:00</span>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-4">
                      <span class="font-weight-bold">Order Status</span>
                    </div>
                    <div class="col-8 pl-0">
                      <div class="d-inline">
                        <label for="orderStatus" style="margin-right: 4px;">:</label>
                        <select class="custom-select" id="orderStatus" name="order-status">
                          <option selected value="NEW ORDER">NEW ORDER</option>
                          <option value="UPDATED">UPDATED</option>
                          <option value="CONFIRMED">CONFIRMED</option>
                          <option value="PAID">PAID</option>
                          <option value="CANCELED">CANCELED</option>
                          <option value="CLOSED">CLOSED</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <textarea name="spc_instruction" class="md-textarea form-control" id="orderInstruction" rows="2" cols="50">SPESHAL</textarea>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-12">
                  <div class="row">
                    <div class="col-2">
                      <span class="font-weight-bold">Last Update</span>
                    </div>
                    <div class="col-8 pl-0">
                      <span class="mr-2">:</span>
                      <span class="font-weight-bold primary-theme-color" id="orderUpdated">
                        20-20-2021 19:01 by Admin
                      </span>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- EoL Detail Header -->

          <!-- Detail Separator -->
          <div class="row">
            <div class="col-12 px-0 mx-0">
              <hr>
            </div>
          </div>
          <!-- EoL Detail Separator -->

          <!-- Member Detail Header -->
          <div class="row">
            <div class="col-8">
              <span class="font-weight-bold text-uppercase primary-theme-color">member info</span>
            </div>
            <div class="col-4">
              <span class="font-weight-bold text-uppercase primary-theme-color">messages</span>
            </div>
          </div>
          <!-- EoL Member Detail Header -->

          <!-- Detail Separator -->
          <div class="row">
            <div class="col-12 px-0 mx-0">
              <hr class="mt-1">
            </div>
          </div>
          <!-- EoL Detail Separator -->

          <!-- Member Detail -->
          <div class="row">

            <div class="col-8">

              <!-- Member Details -->
              <div class="member-details">
                <div class="row">
                  <div class="col-2">
                    <span class="font-weight-bold text-capitalize">name</span>
                  </div>
                  <div class="col-4">
                    <div id="memberName">
                      <span class="mr-2">:</span>
                    </div>
                  </div>
                  <div class="col-2 pl-0">
                    <span class="font-weight-bold text-capitalize">Mobile</span>
                  </div>
                  <div class="col-3 px-0">
                    <div id="memberMobile">
                      <span class="mr-2">:</span>
                    </div>
                  </div>
                </div>

                <div class="row my-2">
                  <div class="col-3">
                    <div>
                      <span class="font-weight-bold text-capitalize">address</span>
                    </div>
                  </div>
                  <div class="col-9">
                    <p class="mb-0" style="margin-left: -45px;" id="memberAddress">
                    </p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2">
                    <span class="font-weight-bold text-capitalize">email</span>
                  </div>
                  <div class="col-10">
                    <div id="memberEmail">
                      <span class="mr-2">:</span>
                    </div>
                  </div>
                </div>

              </div>
              <!-- EoL Member Details -->

              <!-- Shipping Details -->
              <div class="shipping-details">

                <div class="row mt-5">
                  <div class="col-12 pl-0">
                    <span class="font-weight-bold text-uppercase primary-theme-color pl-3">shipping info</span>
                    <hr class="my-2">
                  </div>
                </div>

                <div class="row">
                  <div class="col-2">
                    <span class="font-weight-bold text-capitalize">name</span>
                  </div>
                  <div class="col-4">
                    <div id="shippingName">
                      <span class="mr-2">:</span>
                    </div>
                  </div>
                  <div class="col-2 pl-0">
                    <span class="font-weight-bold text-capitalize">Mobile</span>
                  </div>
                  <div class="col-3 px-0">
                    <div id="shippingMobile">
                      <span class="mr-2">:</span>
                    </div>
                  </div>
                </div>

                <div class="row my-2">
                  <div class="col-3">
                    <div>
                      <span class="font-weight-bold text-capitalize">address</span>
                    </div>
                  </div>
                  <div class="col-9">
                    <p class="mb-0" style="margin-left: -45px;" id="shippingAddress">
                    </p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2">
                    <span class="font-weight-bold text-capitalize">email</span>
                  </div>
                  <div class="col-10">
                    <div id="shippingEmail">
                      <span class="mr-2">:</span>
                    </div>
                  </div>
                </div>

              </div>
              <!-- EoL Shipping Details -->

            </div>
            <div class="col-4">

              <!-- Order Message Header -->
              <span class="font-weight-bold text-uppercase primary-theme-color">messages</span>
              <!-- EoL Order Message Header -->

              <!-- Order Messages -->

              <!-- EoL Order Messages -->
            </div>
          </div>
          <!-- EoL Member Detail -->

          <!-- Detail Separator -->
          <div class="row mt-5">
            <div class="col-12 px-0 mx-0">
              <hr class="mt-1">
            </div>
          </div>
          <!-- EoL Detail Separator -->

          <!-- Product Detail -->
          <div class="row">
            <div class="col-12">
              <span class="font-weight-bold text-uppercase primary-theme-color">detail order</span>
            </div>
          </div>
          <!-- EoL Product Detail -->

          <!-- Detail Separator -->
          <div class="row">
            <div class="col-12 px-0 mx-0">
              <hr class="mt-1">
            </div>
          </div>
          <!-- EoL Detail Separator -->

          <div class="row">

            <div class="col-12 detail-loop">

              <!-- Main Loop Template -->
              <div class="row original-loop d-none">
                <!-- Detail Image -->
                <div class="col-2">

                  <div class="p-2 border">
                    <img class="img-fluid productImage">
                  </div>

                </div>
                <!-- EoL Detail Image -->


                <!-- Detail Info -->
                <div class="col-5">

                  <div class="row">
                    <div class="col-12">
                      <span class="font-weight-bold primary-theme-color text-uppercase">product info</span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-5 pr-0">
                      <span class="font-weight-bold">Product ID</span>
                    </div>
                    <div class="col-7 px-0">
                      <p class="mb-0 productID">
                      </p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-5 pr-0">
                      <span class="font-weight-bold">Product Name</span>
                    </div>
                    <div class="col-7 px-0">
                      <p class="mb-0 productName">
                      </p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-5 pr-0">
                      <span class="font-weight-bold">Order Price</span>
                    </div>
                    <div class="col-7 px-0">
                      <p class="mb-0 productPrice">
                      </p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-5 pr-0">
                      <span class="font-weight-bold">Order Qty</span>
                    </div>
                    <div class="col-7 px-0">
                      <p class="mb-0 productQty">
                      </p>
                    </div>
                  </div>


                </div>
                <!-- EoL Detail Info -->



                <!-- Detail Inquiry -->
                <div class="col-5">

                  <div class="col-12">
                    <br>
                  </div>

                  <div class="row">
                    <div class="col-5">
                      <span class="font-weight-bold">Order Queries</span>
                    </div>
                    <div class="col-1">
                      <span>:</span>

                    </div>
                    <div class="col-12 pt-2">
                      <textarea class="md-textarea form-control pt-2 productQueries" name="inquiry" id="inquiry" cols="30" rows="2"></textarea>
                    </div>
                  </div>

                </div>
                <!-- EoL Detail Inquiry -->
              </div>

              <div class="row productSeparator d-none">
                <div class="col-12">
                  <hr>
                </div>
              </div>
              <!-- EoL Main Loop Template -->

            </div>

          </div>

          <!-- Detail Pricing -->
          <div class="row">
            <div class="col-3 offset-5 text-right">
              <span class="font-weight-bold text-capitalize pt-4">product amount</span>
            </div>
            <div class="col-4">
              <input id="productAmount" class="form-control text-right" type="text" value="<?= number_format('20000', 2, ',', '.'); ?>" id="txtPrice" disabled>
            </div>
          </div>

          <div class="row my-2">
            <div class="col-3 offset-5 text-right">
              <span class="font-weight-bold text-capitalize pt-4">shipping cost</span>
            </div>
            <div class="col-4">
              <input id="productPostage" class="form-control text-right" type="text" value="<?= number_format('20000', 2, ',', '.'); ?>" id="txtPrice" disabled>
            </div>
          </div>

          <div class="row">
            <div class="col-3 offset-5 text-right">
              <span class="font-weight-bold text-capitalize pt-4">total</span>
            </div>
            <div class="col-4">
              <input id="productTotal" class="form-control text-right" type="text" value="<?= number_format('20000', 2, ',', '.'); ?>" id="txtPrice" disabled>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="font-weight-bold text-capitalize">
                internal notes
                <span class="pl-2">:</span>
              </div>
            </div>
            <div class="col-12">
              <textarea id="internalNotes" name="spc_instruction" class="md-textarea form-control" rows="2" cols="50">SPESHAL</textarea>
            </div>
          </div>
          <!-- EoL Detail Pricing -->

        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-info" id="btnSaveData">Save Data</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Product Details -->