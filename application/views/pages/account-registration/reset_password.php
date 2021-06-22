<style type="text/css">
  
  .expiration-text {
    font-size: 2em;
  }


</style>

<div class="login-container">
    
  <form method="POST" action="<?php echo base_url('ResetPassword/resetPasswordProcess'); ?>" class="needs-validation" novalidate>
    
    <div class="row" id="login-inner-container">

      <!-- ONLY RESET IF THE STATUS IS STILL ACTIVE -->
      <?php if($RESET_DATA[0]->RESET_STATUS == 'ACTIVE'): ?>
  
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
              <div class="form-group">
                  <label for="uPass">Password</label>
                  <input type="password" class="form-control" name="uPass" id="uPass" onfocus="resetValidation()" aria-describedby="passHelp" placeholder="Password" onblur="checkPassword()" required>
                  <div class="invalid-feedback">
                      Password is required
                    </div>
                  <small id="passHelp" class="form-text text-muted">Your password must include a capital letter and a number and longer than 8 characters.</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 px-5">
              <div class="form-group">
                  <label for="uPass2">Confirm Password</label>
                  <input type="password" class="form-control" id="uPass2" onfocus="resetValidation()" onblur="matchPassword()" aria-describedby="passHelp" required>
                </div>
            </div>
        </div>

        <!-- HIDDEN INPUT FOR FIELD PROCESSING -->
        <input type="hidden" name="input-email" value="<?php echo $RESET_EMAIL; ?>">

        <div class="row">
          <div class="col-8 px-5">
            <button class="form-control btn btn-kku" type="submit">Reset Password</button>
          </div>
        </div>

      </div>

      <?php else: ?>
      <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="d-flex justify-content-center">
              <span class="text-uppercase font-weight-bold pb-md-2 pb-lg-2 pb-xl-2 login-text-color">
                reset key expired
              </span>
            </div>

          </div>

          <div class="col-12 mt-2 mt-md-3 mt-lg-4 mt-xl-4 pb-0 pb-md-2 pb-lg-2 pb-xl-2">
            <div class="d-flex justify-content-center">
              <span class="text-capitalize pb-md-2 pb-lg-2 pb-xl-2 login-text-color">
                it appears that the password reset key has been used. </br>you can start this process once again by clicking 
                <a href="<?php echo base_url('profile/forgot_password'); ?>" style="text-decoration: none; color: black;"><u>here</u></a>.
              </span>
            </div>            
          </div>

        </div>

      </div>
      <?php endif; ?>

    </div>

  </form>

</div>

<script>
  formOveride();

  <?php if($this->session->has_userdata('error')):?>
    swal.fire({
      title:'Reset Password Failed',
      text: 'You cannot use your old password, please try again',
      type: 'error',
      showCancelButton: false,
    });
  <?php endif; ?>
</script>
