
<?php echo form_open('General/Profile/updatePhone'); ?> 

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

<?php foreach ($memberDetails->result() as $data) : ?>
 
  <!-- HEADER -->
  <div class="modal-header p-0.01">
    <p  class="title"><i class="fas fa-phone"></i></i> Edit Phone Number</p>
    <button type="button" class="close mr-1 mt-0.5" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <!-- Edit Margin -->
  <div class="modal-body">
    <div class="row">
      <div class="col-lg-12 pl-20">
        <label class="label">Phone Number</label>
      </div>
    </div>

    <div class="row" style=" margin-bottom: 1em;">
      <div class="col-lg-12">
        <input type="hidden" name="id" class="form-control form-input-modal" value="<?php echo $data->ID; ?>">
        <input name="phone" class="form-control form-input-modal" value="<?php echo $data->PHONE; ?>">
      </div>
    </div>

  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-default btn-save">Save</button>
    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
  </div>

<?php endforeach; ?>
<?php echo form_close(); ?>