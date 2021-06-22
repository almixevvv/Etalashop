  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates-cms/frame_side'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- MEMBER PART -->
        <button type="submit" class="btn btn-default btn-success" style="font-size: 11px; margin-bottom: 1em;width: 15%" data-toggle="modal" data-target="#marginAddModal"><i class="fas fa-plus-circle"></i> Add Parameter Margin</button>
        <div class="card mb-3" >
          <div class="card-header">
            <i class="fas fa-funnel-dollar"></i>
            <b>Margin Parameter</b>
          </div>
          <div class="card-body" >
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="20%">ID</th>
                  <th width="5%">Value</th>
                  <th width="50%">Description</th>
                  <!-- <th width="15%">Created</th> -->
                  <!-- <th width="15%">Updated</th> -->
                  <th width="10%">Status</th>
                  <!-- <th width="10%">Updated By</th> -->
                  <th width="10%">Action</th>
                </tr>
              </thead>   
              <tbody>
              <?php
               $no = 1;
              foreach($content->result() as $dt){
                $rec = $dt->REC_ID;
                $value = $dt->VALUE;
                $id = $dt->ID;
                $desc = $dt->DESCRIPTION;
                $created = $dt->CREATED_TIME;
                $updated = $dt->UPDATED_TIME;
                $updatedby = $dt->UPDATED_BY;
                $status = $dt->STATUS;

                echo "<tr>"; ?>
                  <td>
                        <!-- <b style="display: none;"><?php echo $join_date;?></b>  -->
                      <?php echo $no++;?>       
                  </td>
                  
                  <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6;"><?php echo $id;?></b><br><br>
                        <label>Set as current parameter :</label>
                        <button data-rec="<?php echo $rec;?>" class="buttonSet btn btn-warning" id="buttonSet" style="width: 6em;font-size: 12px;color: white;" type="submit">SET</button>
                      </p>                        
                  </td>

                  <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6;"><?php echo $value;?></b> 
                        
                      </p>                        
                  </td>

                  <td>
                        <label><?php echo $desc;?></label><br><br>
                        <b style="font-weight: bold;">Created</b><br>
                        <label style="color: #2db4d6;"><?php echo $created;?></label><br>
                        <b style="font-weight: bold;">Updated by</b><br>
                        <label style="color: #2db4d6;"><?php echo $updatedby;?> on <?php echo $updated;?></label>                  
                  </td>

                 <!--  <td>
                      <p style='line-height:20px;'>
                        <?php echo $created;?>
                        
                      </p>                        
                  </td> -->

                  <!-- <td>
                      <p style='line-height:20px;'>
                        Updated by <?php echo $updatedby;?> <?php echo $updated;?>
                        
                      </p>                        
                  </td> -->

                  <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6;"><?php echo $status;?></b>
                        
                      </p>                        
                  </td>

                  <!-- <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6;"><?php echo $updatedby;?></b>
                        
                      </p>                        
                  </td> -->
                 
                  <td>
                    
                     <button class="btn btn-info" type="button" style="width: 6em;font-size: 12px;" data-toggle="modal" data-target="#marginModal" data-id="<?php echo $rec; ?>">EDIT</button><br>
                     
                     <button data-rec="<?php echo $rec;?>" class="buttonDelete btn btn-danger"  style="width: 6em;font-size: 12px;margin-top:0.5em; " type="submit">DELETE</button>
                     
                     
                  </td>
                                 
            <?php
                echo "</tr>";
              }
            ?>
             
            </tbody>
          </table>            
        </div>
      </div>
    </div><!--/col-->

    <button type="submit" class="btn btn-default btn-success" style="font-size: 11px; margin-bottom: 1em;width: 15%;" data-toggle="modal" data-target="#marginAddModalRate"><i class="fas fa-plus-circle"></i> Add Parameter Rate</button>
    <div class="card mb-3" >
          <div class="card-header">
            <i class="fas fa-funnel-dollar"></i>
            <b>Kurs Rate</b>
          </div>
          <div class="card-body" >
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="20%">ID</th>
                  <th width="5%">Value</th>
                  <th width="50%">Description</th>
                  <!-- <th width="15%">Created</th> -->
                  <!-- <th width="15%">Updated</th> -->
                  <th width="10%">Status</th>
                  <!-- <th width="10%">Updated By</th> -->
                  <th width="10%">Action</th>
                </tr>
              </thead>   
              <tbody>
              <?php
               $no = 1;
              foreach($rate->result() as $dt){
                $rec = $dt->REC_ID;
                $value = $dt->VALUE;
                $id = $dt->ID;
                $desc = $dt->DESCRIPTION;
                $created = $dt->CREATED_TIME;
                $updated = $dt->UPDATED_TIME;
                $updatedby = $dt->UPDATED_BY;
                $status = $dt->STATUS;

                echo "<tr>"; ?>
                  <td>
                        <!-- <b style="display: none;"><?php echo $join_date;?></b>  -->
                      <?php echo $no++;?>       
                  </td>
                  
                  <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6;"><?php echo $id;?></b><br><br>
                        <label>Set as current parameter :</label>
                        <button data-rec="<?php echo $rec;?>" class="buttonSetRate btn btn-warning"  style="width: 6em;font-size: 12px;color: white;" type="submit">SET</button>
                      </p>                        
                  </td>

                  <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6;"><?php echo $value;?></b> 
                        
                      </p>                        
                  </td>

                  <td>
                        <label><?php echo $desc;?></label><br><br>
                        <b style="font-weight: bold;">Created</b><br>
                        <label style="color: #2db4d6;"><?php echo $created;?></label><br>
                        <b style="font-weight: bold;">Updated by</b><br>
                        <label style="color: #2db4d6;"><?php echo $updatedby;?> on <?php echo $updated;?></label>                  
                  </td>

                 <!--  <td>
                      <p style='line-height:20px;'>
                        <?php echo $created;?>
                        
                      </p>                        
                  </td> -->

                  <!-- <td>
                      <p style='line-height:20px;'>
                        Updated by <?php echo $updatedby;?> <?php echo $updated;?>
                        
                      </p>                        
                  </td> -->

                  <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6;"><?php echo $status;?></b>
                        
                      </p>                        
                  </td>

                  <!-- <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6;"><?php echo $updatedby;?></b>
                        
                      </p>                        
                  </td> -->
                 
                  <td>
                    
                     <button class="btn btn-info" type="button" style="width: 6em;font-size: 12px;" data-toggle="modal" data-target="#marginModalRate" data-id="<?php echo $rec; ?>">EDIT</button><br>
                     
                     <button data-rec="<?php echo $rec;?>" class="buttonDeleteRate btn btn-danger"  style="width: 6em;font-size: 12px;margin-top:0.5em; " type="submit">DELETE</button>
                     
                     
                  </td>
                                 
            <?php
                echo "</tr>";
              }
            ?>
             
            </tbody>
          </table>            
        </div>
      </div>
    </div><!--/col-->
    

        <!-- END MEMBER PART -->

         <!-- Modal Edit Margin-->
        <div id="marginModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-body" style="padding: 0!important;">
                <!-- LOAD THE CONTENT -->
              </div>
            </div>

          </div>
        </div>

         <!-- Modal Edit Rate-->
        <div id="marginModalRate" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-body" style="padding: 0!important;">
                <!-- LOAD THE CONTENT -->
              </div>
            </div>

          </div>
        </div>

        <!-- Modal Add Margin-->
        <div id="marginAddModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-body" style="padding: 0!important;">
                <!-- LOAD THE CONTENT -->
                

              </div>
            </div>

          </div>
        </div>

        <!-- Modal Add Rate-->
        <div id="marginAddModalRate" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-body" style="padding: 0!important;">
                <!-- LOAD THE CONTENT -->
                

              </div>
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

    $('#marginModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');

      // console.log('Button Position ' + orderno);
      var getMargin = '<?php echo base_url('Margin_cms/getMargin?id='); ?>';

      $('.modal-body').load(getMargin + id,function(){
        $('#marginModal').modal({show:true});
      });
    });

    $('#marginModalRate').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');

      // console.log('Button Position ' + orderno);
      var getRate = '<?php echo base_url('Margin_cms/getRate?id='); ?>';

      $('.modal-body').load(getRate + id,function(){
        $('#marginModalRate').modal({show:true});
      });
    });
 
  </script>

  <script type="text/javascript">

    $('#marginAddModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      // var id = button.data('id');

      // console.log('Button Position ' + orderno);
      var getAddMargin = '<?php echo base_url('Margin_cms/getAddMargin?id='); ?>';

      $('.modal-body').load(getAddMargin,function(){
        $('#marginAddModal').modal({show:true});
      });
    });

    $('#marginAddModalRate').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      // var id = button.data('id');

      // console.log('Button Position ' + orderno);
      var getAddRate = '<?php echo base_url('Margin_cms/getAddRate?id='); ?>';

      $('.modal-body').load(getAddRate,function(){
        $('#marginAddModalRate').modal({show:true});
      });
    });
 
  </script>

  <script type="text/javascript">

  $(document).ready(function() {

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    });

    $('.buttonDelete').on('click', function() {
      var id=$(this).attr("data-rec");
      swal.fire({
        title:"Delete Margin",
        text:"Are you sure you want to delete this margin from margin parameter?",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Selected margin has been deleted.',
              'success'
            );
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Margin_cms/deleteMargin'); ?>",
                data: {hiddenREC:id},
                success: function(data) {
                  console.log(data);
                  location.reload();
                }
            });
        }
      });
    });

  });

  $(document).ready(function() {

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    });

    $('.buttonDeleteRate').on('click', function() {
      var id=$(this).attr("data-rec");
      swal.fire({
        title:"Delete Rate",
        text:"Are you sure you want to delete this rate from kurs rate?",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Selected rate has been deleted.',
              'success'
            );
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Margin_cms/deleteRate'); ?>",
                data: {hiddenREC:id},
                success: function(data) {
                  console.log(data);
                  location.reload();
                }
            });
        }
      });
    });

  });

  $(document).ready(function() {

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    });

    $('.buttonSetRate').on('click', function() {
      var id=$(this).attr("data-rec");
      swal.fire({
        title:"Set as Current Rate",
        text:"Are you sure you want to set this rate into current rate?",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Success!',
              'Selected parameter has been set to current rate.',
              'success'
            );
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Margin_cms/setAsCurrentRate'); ?>",
                data: {hiddenREC:id},
                success: function(data) {
                  console.log(data);
                  location.reload();
                }
            });
        }
      });
    });

  });

  $(document).ready(function() {

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    });

    $('.buttonSet').on('click', function() {
      var id=$(this).attr("data-rec");
      swal.fire({
        title:"Set as Current Margin",
        text:"Are you sure you want to set this rate into current margin?",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Success!',
              'Selected parameter has been set to current margin.',
              'success'
            );
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Margin_cms/setAsCurrent'); ?>",
                data: {hiddenREC:id},
                success: function(data) {
                  console.log(data);
                  location.reload();
                }
            });
        }
      });
    });

  });

</script>
</body>
