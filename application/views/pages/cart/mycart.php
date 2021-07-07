<div class="cart-container">

	<form method="POST" action="<?= base_url('General/Checkout/checkoutProcess') ?>">
		<div class="row  d-md-block d-lg-block d-xl-block">
			<!-- CART BREADCRUMB -->
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="mb-0 mb-md-3 mb-lg-3 mb-xl-3 pt-0 pt-md-2 pt-lg-2 pt-xl-2 pl-0 pl-md-1 pl-lg-4 pl-xl-4" style="text-align: left;">
					<span style="color: #333;">
						<a href="<?php echo base_url(); ?>" style="color: black;">
							<span class="fa fa-home mr-1"></span> Home
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
			<div class="col-12 pl-0 pl-md-4 pl-lg-4 pl-xl-4" id="cart-label-separator">
				<label class="cart-header-label pl-0 pl-md-0 pl-lg-4 pl-xl-4"><?= $row ?> Item(s) in the Cart</label>
			</div>
			<!-- END OF TOTAL CART -->
		</div>

		<!-- DEKSTOP -->
		<div class="row px-4 pt-0 px-md-4 pt-md-3">
			<div class="col-12 col-md-7">

				<!-- Cart Title -->
				<div class="row d-none d-md-block d-lg-block d-xl-block">
					<div class="col-md-12 col-lg-12 col-sm-12 col-xl-12">
						<div class="row" id="cart-header-border">
							<div class="col-6 col-md-6 col-sm-6">
								<div class="d-flex justify-content-center">Product Detail</div>
							</div>
							<div class="col-3 col-md-3 col-sm-3">
								<div class="d-flex justify-content-center">Estimated Price</div>
							</div>
							<div class="col-1 col-md-1 col-sm-1">
								<div class="d-flex justify-content-center">Qty</div>
							</div>
						</div>
					</div>
				</div>
				<!-- EoL Cart Title Section -->

				<div class="row">
					<?php if ($row == 0) { ?>
						<div class="col-12 col-md-12 col-lg-12 col-xl-12">
							<div class="no-item-list"> NO ITEM IN CART </div>
						</div>
					<?php } else { ?>

						<?php foreach ($items->result() as $key) {

							$price 							= $key->PRODUCT_PRICE;
							$weight 						= $key->WEIGHT;

							$priceWeight 					= WEIGHT_PRICE;

							//SHOPPING CART PRICE CALCULATION
							$subtotal 						= $subtotal + $price;
							$subqty   						= $subqty + $key->PRODUCT_QUANTITY;

							// WEIGHT CALCULATION
							$subWeight     					= $subWeight + $weight;
							$weightTotal 					= $subWeight * $key->PRODUCT_QUANTITY;
							$priceWeightTotal 				= $priceWeight * $weightTotal;

							$totalPrice 					= $priceWeightTotal + $subtotal;
							$pricing['price'] 				= $key->PRODUCT_PRICE;
						?>

							<!-- Cart items loop -->
							<div class="row" id="rowcart_<?php echo $key->PRODUCT_ID; ?>">

								<div class="col-md-12 mt-4  mt-lg-4 mt-xl-4 mb-4 mb-md-4 mb-lg-4 mb-xl-4">
									<div class="row pb-4 cart-product-separator">

										<!-- Product details -->
										<div class="col-md-6 col-sm-6">
											<div class="row">
												<div class="col-4">
													<a href="<?= base_url('product_detail?id=' . $key->PRODUCT_ID) ?>">
														<img class="img-list-order w-100" src="<?= base_url('assets/uploads/products/' . $key->IMAGES1); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png'); ?>' " />
													</a>
												</div>
												<div class="col-8 pl-0">
													<div class="d-flex flex-column">
														<div class="mb-1 text-capitalize">
															<a href="<?= base_url('product_detail?id=' . $key->PRODUCT_ID); ?>" style="color: #212529; font-size: 15px;">
																<?= $key->PRODUCT_NAME; ?>
															</a>
														</div>
														<!-- Kalo Mobile Tampil -->
														<div class="col-sm-12 pl-0 d-md-none">
															<span style="font-size: 0.8em; font-weight: bold">
																IDR <?= number_format($price, 2, ',', '.') . ' / ' . number_format($key->PRODUCT_QUANTITY); ?> Pcs
															</span>
														</div>
														<!-- End Kalo Mobile Tampil -->

														<div class="text-capitalize mb-2">
															<textarea class="form-control mt-2" name="<?= 'customer-notes-' . $i; ?>" style="background-color: #eee; width: 100%; height:50px; font-size: 12px;"><?= $key->PRODUCT_NOTES; ?></textarea>
															<input type="hidden" name="txt-name" value="<?= $key->PRODUCT_NOTES; ?>">
														</div>

														<div class="col-sm-6 d-md-none text-right">
															<button type="button" class="btn btn-danger delete-item ml-5" style="height: 2.5em; width: 2.5em" title="Remove Item" data-id="<?= $key->PRODUCT_ID; ?>" data-buyer="<?= $key->PRODUCT_BUYER; ?>">
																<i class="fa fa-trash"></i>
															</button>
														</div>

													</div>
												</div>
											</div>
										</div>
										<!-- EoL product details -->

										<!-- Product estimated price -->
										<div class="col-3 col-md-3 col-sm-3">
											<div class="row">
												<div class="col-12 d-none d-md-block">

													<div class="d-flex justify-content-center">
														<span class="font-weight-bold"><?= ($key->PRODUCT_PRICE <= 0 ? 'Price Negotiable' : 'IDR ' . number_format($price, 2, ',', '.')); ?></span>
													</div>

												</div>
											</div>
										</div>
										<!-- EoL product estimated price -->

										<!-- Product quantity -->
										<div class="col-md-1 d-none d-md-flex">
											<div class="d-flex justify-content-center">
												<span><?= number_format($key->PRODUCT_QUANTITY); ?></span>
											</div>
										</div>
										<!-- EoL product quantity -->

										<div class="col-1 col-sm-12col-md-3 col-lg-2 pr-0 pl-0 d-none d-md-flex">
											<button type="button" class="btn btn-danger delete-item ml-5" style="height: 2.5em; width: 2.5em" title="Remove Item" data-id="<?php echo $key->PRODUCT_ID; ?>" data-buyer="<?php echo $key->PRODUCT_BUYER; ?>">
												<i class="fa fa-trash"></i>
											</button>
										</div>


									</div>
								</div>


							</div>
							<!-- EoL Cart items loop -->

						<?php } ?>

					<?php } ?>

				</div>
			</div>

			<div class="col-12 col-md-5 pl-0 pr-0 pl-md-4">
				<div class="card">

					<div class="col-md-12">
						<h5 class="mt-3 mb-3">Shopping Summary</h5>
					</div>

					<div class="row">
						<div class="col-6 col-md-6 col-sm-6">
							<span class="pl-3">Total Items </span>
						</div>
						<div class="col-6 col-md-6 col-sm-6 text-right">
							<span class="font-weight-bold pr-4"><?= ($subqty == 0 ? '0' : $subqty); ?></span>
						</div>
					</div>

					<div class="row">
						<div class="col-6 col-md-6 col-sm-6">
							<span class="pl-3">Total Price Items</span>
						</div>

						<div class="col-6 col-md-6 col-sm-6 text-right">
							IDR <span class="font-weight-bold pr-4"><?= ($subtotal == 0 ? '0.00' : number_format($subtotal, 2, ',', '.')) ?></span>
						</div>
					</div>

					<div class="row">
						<div class="col-6 col-md-6 col-sm-6">
							<span class="pl-3">Total Weight</span>
						</div>

						<div class="col-6 col-md-6 col-sm-6 text-right">
							<span class="font-weight-bold pr-4"><?= ($weightTotal == 0 ? '0.00' : number_format($weightTotal, 2, ',', '.')); ?> Kg</span>
						</div>
					</div>

					<div class="row">
						<div class="col-6 col-md-6 col-sm-6">
							<span class="pl-3">Total Price Weight</span>
						</div>

						<div class="col-6 col-md-6 col-sm-6 text-right">
							IDR <span class="font-weight-bold pr-4"><?= ($priceWeightTotal == 0 ? '0.00' : number_format($priceWeightTotal, 2, ',', '.')) ?></span>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="border-top pt-2 mt-3 mb-3 mx-3"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-6 col-md-6 col-sm-6">
							<span class="font-weight-bold pl-3">TOTAL</span>
						</div>

						<div class="col-6 col-md-6 col-sm-6 text-right">
							IDR <span class="font-weight-bold pr-4"><?= ($totalPrice == 0 ? '0.00' : number_format($totalPrice, 2, ',', '.')) ?></span>
						</div>
					</div>

					<div class="row pl-3 mt-3 mb-3">
						<div class="col-6">
							<a href="<?php echo base_url(); ?>" class="btn btn-info" title="Shoping" style="color: white; font-size: 1em">
								<i class="fa fa-angle-left"></i>&nbsp; SHOPPING
							</a>
						</div>
						<div class="col-6" style="text-align: right">
							<button type="submit" class="btn text-cart-button mr-4" id="btnCheckOut" title="Submit Inquiry" style="background-color: #69c2ac; color:#fff; font-size: 1em">CHECKOUT&nbsp;<i class="fa fa-angle-right"></i></button>

						</div>
					</div>

				</div>
			</div>
		</div>

	</form>

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

					swal.fire({
						title: 'Deleted!',
						text: "Selected product has been removed",
						type: "success",
						showCancelButton: true,
						cancelButtonColor: '#d33',
						confirmButtonText: "Confirm",
						confirmButtonColor: '#3085d6'
					}).then((result) => {
						if (result.value) {
							location.reload();
						}
					});
				});
			}
		});
	});
</script>