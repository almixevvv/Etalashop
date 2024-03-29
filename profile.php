<style type="text/css">
  .profile-button {
    background: #ffffff;
    border: 1px solid #24ca9d;
    border-radius: 10px;
    padding-left: 0.5em;
    padding-right: 0.5em;
    margin-right: 0.5em;
    text-align: center;
    font-size: 0.7em;
    margin-top: 0.3em;
  }

  .main-color-grey {
    color: #c2c0c0;
  }
</style>
<div class="trans-container">
  <!-- FILTER BUTTON -->

  <!-- END OF FILTER BUTTON -->

  <!-- FILTER BUTTON MOBILE -->
  <div class="row" id="trans-filter-separator-mobile">

    <div class="row">
      <div class="col-12 pl-1 pr-1">
        <i class="far fa-user"></i>
        <span style="font-weight: bold;"><?php echo $memberDetails->result()[0]->FIRST_NAME; ?> <?php echo $memberDetails->result()[0]->LAST_NAME; ?></span>
      </div>
    </div>

  </div>

  <!-- END OF FILTER BUTTON MOBILE -->

  <?php foreach ($memberDetails->result() as $master) : ?>
    <!-- MAIN TRANSACTION -->
    <div class="trans-main-container">

      <div class="row container-border-main">
        <div class="col-12">

          <!-- TRANS DATE -->
          <div class="row container-border-date">
            <div class="col-12 col-md-5 col-lg-5 col-xl-5 pb-1 pb-md-1 pb-lg-1 pb-xl-1">
              <span class="main-color" style="font-weight: bold">My Profile</span>
            </div>
          </div>
          <!-- END OF TRANS DATE -->

          <!-- MAIN TRANS PART -->
          <div class="row container-border-order-number">

            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order">
              <div class="row">
                <div class="col-12">
                  <?php if ($master->IMAGE == '') { ?>
                    <img class="img-fluid" src="<?php echo base_url('assets/images/no-image.png') ?>">
                  <?php } else { ?>
                    <img style="margin-left: 3em;width: 70%;" src="<?php echo base_url('assets/images/member-img/' . $master->IMAGE); ?>">
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order">
              <div class="row">
                <div class="col-12">
                  <span>Name</span>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <span class="main-color-grey font-weight-bold"><?php echo $master->FIRST_NAME; ?> <?php echo $master->LAST_NAME; ?> </span>
                </div>
              </div>

              <div class="row" style="margin-top: 2em;">
                <div class="col-12">
                  <span>Birth Date</span>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <span class="main-color-grey font-weight-bold"><?php echo date("d F Y", strtotime($master->BIRTH_DATE)); ?></span>
                </div>
              </div>

              <div class="row" style="margin-top: 2em;">
                <div class="col-2">
                  <span>Email</span>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="main-color-grey font-weight-bold"><?php echo $master->EMAIL; ?></span>
                </div>
              </div>

              <div class="row" style="margin-top: 2em;">
                <div class="col-5">
                  <span>Phone Number</span>
                </div>
                <div class="col-3 pl-3 pr-0">
                  <div class="profile-button">
                    <a href="<?php echo base_url('#'); ?>" data-id="<?php echo $master->ID; ?>" data-toggle="modal" data-target="#phoneModal">
                      <span class="main-color">EDIT</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <span class="main-color-grey font-weight-bold"><?php echo $master->PHONE; ?></span>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order-last">
              <div class="row">
                <div class="col-12">
                  <span>Address</span>
                </div>
                <div class="col-12">
                  <span class="main-color-grey font-weight-bold"><?php echo $master->ADDRESS; ?></span>
                </div>
              </div>

              <div class="row" style="margin-top: 2em;">
                <div class="col-12">
                  <span>Address 2</span>
                </div>
                <div class="col-12">
                  <span class="main-color-grey font-weight-bold"><?php echo $master->ADDRESS_2; ?></span>
                </div>
              </div>

              <div class="row" style="margin-top: 2em;">
                <div class="col-12">
                  <span>Country</span>
                </div>
                <div class="col-12">
                  <span class="main-color-grey font-weight-bold"><?php echo $master->COUNTRY; ?></span>
                </div>
              </div>

              <div class="row" style="margin-top: 2em;">
                <div class="col-12">
                  <span>Province</span>
                </div>
                <div class="col-12">
                  <span class="main-color-grey font-weight-bold"><?php echo $master->PROVINCE; ?> - <?php echo $master->ZIP; ?> </span>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order-last">
              <a href="<?php echo base_url('#'); ?>" data-id="<?php echo $master->ID; ?>" data-toggle="modal" data-target="#photoModal">
                <div class="trans-filter-button">
                  <span class="text-uppercase main-color"><i class="fas fa-image"></i> Change Photo</span>
                </div>
              </a>
            </div>

            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order-last">
              <a href="<?php echo base_url('#'); ?>" data-id="<?php echo $master->ID; ?>" data-toggle="modal" data-target="#passwordModal">
                <div class="trans-filter-button">
                  <span class="text-uppercase main-color"><i class="fas fa-key"></i> Change Password</span>
                </div>
              </a>
            </div>

            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order-last">
              <a href="<?php echo base_url('#'); ?>" data-id="<?php echo $master->ID; ?>" data-toggle="modal" data-target="#addressModal">
                <div class="trans-filter-button">
                  <span class="text-uppercase main-color"><i class="fas fa-map-marker-alt"></i> Change Address</span>
                </div>
              </a>
            </div>

          </div>


          <!-- END OF MAIN TRANS PART -->

        </div>
      </div>
    </div>
    <!-- END OF MAIN TRANSACTION -->
  <?php endforeach; ?>



</div>

<!-- MODAL PART -->
<div id="photoModal" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body p-0">
        <!-- LOAD THE CONTENT -->
      </div>
    </div>

  </div>
</div>

<div id="passwordModal" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body p-0">
        <!-- LOAD THE CONTENT -->
      </div>
    </div>

  </div>
</div>

<div id="addressModal" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-0">
        <!-- LOAD THE CONTENT -->
      </div>
    </div>

  </div>
</div>

<div id="phoneModal" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-0">
        <!-- LOAD THE CONTENT -->
      </div>
    </div>

  </div>
</div>
<!-- END OF MODAL PART -->

<?php if ($this->session->userdata('password') == 'different') { ?>
  <script>
    swal.fire({
      title: "Incorrect Password",
      text: "Incorrect password, please try enter your old password",
      type: "error",
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: "Confirm",
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php } ?>

<?php if ($this->session->userdata('password') == 'unknown_error') { ?>
  <script>
    swal.fire({
      title: "Unknown Error",
      text: "Error - Unknown Error",
      type: "error",
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: "Confirm",
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php } ?>

<?php if ($this->session->userdata('password') == 'success') { ?>
  <script>
    swal.fire({
      title: "Update Password",
      text: "Success Update Password",
      type: "success",
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: "Confirm",
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php } ?>

<?php if ($this->session->userdata('phone') == 'success') { ?>
  <script>
    swal.fire({
      title: "Update Number",
      text: "Success Update Phone Number",
      type: "success",
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: "Confirm",
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php } ?>

<?php if ($this->session->userdata('address') == 'success') { ?>
  <script>
    swal.fire({
      title: "Update Address",
      text: "Success Update Address",
      type: "success",
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: "Confirm",
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php } ?>


<script type="text/javascript">
  $('#photoModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');

    // console.log('Button Position ' + orderno);
    var changePassword = '<?php echo base_url('General/Profile/changePhoto?id='); ?>';

    $('.modal-body').load(changePassword + id, function() {
      $('#photoModal').modal({
        show: true
      });
    });
  });

  $('#passwordModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');

    // console.log('Button Position ' + orderno);
    var changePassword = '<?php echo base_url('General/Profile/changePassword?id='); ?>';

    $('.modal-body').load(changePassword + id, function() {
      $('#passwordModal').modal({
        show: true
      });
    });
  });

  $('#addressModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');

    // console.log('Button Position ' + orderno);
    var changeAddress = '<?php echo base_url('General/Profile/changeAddress?id='); ?>';

    $('.modal-body').load(changeAddress + id, function() {
      $('#addressModal').modal({
        show: true
      });
    });
  });

  $('#phoneModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');

    // console.log('Button Position ' + orderno);
    var changePhone = '<?php echo base_url('General/Profile/changePhone?id='); ?>';

    $('.modal-body').load(changePhone + id, function() {
      $('#phoneModal').modal({
        show: true
      });
    });
  });
</script>