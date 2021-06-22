  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates-cms/frame_side'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- MEMBER PART -->

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-user-tie"></i>
            <b>Member List</b></div>
          <div class="card-body" >
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="30%">Member Info</th>
                  <th width="25%">Contacts</th>
                  <th width="20%">Other Info</th>
                  <th width="10%">Status</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>   
              <tbody>
            <?php
               $no = 1;
              foreach($content->result() as $dt){
                $id = $dt->ID;
                $fname = $dt->FIRST_NAME;
                $lname = $dt->LAST_NAME;
                $birhtdate = $dt->BIRTH_DATE;
                $joindate = $dt->JOIN_DATE;
                $phone = $dt->PHONE;
                $addr = $dt->ADDRESS;
                $addr2 = $dt->ADDRESS_2;
                $country = $dt->COUNTRY;
                $province = $dt->PROVINCE;
                $zip = $dt->ZIP;
                $email = $dt->EMAIL;
                $status = $dt->STATUS;
                $pass = $dt->PASSWORD;

                echo "<tr>"; ?>
                  <td>
                        <!-- <b style="display: none;"><?php echo $join_date;?></b>  -->
                      <?php echo $no;?>       
                  </td>
                  
                  <td>
                      <p style='line-height:20px;'>
                        <b>Name<span style="margin-left: 2em;">:</b></span><b style="color: #2db4d6">&nbsp;<?php echo $fname;?> <?php echo $lname;?></b><br><br>
                        <b>Address<span style="margin-left: 0.8em;">:</b><br></span><?php echo $addr;?><br>
                        <?php echo $addr2;?> - <?php echo $zip;?><br><br>
                        <b>Country<span style="margin-left: 0.8em;">:</b></span>&nbsp;<?php echo $country;?><br><br>
                        <b>Province<span style="margin-left: 0.5em;">:</b></span>&nbsp;<?php echo $province;?>
                        
                      </p>                        
                  </td>

                  <td>
                      <p style='line-height:20px;'>
                        <b>Email : </b><b style="color: #2db4d6;"><?php echo $email;?></b> <br><br>  
                        <b>Phone : </b><?php echo $phone;?>
                      </p>                        
                  </td>

                  <td>
                      <p style='line-height:20px;'>
                        <b>Birth Date : </b><?php echo $birhtdate;?> <br><br>  
                        <b>Join Date : </b><?php echo $joindate;?>
                      </p>                        
                  </td>

                  <td>
                      <?php if ($status == 'ACTIVE'): ?>
                      <p style='line-height:20px; color: #1f8a17; font-weight: bold;'>
                        <?php
                            echo $status;    
                        ?>  
                      </p>
                      <?php else: ?>
                        <p style='line-height:20px; font-weight: bold;'>
                        <?php
                            echo $status;    
                        ?>  
                      </p>
                      <?php endif; ?>                        
                  </td>

                 
                    
                  <td>                   
                    <button class="btn btn-info" style="width: 6em;font-size: 12px;" type="button" data-toggle="modal" data-target="#memberModal" data-id="<?php echo $id; ?>">EDIT</button><br>
                    
                    <!-- UNTUK RESET PASSWORD -->
                    
                    <button class="btnReset btn btn-warning" data-id="<?php echo $id;?>" style="width: 6em;font-size: 12px;color: white;margin-top: 0.5em;" type="submit">RESET</button><br>
                    <input type="hidden" name="hiddenID" value="<?php echo $id;?>"></input>
                    <input type="hidden" name="hiddenPass" value="<?php echo $pass;?>"></input>
                   
                     
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
    

        <!-- END MEMBER PART -->

        <!-- Modal -->
        <div id="memberModal" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md">
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

     $('#memberModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');

          // console.log('Button Position ' + orderno);
          var getMember = '<?php echo base_url('Member_cms/getMember?id='); ?>';

          $('.modal-body').load(getMember + id,function(){
            $('#memberModal').modal({show:true});
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
      var id=$(this).attr("data-id");
      swal.fire({
        title:"Delete Member",
        text:"Are you sure you want to delete this member from member list?",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Selected member has been deleted.',
              'success'
            );
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Member_cms/deleteMember'); ?>",
                data: {id:id},
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

    $('.btnReset').on('click', function() {
      var id=$(this).attr("data-id");
      swal.fire({
        title:"Reset Password Member",
        text:"Are you sure you want to reset this member password?",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Reset!',
              'Selected member password has been reset.',
              'success'
            );
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Member_cms/resetPassword'); ?>",
                data: {id:id},
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
