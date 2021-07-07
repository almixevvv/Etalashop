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

  <form id="add-inquiry-form" action="<?= base_url('General/Checkout/checkoutProcess'); ?>" method="POST" class="needs-validation" novalidate>

    <!-- LOAD USER DATA -->
    <div id="checkout-inner-container">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label for="txt-name">Name</label>
            <input type="text" name="txt-name" class="form-control" required value="<?= (isset($userData['FIRST_NAME']) ? $userData['FIRST_NAME'] : ''); ?> " />
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label for="txt-email">Email</label>
            <input type="text" name="txt-email" value="<?= (isset($userData['EMAIL']) ? $userData['EMAIL'] : ''); ?>" class="form-control" required />
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label for="txt-phone">Phone Number</label>
            <input type="number" name="txt-phone" value="<?= (isset($userData['PHONE']) ? $userData['PHONE'] : ''); ?>" class="form-control" required />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
          <div class="form-group">
            <label for="txt-address-1">Address</label>
            <input type="text" name="txt-address-1" value="<?= (isset($userData['ADDRESS']) ? $userData['ADDRESS'] : ''); ?>" class="form-control" required />
          </div>
        </div>
        <div class="col-12 col-md-6 co-lg-6 co-xl-6">
          <div class="form-group">
            <label for="txt-address-2">Address 2</label>
            <input type="text" name="txt-address-2" value="<?= (isset($userData['ADDRESS_2']) ? $userData['ADDRESS_2'] : ''); ?>" class="form-control" required />
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
            <input type="text" name="txt-state" value="<?= (isset($userData['PROVINCE']) ? $userData['PROVINCE'] : ''); ?>" id="txt-state" class="form-control" required />
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label for="txt-zip">ZIP Code</label>
            <input type="text" name="txt-zip" value="<?= (isset($userData['ZIP']) ? $userData['ZIP'] : ''); ?>" id="txt-zip" class="form-control" required />
          </div>
        </div>
      </div>

      <div class="row">

        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="save-info" id="save-info" type="checkbox">
            <label class="form-check-label" for="save-info">
              Save This Information for Next Time
            </label>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-12 col-md-5 col-lg-5 col-xl-5">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="clear-data" id="clear-data" type="checkbox">
            <label class="form-check-label" for="clear-data">
              My Shipping Address is Different From My Billing Address
            </label>
          </div>
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
  var orderID;

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

    let ckb = $("#clear-data").is(':checked');

    if (ckb) {
      $('input[name=txt-name]').val('');
      $('input[name=txt-email]').val('');
      $('input[name=txt-phone]').val('');
      $('input[name=txt-address-1]').val('');
      $('input[name=txt-address-2]').val('');
      $('input[name=txt-state]').val('');
      $('input[name=txt-zip]').val('');
    } else {

      $.post(baseUrl + 'API/getMemberData', {
        email: email
      }, function(resp) {
        $.each(resp, function(index, value) {
          $('input[name=txt-name]').val(value.FIRST_NAME + ' ' + value.LAST_NAME);
          $('input[name=txt-email]').val(value.EMAIL);
          $('input[name=txt-phone]').val(value.PHONE);
          $('input[name=txt-address-1]').val(value.ADDRESS);
          $('input[name=txt-address-2]').val(value.ADDRESS_2);
          $('input[name=txt-state]').val(value.PROVINCE);
          $('input[name=txt-zip]').val(value.ZIP);
        });
      });
    }

  });

  $.get('https://restcountries.eu/rest/v2/all?fields=name;callingCodes;flag', function(resp) {
    let countryData = '';

    $.each(resp, function(index, value) {
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
  }).fail(function(resp) {
    let errorMsg = 'Ajax request failed: ' + resp.responseText;
    console.log(errorMsg);
  });
</script>