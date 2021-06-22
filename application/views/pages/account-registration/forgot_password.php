<div class="login-container">
    
  <form method="POST" action="<?php echo base_url('ResetPassword/sendPasswordReset'); ?>" class="needs-validation" novalidate>
    
    <div class="row" id="login-inner-container">
      
      <div class="col-12 col-md-12 col-lg-12 col-xl-12">

        <div class="row">
          
          <div class="col-12">
            <div class="d-flex justify-content-center">
              <span class="text-uppercase font-weight-bold pb-md-2 pb-lg-2 pb-xl-2 login-text-color">
                reset password
              </span>
            </div>
          </div>

        </div>

        <div class="row mt-4">
          
          <div class="col-12 px-5">
            <label for="reset-email">Registered Email Address</label>
            <input type="email" class="form-control" id="reset-email" name="reset-email" placeholder="Email" required>
            <div class="invalid-feedback">
              Email cannot be empty
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-8 px-5">
            <button class="form-control btn btn-kku" type="submit">Reset Password</button>
          </div>
        </div>

      </div>

    </div>

  </form>

</div>

<?php if($this->session->error == 'email_send'): ?>
<script type="text/javascript">

  swal.fire({
    title:'Reset Failed',
    text: 'Reset process failed, please try again later.',
    type: 'error',
    showCancelButton: false,
  });

</script>
<?php endif; ?>

<?php if($this->session->error == 'no_email'): ?>
<script type="text/javascript">

  swal.fire({
    title:'Reset Failed',
    text: 'This email is not registered, please try again.',
    type: 'error',
    showCancelButton: false,
  });

</script>
<?php endif; ?>


<script>
  formOveride();
</script>
