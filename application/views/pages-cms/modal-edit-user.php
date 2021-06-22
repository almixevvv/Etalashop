<?php echo form_open('User_cms/updateAccount');?>
<?php foreach($content->result() as $data): ?>

<!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Edit User Account</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<input type="hidden" name="hidden_id" style="width: 100%" value="<?php echo $data->ID; ?>">
    	<label style="width: 5em;font-weight: bold;">ID</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input disabled="" name="acc_id" style="width: 100%" value="<?php echo $data->ID; ?>" class="form-control">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
      <label style="width: 5em;font-weight: bold;">Name</label>
      <label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <input name="acc_name" style="width: 100%" value="<?php echo $data->NAME; ?>" class="form-control">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
    	<label style="width: 5em;font-weight: bold;">Group</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <select style="width: 50%" name="acc_group" class="form-control">
          <?php 
          foreach($group->result() as $s_group): 
            if($s_group->ID==$data->GROUP_ID){
              ?>
               <option value="<?php echo $s_group->ID?>" selected="selected"><?php echo $s_group->NAME; ?></option>
              <?php
            }
            else{
              ?>
               <option value="<?php echo $s_group->ID?>"><?php echo $s_group->NAME; ?></option>
              <?php
            }
            endforeach; 
          ?>  
        </select>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-4">
      <label style="width: 5em;font-weight: bold;">Status</label>
      <label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-8">
        <select style="width: 50%" name="acc_status" class="form-control">
          <?php
           if($data->STATUS=="ACTIVE"){
            ?>
             <option value="ACTIVE" selected="selected">ACTIVE</option>
             <option value="INACTIVE">INACTIVE</option>
            <?php
           }
           else{
             ?>
             <option value="ACTIVE" >ACTIVE</option>
             <option value="INACTIVE" selected="selected">INACTIVE</option>
            <?php
           }
          ?>
         
        </select>
    </div>
  </div>
  
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default btn-info">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
</div>

<?php endforeach; ?>
<?php echo form_close();?>

