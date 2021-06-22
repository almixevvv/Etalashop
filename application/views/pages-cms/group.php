<div id="wrapper">

    <!-- Sidebar -->


    <div id="content-wrapper" style="background-color: #f7f7f7;">

        <div class="container-fluid">

            <!-- ABOUT PART -->
            <?php
              $role = $this->session->userdata('ROLE');
              // var_dump($role);
              if (stripos($role, "ADD;") === false) {
              ?>
            <button class="btn btn-success" style="font-size: 12px;margin-bottom: 1em;" type="button" data-toggle="modal" data-target="#addgroupModal" disabled>+ Add Group</button>
            <?php
              } else {
            ?>
            <button class="btn btn-success" style="font-size: 12px;margin-bottom: 1em;" type="button" data-toggle="modal" data-target="#addgroupModal" >+ Add Group</button>
            <?php
              }
            ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- <?php echo $this->session->userdata('ID') ?> -->
                        <!-- <button type="button" class="btn btn-success" style="width: 5%;font-size: 12px;margin-bottom: 1em;" data-toggle="modal" data-target="#addNewProduk"><i class="fas fa-plus"></i></button> -->
                        <table class="table table-bordered" id="dataTable" cellspacing="0" style="font-size:12px">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th width="39%">GROUP ID</th>
                                    <th width="20%">NAME</th>
                                    <th width="20%">DESCRIPTION</th>
                                    <th width="20%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($group->result() as $dt) {
                                    $id = $dt->ID;
                                    $name = $dt->NAME;
                                    $desc = $dt->DESCRIPTION;

                                    echo "<tr>";
                                ?>
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>

                                    <td>
                                        <label style="font-weight: bold;"><?php echo $id; ?></a></label> 
                                    </td>

                                    <td>
                                        <label style="font-weight: bold;"><?php echo $name; ?></a></label> 
                                    </td>

                                    <td>
                                        <label style="font-weight: bold;"><?php echo $desc; ?></a></label> 
                                    </td>

                                    <td>
                                      <?php
                                        $role = $this->session->userdata('ROLE');
                                        // var_dump($role);
                                        if (stripos($role, "EDIT;") === false) {
                                        ?>
                                        <button class="btn btn-warning" style="width: 6em;font-size: 12px;" type="button" data-toggle="modal" data-target="#editgroupModal" data-id="<?php echo $id; ?>" disabled>EDIT</button>
                                      <?php
                                        } else {
                                      ?>
                                        <button class="btn btn-warning" style="width: 6em;font-size: 12px;" type="button" data-toggle="modal" data-target="#editgroupModal" data-id="<?php echo $id; ?>" >EDIT</button>
                                      <?php
                                        }
                                      ?>

                                      <?php
                                        $role = $this->session->userdata('ROLE');
                                        // var_dump($role);
                                        if (stripos($role, "DELETE;") === false) {
                                        ?>
                                        <button class="buttonDeleteGroup btn btn-danger" style="width: 6em;font-size: 12px;" type="button" data-id="<?php echo $id; ?>" disabled>DELETE</button>
                                      <?php
                                        } else {
                                      ?>
                                        <button class="buttonDeleteGroup btn btn-danger" style="width: 6em;font-size: 12px;" type="button" data-id="<?php echo $id; ?>">DELETE</button>
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

            <div id="editgroupModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-body" style="padding: 0!important;">
                    <!-- LOAD THE CONTENT -->
                  </div>
                </div>

              </div>
            </div>

            <div id="addgroupModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-body" style="padding: 0!important;">
                    <!-- LOAD THE CONTENT -->
                  </div>
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

<link rel="stylesheet" href="<?php echo base_url('reseller/assets/sweet-alert/sweetalert2.min.css'); ?>" />
<script type="text/javascript">
    $('#dataTable').DataTable({
    responsive: true
  });

    $('#editgroupModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');

          // console.log('Button Position ' + orderno);
          var getGroup = '<?php echo base_url('Group_cms/getGroup?id='); ?>';

          $('.modal-body').load(getGroup + id,function(){
            $('#editgroupModal').modal({show:true});
          });
    });

    $('#addgroupModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);

          // console.log('Button Position ' + orderno);
          var getAddGroup = '<?php echo base_url('Group_cms/getAddGroup'); ?>';

          $('.modal-body').load(getAddGroup,function(){
            $('#addgroupModal').modal({show:true});
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

    $('.buttonDeleteGroup').on('click', function() {
      var id=$(this).attr("data-id");
      swal.fire({
        title:"Delete Group",
        text:"Are you sure you want to delete this group?",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Selected group has been deleted.',
              'success'
            );
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Group_cms/deleteGroup'); ?>",
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