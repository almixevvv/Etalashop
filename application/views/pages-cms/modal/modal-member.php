<?php echo form_open('Member_cms/updateMember');?>
<?php foreach($member->result() as $data): ?>

<!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Edit Member</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<input type="hidden" name="member_id" style="width: 100%" value="<?php echo $data->ID;?>">
    	<label style="width: 5em;font-weight: bold;">Name</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <?php echo $data->FIRST_NAME;?> <?php echo $data->LAST_NAME;?>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Birth Date</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <?php echo $data->BIRTH_DATE;?>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Email</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input name="member_email" style="width: 100%" value="<?php echo $data->EMAIL;?>">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Phone</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input name="member_phone" style="width: 100%" value="<?php echo $data->PHONE;?>">
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
    	<label style="width: 5em;font-weight: bold;">Address 1</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
    	<textarea name="member_add1" class="md-textarea form-control" rows="3" style="font-size: 12px; width: 100%;"><?php echo $data->ADDRESS;?></textarea>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
    	<label style="width: 5em;font-weight: bold;">Address 2</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
    	<textarea name="member_add2" class="md-textarea form-control" rows="3" style="font-size: 12px; width: 100%;"><?php echo $data->ADDRESS_2;?></textarea>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Country</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input name="member_country" style="width: 100%" value="<?php echo $data->COUNTRY;?>">
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Province</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input name="member_province" style="width: 100%" value="<?php echo $data->PROVINCE;?>">
    </div>
  </div>
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default btn-info">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
</div>

<?php endforeach; ?>
<?php echo form_close();?>