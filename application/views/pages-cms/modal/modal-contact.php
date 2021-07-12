<?php echo form_open('Form_contact_cms/update'); ?>
<script src="<?php echo base_url('assets/cms/tiny_mce/tiny_mce.js'); ?>"></script>
<script src="<?php echo base_url('assets/cms/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php'); ?>"></script>
<script src="<?php echo base_url('assets/cms/tiny_mce/tiny_mce_setting.js'); ?>"></script>
<script type="text/javascript">
  tinymce.init({
      selector: "#test"
  });
  </script>

<?php foreach($contact->result() as $data): ?>

              <div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
                <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Edit Contact Us</p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>  

              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                    <label style="font-weight: bold;">Title</label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <input type="hidden" name="contact_id" value="<?php echo $data->REC_ID;?>">
                    <textarea name="contact_title" id="test"class="md-textarea form-control" rows="5" style="font-size: 12px; width: 100%;"><?php echo $data->TITLE;?></textarea>
                  </div>
                </div>

                <br>

                <div class="row">
                  <div class="col-lg-12">
                    <label style="font-weight: bold;">Description</label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <textarea name="contact_desc" class="md-textarea form-control" rows="5" style="font-size: 12px; width: 100%;"><?php echo $data->DESCRIPTION;?></textarea>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-info">Save</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
              </div>       
              

<?php endforeach; ?>
<?php echo form_close(); ?>