 
 <div class="message-holder">

  <?php foreach($message->result() as $data): ?>

    <!-- CONVERT THE TIMESTAMP -->
    <?php
      $phpdate = strtotime($data->MESSAGE_TIME);
      $mysqldate = date( 'd-m-Y', $phpdate );
      $mysqltime = date('H:m', $phpdate);
    ?>

    <!-- IF THE MESSAGE IS FROM ADMIN, USE ADMIN TEMPLATE -->
    <?php if($data->SENDER_ID == 'ADMIN'): ?>
   
    <!-- ADMIN MESSAGE TEMPLATE -->
    <div class="row mt-1 mb-1">
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-start">
              <div class="admin-message-window">
                <span class="font-weight-bold">
                  Admin
                </span>
                <br>
                <span>
                  <?php echo $data->MESSAGE; ?>
                </span>
              </div>
            </div>
          </div>
        </div>

      <!-- ADMIN MESSAGE TIMESTAMP -->
      <div class="row">
        <div class="col-12">
          <div class="d-flex justify-content-start">
            <small class="font-italic"><?php echo $mysqldate.' '.$mysqltime; ?></small>
          </div>
        </div>
      </div>
      <!-- END OF ADMIN MESSAGE TIMESTAMP -->

      </div>
    </div>
    <!-- END OF ADMIN MESSAGE TEMPLATE -->

    <?php elseif($data->SENDER_ID == 'CUSTOMER'): ?>

    <!-- MEMBER MESSAGE TEMPLATE --> 
    <div class="row mt-1 mb-1">
      <div class="col-12">        
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-end">
              <div class="user-message-window">
                <span class="font-weight-bold">
                  Me
                </span>
                <br>
                <span>
                  <?php echo $data->MESSAGE; ?>
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- MEMBER MESSAGE TIMESTAMP -->
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-end">
              <small class="font-italic"><?php echo $mysqldate.' '.$mysqltime; ?></small>
            </div>
          </div>
        </div>
        <!-- END OF MEMBER MESSAGE TIMESTAMP -->

      </div>
    </div>
    <!-- MEMBER MESSAGE TEMPLATE -->
    <?php endif; ?>

  <?php endforeach; ?>
  
</div>
        
<div class="form-group">
  <label for="sender-messages">Enter Your Messages</label>
  <textarea name="sender-messages" class="form-control" id="sender-messages" rows="3"></textarea>
  <label for="sender-messages">Characters limit <span class="remaining-character">255</span></label>
  <div class="invalid-feedback">
    You've exceeded the characters limit
  </div>
  <input type="hidden" id="hidden-id" value="<?php echo $transID; ?>">
</div>

<script type="text/javascript">

  $('#sender-messages').keypress(function(e) {

    var txtValue = $('#sender-messages').val();
    var txtLength = txtValue.length;
    var final = 255;
    var txtRemains = parseInt(final - txtLength);

    $('.remaining-character').text(txtRemains);

    if (txtRemains <= 0 && e.which !== 0 && e.charCode !== 0) {
      $('#sender-messages').val((txtValue).substring(0, txtLength - 1));
      $('#sender-messages').addClass("is-invalid");
      return false;
    } else {
      $('#sender-messages').removeClass("is-invalid");
    }

  });

</script>
