<?php echo form_open('CMS/Contact_cms/updateContact'); ?>
<?php foreach ($contact->result() as $data) : ?>

  <!-- HEADER -->
  <div class="modal-header bg-primary" style="padding: 0.2rem;">
    <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Edit <?php echo $data->TITLE; ?></p>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <!-- Edit Margin -->
  <div class="modal-body" style="font-size: 14px;">

    <div class="row" style=" margin-bottom: 1em;">
      <div class="col-lg-12">
        <label>Content</label>
        <input type="hidden" name="txt_id" id="txt_id" class="form-control" value="<?php echo $data->REC_ID; ?>">
        <input type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo $data->CONTENT; ?>">
      </div>
    </div>

  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-default btn-info">Save</button>
    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
  </div>

<?php endforeach; ?>
<?php echo form_close(); ?>