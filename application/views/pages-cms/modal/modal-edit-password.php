<?php echo form_open('CMS/updatePassword');?>

<!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Change Password</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-6">
    	<label style="width: 10em;font-weight: bold;">New Password</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-6">
        <input type="Password" name="new_pass" class="form-control" id="new_pass" style="width: 100%;margin-top: -0.5em;">
    </div>
  </div>
  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-6">
      <label style="width: 10em;font-weight: bold;">Confirm Password</label>
      <label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-6">
        <input type="Password" name="confirm_pass" class="form-control" id="confirm_pass" style="width: 100%;margin-top: -0.5em;">
    </div>
  </div>
  
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default btn-info">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
</div>

<?php echo form_close();?>