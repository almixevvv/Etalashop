<?php echo form_open('CMS/User_cms/updateUser'); ?>
<?php foreach ($user->result() as $data) : ?>

  <!-- HEADER -->
  <div class="modal-header bg-primary" style="padding: 0.2rem;">
    <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Edit User</p>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <!-- Edit Margin -->
  <div class="modal-body" style="font-size: 14px;">

    <div class="row" style=" margin-bottom: 1em;">
      <div class="col-lg-12">
        <label>User ID</label>
        <input type="text" name="txt_id" id="txt_id" class="form-control" value="<?php echo $data->ID; ?>" readonly>
      </div>
    </div>

    <div class="row" style=" margin-bottom: 1em;">
      <div class="col-lg-12">
        <label>Name</label>
        <input type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo $data->NAME; ?>">
      </div>
    </div>

    <div class="row" style=" margin-bottom: 1em;">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-6">
            <label>Group</label>
            <select name="txt_group" class="form-control">
              <?php
              foreach ($group->result() as $s_group) :
                if ($s_group->ID == $data->GROUP_ID) {
              ?>
                  <option value="<?php echo $s_group->ID ?>" selected="selected"><?php echo $s_group->NAME; ?></option>
                <?php
                } else {
                ?>
                  <option value="<?php echo $s_group->ID ?>"><?php echo $s_group->NAME; ?></option>
              <?php
                }
              endforeach;
              ?>
            </select>
          </div>
          <div class="col-lg-6">
            <label>Status</label>
            <select name="txt_status" class="form-control">
              <?php
              if ($data->STATUS == 'A') {
                echo '<option selected value="A" style="color: #2bba34;">ACTIVE</option>';
                echo '<option value="I" style="color: red;">INACTIVE</option>';
              } else if ($data->STATUS == 'I') {
                echo '<option value="A" style="color: #2bba34;">ACTIVE</option>';
                echo '<option selected value="I" style="color: red;">INACTIVE</option>';
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-default btn-info">Save</button>
    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
  </div>

<?php endforeach; ?>
<?php echo form_close(); ?>