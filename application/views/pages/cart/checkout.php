<div class="checkout-container">

  <div class="row d-none d-md-block d-lg-block d-xl-block">

    <!-- CART BREADCRUMB -->
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
      <div class="mb-0 mb-md-3 mb-lg-3 mb-xl-3 pt-0 pt-md-2 pt-lg-2 pt-xl-2" style="text-align: left;">

        <span style="color: #333;">
          <a href="<?php echo base_url(); ?>" style="color: black;">
            <span class="fa fa-home"></span> Home
          </a>
        </span>

        <span style="color: #333;"> -
          <a href="<?php echo base_url('mycart'); ?>" style="color: black;">
            Shopping Cart
          </a>
        </span>

        <span style="color: black;"> -
          Checkout
        </span>

      </div>
    </div>
    <!-- END OF CART BREADCRUMB -->

  </div>

  <div class="row">
    <div class="col-12 col-md-5 col-lg-5 col-xl-5">
      <h3>Shipping Details</h3>
    </div>
  </div>

  <form id="add-inquiry-form" action="<?php echo base_url('Checkout/checkoutProcess'); ?>" method="POST" class="needs-validation" novalidate>

    <!-- LOAD USER DATA -->
    <div id="checkout-inner-container">

      <div class="row">
        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label for="txt-name">Name</label>
            <?php if (isset($userData)) { ?>
              <input type="text" name="txt-name" value="<?php echo $userData->MEMBER_NAME; ?>" class="form-control" required />
            <? } else { ?>
              <input type="text" name="txt-name" class="form-control" required />
            <?php } ?>
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label for="txt-email">Email</label>
            <?php if (isset($userData)) { ?>
              <input type="text" name="txt-email" value="<?php echo $userData->MEMBER_EMAIL; ?>" class="form-control" required />
            <?php } else { ?>
              <input type="text" name="txt-email" class="form-control" required />
            <?php } ?>
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label for="txt-phone">Phone Number</label>
            <?php if (isset($userData)) { ?>
              <input type="number" name="txt-phone" value="<?php echo $userData->MEMBER_PHONE; ?>" class="form-control" required />
            <?php } else { ?>
              <input type="number" name="txt-phone" class="form-control" required />
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
          <div class="form-group">
            <label for="txt-address-1">Address</label>
            <?php if (isset($userData)) { ?>
              <input type="text" name="txt-address-1" value="<?php echo $userData->ADDRESS_1; ?>" class="form-control" required />
            <?php } else { ?>
              <input type="text" name="txt-address-1" class="form-control" required />
            <?php } ?>
          </div>
        </div>
        <div class="col-12 col-md-6 co-lg-6 co-xl-6">
          <div class="form-group">
            <label for="txt-address-2">Address 2</label>
            <?php if (isset($userData)) { ?>
              <input type="text" name="txt-address-2" value="<?php echo $userData->ADDRESS_2; ?>" class="form-control" required />
            <?php } else { ?>
              <input type="text" name="txt-address-2" class="form-control" required />
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-6 col-md-4 col-lg-4 col-xl-4">
          <label for="txt-country">Country</label>
          <select name="txt-country" id="txt-country" class="form-control">
            <option value="Indonesia" selected="selected">Indonesia</option>
          </select>
        </div>
        <div class="col-6 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label for="txt-state">State/Province</label>
            <?php if (isset($userData)) { ?>
              <input type="text" name="txt-state" value="<?php echo $userData->STATE; ?>" id="txt-state" class="form-control" required />
            <?php } else { ?>
              <input type="text" name="txt-state" id="txt-state" class="form-control" required />
            <?php } ?>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label for="txt-zip">ZIP Code</label>
            <?php if (isset($userData)) { ?>
              <input type="text" name="txt-zip" value="<?php echo $userData->ZIP; ?>" id="txt-zip" class="form-control" required />
            <?php } else { ?>
              <input type="text" name="txt-zip" id="txt-zip" class="form-control" required />
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="row">

        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
          <label>
            <input name="save-info" type="checkbox"> Save This Information for Next Time
          </label>
        </div>

      </div>

      <div class="row">

        <div class="col-12 col-md-5 col-lg-5 col-xl-5">
          <label>
            <input name="clear-data" type="checkbox" id="clear-data"> My Shipping Address is Different From My Billing Address
          </label>
        </div>

      </div>

      <div class="row">

        <div class="col-6 col-md-3 col-lg-3 col-xl-3">
          <button class="form-control btn-kku" type="submit" id="btn-req">Submit</button>
        </div>

      </div>

      <div class="d-none" id="id-user"><?php echo $userID; ?></div>
      <div class="d-none" id="email-user"><?php echo $userEmail; ?></div>
      <div class="d-none" id="order-id"></div>

    </div>

  </form>

</div>
<script type="text/javascript">
  //GET ORDER ID
  var getUrl = window.location;
  var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
  var orderID;

  $.ajax({
    url: baseUrl + '/Checkout/generateID',
    type: 'GET',
    success: function(data) {
      // console.log(data);
      orderID = data;
    },
    error: function(ex) {
      console.log(ex);
    }
  });

  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

  const form = document.querySelector('#add-inquiry-form');
  form.addEventListener('submit', (e) => {
    if (form.checkValidity() === true) {
      // e.preventDefault();
      let email = $('#email-user').text();
      let id = $('#id-user').text();

      db.collection('inquiries').add({
        action: 'submitInquiry',
        customerEmail: email,
        customerID: id,
        orderID: orderID,
        flag: '1'
      }).then(() => {
        form.submit();
      });
    }
  });

  var email = $('#email-user').text();

  $('#clear-data').on('change', function() {

    ckb = $("#clear-data").is(':checked');

    if (ckb) {
      $('input[name=txt-name]').val('');
      $('input[name=txt-email]').val('');
      $('input[name=txt-phone]').val('');
      $('input[name=txt-address-1]').val('');
      $('input[name=txt-address-2]').val('');
      $('input[name=txt-state]').val('');
      $('input[name=txt-zip]').val('');
    } else {

      $.ajax({
        url: baseUrl + 'Checkout/getMemberData',
        type: 'POST',
        data: {
          email: email
        },
        success: function(data) {
          $.each(data, function(index, value) {
            $('input[name=txt-name]').val(value.FIRST_NAME + ' ' + value.LAST_NAME);
            $('input[name=txt-email]').val(value.EMAIL);
            $('input[name=txt-phone]').val(value.PHONE);
            $('input[name=txt-address-1]').val(value.ADDRESS);
            $('input[name=txt-address-2]').val(value.ADDRESS_2);
            $('input[name=txt-state]').val(value.PROVINCE);
            $('input[name=txt-zip]').val(value.ZIP);
          });
        }
      });
    }

  });

  $.ajax({
    url: 'https://restcountries.eu/rest/v2/all?fields=name;callingCodes;flag',
    type: 'GET',
    success: function(data) {
      var countryData = '';
      $.each(data, function(index, value) {
        //Get country data from API
        $("#txt-country").append($('<option>', {
          value: value.name,
          text: value.name
        }));

        //Get country phone number from API
        $("#country-code").append($('<option>', {
          value: value.callingCodes,
          text: value.name + " +" + value.callingCodes
        }));
      });
    },
    error: function(xhr, ajaxOptions, thrownError) {
      var errorMsg = 'Ajax request failed: ' + xhr.responseText;
      console.log(errorMsg);
    }
  });
</script>