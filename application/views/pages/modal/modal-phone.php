<?php echo form_open('Profile/updatePhone');?>
<?php foreach($memberDetails->result() as $data): ?>

<!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.01rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 7em; font-size: 20px; font-weight: bold;"><i class="fas fa-phone"></i></i> Edit Phone Number</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row">
    <div class="col-lg-12">
    	<label style="margin-left: 2em;">Phone Number</label>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <input type="hidden" name="id" class="form-control" style="width: 90%; margin-left: 1.5em;" value="<?php echo $data->ID;?>">
      <input name="phone" class="form-control" style="width: 90%; margin-left: 1.5em;" value="<?php echo $data->PHONE;?>">
    </div>
  </div>
  
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default" style="background-color: #34ca9d;color: white;">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
</div>

<?php endforeach; ?>
<?php echo form_close();?>

