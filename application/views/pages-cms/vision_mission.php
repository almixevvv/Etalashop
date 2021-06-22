<div id="wrapper">

    <!-- Sidebar -->


    <div id="content-wrapper" style="background-color: #f7f7f7;">

        <div class="container-fluid">

            <!-- ABOUT PART -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- <?php echo $this->session->userdata('ID') ?> -->
                        <!-- <button type="button" class="btn btn-success" style="width: 5%;font-size: 12px;margin-bottom: 1em;" data-toggle="modal" data-target="#addNewProduk"><i class="fas fa-plus"></i></button> -->
                        <table class="table table-bordered" id="dataTable" cellspacing="0" style="font-size:12px">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th width="59%">VISION</th>
                                    <th width="20%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($vision->result() as $dt) {
                                    $id = $dt->REC_ID;
                                    $content = $dt->CONTENT;

                                    echo "<tr>";
                                ?>
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>

                                    <td>
                                        <label><?php echo $content; ?></label>   
                                    </td>

                                    <td>
                                      <?php
                                          $role = $this->session->userdata('ROLE');
                                          // var_dump($role);
                                          if (stripos($role, "EDIT;") === false) {
                                      ?>
                                      <a href="<?php echo base_url("Vision_mission_cms/getEditVision?id=$id");?>">
                                          <button class="btn btn-warning" style="width: 6em;font-size: 12px;margin-bottom: 1em;" type="button" data-toggle="modal" data-target="#editnewsModal" data-id="<?php echo $id; ?>" disabled>EDIT</button>
                                      </a>
                                      <?php
                                          } else {
                                      ?>
                                      <a href="<?php echo base_url("Vision_mission_cms/getEditVision?id=$id");?>">
                                          <button class="btn btn-warning" style="width: 6em;font-size: 12px;margin-bottom: 1em;" type="button" data-toggle="modal" data-target="#editnewsModal" data-id="<?php echo $id; ?>">EDIT</button>
                                      </a>
                                      <?php
                                          }
                                      ?>

                                        
                                    </td>


                                <?php
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- <?php echo $this->session->userdata('ID') ?> -->
                        <!-- <button type="button" class="btn btn-success" style="width: 5%;font-size: 12px;margin-bottom: 1em;" data-toggle="modal" data-target="#addNewProduk"><i class="fas fa-plus"></i></button> -->
                        <table class="table table-bordered" id="dataTable2" cellspacing="0" style="font-size:12px">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th width="59%">VISION</th>
                                    <th width="20%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($mission->result() as $dt) {
                                    $id = $dt->REC_ID;
                                    $content = $dt->CONTENT;

                                    echo "<tr>";
                                ?>
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>

                                    <td>
                                        <label><?php echo $content; ?></label>   
                                    </td>

                                    <td>
                                      <?php
                                          $role = $this->session->userdata('ROLE');
                                          // var_dump($role);
                                          if (stripos($role, "EDIT;") === false) {
                                      ?>
                                      <a href="<?php echo base_url("Vision_mission_cms/getEditMission?id=$id");?>">
                                          <button class="btn btn-warning" style="width: 6em;font-size: 12px;margin-bottom: 1em;" type="button" data-toggle="modal" data-target="#editnewsModal" data-id="<?php echo $id; ?>" disabled>EDIT</button>
                                      </a>
                                      <?php
                                          } else {
                                      ?>
                                      <a href="<?php echo base_url("Vision_mission_cms/getEditMission?id=$id");?>">
                                          <button class="btn btn-warning" style="width: 6em;font-size: 12px;margin-bottom: 1em;" type="button" data-toggle="modal" data-target="#editnewsModal" data-id="<?php echo $id; ?>">EDIT</button>
                                      </a>
                                      <?php
                                          }
                                      ?>

                                        
                                    </td>


                                <?php
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <button type="button" class="btn btn-success" style="width: 15%;font-size: 12px;margin-bottom: 1em;" data-toggle="modal" data-target="#addNewMargin" ><i class="fas fa-plus"></i> Tambah Batas</button> -->

        </div>
        <!-- end content -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets_cms/sweet-alert/sweetalert2.min.css'); ?>" />
<script type="text/javascript">
  $('#dataTable').DataTable({
    responsive: true
  });

  $('#dataTable2').DataTable({
    responsive: true
  });

    $('#edituserModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');

          // console.log('Button Position ' + orderno);
          var getUser = '<?php echo base_url('Contact_cms/getContact?id='); ?>';

          $('.modal-body').load(getUser + id,function(){
            $('#edituserModal').modal({show:true});
          });
    });

    $('#adduserModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);

          // console.log('Button Position ' + orderno);
          var getAddUser = '<?php echo base_url('Contact_cms/getAddContact'); ?>';

          $('.modal-body').load(getAddUser,function(){
            $('#adduserModal').modal({show:true});
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

    $('.buttonDeleteUser').on('click', function() {
      var id=$(this).attr("data-id");
      swal.fire({
        title:"Delete",
        text:"Are you sure you want to delete this?",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Selected content has been deleted.',
              'success'
            );
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Contact_cms/deleteContact'); ?>",
                data: {orderNo:id},
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