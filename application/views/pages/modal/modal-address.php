<?php echo form_open('General/Profile/updateAddress'); ?>

<style type="text/css">
  .modal-header{
    background-color: #2dd6a7;
  }   
  .modal-body{
    font-size: 16px;
  }

  .label{
    margin-left: 2em;
    font-size: 16px;
  }

  .label-small{ 
    font-size: 16px;
  }

  .form-input-modal{
    width: 90%; 
    margin-left: 1.5em;
  }

  .btn-save{
    background-color: #34ca9d;
    color: white;
  }
  .title{
    color: white;
    margin-top: 0.5em; 
    margin-left: 7em; 
    font-size: 20px; 
    font-weight: bold;
  }

  .modal-title{
    color: #fff;
    font-weight: bold;
    font-size: 20px;
  }
</style>

<?php foreach ($memberDetails->result() as $data) : ?> 

  <!-- HEADER -->
  <div class="modal-header">
    <p class="modal-title" style="text-align: left"><i class="fas fa-map-marker-alt"></i> Change Address </p>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" style="text-align: right">&times;</span>
    </button> 
  </div>

  <!-- Edit Margin -->
  <div class="modal-body" style="font-size: 14px;">
    <div class="row">
      <div class="col-lg-12">
        <label class="label">Address</label>
      </div>
    </div>

    <div class="row" style=" margin-bottom: 1em;">
      <div class="col-lg-12">
        <input type="hidden" name="id" class="form-control" value="<?php echo $data->ID; ?>">
        <textarea name="add1" class="md-textarea form-control form-input-modal" rows="3"><?php echo $data->ADDRESS; ?></textarea>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <label class="label">Address 2</label>
      </div>
    </div>

    <div class="row" style=" margin-bottom: 1em;">
      <div class="col-lg-12">
        <textarea name="add2" class="md-textarea form-control form-input-modal" rows="3"><?php echo $data->ADDRESS_2; ?></textarea>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <label class="label-small ml-4">Country</label>
      </div>
      <div class="col-lg-4">
        <label class="label-small ml-3">Province</label>
      </div>
      <div class="col-lg-4">
        <label class="label-small">Zip Code</label>
      </div>
    </div>

    <div class="row" style=" margin-bottom: 1em;">
      <div class="col-lg-4">
        <input name="country" class="form-control" style="width: 90%; margin-left: 1.5em;" value="<?php echo $data->COUNTRY; ?>">
      </div>

      <div class="col-lg-4">
        <input name="province" class="form-control" style="width: 90%; margin-left: 0.6em;" value="<?php echo $data->PROVINCE; ?>">
      </div>

      <div class="col-lg-4">
        <input name="zip" class="form-control" style="width: 90%; margin-left: -0.5em;" value="<?php echo $data->ZIP; ?>">
      </div>
    </div>


  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-default" style="background-color: #34ca9d;color: white;">Save</button>
    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
  </div>

<?php endforeach; ?>
<?php echo form_close(); ?>