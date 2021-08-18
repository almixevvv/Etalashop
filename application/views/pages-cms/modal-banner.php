<?php echo form_open_multipart('Banner_cms/updateBanner');?>
<?php foreach($banner->result() as $data): ?>

<!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Edit Banner</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<input type="hidden" name="banner_id" style="width: 100%" value="<?php echo $data->REC_ID;?>">
    	<label style="width: 5em;font-weight: bold;">Type</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
      <select name="banner_type" id="inputCategory" class="form-control modal-status">
        <option selected="">- Select Type -</option>
        <option value="MAIN">Main</option>
        <option value="BOTTOM">Bottom</option>
      </select>
       <!-- <input type="text" name="banner_type" value="<?php echo $data->TYPE;?>"> -->
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Link Type</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
       <input type="text" name="banner_linkType" value="<?php echo $data->LINK_TYPE;?>">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Link To</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input name="banner_linkTo" style="width: 100%" value="<?php echo $data->LINKTO;?>">
    </div>
  </div>

 <!--  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Order No</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input name="banner_orderNo" style="width: 100%" value="<?php echo $data->ORDER_NO;?>">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Flag</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input name="banner_flag" style="width: 100%" value="<?php echo $data->FLAG;?>">
    </div>
  </div> -->

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
      <label style="width: 5em;font-weight: bold;">Description</label>
      <label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input name="banner_description" style="width: 100%" value="<?php echo $data->DESCRIPTION;?>">
    </div>
  </div>
</div>

<div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-5">
      <label style="width: 5em;font-weight: bold; margin-left: 1em;">Image</label>
      <label style="margin-left: 2.8em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-7">
      <p name="banner_image"><?php echo "<img style='width: 20%; margin-left: -2.5em;' src='".base_url().$data->BANNER_IMAGE."'></img>"; ?></p>
    </div>
  </div>
</div>

<!-- ini maunya buat edit foto tapi pake upload foto -->
  

 <div class="row">
    <div class="col-lg-5 ml-5 mt-4">
      <img id="uploadprev2" src="<?php echo base_url('assets/img/no-image.png');?>" style="width: 300px;height: 300px; "/>
    </div>
    <div class="col-lg-6 mt-4">
      <div class="row">
        <div class="col-lg-6 mt-4">
          <input id="imgupload2" type="file" title="Banner Image" name="file_image" action="<?php echo base_url('Banner_cms/addBanner'); ?>" />
        </div>
      </div>
    </div>
  </div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default btn-info">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
</div>

<?php endforeach; ?>
<?php echo form_close();?>

  <!-- ---------Modal Script------------ -->
  <script type="text/javascript">

    function readPreview(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function(e) {
          $('#uploadprev2').attr('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imgupload2").change(function() {
      readPreview(this);
    });

  </script>

<!-- ---------End Modal Script------------ -->