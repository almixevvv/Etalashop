<body class="sansserif" style="color: black!important;">
  
  <div id="main-body" style="background-color: white; max-width:500px; margin:auto; padding:30px; border: 1px solid #34ca9d; border-radius: 5px; color: black!important;">
    
    <div style="content: ''; clear: both; display: table;">
      <div style="float: left;">
        <img src="<?php echo base_url('assets/images/logo.png'); ?>" style="width:100%; max-width:200px;"/>
      </div>
    </div>

    <div style="width: 80%; color: black!important;">
      <h4>Dear Customer,</h4>
      <h4>To complete your password reset process, please click the button below:</h4>
    </div>

    <div style="width: 100%; color: black!important;">
      <div style="text-align: center; width: 100%;">
        <a style="background-color: #34ca9d; -moz-border-radius: 19px; -webkit-border-radius: 19px; border-radius: 19px; display: inline-block; cursor: pointer; color: #ffffff; padding: 16px 31px; text-decoration: none;" href="<?php echo base_url('profile/reset?email='.$USER_EMAIL.'&key='.$RESET_ID); ?>">RESET PASSWORD</a>
      </div>

    <div style="width: 80%; color: black!important;">
      <h4>Start shopping from our selection or visit our help section for more info.</h4>
      <h4>Cheers, Kikikuku Team</h4>
      <hr>
      <h4>If the button above doesn't appear, copy and paste this URL to your browser:</h4>
    </div>

    <div style="width: 100%; font-size: 0.9em; color: black!important;">
      <?php echo base_url('profile/reset?email='.$USER_EMAIL.'&key='.$RESET_ID); ?>
    </div>

    </div>

    <div style="width: 100%; color: black!important;">
      
      <center>
        <div class="card-header" style="margin-top: 1em;margin-bottom:1em; background-color: #ffedc4;border: 1px solid #f0c465; color: #666666;padding-top: 2em;padding-bottom: 2em; font-size: 12px;">
          Be sure not to inform evidence and payment data to any party except Kikikuku
        </div>
      </center>

      <hr>

      <div style="color: #666666;font-size: 12px;margin-top: 1em; color: black!important;">
        Email is generated automatically. Please do not send replies to this email.
      </div>
      
    </div>

  </div>

</body>
