   <!-- ORDER PART -->
   <div id="wrapper">

     <!-- Sidebar -->
     <?php $this->load->view('templates-cms/frame_side'); ?>
     <div id="content-wrapper">



       <div class="container-fluid">

         <!-- DataTables Example -->

         <div class="card mb-3">

           <div class="card-header">

             <i class="fas fa-clipboard-list"></i>

             <b>Order Management</b>

           </div>

           <div class="card-body">

             <label style="margin-bottom: 0.5em;">Search by Status :</label><br>

             <?php

              if ($this->input->get('query') == 'all') :

              ?>

               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=all'); ?>">

                 <button class="btn btn-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">ALL</button>

               </a>

             <?php else : ?>

               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=all'); ?>">

                 <button class="btn btn-outline-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">ALL</button>

               </a>

             <?php endif; ?>



             <?php

              foreach ($new_order->result() as $total_new_order);

              ?>

             <?php

              if ($this->input->get('query') == 'new') :

              ?>

               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=new'); ?>">

                 <button class="btn btn-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">NEW ORDER (<?php echo $total_new_order->new_order; ?>)</button>

               </a>

             <?php else : ?>

               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=new'); ?>">

                 <button class="btn btn-outline-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">NEW ORDER (<?php echo $total_new_order->new_order; ?>)</button>

               </a>

             <?php endif; ?>



             <?php
              foreach ($updated_order->result() as $total_updated_order);
              ?>

             <?php
              if ($this->input->get('query') == 'updated') :
              ?>

               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=updated'); ?>">
                 <button class="btn btn-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">UPDATED (<?php echo $total_updated_order->updated_order; ?>)</button>
               </a>

             <?php else : ?>
               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=updated'); ?>">
                 <button class="btn btn-outline-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">UPDATED (<?php echo $total_updated_order->updated_order; ?>)</button>
               </a>
             <?php endif; ?>



             <?php
              foreach ($confirmed_order->result() as $total_confirmed_order);
              ?>

             <?php
              if ($this->input->get('query') == 'confirmed') :
              ?>
               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=confirmed'); ?>">
                 <button class="btn btn-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">CONFIRMED (<?php echo $total_confirmed_order->confirmed_order; ?>)</button>
               </a>
             <?php else : ?>
               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=confirmed'); ?>">
                 <button class="btn btn-outline-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">CONFIRMED (<?php echo $total_confirmed_order->confirmed_order; ?>)</button>
               </a>
             <?php endif; ?>



             <?php
              foreach ($paid_order->result() as $total_paid_order);
              ?>

             <?php
              if ($this->input->get('query') == 'paid') :
              ?>
               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=paid'); ?>">
                 <button class="btn btn-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">PAID (<?php echo $total_paid_order->paid_order; ?>)</button>
               </a>
             <?php else : ?>
               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=paid'); ?>">
                 <button class="btn btn-outline-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">PAID (<?php echo $total_paid_order->paid_order; ?>)</button>
               </a>
             <?php endif; ?>



             <?php
              if ($this->input->get('query') == 'canceled') :
              ?>
               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=canceled'); ?>">
                 <button class="btn btn-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">CANCELED</button>
               </a>
             <?php else : ?>
               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=canceled'); ?>">
                 <button class="btn btn-outline-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">CANCELED</button>
               </a>
             <?php endif; ?>



             <?php
              if ($this->input->get('query') == 'done') :
              ?>
               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=done'); ?>">
                 <button class="btn btn-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">DONE</button>
               </a>

             <?php else : ?>
               <a style="text-decoration: none!important;" href="<?php echo base_url('cms/orders/status?query=done'); ?>">
                 <button class="btn btn-outline-info" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 12%;">DONE</button>
               </a>
             <?php endif; ?>



             <div class="table-responsive" style="margin-top: 1em;">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px">
                 <thead>
                   <tr>
                     <th width="5%">No</th>
                     <th width="20%">Order Info</th>
                     <th width="30%">Shipping Info</th>
                     <th width="35%">Order Value</th>
                     <th width="10%">Action</th>
                   </tr>
                 </thead>

                 <tbody>
                   <?php
                    $no = 1;

                    foreach ($content->result() as $dt) {

                      /*------------------------------------------------ MEMBER INFO*/
                      $id = $dt->ID;
                      $fname = $dt->FIRST_NAME;
                      $lname = $dt->LAST_NAME;
                      $phone = $dt->PHONE;
                      $address = $dt->ADDRESS;
                      $address2 = $dt->ADDRESS_2;
                      $province = $dt->PROVINCE;
                      $country = $dt->COUNTRY;
                      $zip = $dt->ZIP;
                      $email = $dt->EMAIL;
                      $flag = $dt->FLAG;
                      $view_flag = $dt->VIEW_FLAG;

                      /*------------------------------------------------ ORDER INFO*/
                      $order_n = $dt->ORDER_NO;
                      $order_d = $dt->ORDER_DATE;
                      $status_o = $dt->STATUS_ORDER;
                      $spc_instruction = $dt->SPC_INSTRUCTION;
                      $internal_notes = $dt->INTERNAL_NOTES;

                      /*------------------------------------------------ ORDER VALUE*/
                      $total_p = $dt->TOTAL_POSTAGE;
                      $amount = $dt->AMOUNT;
                      $updated = $dt->UPDATED;

                      /*------------------------------------------------ VIEW CUSTOMER INFO*/

                      $cus_name = $dt->MEMBER_NAME;
                      $addresso1 = $dt->ADDRESSO_1;
                      $addresso2 = $dt->ADDRESSO_2;
                      $state = $dt->STATE;
                      $zip_order = $dt->ZIP_ORDER;
                      $country_order = $dt->COUNTRY_ORDER;
                      $member_phone = $dt->MEMBER_PHONE;
                      $member_email = $dt->MEMBER_EMAIL;

                      echo "<tr>"; ?>

                     <?php if ($view_flag == 0) { ?>
                       <td id="order_<?php echo $no; ?>" style="background: linear-gradient(to top left, #ffffff 80%, #2dd6a7 100%);">
                         <?php echo $no; ?>
                       </td>
                     <?php } else { ?>
                       <td id="order_<?php echo $no; ?>">
                         <?php echo $no; ?>
                       </td>
                     <?php } ?>

                     <td>

                       <p style='line-height:20px;'>
                         <!-- <b>Order No<span style="margin-left: 35px;">:</b></span><b style="color: #fcdb03;">&nbsp<?php echo $amount; ?></b><br><br> -->
                         <b>Order No<span style="margin-left: 2em;">:</b><br></span><b style="color: #2db4d6">&nbsp<?php echo $order_n; ?></b><br><br>
                         <b>Order Date<span style="margin-left: 1.1em;">:</b><br></span><b style="color: #2db4d6">&nbsp<?php echo $order_d; ?></b><br><br>
                         <b style="color: #1f8a17;"><?php echo $status_o; ?></b> <br>


                         <?php

                          if ($status_o !== 'NEW ORDER') : ?>
                           <a style="text-decoration: none!important;" href="<?php echo base_url('Orders_cms/invoice?id=' . $order_n); ?>">
                             <button type="button" data-id="<?php echo $order_n; ?>" style="font-size: 12px; color: white; width: 50%;" class="btn btn-warning btn-invoice">Send Invoice</button>
                             <?php
                              if ($flag == 1) : ?>
                               <i class="fas fa-clipboard-check" style="color: #00b011; font-size: 20px;"></i>
                               <label style="color: #00b011; font-size: 12px;">Invoice Sent!</label>
                             <?php endif; ?><br>
                           </a>
                         <?php endif; ?>

                         <?php
                          if ($status_o !== 'NEW ORDER' && $status_o !== 'UPDATED') : ?>
                           <button type="button" style="font-size: 12px; margin-top: 0.5em; width: 50%;" class="btn btn-success" data-toggle="modal" data-orderno="<?php echo $order_n; ?>" data-target="#exampleModal2">Check Payment</button>
                         <?php endif; ?>
                       </p>
                     </td>

                     <td>

                       <p style='line-height:20px;'>
                         <b><?php echo $cus_name; ?></b><br><br>
                         <?php echo $addresso1; ?><br>
                         <?php echo $addresso2; ?><br>
                         <?php echo $state; ?> - <?php echo $zip_order; ?><br>
                         <?php echo $country_order; ?><br><br>
                         <b style="color: #2db4d6;"><?php echo $member_phone; ?></b><br><br>
                         <b style="color: #2db4d6;"><?php echo $member_email; ?></b><br><br>
                       </p>
                     </td>

                     <td>

                       <div style="font-weight: bold;">
                         (Total Product)
                       </div>
                       <br>

                       <div class="row">
                         <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5' style="font-weight: bold;">Product </div>
                         <div class='col-lg-7 col-md-7 col-sm-7 col-xs-7' style="font-weight: bold;color:#2db4d6;text-align: right;"> <?php echo number_format($amount, 2); ?></div>
                       </div>

                       <div class="row">
                         <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' style="font-weight: bold;"> Shipping Cost </div>
                         <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' style="font-weight: bold;color:#2db4d6;text-align: right;"> <?php echo number_format($total_p, 2); ?> </div>
                       </div>

                       <hr style="border :2px solid; width: 6em;" align="right">

                       <div class="row">
                         <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' style="font-weight: bold;"> Total </div>
                         <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8' style="font-weight: bold;color:#2db4d6;text-align: right;"> <?php echo number_format($amount + $total_p, 2); ?> </div>
                       </div>

                       <div class="row" style="margin-top: 2em;">
                         <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' style="font-weight: bold;color:#2db4d6;"> Last Edit By Admin</div>
                         <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' style="font-weight: bold;color:#2db4d6;text-align: right;"> <?php echo $updated; ?> </div>
                       </div>
                     </td>

                     <td>
                       <!-- Trigger the modal with a button -->
                       <button type="button" style="width: 6em;font-size: 12px;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal" data-orderno="<?php echo $order_n; ?>" data-rowid="order_<?php echo $no; ?>">VIEW</button>
                       <button data-orderno="<?php echo $order_n; ?>" class="buttonDelete btn btn-danger btn-sm" style="width: 6em;font-size: 12px;margin-top: 0.5em;" type="button">DELETE</button>
                     </td>

                   <?php
                      echo "</tr>";
                      $no++;
                    }
                    ?>
                 </tbody>
               </table>
             </div>
           </div>
           <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
         </div>
         <!-- END ORDER PART -->

         <!-- Modal View-->
         <div id="exampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg">
             <div class="modal-content">
               <div class="modal-body" style="padding: 0!important;">
                 <!-- LOAD THE CONTENT -->
               </div>
             </div>
           </div>
         </div>



         <!-- Modal Check Payment-->
         <div id="exampleModal2" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-md">
             <div class="modal-content">
               <div class="modal-body" style="padding: 0!important;">
                 <!-- LOAD THE CONTENT -->
               </div>
             </div>
           </div>
         </div>

       </div>
       <!-- /.container-fluid -->



       <!-- Sticky Footer -->
       <footer class="sticky-footer">
         <div class="container my-auto">
           <div class="copyright text-center my-auto">
             <span>Copyright © Incube Solutions 2019</span>
           </div>
         </div>
       </footer>

     </div>
     <!-- /.content-wrapper -->
   </div>

   <!-- /#wrapper -->


   <!-- Bootstrap core JavaScript-->
   <script src="<?php echo base_url('assets/cms/jquery/jquery.min.js'); ?>"></script>
   <script src="<?php echo base_url('assets/bootstrap-4/js/bootstrap.bundle.min.js'); ?>"></script>


   <!-- Core plugin JavaScript-->
   <script src="<?php echo base_url('assets/cms/jquery-easing/jquery.easing.min.js'); ?>"></script>


   <!-- Page level plugin JavaScript-->
   <script src="<?php echo base_url('assets/cms/chart.js/Chart.min.js'); ?>"></script>
   <script src="<?php echo base_url('assets/cms/datatables/jquery.dataTables.js'); ?>"></script>
   <script src="<?php echo base_url('assets/cms/datatables/dataTables.bootstrap4.js'); ?>"></script>

   <!-- Custom scripts for all pages-->
   <script src="<?php echo base_url('assets/cms/js/sb-admin.min.js'); ?>"></script>

   <!-- Demo scripts for this page-->
   <script src="<?php echo base_url('assets/cms/js/demo/datatables-demo.js'); ?>"></script>
   <script src="<?php echo base_url('assets/cms/js/demo/chart-area-demo.js'); ?>"></script>

   <script src="<?php echo base_url('assets/incube-assets/baseUrl.1.0.js'); ?>"></script>
   <script src="<?php echo base_url('assets/incube-assets/orderManagement.1.0.js'); ?>"></script>

   </body>