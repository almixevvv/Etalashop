<div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates-cms/frame_side'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- MEMBER PART -->
        <button type="submit" class="btn btn-default btn-success" style="font-size: 11px; margin-bottom: 1em;width: 15%" data-toggle="modal" data-target="#addGroup"><i class="fas fa-plus-circle"></i> Add User Group</button>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            <b>User Group</b></div>
          <div class="card-body" >
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="30%">ID</th>
                  <th width="25%">Name</th>
                  <th width="30%">Description</th>
                  <th width="10%">Action</th>                
                </tr>
              </thead>   
              <tbody>
            <?php
               $no = 1;
              foreach($content->result() as $dt){
                $id = $dt->ID;
                $name = $dt->NAME;
                $desc = $dt->DESCRIPTION;

                echo "<tr>"; ?>
                  <td>
                        <!-- <b style="display: none;"><?php echo $join_date;?></b>  -->
                      <?php echo $no;?>       
                  </td>
                  
                  <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6"><?php echo $id;?></b>                  
                      </p>                        
                  </td>

                  <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6"><?php echo $name;?></b>
                      </p>                        
                  </td>

                  <td>
                      <p style='line-height:20px;'>
                        <b style="color: #2db4d6"><?php echo $desc;?></b>
                      </p>                        
                  </td>
                 
                    
                  <td>                   
                    <button class="btn btn-info" style="width: 6em;font-size: 12px;" type="button" data-toggle="modal" data-target="#editGroup" data-id="<?php echo $id; ?>">EDIT</button><br>
                    
                     
                    <button data-id="<?php echo $id;?>" class="buttonDelete btn btn-danger" style="width: 6em;font-size: 12px;margin-top: 0.5em;" type="submit">DELETE</button>
                  </td>
                                 
            <?php
                echo "</tr>";
                $no++;
              }
            ?>
             
            </tbody>
          </table>            
        </div>
      </div>
    </div><!--/col-->

    <!-- END USER PART -->

        <!-- Modal -->
        <div id="editGroup" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-body" style="padding: 0!important;">
                <!-- LOAD THE CONTENT -->
              </div>
            </div>

          </div>
        </div>

        <div id="addGroup" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
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

    $('#editGroup').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');

          // console.log('Button Position ' + orderno);
          var getGroup = '<?php echo base_url('Group_cms/getGroup?id='); ?>';

          $('.modal-body').load(getGroup + id,function(){
            $('#editGroup').modal({show:true});
          });
    });

    $('#addGroup').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
       //var id ='';
      // console.log(id);
      // console.log('Button Position ' + orderno);
      var getAddGroup = '<?php echo base_url('Group_cms/getAddGroup'); ?>';

      $('.modal-body').load(getAddGroup,function(){
        $('#addGroup').modal({show:true});
      });
    });

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    });

    $('.buttonDelete').on('click', function() {
      var id=$(this).attr("data-id");
      swal.fire({
        title:"Delete User Group",
        text:"Are you sure you want to delete this user group?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancel",
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Selected user group has been deleted.',
              'success'
            );
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Group_cms/deleteGroup'); ?>",
                data: {id:id},
                success: function(data) {
                  console.log(data);
                  location.reload();
                }
            });
        }
      });
    });
  </script>