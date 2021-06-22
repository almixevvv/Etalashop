<style type="text/css">
  body {
    background-image: linear-gradient(to bottom, #ffffff 0%, #18b589 100%);
  }
</style>

<body style="background-color: linear-gradient(to bottom, #f17f05 0%,#ff910d 60%,#ff7c00 61%,#ffa73d 61%,#ffa73d 61%,#ff7c00 61%,#ff7f04 100%);">

  <div class="container">
    <div class="card card-login mx-auto mt-5" style="background-color: transparent;border:transparent;">
      <div class="card-body">
        <?php echo form_open('CMS/CMS/login_process'); ?>
        <div class="d-flex justify-content-center">
          <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Kikikuku Logo" style="width: 100%;">
        </div>
        <div class="form-group" style="margin-top: 3em;">
          <div class="form-label-group">
            <input type="text" id="inputEmail" name="txt-username" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
            <label style="color: black;opacity: 0.3;" for="inputEmail">Username</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="password" id="inputPassword" name="txt-password" class="form-control" placeholder="Password" required="required">
            <label style="color: black;opacity: 0.3;" for="inputPassword">Password</label>
          </div>
          <?php if ($this->session->has_userdata('no_password')) { ?>
            <div class="alert alert-danger alert-dismissible fade show mt-2">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Login Failed!</strong> Wrong Username/Password.
            </div>
          <?php } else if ($this->session->has_userdata('no_email')) { ?>
            <div class="alert alert-danger alert-dismissible fade show mt-2">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Login Failed!</strong> Username Not Found.
            </div>
          <?php } ?>
        </div>
        <div class="form-group">
          <div class="checkbox">
            <label style="color: white;">
              <input type="checkbox" value="remember-me">
              Remember Password
            </label>
          </div>
        </div>
        <center>
          <button type="submit" class="btn btn-info">LOGIN</button>
        </center>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('assets/cms/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap-4/js/bootstrap.bundle.min.js'); ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/cms/jquery-easing/jquery.easing.min.js'); ?>"></script>

</body>