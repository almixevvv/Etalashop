<div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates-cms/frame_side'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- PRIVACY PART -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"
        data-terms='<?php echo $privasi; ?>' style="font-size: 11px;margin-bottom: 1em;"><i class="fas fa-edit"></i> Edit Privacy</button>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-address-book"></i>
            <b>Privacy</b></div>
          <div class="card-body" >
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px"> 
                <thead>
                <tr>
                  <th>Content</th>
                </tr>
                </thead>   
                <tbody>
                  <?php 
                    foreach($privacy->result() as $dt){
                
                      $privasi = $dt->CONTENT;
                    }
                  ?>
                  <td>
                    <label style="margin-left: 0.4em;font-size: 11px;"><?php echo $privasi; ?></label>
                  </td>
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
          <?php echo form_open('Form_privacy_cms/update'); ?>
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
                <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Edit Privacy</p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>  

              <div class="modal-body">
                <textarea name="text-privasi" id="form10" class="textarea form-control modal-terms" style="height: 450px;width: 760px;"> <?php echo $privasi; ?></textarea>
              </div>
              
              <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-info">Save</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
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
      var privasi = button.data('privasi');
      
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this);

      modal.find('.modal-privasi').val(privasi);
    });  

  </script>
<script src="<?php echo base_url('assets/cms/tiny_mce/tiny_mce.js'); ?>"></script>
  <script src="<?php echo base_url('assets/cms/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php'); ?>"></script>
  <script src="<?php echo base_url('assets/cms/tiny_mce/tiny_mce_setting.js'); ?>"></script>
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
</body>
