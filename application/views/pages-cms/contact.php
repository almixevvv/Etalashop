<div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates-cms/frame_side'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- CONTACT PART -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-address-book"></i>
            <b>Contact Us</b></div>
          <div class="card-body" >
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px"> 
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="30%">Title</th>
                  <th width="60%">Description</th>
                  <th width="5%">Action</th>
                </tr>
                </thead>   
                <tbody>
                  <?php 
                  $no = 1;
                    foreach($content->result() as $dt) :
                      $id = $dt->REC_ID;
                      $title = $dt->TITLE;
                      $desc = $dt->DESCRIPTION;
                      $img = $dt->IMAGE;
                    
                  ?>
                  <tr>
                    <td>
                      <?php echo $no; ?>
                    </td>
                    <td>
                      <label style="margin-left: 0.4em;"><img width="30px" src="<?php echo base_url('assets/images/'.$img) ; ?>"></label>
                      <label style="margin-left: 0.4em;"><?php echo $title; ?></label>
                    </td>
                    <td>
                      <label style="margin-left: 0.4em;"><?php echo $desc; ?></label>
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

</div>
<!-- end content -->


        <!-- END BANNER PART -->
        <!-- Modal -->
        <div id="exampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-body" style="padding: 0!important;">
                <!-- LOAD THE CONTENT -->
              </div>
            </div>
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
      var id = button.data('id');

      // Extract info from data-* attributes 
      var getContact = '<?php echo base_url('Contact_cms/getContact?id='); ?>';
      
      $('.modal-body').load(getContact + id,function(){

      });
      
    });  

  </script>

</body>
