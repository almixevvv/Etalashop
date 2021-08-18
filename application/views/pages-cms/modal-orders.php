<style media="screen">
  .user-message-window {
    height: auto;
    border: 1px solid #2db4d6;
    background-color: #fafafa;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
    margin-left: 1em;
    width: 280px;
  }

  .admin-message-window {
    height: auto;
    border: 1px solid #2dd6a7;
    background-color: #f0fffa;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
    margin-left: 1em;
    width: 280px;
  }
</style>


<?php foreach ($details->result() as $data) :
  $order_no = $data->ORDER_NO;
  $userEmail = $data->MEMBER_EMAIL;
?>

  <form action="<?php echo base_url('Orders_cms/updateOrder'); ?>" id="update-order-form">


    <!-- INITIAL DATA -->
    <?php $totalPostage = $data->TOTAL_POSTAGE; ?>

    <!-- INITIAL DATA -->
    <!-- HEADER -->
    <div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
      <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">View Order Management</p>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- ORDER NUMBER -->
    <div class="modal-body" style="font-size: 11px; ">
      <div class="row">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-md-12">
              <label style="width: 10em; font-weight: bold;">Order No</label>
              <input type="hidden" id="hidden-id" value="<?php echo $data->ORDER_NO; ?>">
              <label style="margin-left: 1em; font-weight: bold;">:</label>

              <!-- HIDDEN INPUT FOR FORM PURPOSE -->
              <input type="hidden" name="order-no" value="<?php echo $data->ORDER_NO; ?>">
              <!-- HIDDEN INPUT FOR FORM PURPOSE -->
              <span style="font-size: 11px;margin-left: 1em; font-weight: bold; color: #2db4d6"><?php echo $data->ORDER_NO; ?></span>
            </div>
            <label class="col-md-12">
              <label style="width: 10em; font-weight: bold;">Order Date</label>
              <label style="margin-left: 1em; font-weight: bold;">:</label>
              <span style="font-size: 11px;margin-left: 1em; font-weight: bold; color: #2db4d6"><?php echo $data->ORDER_DATE; ?></span>
            </label>
            <div class="col-md-12">
              <label style="width: 10em; font-weight: bold;">Order Status</label>
              <input type="hidden" name="prev_status" value="<?php if ($data->STATUS_ORDER == 'NEW ORDER') {
                                                                echo $data->STATUS_ORDER;
                                                              } ?>">
              <label style="margin-left: 1em; font-weight: bold;">:</label>
              <select name="order-status" style="font-size: 11px; margin-left: 1em; width:10em;font-weight: bold;" class="custom-select">
                <?php
                if ($data->STATUS_ORDER == 'NEW ORDER') {
                  echo '<option selected value="NEW ORDER">NEW ORDER</option>';
                  echo '<option value="UPDATED">UPDATED</option>';
                  echo '<option value="CONFIRMED">CONFIRMED</option>';
                  echo '<option value="PAID">PAID</option>';
                  echo '<option value="CANCELED">CANCELED</option>';
                  echo '<option value="CLOSED">CLOSED</option>';
                } else if ($data->STATUS_ORDER == 'UPDATED') {
                  echo '<option value="NEW ORDER">NEW ORDER</option>';
                  echo '<option selected value="UPDATED">UPDATED</option>';
                  echo '<option value="CONFIRMED">CONFIRMED</option>';
                  echo '<option value="PAID">PAID</option>';
                  echo '<option value="CANCELED">CANCELED</option>';
                  echo '<option value="CLOSED">CLOSED</option>';;
                } else if ($data->STATUS_ORDER == 'CONFIRMED') {
                  echo '<option value="NEW ORDER">NEW ORDER</option>';
                  echo '<option value="UPDATED">UPDATED</option>';
                  echo '<option selected value="CONFIRMED">CONFIRMED</option>';
                  echo '<option value="PAID">PAID</option>';
                  echo '<option value="CANCELED">CANCELED</option>';
                  echo '<option value="CLOSED">CLOSED</option>';
                } else if ($data->STATUS_ORDER == 'PAID') {
                  echo '<option value="NEW ORDER">NEW ORDER</option>';
                  echo '<option value="UPDATED">UPDATED</option>';
                  echo '<option value="CONFIRMED">CONFIRMED</option>';
                  echo '<option selected value="PAID">PAID</option>';
                  echo '<option value="CANCELED">CANCELED</option>';
                  echo '<option value="CLOSED">CLOSED</option>';
                } else if ($data->STATUS_ORDER == 'CANCELED') {
                  echo '<option value="NEW ORDER">NEW ORDER</option>';
                  echo '<option value="UPDATED">UPDATED</option>';
                  echo '<option value="CONFIRMED">CONFIRMED</option>';
                  echo '<option value="PAID">PAID</option>';
                  echo '<option selected value="CANCELED">CANCELED</option>';
                  echo '<option value="CLOSED">CLOSED</option>';
                } else if ($data->STATUS_ORDER == 'DONE') {
                  echo '<option value="NEW ORDER">NEW ORDER</option>';
                  echo '<option value="UPDATED">UPDATED</option>';
                  echo '<option value="CONFIRMED">CONFIRMED</option>';
                  echo '<option value="PAID">PAID</option>';
                  echo '<option value="CANCELED">CANCELED</option>';
                  echo '<option selected value="DONE">DONE</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="row">
            <div class="col-md-12">
              <label style="width: 10em; font-weight: bold;">Special Instruction</label>
              <label style="margin-left: 1em; font-weight: bold;">:</label>
              <textarea name="spc_instruction" style="font-size: 11px;" class="md-textarea form-control" rows="1" cols="50"><?php echo $data->SPC_INSTRUCTION; ?></textarea>
            </div>
            <div class="col-md-12">
              <label style="width: 10em; color: #2db4d6; font-weight: bold;">Last Update</label>
              <label style="margin-left: 1em; font-weight: bold; color: #2db4d6;">:</label>
              <label name="order-update" style="font-size: 11px;margin-left: 1em; font-weight: bold; color: #2db4d6"><?php echo $data->UPDATED; ?> <?php echo 'by ADMIN' ?></label>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <!-- MEMBER INFO -->
      <div class="row" style="margin-bottom: -1em;">
        <div class="col-lg-6">
          <div style="text-align: left; color: #2db4d6; font-size: 12px; font-weight: bold;">MEMBER INFO
          </div>
        </div>
        <div class="col-lg-6">
          <div style="text-align: left; color: #2db4d6; font-size: 12px;margin-left: 4.4em; font-weight: bold;">MESSAGES
          </div>
        </div>
      </div>
      <hr>

      <div class="row">
        <div class="col-lg-6">
          <!-- MEMBER INFO -->
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label style="width: 5em; font-weight: bold;">Name</label>
                  <label style="margin-left: 1em; font-weight: bold;">:</label>
                  <span style="font-size: 11px;margin-left: 1em; font-weight: bold;"><?php echo $data->FIRST_NAME; ?> <?php echo $data->LAST_NAME; ?></span>
                </div>
                <div class="col-md-12">
                  <label style="width: 5em; font-weight: bold;">Address</label>
                  <label style="margin-left: 1em; font-weight: bold;">:</label><br>
                  <span style="font-size: 11px;"><?php echo $data->ADDRESS; ?></span><br>
                  <span style="font-size: 11px;"><?php echo $data->ADDRESS_2; ?></span>
                  <r>
                    <span style="font-size: 11px;"><?php echo $data->PROVINCE; ?></span><br>
                    <span style="font-size: 11px;"><?php echo $data->ZIP; ?></span><br>
                    <span style="font-size: 11px;"><?php echo $data->COUNTRY; ?></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label style="width: 5em; font-weight: bold;">Mobile</label>
                  <label style="margin-left: 1em; font-weight: bold;">:</label><br>
                  <span style="color: #00b011; font-size: 11px; font-weight: bold;"><?php echo $data->PHONE; ?></span>
                  <a href="https://web.whatsapp.com/send?phone=+62 <?php echo substr($data->PHONE, 1, 12) ?>" target="_blank">
                    <i class="fab fa-whatsapp fa-2x" style="color: #00b011; margin-top: -1em"></i>
                  </a>
                </div>
                <div class="col-md-12">
                  <label style="width: 5em; font-weight: bold;margin-top: 2em;">Email</label>
                  <label style="margin-left: 1em; font-weight: bold">:</label><br>
                  <span style="font-size: 11px;font-weight: bold;"><?php echo $data->EMAIL; ?></span>
                </div>
              </div>
            </div>
          </div>

          <!-- SHIPPING INFO -->
          <div class="row" style="margin-bottom: -1em;margin-top: 1em;">
            <div class="col-lg-6">
              <div style="text-align: left; color: #2db4d6; font-size: 12px; font-weight: bold;">SHIPPING INFO</div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label style="width: 5em; font-weight: bold;">Name</label>
                  <label style="margin-left: 1em; font-weight: bold;">:</label>
                  <span style="font-size: 11px;margin-left: 1em; font-weight: bold;"><?php echo $data->MEMBER_NAME; ?></span>
                </div>
                <div class="col-md-12">
                  <label style="width: 5em; font-weight: bold;">Address</label>
                  <label style="margin-left: 1em; font-weight: bold;">:</label><br>
                  <span style="font-size: 11px;"><?php echo $data->ADDRESSO_1; ?></span><br>
                  <span style="font-size: 11px;"><?php echo $data->ADDRESSO_2; ?></span>
                  <r>
                    <span style="font-size: 11px;"><?php echo $data->STATE; ?></span><br>
                    <span style="font-size: 11px;"><?php echo $data->ZIP_ORDER; ?></span><br>
                    <span style="font-size: 11px;"><?php echo $data->COUNTRY_ORDER; ?></span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label style="width: 5em; font-weight: bold;">Mobile</label>
                  <label style="margin-left: 1em; font-weight: bold;">:</label><br>
                  <span style="color: #00b011; font-size: 11px; font-weight: bold;"><?php echo $data->MEMBER_PHONE; ?></span>
                  <a href="https://web.whatsapp.com/send?phone=+62 <?php echo substr($data->MEMBER_PHONE, 1, 12) ?>" target="_blank">
                    <i class="fab fa-whatsapp fa-2x" style="color: #00b011; margin-top: -1em"></i>
                  </a>
                </div>
                <div class="col-md-12">
                  <label style="width: 5em; font-weight: bold;margin-top: 2em;">Email</label>
                  <label style="margin-left: 1em; font-weight: bold;">:</label><br>
                  <span style="font-size: 11px; font-weight: bold;"><?php echo $data->MEMBER_EMAIL; ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- MESSAGE BOX -->
        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-12" style="margin-left: 5em;">
              <div id="boxMessage" style="max-height:275px; height:260px; overflow:auto; margin-left:0em; border:1px solid lightgrey; margin-bottom: 1em; width: 320px;">

                <!-- PRINT AND LOOP THE MESSAGE -->
                <?php foreach ($messages->result() as $msg) : ?>

                  <!-- CHECK IF THE SENDER IS CUSTOMER OR ADMIN -->
                  <?php if ($msg->SENDER_ID == 'CUSTOMER') : ?>
                    <div class="user-message-window">
                      <div class="time-right" style="text-align: left; color: #2db4d6"><b>CUSTOMER</b>&nbsp<?php echo $msg->MESSAGE_TIME; ?></div>
                      <div style="text-align: left;"><?php echo $msg->MESSAGE; ?></div>
                      <!-- <div class="time-right" style="text-align: left; color: #2db4d6; font-weight: bold; margin-top: 0.5em;"><?php echo $msg->MESSAGE_TIME; ?></div> -->
                    </div>

                  <?php else : ?>
                    <div class="admin-message-window">
                      <div class="time-right" style="text-align: right; color: #2dd6a7;"><?php echo $msg->MESSAGE_TIME; ?> <b>KIKIKUKU</b></div>
                      <div style="text-align: right;"><?php echo $msg->MESSAGE; ?></div>
                      <!-- <div class="time-right" style="text-align: right; color: #2dd6a7; font-weight: bold; margin-top: 0.5em;"><?php echo $msg->MESSAGE_TIME; ?></div> -->
                    </div>
                  <?php endif; ?>
                  <!-- CHECK IF THE SENDER IS CUSTOMER OR ADMIN -->
                <?php endforeach; ?>
                <!-- PRINT AND LOOP THE MESSAGE -->

              </div>
              <div class="row">
                <div class="col-lg-8">
                  <textarea id="text_message" name="text_message" class="md-textarea form-control" rows="1" style="width: 270px; font-size: 11px;"></textarea>
                </div>
                <div class="col-lg-4">
                  <button type="button" class="btn btn-primary btn-sm" id="submitMessages" style="font-size: 12px; margin-left: 1em;">Send</button>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>


    <hr>
    <div style="margin-top: 1em; margin-bottom: -1em;">
      <p style="font-size: 15px;color: #2db4d6; font-weight: bold;">DETAIL ORDER</p>
    </div>
    <hr>


    <?php
    //GET TOTAL PRODUCT ID
    $this->db->select('*');
    $this->db->from('g_order_detail');
    $this->db->where('ORDER_NO', $data->ORDER_NO);

    $query = $this->db->get();
    ?>

    <!-- ini buat nampilin data product ordernya -->
    <div id="detail-rows">
      <?php
      $product_amount = 0;
      $a = 0;
      $counter = 1;

      foreach ($query->result() as $data) :
      ?>

        <div class="row">
          <div class="col-lg-3">
            <div class="row">
              <div class="col-md-12">
                <!-- GET DATA FROM API -->
                <?php
                $finalUrl   = 'http://en.yiwugo.com/ywg/productdetail.html?account=Wien.suh@gmail.com&productId=' . $data->PROD_ID;
                $json = file_get_contents($finalUrl);
                $dataproduct = json_decode($json, true);
                ?>
                <img src="http://img1.yiwugou.com/<?php echo $dataproduct['detail']['productForApp']['picture']; ?>" style='width: 11em;' />
              </div>
            </div>
          </div>
          <div class="col-lg-3" style="margin-left: -4em"><b style="color: #2db4d6; ">PRODUCT INFO</b>
            <div class="row">
              <div class="col-md-12">
                <label style="width: 7em; font-weight: bold;">Product ID</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <span style="font-size: 11px;"><?php echo $dataproduct['detail']['id']; ?></span>
                <input type="hidden" name="product_name_<?php echo $counter; ?>" value="<?php echo $dataproduct['detail']['id']; ?>">
              </div>
              <div class="col-md-12">
                <label style="width: 7em; font-weight: bold;">Product Name</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label><br>
                <span style="font-size: 11px;"><?php echo $dataproduct['detail']['productForApp']['title']; ?></span>
              </div>
              <div class="col-md-12">
                <label style="width: 7em; font-weight: bold;">Yiwugo Price</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <span style="font-size: 11px;"><?php echo $dataproduct['detail']['productForApp']['sellPrice']; ?></span>
              </div>
              <div class="col-md-12">
                <label style="width: 7em; font-weight: bold;">Order Price</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <span style="font-size: 11px;"><?php echo number_format($data->PRICE, 2); ?></span>
              </div>
              <div class="col-md-12">
                <label style="width: 7em; font-weight: bold;">Final Price</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <!-- <input type="type" name="final_price" value="<?php echo $data->FINAL_PRICE; ?>" style="width: 5em" > -->
                <input type="type" name="final_price_<?php echo $counter; ?>" onkeypress="return Angkasaja(event)" value="<?php echo $data->FINAL_PRICE; ?>" style="width: 6em" onkeyup="myfunction(<?php echo $a; ?>)" id="final_price_<?php echo $a; ?>">
              </div>
              <div class="col-md-12">
                <label style="width: 7em; font-weight: bold;">Quantity</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <input type="type" name="txt_quantity_<?php echo $counter; ?>" onkeypress="return Angkasaja(event)" value="<?php echo $data->QUANTITY; ?>" style="width: 6em" onkeyup="myfunction(<?php echo $a; ?>)" id="txt_quantity_<?php echo $a; ?>">
                <!-- <span style="font-size: 11px;"><?php echo $data->QUANTITY; ?></span>
          <input type="hidden" id="txt_quantity_<?php echo $a; ?>" value="<?php echo $data->QUANTITY; ?>"> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="row">
              <div class="col-md-12"><br><b>Inquiry</b>
                <span style="margin-left: 1em; font-weight: bold;">:</span><br>
                <textarea class="lg-textarea form-control" rows="3" style="font-size: 11px;"><?php echo $data->NOTES; ?></textarea>
              </div>
            </div>
          </div>
          <div class="col-lg-3"><b style="color: #2db4d6; ">SELLER INFO</b>
            <div class="row">
              <div class="col-lg-12">
                <label style="width: 4em; font-weight: bold;">Shop ID</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <span style="font-size: 11px;"><?php echo $dataproduct['shopinfo']['shop']['shopId']; ?></span>
              </div>
              <div class="col-lg-12">
                <label style="width: 4em; font-weight: bold;">Seller</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <span style="font-size: 11px;"><?php echo $dataproduct['shopinfo']['shop']['shopName']; ?></span>
              </div>
              <div class="col-lg-12">
                <label style="width: 4em; font-weight: bold;">Email</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <span style="font-size: 11px;" id="user-email[]"><?php echo $dataproduct['shopinfo']['shop']['femail']; ?></span>
              </div>
              <div class="col-lg-12">
                <label style="width: 4em; font-weight: bold;">Mobile</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <span style="font-size: 11px; color: #00b011; font-weight: bold;"><?php echo $dataproduct['shopinfo']['shop']['mobile']; ?></span>
                <a href="#" target="_blank">
                  <i class="fab fa-weixin fa-2x" style="color: #00b011;"></i>
                </a>
              </div>
              <div class="col-lg-12">
                <label style="width: 4em; font-weight: bold;">Telephone</label>
                <label style="margin-left: 1em; font-weight: bold;">:</label>
                <span style="font-size: 11px;"><?php echo $dataproduct['shopinfo']['shop']['telephone']; ?></span>
              </div>
            </div>
          </div>
        </div>
        <hr>
      <?php
        $counter++;
        $product_amount = $product_amount + ($data->FINAL_PRICE * $data->QUANTITY);
        $a++;
      endforeach;
      ?>

      <p style="text-align: right; font-size: 11px;font-weight: bold;">Product Amount &nbsp;
        <!-- ini yang di tampilin  -->
        <span style="width: 30%; float: right; background-color: lightgrey; font-size: 11px; font-weight: bold;" class="form-control modal-amount" id="amount_total"><?php echo number_format($product_amount, 2); ?></span>
        <!-- ini yang di masuk database  -->
        <input name="order-amount" type="hidden" id="txt1" style="width: 30%; float: right;" class="form-control modal-amount" disabled="true" value="<?php echo $product_amount; ?>" />
      </p><br>
      <!-- ini yang di perhitungan  -->
      <p style="text-align: right; clear:both; font-size: 11px;font-weight: bold;">Shipping Cost &nbsp;
        <input name="import_cost" type="text" id="txt2" onkeypress="return Angkasaja(event)" onkeyup="sum();" value="<?php echo $totalPostage; ?>" style="width: 30%; float: right; text-align: right; font-size: 11px; font-weight: bold;" class="form-control" />
      </p><br>

      <p style="text-align: right; clear: both; font-size: 11px;font-weight: bold;">Total &nbsp;
        <!-- ini yang di tampilin  -->
        <span id="txt3" style="width: 30%; float: right;text-align: right; background-color: lightgrey; font-size: 11px; font-weight: bold;" class="form-control" disabled="true"></span>
        <!-- ini yang di masuk database  -->
        <input type="hidden" id="txt_input" style="width: 30%; float: right;" class="form-control" disabled="true" />
      </p><br>

      <br>

      <?php foreach ($internal->result() as $notes) : ?>
        <div class="md-form">
          <p style="font-size: 11px;"><b>Internal Notes :</b></p>
          <textarea name="internal_notes" class="md-textarea form-control" rows="3" style="margin-top: -1em; font-size: 11px;"><?php echo $notes->INTERNAL_NOTES; ?></textarea>
        </div>
      <?php endforeach; ?>

      <div class="modal-footer">
        <button type="submit" class="btn btn-default btn-info">Save</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>

        <!-- SEND TOTAL AMOUNT FOR LOOP IN FUNCTION -->
        <input type="hidden" id="txt_quantity_<?php echo $a; ?>" value="<?php echo $data->QUANTITY; ?>">
        <input type="hidden" name="loop-counter" value="<?php echo $counter; ?>">
        <input type="hidden" name="user-email" value="<?php echo $userEmail; ?>">
        <!-- SEND TOTAL AMOUNT FOR LOOP IN FUNCTION -->
      </div>
  </form>

  <!-- script buat perhitungan otomatis -->
  <script>
    function sum() {
      var txtFirstNumberValue = document.getElementById('txt1').value.replace(",", "");
      var txtSecondNumberValue = document.getElementById('txt2').value;
      var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue);
      if (!isNaN(result)) {
        document.getElementById('txt3').innerHTML = formatNumber(result);
        document.getElementById('txt_input').value = result;
      }
    }

    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    // function buat perhitungan final price x quantity masuk ke product amount
    function myfunction(action) {
      var jumlah_order = <?php echo $a; ?>;
      var total_price = 0;
      var id_action = action;
      for (var i = 0; i < jumlah_order; i++) {
        var final_price = document.getElementById('final_price_' + i).value;
        var quantity = document.getElementById('txt_quantity_' + i).value;
        var jumlah = final_price * quantity;
        total_price = total_price + jumlah;
      }

      document.getElementById('amount_total').innerHTML = formatNumber(total_price);
      document.getElementById('txt1').value = total_price;
    }
  </script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/bootstrap-4/js/bootstrap.js'); ?>"></script>

  <!-- INSERT TO FIREBASE -->
  <!-- <script>
    $('form').on('submit', function(e) {
      e.preventDefault();

      let email = $('input[name=user-email]').val();
      let id = $("#hidden-id").val();

      let orderStatus = $('select[name=order-status]').find('option:selected').text();

      if (orderStatus.indexOf("PAID") >= 0) {
        //ORDER SENT
        db.collection('transactions').add({
          action: 'orderSent',
          customerEmail: email,
          orderID: id,
          flag: '1'
        }).then(() => {
          // alert('form finished processing');
          $(this).submit();
          // $('#update-order-form').submit();
        });
      } else {
        //ORDER PRICE CHANGED
        db.collection('transactions').add({
          action: 'priceUpdated',
          customerEmail: email,
          orderID: id,
          flag: '1'
        }).then(() => {
          $(this).submit();
          // alert('form finished processing');
          // $('#update-order-form').submit();
        });
      }

    });
  </script> -->

  <!-- script buat input angka saja -->
  <script type="text/javascript">
    function Angkasaja(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
      return true;
    }

    $("#submitMessages").on('click', function() {

      var message = $("#text_message").val();
      var ORDER_ID = $("#hidden-id").val();

      $.ajax({
        url: "<?php echo base_url('Orders_cms/adminSendMessages'); ?>",
        type: "POST",
        data: {
          id: ORDER_ID,
          message: message
        },
        success: function() {
          var getDetails = '<?php echo base_url('Orders_cms/getDetails?id='); ?>';

          $('.modal-body').load(getDetails + ORDER_ID, function() {
            $('#boxMessage').modal({
              show: true
            });
            //$(".message-holder").animate({ scrollTop: $('.message-holder').prop("scrollHeight")}, 1000);
          });

        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    });
  </script>