
<!-- CUSTOM DATE PICKER JAVASCRIPT -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="order-confirmation-container">

  <form action="<?php echo base_url('PaymentProcess/manualProcess'); ?>" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>

  <div class="order-confirmation-inner-container">

    <div class="row">

      <div class="col-12 mb-3">
        <div class="d-flex justify-content-center">
          <h4 class="main-color text-uppercase">Payment Confirmation</h4>
        </div>
      </div>
    
      <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        
        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
              <label for="uAccountName">Account Name</label>
                <input type="text" class="form-control" name="uAccountName" id="uAccountName" onfocus="resetValidation()" placeholder="Enter your account name" required>
                <div class="invalid-feedback">
                  Account Name is Required
                </div>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
              <label for="uAccountNumber">Account Number</label>
              <input type="number" class="form-control" name="uAccountNumber" id="uAccountNumber" onfocus="resetValidation()" placeholder="Enter your account number" required>
              <div class="invalid-feedback">
                Account number is Required
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          
          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
              <label for="uBankName">Bank Name</label>
              <select class="form-control" id="uBankName" name="uBankName">
                <option value="mandiri">Mandiri</option>
                <option value="bca">BCA</option>
                <option value="cimb">CIMB Niaga</option>
                <option value="bri">BRI</option>
                <option value="bni">BNI</option>
                <option value="others">Lainnya</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="uAdditionalBank" id="uAdditionalBank" onfocus="resetValidation()" placeholder="Enter your bank name" >
            </div>
          </div>

        </div>

      </div>

      <div class="col-12 col-md-6 col-lg-6 col-xl-6">

        <div class="row">
            
          <div class="col-12">

            <div class="form-group">
              <label for="uAccountNumber">Transfer Amount</label>
              <input type="number" class="form-control" name="uAccountPayment" id="uAccountNumber" onfocus="resetValidation()" placeholder="Enter your account number" required pattern="[0-9]*" />
              <div class="invalid-feedback">
                Account number is Required
              </div>
            </div>

          </div>

        </div>

        <div class="row">
          
          <div class="col-12">
            <div class="form-group">
              <label for="datepicker">Transfer Date</label>
              <input id="datepicker" class="form-control" name="uTransferDate" required />
            </div>
          </div>

        </div>

        <div class="row">
          
          <div class="col-12">
            <div class="form-group">
              <label for="uReceipt">Transfer Receipt</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="uReceipt" name="uReceipt" accept="image/*" required>
                <label class="custom-file-label" for="uReceipt">Choose Transfer Receipt</label>
              </div>
            </div>
            <div class="invalid-feedback">
              Receipt can't be empty
            </div>
          </div>

        </div>
        
      </div>

      <?php //HIDDEN INPUT FOR ORDER ID ?>
      <input type="hidden" name="payment-order-value" value="<?php echo $orderID; ?>">
      <input type="hidden" name="payment-transaction-id" value="<?php echo $transactionID; ?>">

      <div class="col-6 col-md-7 col-lg-5 col-xl-4 ">
        <button type="submit" class="btn btn-kku">Submit Payment</button>
      </div>

    </div>

  </div>

  </form>

</div>

<script type="text/javascript">

  $('#datepicker').datepicker({
    uiLibrary: 'bootstrap4'
  });

  <?php if($this->session->userdata('upload') == 'error'): ?>
	swal.fire({
		title:'Payment Confirmation Error',
		text: 'There is something wrong with your confirmation process. Please try again later.',
		type: 'error',
		showCancelButton: false,
	});
  <?php endif; ?>

  $('#uAdditionalBank').hide();

  $('#uBankName').change(function() {

    var value = $(this).find(":selected").val();

    if(value === 'others') {
      $('#uAdditionalBank').show();
    } else {
      $('#uAdditionalBank').hide();
    }

  });

  $("#uReceipt").change(function() {
    
    var fileName = $("#uReceipt").prop('files')[0]["name"];

    // $("inputDisplayFileName").val(fileName);
    $('.custom-file-label').text(fileName);

  });
  
  formOveride();

</script>