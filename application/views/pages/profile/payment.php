
<div class="pages-container">
  <div class="pages-inner-container">

    <div class="row">
      <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="d-flex justify-content-center">
          <h4 class="text-uppercase text-center" style="color: #34ca9d">please select your payment method</h4>
        </div>
      </div>    
    </div>

      <div class="row mt-md-4 mt-lg-4 mt-xl-4">
        <div class="col-12 pb-5 pb-md-2 pb-lg-3 pt-3 pt-md-1">
          <div class="d-flex justify-content-center">
            
            <div class="accordion payment-accordion">

              <div class="card">
                <div class="card-header" id="heading-1">
                  <h2 class="mb-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="payment-options" id="payment-bca" value="bca" data-toggle="collapse" data-target="#container-bca" aria-expanded="false" aria-controls="container-bca">
                      <label class="form-check-label" for="payment-bca">
                        <span class="payment-label">Manual Transfer (BCA) 
                          <img id="bca-payment" src="<?php echo base_url('assets/images/bca-logo.png'); ?>"/>
                        </span>
                      </label>
                    </div>
                  </h2>
                </div>

                <div id="container-bca" class="collapse" aria-labelledby="heading-1" data-parent=".payment-accordion">
                  <div class="faq-card-container">
                    
                    <div class="d-flex flex-column bd-highlight mb-3">
                      <div class="d-flex justify-content-center">
                        <div class="p-2 bd-highlight">
                          <span class="text-center">BCA</span><br>
                          <span class="text-center">PT TRIMARAN INDAH SUKSES</span><br>
                          <span class="text-center">4073 0534 58</span>
                        </div>
                      </div>
                      <div class="p-2 bd-highlight">
                        <span>Total Payment</span>
                      </div>
                      <div class="p-2">
                        <span class="font-weight-bold font-italic payment-price main-color">
                          IDR <?php echo number_format($orderTotal, 2); ?>
                        </span>
                      </div>
                      <div class="p-2">
                        <span>Payment Requirement</span>
                      </div>
                      <div class="p-2">
                        <ul class="requirement-list" style="list-style-type: circle;">
                          <li class="text-capitalize">Payment can only be done by transfer to BCA Account</li>
                          <li class="text-capitalize">Your total order amount is not included for automatic verification process</li>
                          <li class="text-capitalize">Please transfer to the last 2 digits</li>
                        </ul>
                      </div>
                      <div class="p-2">
                        <div class="form-group">
                          <?php echo form_open('order/confirmation'); ?>
                            <input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
                            <input type="hidden" name="orderTotal" value="<?php echo $orderTotal; ?>">
                            <input type="hidden" name="transactionID" value="<?php echo $transactionID; ?>">
                            <button type="submit" class="btn btn-kku mt-0">Continue Payment</button>
                          <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="heading-2">
                  <h2 class="mb-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="payment-options" id="payment-visa" value="visa" data-toggle="collapse" data-target="#container-visa" aria-expanded="false" aria-controls="container-visa" />
                      <label class="form-check-label" for="payment-visa">
                        <span class="payment-label">VISA 
                          <img id="visa-payment" src="<?php echo base_url('assets/images/visa-logo.png'); ?>"/> 
                        </span>
                      </label>
                    </div>
                  </h2>
                </div>

                <div id="container-visa" class="collapse" aria-labelledby="heading-2" data-parent=".payment-accordion">
                  <div class="faq-card-container">
                    
                    <div class="d-flex flex-column bd-highlight mb-3">
                      <div class="p-2 bd-highlight">
                        <span>Total Payment</span>
                      </div>
                      <div class="p-2">
                        <span class="font-weight-bold font-italic payment-price main-color">
                          IDR <?php echo number_format($orderTotal, 2); ?>
                        </span>
                      </div>
                      <div class="p-2">
                        <span>Payment Requirement</span>
                      </div>
                      <div class="p-2">
                        <ul class="requirement-list" style="list-style-type: circle;">
                          <li class="text-capitalize">Payment can only be done by using VISA logo card</li>
                          <li class="text-capitalize">There's additional service fee of Rp. 2.500</li>
                          <li class="text-capitalize">If there's refund, the refund will be transfered to your credit card</li>
                        </ul>
                      </div>
                      <div class="p-2">
                        <div class="form-group">
                          <?php echo form_open('order/confirmation'); ?>
                            <input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
                            <input type="hidden" name="orderTotal" value="<?php echo $orderTotal; ?>">
                            <input type="hidden" name="transactionID" value="<?php echo $transactionID; ?>">
                            <button type="submit" class="btn btn-kku mt-0">Continue Payment</button>
                          <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="heading-3">
                  <h2 class="mb-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="payment-options" id="payment-mastercard" value="mastercard" data-toggle="collapse" data-target="#container-mastercard" aria-expanded="false" aria-controls="container-mastercard" />
                      <label class="form-check-label" for="payment-mastercard">
                        <span class="payment-label">Mastercard 
                          <img id="mastercard-payment" src="<?php echo base_url('assets/images/mastercard-logo.jpeg'); ?>"/>
                        </span>
                      </label>
                    </div>
                  </h2>
                </div>

                <div id="container-mastercard" class="collapse" aria-labelledby="heading-3" data-parent=".payment-accordion">
                  <div class="faq-card-container">
                    
                    <div class="d-flex flex-column bd-highlight mb-3">
                      <div class="p-2 bd-highlight">
                        <span>Total Payment</span>
                      </div>
                      <div class="p-2">
                        <span class="font-weight-bold font-italic payment-price main-color">
                          IDR <?php echo number_format($orderTotal, 2); ?>
                        </span>
                      </div>
                      <div class="p-2">
                        <span>Payment Requirement</span>
                      </div>
                      <div class="p-2">
                        <ul class="requirement-list" style="list-style-type: circle;">
                          <li class="text-capitalize">Payment can only be done by using Mastercard logo card</li>
                          <li class="text-capitalize">There's additional service fee of Rp. 2.500</li>
                          <li class="text-capitalize">If there's refund, the refund will be transfered to your credit card</li>
                        </ul>
                      </div>
                      <div class="p-2">
                        <div class="form-group">
                          <?php echo form_open('order/confirmation'); ?>
                            <input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
                            <input type="hidden" name="orderTotal" value="<?php echo $orderTotal; ?>">
                            <input type="hidden" name="transactionID" value="<?php echo $transactionID; ?>">
                            <button type="submit" class="btn btn-kku mt-0">Continue Payment</button>
                          <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>

          </div>
      </div>
    </div>

  </div>
</div>
