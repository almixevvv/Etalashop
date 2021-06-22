<div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates-cms/frame_side'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- About PART -->

       <!-- start: Content -->
    <div class="main" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
    
    <form name="form_action" method="post">
          <input type="hidden" name="id" value=""  />
        </form>        
                                       


  <div class="row">
        <div class="col-lg-12" id="tabel">
          <div class="panel panel-default">
            <div class="panel-heading" data-original-title>
              <h2><span class="break"></span>How To</h2>
            </div>
            <div class="panel-body">
              <table id="subscription_table" name="subscription_table" class="table table-striped table-bordered bootstrap-datatable">
                <thead>
                  <tr>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>   
                <tbody>
                <?php foreach($howto->result() as $dt){
                  $howto = $dt->CONTENT;
                }
                ?>
                <td>
                  <?php echo $howto; ?>
                </td>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                  data-howto='<?php echo $howto; ?>'>edit</button>
                </td>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
        <!--/col-->  
      </div><!--/row-->
</div>
<!-- end content -->

        <!-- END ABOUT PART -->
        <!-- Modal -->
        <div id="exampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <?php echo form_open('Form_howto_cms/update'); ?>
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-body">
                <b>
                  How To : 
                </b>
                <textarea name="text-howto" id="form10" class="md-textarea form-control modal-howto" rows="10"><?php echo $howto; ?></textarea>
                <button type="submit" class="btn btn-default btn-danger" style="margin: 10px;">Save</button>
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
      var howto = button.data('howto');
      
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this);

      modal.find('.modal-howto').val(howto);
    });  

  </script>
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

</body>