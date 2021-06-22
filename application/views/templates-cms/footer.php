<script type="text/javascript">

  <?php if($this->session->has_userdata('error') == 'mismatch') { ?>
    swal.fire({
        title: "Error",
        text: "Password Mismatch",
        type: "error",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('success') == 'match') { ?>
    swal.fire({
        title: "Success",
        text: "Password Changed",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('updatemember') == 'updatemember') { ?>
    swal.fire({
        title: "Success",
        text: "Member Updated",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('updatemargin') == 'updatemargin') { ?>
    swal.fire({
        title: "Success",
        text: "Margin Updated",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('updaterate') == 'updaterate') { ?>
    swal.fire({
        title: "Success",
        text: "Rate Updated",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('addmargin') == 'addmargin') { ?>
    swal.fire({
        title: "Success",
        text: "Success Add New Margin",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('addrate') == 'addrate') { ?>
    swal.fire({
        title: "Success",
        text: "Success Add New Rate",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('adduser') == 'adduser') { ?>
    swal.fire({
        title: "Success",
        text: "Success Add New User Account",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('addgroup') == 'addgroup') { ?>
    swal.fire({
        title: "Success",
        text: "Success Add User Group",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('updateuser') == 'updateuser') { ?>
    swal.fire({
        title: "Success",
        text: "User Account Updated",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  <?php if($this->session->has_userdata('updategroup') == 'updategroup') { ?>
    swal.fire({
        title: "Success",
        text: "User Group Updated",
        type: "success",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      });
  <?php } ?>

  $(document).ready(function() {

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    });

    $('#buttonLogOut').on('click', function() {
      swal.fire({
        title:"Logout",
        text:"Are you sure you want to logout?",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm",
        confirmButtonColor: '#3085d6'
      }).then((result) => {
          
          if (result.value) {
            window.location.replace("<?php echo base_url('CMS/logout'); ?>");
            // swalWithBootstrapButtons.fire(
            //   'Deleted!',
            //   'Selected product has been removed.',
            //   'success'
            // );
            
        }
      });
    });

  });

  $('#changePass').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    // console.log(id);
    // console.log('Button Position ' + orderno);
    var getPassword = '<?php echo base_url('CMS/getPassword?id='); ?>';

    $('.modal-body').load(getPassword + id,function(){
      $('#changePass').modal({show:true});
    });
  });

</script>
</body>
</html>
