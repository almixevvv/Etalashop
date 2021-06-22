<div id="wrapper">

  <!-- Sidebar -->
  <div id="content-wrapper" style="background-color: #f7f7f7;">
    <div class="container-fluid">

      <!-- ABOUT PART -->
      <div class="card mb-3">
        <div class="card-header">
          <button class="btn btn-success" type="button" data-toggle="modal" data-target="#adduserModal" <?= (stripos($this->session->userdata('ROLE'), "ADD;") === false ? 'disabled' : ''); ?>>+ Add User</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0" style="font-size:12px">
              <thead>
                <tr>
                  <th width="1%">NO</th>
                  <th width="39%">USER INFO</th>
                  <th width="20%">GROUP</th>
                  <th width="20%">STATUS</th>
                  <th width="20%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($user->result() as $dt) {
                ?>
                  <tr>
                    <td>
                      <?php echo $no++; ?>
                    </td>

                    <td>
                      <label style="width: 4em; font-weight: bold;">User ID</label><label>:</label> <label style="font-weight: bold;color: #337ab7;"><?= $dt->ID; ?></a></label><br>
                      <label style="width: 4em; font-weight: bold;">Name</label><label>:</label> <label style="font-weight: bold;"><?= $dt->NAME; ?></a></label>
                    </td>

                    <td>
                      <label style="font-weight: bold;"><?= $dt->GROUP_ID; ?></a></label>
                    </td>

                    <td>
                      <?php if ($dt->STATUS == "A") {
                        $arrStatus = array(
                          'COLOR'   => '#2bba34',
                          'STATUS'  => 'ACTIVE'
                        );
                      } else {
                        $arrStatus = array(
                          'COLOR'   => 'red',
                          'STATUS'  => 'INACTIVE'
                        );
                      } ?>
                      <label style="color: <?= $arrStatus['COLOR']; ?>; font-weight: bold;"><?= $arrStatus['STATUS']; ?></label>
                    </td>

                    <td>
                      <button <?= (stripos($this->session->userdata('ROLE'), 'EDIT;') === false ? 'disabled' : ''); ?> class="btn btn-warning" style="width: 6em;font-size: 12px;" type="button" data-toggle="modal" data-target="#edituserModal" data-id="<?= $dt->ID; ?>">EDIT</button>
                      <button <?= (stripos($this->session->userdata('ROLE'), 'DELETE;') === false ? 'disabled' : ''); ?> class="buttonDeleteUser btn btn-danger" style="width: 6em;font-size: 12px;" type="button" data-id="<?= $dt->ID; ?>">DELETE</button>
                    </td>

                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div id="adduserModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="adduserModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-light">Add User</h5>
              <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="row" style=" margin-bottom: 1em;">
                <div class="col-lg-12">
                  <label>User</label>
                  <input type="text" name="addTxtID" id="addTxtID" class="form-control">
                </div>
              </div>

              <div class="row" style=" margin-bottom: 1em;">
                <div class="col-lg-12">
                  <label>Name</label>
                  <input type="text" name="addTxtNAME" id="addTxtNAME" class="form-control">
                </div>
              </div>

              <div class="row" style=" margin-bottom: 1em;">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-6">
                      <label>Group</label>
                      <select name="addSctGROUP" id="addSctGROUP" class="form-control">
                        <option value="none"> - </option>
                        <?php foreach ($group->result() as $s_group) { ?>
                          <option value="<?= $s_group->ID ?>" <?= ($s_group->ID == $data->GROUP_ID ? "selected='selected'" : ''); ?>><?php echo $s_group->NAME; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label>Status</label>
                      <select name="addSctSTATUS" id="addSctSTATUS" class="form-control">
                        <option value="none"> - </option>
                        <option value="A" style="color: #2bba34;">ACTIVE</option>
                        <option value="I" style="color: red;">INACTIVE</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row" style=" margin-bottom: 1em;">
                <div class="col-lg-12">
                  <label>Password</label>
                  <input type="password" name="addTxtPASS" id="addTxtPASS" class="form-control">
                </div>
              </div>

              <div class="row" style=" margin-bottom: 1em;">
                <div class="col-lg-12">
                  <label>Confirm Password</label>
                  <input type="password" name="addTxtCONFIRM" id="addTxtCONFIRM" class="form-control">
                </div>
              </div>


            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-default btn-info" id="btnAddSubmit">Save</button>
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- end content -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<link rel="stylesheet" href="<?= base_url('assets_cms/sweet-alert/sweetalert2.min.css'); ?>" />
<script src="<?= base_url('assets_cms/js/userFunction.js?version=' . filemtime('./assets_cms/js/userFunction.js')); ?>"></script>

</body>