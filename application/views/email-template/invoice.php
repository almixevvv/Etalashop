<style type="text/css">
  .sansserif {
    font-family: Arial, Helvetica, sans-serif;
  }

  .buttonBack {
    background-color: #ff4f42;
    border-color: transparent;
    color: white;
    border-radius: 5px;
    padding: 3px;
    width: 10em;
    /*margin-left: 35em;*/
    margin-bottom: 1em;
    font-family: Arial, Helvetica, sans-serif;
  }

  .buttonSendTop {
    background-color: #1e8c00;
    border-color: transparent;
    color: white;
    border-radius: 5px;
    padding: 3px;
    width: 10em;
    /*margin-left: 35em;*/
    margin-bottom: 1em;
    font-family: Arial, Helvetica, sans-serif;
  }

  .buttonSendBot {
    background-color: #1e8c00;
    border-color: transparent;
    color: white;
    border-radius: 5px;
    padding: 3px;
    width: 10em;
    /*margin-left: 35em;*/
    margin-top: 1em;
    font-family: Arial, Helvetica, sans-serif;
  }
</style>

<?php foreach ($details->result() as $data) : ?>
  <?php $totalPostage = $data->TOTAL_POSTAGE; ?>

  <center>
    <?php echo form_open('Orders_cms/sendInvoice'); ?>

    <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders'); ?>">
      <button type="button" class="buttonBack">
        < Back </button>
    </a>

    <a style="text-decoration: none!important;" href="#">

      <input type="hidden" name="email-sender" value="<?php echo $data->EMAIL; ?>">
      <input type="hidden" name="email-order-no" value="<?php echo $data->ORDER_NO; ?>">

      <button type="submit" class="buttonSendTop"> Send </button>
    </a>
    <?php echo form_close(); ?>
  </center>

  <!-- <button type="button" class="btn buttonBack"> Send </button> -->

  <body class="sansserif">
    <div class="main-body" style="background-color: white; max-width:500px;margin:auto;padding:30px; border: 1px solid lightgrey;">
      <center>
        <div class="card-header">
          <img src="<?php echo base_url('assets/images/logo.png'); ?>" style="width:100%; max-width:200px;" />
        </div>
      </center>

      <table>
        <tr>
          <td height="10">
            <div style="width: 6em; font-size: 12px;color: #666666; margin-top: 1em;">Order No </div>
            <span style="color: #2db4d6; font-size: 14px; font-weight: bold;"><?php echo $data->ORDER_NO; ?></span>
          </td>
          <td>
            <div style="width: 6em; font-size: 12px;color: #666666;margin-left: 22.2em; margin-top: 1em;">Order Date </div>
            <div style="color: #2db4d6; font-size: 14px;text-align: right; margin-left: 19em;font-weight: bold;"><?php echo date("d F Y", strtotime($data->ORDER_DATE)); ?></div>
          </td>
        </tr>
      </table>

      <hr>

      <table style="margin-top: 1em;">
        <tr class="invoice-table-header" style="background-color: #f0f0f0;">
          <th width="400" style="text-align: left; padding: 4px;">
            <span style="margin-left: 10px; font-size: 12px;">Billing Address</span>
          </th>
          <th width="400" style="text-align: left;">
            <span style="margin-left: 10px; font-size: 12px;">Shipping Address</span>
          </th>
        </tr>
        <tr>
          <!-- Row Name -->
          <td height="10">
            <div style="text-align: left; margin-left: 15px; margin-top: 1em; font-size: 12px;margin-bottom: 1em; color: #2db4d6;"><?php echo $data->FIRST_NAME; ?> <?php echo $data->LAST_NAME; ?></div>
          </td>
          <td height="10">
            <div style="text-align: left; margin-left: 15px; margin-top: 1em; font-size: 12px;margin-bottom: 1em; color: #2db4d6;"><?php echo $data->MEMBER_NAME; ?></div>
          </td>
        </tr>
        <tr>
          <!-- Row Address -->
          <td height="10" style="height: 10px; color: #666666">
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->ADDRESS; ?></div>
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->ADDRESS_2; ?></div>
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->PROVINCE; ?></div>
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->ZIP; ?></div>
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->COUNTRY; ?></div>
          </td>
          <td height="10" style="height: 10px;color: #666666">
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->ADDRESSO_1; ?></div>
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->ADDRESSO_2; ?></div>
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->STATE; ?></div>
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->ZIP_ORDER; ?></div>
            <div style="text-align: left; margin-left: 15px;font-size: 12px;"><?php echo $data->COUNTRY_ORDER; ?></div>
          </td>
        </tr>
        <tr>
          <!-- Row Phone -->
          <td height="10" style="height: 10px;">
            <div style="text-align: left; margin-left: 15px; margin-top: 1em;font-size: 12px; color: #2db4d6;"><?php echo $data->EMAIL; ?></div>
            <div style="text-align: left; margin-left: 15px; margin-top: 1em;font-size: 12px;margin-bottom: 1em;color: #666666"><?php echo $data->PHONE; ?></div>
          </td>
          <td height="10" style="height: 10px;">
            <div style="text-align: left; margin-left: 15px; margin-top: 1em;font-size: 12px; color: #2db4d6;"><?php echo $data->MEMBER_EMAIL; ?></div>
            <div style="text-align: left; margin-left: 15px; margin-top: 1em;font-size: 12px; margin-bottom: 1em;color: #666666"><?php echo $data->MEMBER_PHONE; ?></div>
          </td>
        </tr>
      </table>
    <?php endforeach; ?>

    <hr>

    <center>
      <div style="font-weight: bold; font-size: 12px; margin-top: 1em;">
        ORDER DETAILS
      </div>
    </center>

    <?php
    //GET TOTAL PRODUCT ID
    $this->db->select('*');
    $this->db->from('g_order_detail');
    $this->db->where('ORDER_NO', $data->ORDER_NO);
    $query = $this->db->get();
    ?>

    <table style="margin-top: 1em;">
      <tr class="invoice-table-header" style="background-color: #f0f0f0;">
        <th width="900" style="text-align: left; padding: 4px;">
          <span style="margin-left: 10px;font-size: 12px;">Description</span>
        </th>
        <th width="400" style="text-align: right;">
          <span style="margin-left: 10px;font-size: 12px;">Price (IDR)</span>
        </th>
      </tr>
    </table>

    <?php
    $product_amount = 0;
    $totalPrice = 0;
    $a = 0;
    $counter = 1;
    $harga_awal = 0;

    foreach ($query->result() as $data) : ?>
      <?php
      $harga_awal = ($data->PRICE / $data->QUANTITY);
      ?>


      <table>
        <tr>
          <!-- Product Desc -->
          <td height="10" width="900" style="text-align: left; padding: 4px;">
            <div style="margin-top: 0.5em; font-size: 12px; color: #666666"><?php echo $data->PROD_NAME; ?></div>
            <div style="font-size: 12px; color: #2db4d6; font-weight: bold;"><?php echo $data->QUANTITY; ?></label> X <?php echo number_format($harga_awal, 2); ?></div>
          </td>
          <td height="10" width="400" style="text-align:right;padding: 4px;">
            <div style="font-size: 12px; color: #666666"><?php echo number_format($data->PRICE, 2); ?></div>
          </td>
        </tr>
      </table>

      <hr>

    <?php
      $counter++;
      //$product_amount=$product_amount+($data->FINAL_PRICE * $data->QUANTITY);

      $product_amount =  $product_amount + $data->PRICE;
      $totalPrice = $product_amount + $totalPostage;
      $a++;
    endforeach;

    ?>


    <table>

      <tr>
        <!-- Product Amount -->
        <td height="10" width="900">
          <div style="text-align: left; margin-top: 0.5em; font-size: 12px; color: #666666; ">Product Amount</div>
        </td>
        <td height="10" width="400">
          <div style="text-align: right;font-size: 12px; color: #666666"><?php echo number_format($product_amount, 2); ?></div>
        </td>
      </tr>

      <tr>
        <!-- Shipping Cost -->
        <td height="10" width="900">
          <div style="text-align: left; margin-top: 0.5em; font-size: 12px; color: #666666; ">Shipping Cost</div>
          <div style="text-align: left; font-size: 12px; color: #2db4d6">(Not include shipping cost to outside Jakarta)</div>
        </td>
        <td height="10" width="400">
          <div style="text-align: right;  font-size: 12px; color: #666666"><?php echo number_format($totalPostage, 2); ?></div>
        </td>
      </tr>

      <!-- <tr>
        <td height="10" width="900">
          <hr>
        </td>
      </tr> -->

      <tr>
        <!-- Total -->
        <td height="10" width="900">
          <div style="text-align: left; margin-top: 0.5em; font-size: 14px;color: #2db4d6; font-weight: bold; ">Total Cost</div>
        </td>
        <td height="10" width="400">
          <div style="text-align: right; margin-top: 0.5em; font-size: 14px;color: #2db4d6; font-weight: bold;">IDR <?php echo number_format($totalPrice, 2); ?></div>
        </td>
      </tr>

    </table>

    <center>
      <div class="card-header" style="margin-top: 1em;margin-bottom:1em;background-color: #ffedc4;border: 1px solid #f0c465; color: #666666;padding-top: 2em;padding-bottom: 2em; font-size: 12px;">
        Be sure not to inform evidence and payment data to any party except Etalashop
      </div>
    </center>

    <hr>

    <div style="color: #666666;font-size: 12px;margin-top: 1em;">
      Email is generated automatically. Please do not send replies to this email.
    </div>

    <input type="hidden" id="txt_quantity_<?php echo $a; ?>" value="<?php echo $data->QUANTITY; ?>">
    <input type="hidden" name="loop-counter" value="<?php echo $counter; ?>">

    </div>
  </body>

  <script type="text/javascript">
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