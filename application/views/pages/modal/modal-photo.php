<?php echo form_open_multipart('Profile/updatePhoto');?>
<?php foreach($memberDetails->result() as $data): ?>

<!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.01rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 7em; font-size: 20px; font-weight: bold;"><i class="fas fa-image"></i></i> Change Photo</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row">
    <center>
      <input type="hidden" name="id" value="<?php echo $data->ID; ?>">
      <input type="file" name="file_name" data-multiple-caption="{count} files selected" style="margin-left: 4em; margin-top: 2em;">
      <label class="navbar-text" style="font-size: 12px;">Allowed file extension: .JPG .JPEG .PNG</label>
    </center>
  </div>
  
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default" style="background-color: #34ca9d;color: white;">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
</div>

<?php endforeach; ?>
<?php echo form_close();?>

