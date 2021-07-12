<?php echo form_open('General/Profile/updatePassword'); ?> 

<style type="text/css">
  .modal-header{
    background-color: #2dd6a7;
  }   
  .modal-body{
    font-size: 16px;
  }

  .label{
    margin-left: 2em;
  }

  .label-alert{ 
    color: grey;
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
</style>

<!-- HEADER -->
<div class="modal-header">
  <p class="title"><i class="fas fa-key"></i> Change Password</p>
  <button type="button" class="close mr-1 mt-0.5" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- Edit Margin -->
<div class="modal-body">
  <div class="row">
    <div class="col-lg-12">
      <label class="label">Old Password</label>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 2em;">
    <div class="col-lg-12">
      <input type="password" name="old_password" class="form-control form-input-modal">
    </div>
    <div class="col-lg-12 pl-4">
      <label class="label-alert pl-4">Insert Your Etalashop password, not password from another application account (Google).</label>
    </div>
    <div class="col-lg-12">
      <a href="#">
        <i class="label" class="main-color pl-1">Forgot Password?</i>
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <label class="label">New Password</label>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <input type="password" name="new_password" class="form-control" style="width: 90%; margin-left: 2em;">
    </div>
    <div class="col-lg-12 pl-4">
      <label style="margin-left: 2em; color: grey;">Your password must include a capital letter and a number. </label>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <label class="label">Confirm New Password</label>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <input type="password" name="confirm_password" class="form-control" style="width: 90%; margin-left: 2em;">
    </div>
  </div>


</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default btn-save">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
</div>

<?php echo form_close(); ?>