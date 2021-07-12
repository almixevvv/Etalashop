<?php foreach($payment->result() as $data): ?>

 <!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Check Payment</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Check Payment Data -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-4">
          <label style="font-weight: bold; width: 7em;">Payment Date</label>
          <label style="font-weight: bold; margin-left: 1em">:</label>
        </div>
        <div class="col-lg-8">
          <label name="payment_id" style="color: #2db4d6; font-weight: bold;"><?php echo $data->PAYMENT_DATE;?></label>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <label style="font-weight: bold; width: 7em;">Order ID</label>
          <label style="font-weight: bold; margin-left: 1em">:</label>
        </div>
        <div class="col-lg-8">
          <label name="payment_id" style="color: #2db4d6; font-weight: bold;"><?php echo $data->ORDER_ID;?></label>
        </div>
      </div>
      <hr>
    </div>

    <div class="col-lg-6">
      <div class="row">
        <div class="col-lg-12">
          <label style="font-weight: bold; width: 7em;">Acc. Name</label>
          <label style="font-weight: bold; margin-left: 1em">:</label>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <label name="payment_id" ><?php echo $data->ACCOUNT_NAME;?></label>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <label style="font-weight: bold; width: 7em;">Bank</label>
          <label style="font-weight: bold; margin-left: 1em">:</label>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <label name="payment_id" ><?php echo $data->ACCOUNT_BANK;?></label>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="row">
        <div class="col-lg-12">
          <label style="font-weight: bold; width: 7em;">Acc. Number</label>
          <label style="font-weight: bold; margin-left: 1em">:</label>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <label name="payment_id" style="color: #2db4d6; font-weight: bold;"><?php echo $data->ACCOUNT_NUMBER;?></label>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <label style="font-weight: bold; width: 7em;">Amount</label>
          <label style="font-weight: bold; margin-left: 1em">:</label>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <label name="payment_id" style="color: #2db4d6; font-weight: bold;"><?php echo number_format($data->PAYMENT_AMOUNT,2);?></label>
        </div>
      </div>
    </div>
  </div>
    
  <div class="row">
    <div class="col-lg-12">
    	<label style="font-weight: bold;">Payment Image</label>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
    	<img src="<?php echo base_url($data->PAYMENT_IMAGE);?>" style="width: 100%;">
    </div>
  </div>
</div>

<?php echo form_open('Orders_cms/confirmPayment');?>
<div class="modal-footer">
  <input type="hidden" name="hiddenid" value="<?php echo $data->ORDER_ID;?>">
  <button type="submit" class="btn btn-default btn-info">Confirm</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
</div>
<?php echo form_close();?>

<?php endforeach; ?>
