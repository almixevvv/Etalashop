  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates-cms/frame_side'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- BANNER PART -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-images"></i>
            <b>Banner List</b></div>
          <div class="card-body" >
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px"> 
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="30%">Image</th>
                    <th width="30%">Description</th>
                    <th width="30">Info</th>
                    <th width="5%">Action</th>
                  </tr>
                </thead>   
                <tbody>
                  <?php 
                    $no=1;
                    foreach($content->result() as $dt) :
                
                      $id = $dt->REC_ID;
                      $type = $dt->TYPE;
                      $link_type = $dt->LINK_TYPE;
                      $linkto = $dt->LINKTO;
                      $img = $dt->BANNER_IMAGE;
                      $order_no = $dt->ORDER_NO;
                      $flag = $dt->FLAG;
                      $desc = $dt->DESCRIPTION;
                      $created = $dt->CREATED;
                      $updated = $dt->UPDATED;
                      $user_id = $dt->USER_ID;

                    
                  ?>
                  <tr>
                    <td>
                      <?php echo $no; ?>
                    </td>
                    <td>
                      <label style="margin-left: 0.4em;"><?php echo $img; ?></label>
                    </td>
                    <td>
                      <label style="margin-left: 0.4em;"><?php echo $desc; ?></label>
                    </td>
                    <td>
                      <label style="margin-left: 0.4em;font-weight: bold;">Type</label>
                      <label style="margin-left: 2em;font-weight: bold;">:</label>
                      <label style="margin-left: 0.4em;color: #2db4d6;"><?php echo $type; ?></label><br>
                      <label style="margin-left: 0.4em;font-weight: bold;">Created</label>
                      <label style="margin-left: 0.5em;font-weight: bold;">:</label>
                      <label style="margin-left: 0.4em;color: #2db4d6;"><?php echo $created; ?></label><br>
                      <label style="margin-left: 0.4em;font-weight: bold;">Updated</label>
                      <label style="margin-left: 0.2em;font-weight: bold;">:</label>
                      <label style="margin-left: 0.4em;color: #2db4d6;"><?php echo $updated; ?></label>
                    </td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"
                      data-id="<?php echo $id; ?>" style="font-size: 12px;width: 6em;">EDIT</button>
                    </td>
                  </tr>

                <?php
                  $no++;
                  endforeach; ?>

                </tbody>
              </table>
            </div>
          </div>
        </div> 
    

        <!-- END BANNER PART -->
        <div id="exampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <?php echo form_open('Form_banner_cms/update'); ?>
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-body">
                <!-- <b>
                  About Us : 
                </b> -->
                <textarea name="text-banner" id="form10" class="md-textarea form-control modal-banner" rows="10"></textarea>
                <button type="submit" class="btn btn-default btn-danger" >Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
          <?php echo form_close(); ?>
        </div>


      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Incube Solutions 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('assets/cms/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bootstrap-4/js/bootstrap.bundle.min.js'); ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/cms/jquery-easing/jquery.easing.min.js'); ?>"></script>

  <!-- Page level plugin JavaScript-->
  <script src="<?php echo base_url('assets/cms/chart.js/Chart.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/cms/datatables/jquery.dataTables.js'); ?>"></script>
  <script src="<?php echo base_url('assets/cms/datatables/dataTables.bootstrap4.js'); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets/cms/js/sb-admin.min.js'); ?>"></script>

  <!-- Demo scripts for this page-->
  <script src="<?php echo base_url('assets/cms/js/demo/datatables-demo.js'); ?>"></script>
  <script src="<?php echo base_url('assets/cms/js/demo/chart-area-demo.js'); ?>"></script>
  <script type="text/javascript">
    
    $('#exampleModal').on('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = $(event.relatedTarget); 

      // Extract info from data-* attributes
      var banner = button.data('banner');
      
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this);

      modal.find('.modal-banner').val(banner);
    });  

  </script>
</body>
