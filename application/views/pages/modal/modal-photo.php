<?php echo form_open_multipart('General/Profile/updatePhoto'); ?> 

<style type="text/css">
  .modal-header{
    background-color: #2dd6a7;
  }   
  .modal-body{
    font-size: 16px;
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
    <p class="modal-title" style="text-align: left"><i class="fas fa-map-marker-alt"></i> Change Photo </p>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" style="text-align: right">&times;</span>
    </button> 
  </div>

  <!-- Edit Margin -->
  <div class="modal-body" style="font-size: 14px;">
    <?php echo form_open_multipart('') ?>
    <div class="custom-file mb-1">
      <input type="hidden" name="id" value="<?php echo $data->ID; ?>">
      <input type="file" name="file_name" data-multiple-caption="{count} files selected" class="custom-file-input" id="validatedCustomFile" required>
      <label class="custom-file-label" for="validatedCustomFile">Choose file...</label> 
    </div> 
    <label class="navbar-text" style="font-size: 12px;">Allowed file extension: .JPG .JPEG .PNG</label>

  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-default btn-save">Save</button>
    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
  </div>

<?php endforeach; ?>
<?php echo form_close(); ?>