<?php
//INITIAL COUNTER  
$subtotal 	= 0;
$subqty 	= 0;
$weightTotal = 0;
$subWeight = 0;
?>

<div class="cart-container">
	<div class="row d-none d-md-block d-lg-block d-xl-block">
		<!-- CART BREADCRUMB -->
		<div class="col-12 col-md-12 col-lg-12 col-xl-12">
			<div class="mb-0 mb-md-3 mb-lg-3 mb-xl-3 pt-0 pt-md-2 pt-lg-2 pt-xl-2 pl-0 pl-md-1 pl-lg-4 pl-xl-4" style="text-align: left;">
				<span style="color: #333;">
					<a href="<?php echo base_url(); ?>" style="color: black;">
						<span class="fa fa-home"></span> Home
					</a>
				</span>
				<span style="color: #333;"> -
					Shopping Cart
				</span>
			</div>
		</div>
		<!-- END OF CART BREADCRUMB -->
	</div>

	<div class="row pl-3 pl-md-0 pl-lg-0 pl-xl-0 pr-3 pr-md-0 pr-lg-0 pr-xl-0">
		<!-- TOTAL CART -->
		<div class="col-12 col-12 pl-0 pl-md-4 pl-lg-4 pl-xl-4" id="cart-label-separator">
			<label class="cart-header-label pl-0 pl-md-0 pl-lg-4 pl-xl-4"><?= $row; ?> Item(s) in the Cart</label>
		</div>
		<!-- END OF TOTAL CART -->
	</div>

	<!-- TITLE MY CART -->

	<div class="row">
		<div class="col-md-7">
			<div class="row d-none d-md-block d-lg-block d-xl-block">
				<div class="col-md-12 col-lg-12 col-xl-12">
					<div class="row" id="cart-header-border">
						<div class="col-6 col-md-6">
							<div class="d-flex justify-content-center">Product Detail</div>
						</div>
						<div class="col-3 col-md-3">
							<div class="d-flex justify-content-center">Estimated Price</div>
						</div>
						<div class="col-1 col-md-1">
							<div class="d-flex justify-content-center">Qty</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<form method="POST" action="<?= base_url('General/Checkout/checkoutProcess') ?>">

					<?php
					$i = 0;
					if ($row == 0) { ?>
						<div class="col-12 col-md-12 col-lg-12 col-xl-12">
							<div class="no-item-list"> NO ITEM IN CART </div>
						</div>
					<?php } else { ?>
						<?php foreach ($items->result() as $key) {
							$price = $key->PRODUCT_PRICE;
							$weight = $key->WEIGHT; ?>
							<div class="row d-none d-md-block d-lg-block d-xl-block" id="rowcart_<?= $key->PRODUCT_ID; ?>">
								<div class="col-12 mt-4  mt-lg-4 mt-xl-4 mb-4 mb-md-4 mb-lg-4 mb-xl-4">
									<div class="row pb-4 cart-product-separator">
										<!-- PRODUCT DETAIL PART -->
										<div class="col-6 col-md-6">
											<div class="row">
												<div class="col-4">
													<a href="<?php echo base_url('product_detail?id=' . $key->PRODUCT_ID) ?>">
														<img class="img-list-order" src="<?php echo base_url() . "assets/uploads/products/" . $key->IMAGES1; ?>" style="width: 100px;" />
													</a>

												</div>

												<div class="col-8 pl-0">
													<div class="d-flex flex-column">
														<div class="mb-1 text-capitalize">
															<!-- <span class="font-weight-bold" style="font-size: 15px;">Product Name:</span> <br> -->
															<a href="<?php echo base_url('product_detail?id=' . $key->PRODUCT_ID); ?>" style="color: #212529; font-size: 15px;"><?php echo $key->PRODUCT_NAME; ?></a>
															<input type="hidden" name="txt-name" value="<?php echo  $key->PRODUCT_NAME ?>">
														</div>
														<div class="text-capitalize">
															<!-- <span class="font-weight-bold">Inquiry:</span> -->
															<textarea class="form-control mt-2" name="customer-notes-<?php echo $i; ?>" style="background-color: #eee; width: 100%; height:50px; font-size: 12px;"><?php echo $key->PRODUCT_NOTES; ?></textarea>
															<input type="hidden" name="txt-name" value="<?php echo  $key->PRODUCT_NOTES; ?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- END OF PRODUCT DETAIL PART -->


										<!-- ESTIMATED PRICE SECTION -->
										<div class="col-3 col-md-3">
											<div class="row">
												<div class="col-12">

													<!-- IF THE PRICE IS NEGOTIABLE -->
													<?php if ($key->PRODUCT_PRICE <= 0) { ?>
														<div class="d-flex justify-content-center">
															<span>Price Negotiable</span>
														</div>
														<?php $currentPrice['price'] = 0; ?>

														<!-- CHECK IF THE SDIPRICELIST IS EMPTY -->
													<?php } else {
														$pricing['price'] = $key->PRODUCT_PRICE;
														$pricing['startingQuantity'] = $key->PRODUCT_QUANTITY;
														$pricing['endingQUantity'] = $key->PRODUCT_QUANTITY;
													?>

														<div class="d-flex justify-content-center">
															<span>IDR <?php echo number_format($pricing['price'], 2, '.', ','); ?></span>
														</div>
													<? } ?>
													<!-- IF THE PRICELIST IS NOT EMPTY, CHECK FOR CORRECT VALUE -->

												</div>
											</div>
										</div>
										<!-- END OF ESTIMATED PRICE SECTION -->

									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</form>
			</div>
		</div>
		<div class="col-md-5">

		</div>
	</div>
</div>

<script type="text/javascript">
	$('.delete-item').on('click', function() {

		var id = $(this).attr("data-id");
		var email = $(this).attr('data-buyer');

		swal.fire({
			title: "Remove Product",
			text: "Are you sure you want to remove this product from your cart?",
			type: "warning",
			showCancelButton: true,
			cancelButtonColor: '#d33',
			confirmButtonText: "Confirm",
			confirmButtonColor: '#3085d6'
		}).then((result) => {
			if (result.value) {

				$.get(baseUrl + 'General/Cart/removeCartItem', {
					rowid: id,
					buyer: email
				}, function(resp) {
					var divID = '#rowcart_' + id;
					$("#rowcart_" + id).animate({
						left: '+=100em',
						opacity: '0.5'
					}, 1000, function() {
						$("#rowcart_" + id).remove();
					});
				}).done(function(resp) {
					swa.fire({
						title: "Deleted!",
						text: "Selected product has been removed",
						type: "success",
						showCancelButton: true
					}).then((result) => {
						if (result.value) {
							location.reload();
						}
					})
				});
			}
		});
	});
</script>