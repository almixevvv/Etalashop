<style>
    a {
        cursor: pointer;
    }

    #paymentModal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, .8) url('../assets/images/loader.gif') 50% 50% no-repeat;
    }

    body.loading #paymentModal {
        overflow: hidden;
    }

    body.loading #paymentModal {
        display: block;
    }
</style>


<div class="trans-container">

    <div class="trans-inner-container">

        <?php

        //Counter Variable to diferentiate each form id
        $counter = 1;

        ?>

        <!-- FILTER BUTTON -->
        <div class="row" id="trans-filter-separator-desktop">

            <div class="trans-filter-container-left">
                <span>Search by Status:</span>
            </div>

            <div class="trans-filter-container-right" id="trans-scrollbar">

                <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'created' ? '-active' : ''); ?>">
                    <a href="<?php echo ($this->input->get('transaction') == 'created' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=created')); ?>">
                        <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'created' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Created</span>
                    </a>
                </div>

                <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'updated' ? '-active' : ''); ?>">
                    <a href="<?php echo ($this->input->get('transaction') == 'updated' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=updated')); ?>">
                        <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'updated' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Updated</span>
                    </a>
                </div>

                <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'confirmed' ? '-active' : ''); ?>">
                    <a href="<?php echo ($this->input->get('transaction') == 'confirmed' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=confirmed')); ?>">
                        <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'confirmed' ? 'trans-filter-active' : 'main-color'); ?>">Confirm Payment</span>
                    </a>
                </div>


                <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'paid' ? '-active' : ''); ?>">
                    <a href="<?php echo ($this->input->get('transaction') == 'paid' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=paid')); ?>">
                        <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'paid' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Paid</span>
                    </a>
                </div>


                <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'canceled' ? '-active' : ''); ?>">
                    <a href="<?php echo ($this->input->get('transaction') == 'canceled' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=canceled')); ?>">
                        <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'paid' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Canceled</span>
                    </a>
                </div>


                <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'done' ? '-active' : ''); ?>">
                    <a href="<?php echo ($this->input->get('transaction') == 'done' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=done')); ?>">
                        <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'done' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Done</span>
                    </a>
                </div>

            </div>

        </div>
        <!-- END OF FILTER BUTTON -->

        <!-- FILTER BUTTON MOBILE -->
        <div class="row" id="trans-filter-separator-mobile">

            <div class="row">
                <div class="col-12 pl-1 pr-1">
                    <span>Search by Status:</span>
                </div>
            </div>

            <div class="row" style="width: 99%;">
                <div class="col-12 pl-1 pr-1 pt-2" id="trans-scrollbar">

                    <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'created' ? '-active' : ''); ?>">
                        <a href="<?php echo ($this->input->get('transaction') == 'created' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=created')); ?>">
                            <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'created' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Created</span>
                        </a>
                    </div>

                    <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'updated' ? '-active' : ''); ?>">
                        <a href="<?php echo ($this->input->get('transaction') == 'updated' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=updated')); ?>">
                            <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'updated' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Updated</span>
                        </a>
                    </div>

                    <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'confirmed' ? '-active' : ''); ?>">
                        <a href="<?php echo ($this->input->get('transaction') == 'confirmed' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=confirmed')); ?>">
                            <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'confirmed' ? 'trans-filter-active' : 'main-color'); ?>">Confirm Payment</span>
                        </a>
                    </div>


                    <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'paid' ? '-active' : ''); ?>">
                        <a href="<?php echo ($this->input->get('transaction') == 'paid' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=paid')); ?>">
                            <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'paid' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Paid</span>
                        </a>
                    </div>


                    <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'canceled' ? '-active' : ''); ?>">
                        <a href="<?php echo ($this->input->get('transaction') == 'canceled' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=canceled')); ?>">
                            <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'paid' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Canceled</span>
                        </a>
                    </div>


                    <div class="trans-filter-button<?php echo ($this->input->get('transaction') == 'done' ? '-active' : ''); ?>">
                        <a href="<?php echo ($this->input->get('transaction') == 'done' ? base_url('profile/transaction') : base_url('profile/transaction?transaction=done')); ?>">
                            <span class="text-uppercase <?php echo ($this->input->get('transaction') == 'done' ? 'trans-filter-active' : 'main-color'); ?>">Inquiry Done</span>
                        </a>
                    </div>

                </div>

            </div>

        </div>

        <!-- END OF FILTER BUTTON MOBILE -->
        <?php if ($masterData->num_rows() == 0) { ?>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <span>
                            <h3 class="pt-2 pt-md-4 pt-lg-4 pt-xl-4 pb-2 pb-md-4 pb-lg-4 pb-xl-4 text-uppercase " style="color: rgba(49,53,59,.44);">No Order History</h3>
                        </span>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <?php foreach ($masterData->result() as $master) { ?>
                <!-- MAIN TRANSACTION -->
                <div class="trans-main-container">

                    <div class="row container-border-main">
                        <div class="col-12">

                            <!-- TRANS DATE -->
                            <div class="row container-border-date">
                                <div class="col-12 col-md-5 col-lg-5 col-xl-5 pb-1 pb-md-1 pb-lg-1 pb-xl-1">
                                    <span><?php echo $master->ORDER_DATE; ?></span>
                                </div>
                            </div>
                            <!-- END OF TRANS DATE -->

                            <!-- MAIN TRANS PART -->
                            <div class="row container-border-order-number">

                                <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order">
                                    <div class="row">
                                        <div class="col-12">
                                            <span>ORDER NUMBER</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="main-color font-weight-bold"><?php echo $master->ORDER_NO; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order">
                                    <div class="row">
                                        <div class="col-12">
                                            <span>ORDER STATUS</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="main-color font-weight-bold"><?php echo $master->STATUS_ORDER; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-2 mt-md-2 mt-lg-2 mt-xl-2 container-border-order-last">
                                    <div class="row">
                                        <div class="col-12">
                                            <span>TRANSACTION TOTAL</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="main-color font-weight-bold">IDR <?php echo number_format($master->AMOUNT + $master->TOTAL_POSTAGE, 2, '.', ','); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <span>SHIPPING COST</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="main-color font-weight-bold">IDR <?php echo number_format($master->TOTAL_POSTAGE, 2, '.', ','); ?></span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php

                            $userHistory = $this->profile->getOrderDetails($master->ORDER_NO);

                            foreach ($userHistory->result() as $history) {
                            ?>
                                <div class="row container-border-order-number pt-0 pt-md-2 pt-lg-2 pt-xl-2">

                                    <div class="col-12 col-md-8 col-lg-8 col-xl-8 container-border-order">

                                        <div class="row">

                                            <div class="col-4 col-md-3 col-lg-3 col-xl-2 mt-2 mt-md-2 mt-lg-2 mt-xl-2">
                                                <a href="<?php echo base_url() . 'product_detail?id=' . $history->PRODUCT_ID; ?>">

                                                    <img src="<?php echo $history->PRODUCT_IMAGE; ?>" alt="<?php echo $history->PRODUCT_NAME; ?>" onerror="this.onerror=null;this.src=' . '\'' . base_url('assets/images/no-image-icon.png') . ' \'' . '" class="transaction-image">

                                                </a>
                                            </div>

                                            <div class="col-8 col-md-9 col-lg-9 col-xl-9 mt-2 mt-md-2 mt-lg-2 mt-xl-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="<?php echo base_url('product_detail?id=' . $history->PRODUCT_ID); ?>">
                                                            <span class="text-capitalize" style="color: #212529;">
                                                                <?php echo ucwords(mb_strimwidth($history->PRODUCT_NAME, 0, 100, "...")); ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="row pt-2">
                                                    <div class="col-6">
                                                        <span class="main-color font-weight-bold">
                                                            IDR <?php echo number_format($history->PRODUCT_FINAL_PRICE, 2, '.', ','); ?>
                                                        </span>
                                                    </div>

                                                    <div class="col-6">
                                                        <span class="main-color">
                                                            <?php echo number_format($history->PRODUCT_QUANTITY) . ' pc'; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-3 mt-md-2 mt-lg-2 mt-xl-2">

                                        <div class="row">

                                            <div class="col-12">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <span>TOTAL PRICE</span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="main-color font-weight-bold">
                                                            IDR <?php echo number_format($history->PRODUCT_FINAL_PRICE * $history->PRODUCT_QUANTITY, 2, '.', '.'); ?>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-12">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <span>INQUIRY</span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <?php if ($history->PRODUCT_NOTES == null) { ?>
                                                            <span class="main-color font-weight-bold"> - </span>
                                                        <?php } else { ?>
                                                            <span class="main-color font-weight-bold"><?php echo $history->PRODUCT_NOTES; ?></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            <?php } ?>

                            <div class="row mt-1 mt-md-1 mt-lg-1 mt-xl-1">

                                <div class="trans-container-footer-left">
                                    <a href="#" data-transaction="<?php echo $master->ORDER_NO; ?>" data-sender="<?php echo $this->session->userdata('USERID'); ?>" data-toggle="modal" data-target="#messageModal" style="color: black;">
                                        <span><i class="fas fa-comments pr-2"></i> Send Message</span>
                                    </a>
                                </div>

                                <div class="trans-container-footer-right">
                                    <span><i class="fas fa-clipboard-list pr-2"></i> Order Detail</span>
                                </div>

                                <?php
                                //DONT'S SHOW THE PAYMENT BUTTON IF THE STATUS IS NEW ORDER AND UPDATED
                                if ($master->STATUS_ORDER == 'UPDATED') {

                                    $attributes = array('id' => 'myform' . $counter);
                                    echo form_open('order/payment', $attributes);

                                    //GENERATE RANDOM NUMBER TO HELP CONFIRM THE TRANSFER
                                    $transID = rand(100, 1000);
                                ?>
                                    <div class="trans-container-footer-payment">
                                        <a class="proc-payment" data-ordertotal="<?php echo $master->AMOUNT + $master->TOTAL_POSTAGE; ?>" data-orderid="<?php echo $master->ORDER_NO; ?>" data-toggle="modal" data-target="#paymentOptions" style="color: black;">
                                            <span><i class="fas fa-money-check-alt"></i> Order Payment</span>
                                        </a>
                                    </div>

                                <?php } ?>

                                <!-- SHOW IF THE STATUS IS CONFIRMED -->
                                <?php if ($master->STATUS_ORDER == 'PAID') { ?>
                                    <div class="trans-container-footer-receive">
                                        <a href="#" class="receive-button" data-id="<?php echo $master->ORDER_NO; ?>" style="color: black;">
                                            <span><i class="far fa-check-square pr-2"></i> Receive Order</span>
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                            <!-- END OF MAIN TRANS PART -->

                        </div>
                    </div>
                </div>
                <!-- END OF MAIN TRANSACTION -->
                <?php $counter++; ?>
            <?php } ?>
        <?php } ?>

    </div>

</div>

<!-- MODAL PART -->
<div class="modal fade" id="messageModal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

            </div>

            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <div class="d-flex flex-row">
                        <button type="button" class="btn btn-kku mt-0 mr-3" id="submitMessages" style="width: 100%;">Send Message</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="paymentOptions" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end pr-4 pt-2 pb-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="card w-100">
                            <div class="card-body mx-auto p-2">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-title text-center">Manual Payment (Bank Transfer)</h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-center">
                                            <span style="font-size: 3em; color: Tomato;">
                                                <i class="fas fa-money-check-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="card-text text-center">Start your payment using manual bank transfer, and upload your proof of payment</p>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <center>
                                            <a href="#" class="btn btn-primary start-manual-pay">Start Payment</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card w-100">
                            <div class="card-body mx-auto p-2">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-title text-center">Automatic Payment</h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-center">
                                            <span style="font-size: 3em; color: Tomato;">
                                                <img src="https://midtrans.com/assets/images/logo-midtrans-color.svg" alt="Mid Trans Logo">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="card-text text-center">Start your payment automatically for faster process without any hassle</p>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <center>
                                            <a href="#" class="btn btn-primary start-auto-pay">Start Payment</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF MODAL PART -->

<script type="text/javascript">
    // $('#paymentOption').on('show.bs.modal', function(e) {
    //   alert('kebuka');
    //   // $('.start-auto-pay').data('orderID', id);
    // });

    $('.proc-payment').click(function(resp) {
        let id = $(this).data('orderid');
        $('.start-auto-pay').attr('data-orderid', id);
    });

    $('.start-auto-pay').click(function(resp) {

        let id = $(this).data('orderid');

        snap.show();

        $.post(baseUrl + 'API/startPayment', {
            orderID: id,
            key: 'c549303dcef12a687e9077a21e1a51fb67851efb'
        }, function(resp) {
            console.log(resp);

            if (resp.status == 'error') {
                snap.hide();
            } else {
                snap.pay(resp.message.token, {
                    onSuccess: function(result) {
                        // console.log('success');
                        // console.log(result);
                        $.post(baseUrl + 'API/finishPayment', {
                            data: result,
                            key: 'c549303dcef12a687e9077a21e1a51fb67851efb'
                        }, function(resp) {
                            console.log(resp);
                        });
                    },
                    onPending: function(result) {
                        console.log('pending');
                        console.log(result);
                    },
                    onError: function(result) {
                        console.log('error');
                        console.log(result);
                    },
                    onClose: function() {
                        console.log('customer closed the popup without finishing the payment');
                    }
                });
            }
        });


    });



    /* SET THE CURRENT ORDER STATUS TO FINISHED */
    $('.receive-button').on('click', function() {
        var id = $(this).attr("data-id");
        swal.fire({
            title: "Receive Order",
            text: "Are you sure you want to finish this order?",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: "Confirm",
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                console.log('clicked');
                console.log(id);
                $.post(baseUrl + 'General/Profile/finishOrder', {
                    id: id
                }, function(resp) {
                    console.log(resp);
                });
            }
        });
    });

    /* LOAD THE MODAL DYNAMICALY AND SCROLL TO THE LAST MESSAGE */
    $('#messageModal').on('show.bs.modal', function(e) {

        //Get the trigger data
        var button = $(e.relatedTarget);
        var recipient = button.data('transaction');

        //Create the URL for Controller
        var url = baseUrl + 'General/Profile/getMessages?id=' + recipient;

        $('.modal-body').load(url, function() {
            $(".message-holder").animate({
                scrollTop: $('.message-holder').prop("scrollHeight")
            }, 1000);
            $('#messageModal').modal({
                show: true
            });
        });

    });


    /* SEND THE MESSAGE */
    $('#submitMessages').on('click', function(e) {

        var message = $("#sender-messages").val();
        var transactionID = $("#hidden-id").val();
        var sender = 'CUSTOMER';

        $.get(baseUrl + 'General/Profile/customerSendMessages', {
            sender: sender,
            id: transactionID,
            message: message
        }, function(resp) {
            var url = baseUrl + 'General/Profile/getMessages?id=' + transactionID;

            $('.modal-body').load(url, function() {
                $('#messageModal').modal({
                    show: true
                });
                $(".message-holder").animate({
                    scrollTop: $('.message-holder').prop("scrollHeight")
                }, 1000);
            });
        })

    });
</script>