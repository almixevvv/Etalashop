<body class="sansserif" style="background-color: #e4e4e4; color: black!important;">
<div style="max-width:500px;margin:auto;padding:30px;">
  <div style="content: ''; clear: both; display: table;">
    <div style="float: left; padding-left: 70px;">
      <img src="<?php echo base_url('assets/images/logo.png'); ?>" style="width:100%; max-width:200px;"/>
    </div>
  </div>
  <div style="width: 80%; margin: auto;">
    <h4 style="padding-left: 45px;">Dear Customer,</h4>
    <h4 style="padding-left: 45px;">Thank you for joining Kikikuku.com</h4>
    <h4 style="padding-left: 45px;">To complete your registration process, please confirm that this is your email address</h4>
    <div style="text-align: center;">
      <a href="<?php echo base_url('verification?key=').$hash."&email=".$email; ?>" style="background-color:#34ca9d; -moz-border-radius:19px; -webkit-border-radius:19px; border-radius:19px;
    	display:inline-block;
    	cursor:pointer;
    	color:#ffffff;
    	padding:16px 31px;
    	text-decoration:none;">Yes, this is my email</a>
    </div>
    <h4 style="padding-left: 45px;">Start shopping from our selection or visit our help section for more info</h4>
    <h4 style="padding-left: 44px;">Cheers, Kikikuku Team</h4>
    <hr>
    <h4 style="padding-left: 45px;">If the button above doesn't appear, copy and paste this URL to your browser:</h4>
    <h4 style="padding-left: 45px; text-align: center;"><?php echo base_url('verification?key=').$hash."&email=".$email; ?></h4>
  </div>
</div>

</body>
