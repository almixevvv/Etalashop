<?php echo form_open_multipart('Faq_cms/addFaq');?>


<!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Add FAQ</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
      <input type="hidden" name="banner_id" style="width: 100%" >
      <label style="width: 6em;font-weight: bold;">Title FAQ</label>
      <label style="margin-left: 2em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
       <input type="text" name="faq_title" >
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
      <label style="width: 6em;font-weight: bold;">Content FAQ</label>
      <label style="margin-left: 2em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
      <textarea name="faq_content" class="md-textarea" style="width: 20em; height: 10em;"></textarea>
    </div>
  </div>

</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default btn-info">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
</div>


<?php echo form_close();?>

<script src="<?php echo base_url('assets/js/tiny_mce/tiny_mce.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php'); ?>"></script>
<script src="<?php echo base_url('assets/js/tiny_mce/tiny_mce_setting.js'); ?>"></script>

<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>