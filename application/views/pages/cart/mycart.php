<?php
//INITIAL COUNTER
$subtotal 	= 0;
$subqty 	= 0;
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

	<!-- CART TOTAL ITEMS -->
	<div class="row pl-3 pl-md-0 pl-lg-0 pl-xl-0 pr-3 pr-md-0 pr-lg-0 pr-xl-0">
		<div class="col-12 col-12 pl-0 pl-md-4 pl-lg-4 pl-xl-4" id="cart-label-separator">
			<label class="cart-header-label pl-0 pl-md-0 pl-lg-4 pl-xl-4"><?php echo $row = $items->num_rows(); ?> Item(s) in the Cart</label>
		</div>
	</div>
	<!-- END OF CART TOTAL ITEMS -->
	<?php if ($items->num_rows() > 0) { ?>

		<!-- IF THERE'S AN ITEM -->
		<?php echo form_open('cart/checkout'); ?>
		<div class="custom-cart-container">

			<div class="row d-none d-md-block d-lg-block d-xl-block">
				<div class="col-md-12 col-lg-12 col-xl-12">
					<div class="row" id="cart-header-border">
						<div class="col-5 col-md-5">
							<div class="d-flex justify-content-center">Product Detail</div>
						</div>
						<div class="col-2 col-md-3">
							<div class="d-flex justify-content-center">Estimated Price</div>
						</div>
						<div class="col-1 col-md-1">
							<div class="d-flex justify-content-center">Qty</div>
						</div>
						<div class="col-2 col-md-3">
							<div class="d-flex justify-content-center">Total</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<?php foreach ($items->result() as $item) {

			//Counter Variable
			$i = 1;

			$finalUrl = 'http://kikikuku.com/API/product?key=c549303dcef12a687e9077a21e1a51fb67851efb&id=' . $item->PRODUCT_ID;
			$json 	= file_get_contents($finalUrl);
			$obj 	= json_decode($json, true);

			//SET THE FINAL PRICE VALUE
			if (!$this->incube->priceEmpty($item->PRODUCT_PRICE)) {
				$price = ceil($item->PRODUCT_PRICE * $item->PRODUCT_QUANTITY);
				// $price = ceil($currentPrice['price'] * $items['qty']);
			} else {
				$price = 0;
			}
		?>

			<div class="row d-none d-md-block d-lg-block d-xl-block" id="rowcart_<?php echo $item->PRODUCT_ID; ?>">
				<div class="col-12 mt-4 mt-md-4 mt-lg-4 mt-xl-4 mb-4 mb-md-4 mb-lg-4 mb-xl-4">

					<div class="row pb-4 cart-product-separator">
						<!-- PRODUCT DETAIL PART -->
						<div class="col-5 col-md-5">
							<div class="row">
								<div class="col-4">
									<a href="<?php echo base_url('product_detail?id=' . $item->PRODUCT_ID) ?>">
										<img class="img-list-order" src="<?php echo $item->PRODUCT_IMAGES; ?>" />
									</a>
								</div>

								<div class="col-8 pl-0">
									<div class="d-flex flex-column">
										<div class="mb-1 text-capitalize">
											<span class="font-weight-bold">Product Name:</span>
											<a href="<?php echo base_url('product_detail?id=' . $item->PRODUCT_ID); ?>" style="color: #212529;"><?php echo $obj['item']['TITLE']; ?></a>
										</div>
										<div class="text-capitalize">
											<span class="font-weight-bold">Inquiry:</span>
											<textarea class="form-control mt-2" name="customer-notes-<?php echo $i; ?>" style="background-color: #eee; width: 80%; height:100px;"><?php echo $item->PRODUCT_NOTES; ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END OF PRODUCT DETAIL PART -->

						<!-- ESTIMATED PRICE SECTION -->
						<div class="col-2 col-md-3">
							<div class="row">
								<div class="col-12">

									<!-- IF THE PRICE IS NEGOTIABLE -->
									<?php if ($this->incube->priceEmpty($item->PRODUCT_PRICE)) { ?>
										<div class="d-flex justify-content-center">
											<span class="font-weight-bold">Price Negotiable</span>
										</div>
										<?php $currentPrice['price'] = 0; ?>

										<!-- CHECK IF THE SDIPRICELIST IS EMPTY -->
									<?php } else {
										$pricingUrl = 'http://kikikuku.com/API/pricing?key=c549303dcef12a687e9077a21e1a51fb67851efb&id=' . $item->PRODUCT_ID . '&quantity=' . $item->PRODUCT_QUANTITY;
										$json 		= file_get_contents($pricingUrl);
										$pricing 	= json_decode($json, true);
									?>

										<div class="d-flex justify-content-center">
											<span class="font-weight-bold">IDR <?php echo number_format($pricing['price'], 2, '.', ','); ?></span>
										</div>

										<?php if ($pricing['endingQUantity'] != 'none') { ?>
											<div class="exw-container d-md-none d-lg-block d-xl-block mt-lg-3 mt-xl-3" id="cart-exw-container">
												<div class="cart-exw">
													<label>EXW Price:</label>
												</div>

												<div class="cart-exw pt-2 pb-3">
													<div class="row">
														<div class="col-12">
															<?php if ($pricing['endingQUantity'] == 0) { ?>
																<span class="pl-1"><?php echo number_format($pricing['startingQuantity']) . ' ' . $obj['matrics'] . ' and Above'; ?></span>
															<?php } else { ?>
																<span class="pl-1">
																	<?php echo $pricing['startingQuantity'] . ' ' . $obj['matrics']; ?> ~ <?php echo $pricing['endingQUantity'] . ' ' . $obj['matrics']; ?>
																</span>
															<?php } ?>
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<span class="pl-1" style="font-weight: bold; color: #24ca9d;">IDR <?php echo number_format($pricing['price'], 2, '.', ','); ?></span>/<?php echo $obj['matrics']; ?>
														</div>
													</div>
													<!-- <div class="float-left">
													</div>
													<div class="float-right">

													</div> -->
												</div>

											</div>
										<?php } ?>
									<? } ?>
									<!-- IF THE PRICELIST IS NOT EMPTY, CHECK FOR CORRECT VALUE -->

								</div>
							</div>
						</div>
						<!-- END OF ESTIMATED PRICE SECTION -->

						<!-- QUANTITY SECTION -->
						<div class="col-1 col-md-1">
							<div class="d-flex justify-content-center">
								<span class="font-weight-bold"><?php echo number_format($item->PRODUCT_QUANTITY); ?></span>
							</div>
						</div>
						<!-- END OF QUANTITY SECTION -->

						<!-- PRODUCT PRICE SECTION -->
						<div class="col-2 col-md-3 col-lg-2 pr-0 pl-0">
							<!-- SHOW ON ALL DEVICE -->
							<div class="d-md-none d-lg-block d-xl-block">
								<div class="row">
									<div class="col-lg-12 col-xl-12">
										<div class="d-flex justify-content-center">
											<?php if ($price == 0) : ?>
												<!-- ONLY SHOW IF THE PRICE IS NEGOTIABLE -->
												<span class="font-weight-bold">Price Negotiable</span>
											<?php else : ?>
												<span class="font-weight-bold">IDR <?php echo number_format($price, 2, ',', '.'); ?></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>

							<!-- SHOW ONLY ON TABLET -->
							<div class="d-md-block d-lg-none d-xl-none">
								<div class="row">
									<div class="col-12">
										<div class="d-flex justify-content-center">
											<!-- ONLY SHOW IF THE PRICE IS NEGOTIABLE -->
											<?php if ($price == 0) : ?>
												<span class="font-weight-bold">Price Negotiable</span>
											<?php else : ?>
												<span class="font-weight-bold">IDR <?php echo number_format($price, 2, ',', '.'); ?></span>
											<?php endif; ?>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12 pt-md-2">
										<div class="d-flex justify-content-center">
											<button type="button" class="btn btn-danger delete-item" title="Remove Item" data-id="<?php echo $item->PRODUCT_ID; ?>" data-buyer="<?php echo $item->PRODUCT_BUYER; ?>">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>

							</div>

						</div>
						<!-- END OF PRODUCT PRICE SECTION -->

						<!-- DELETE CART OPTIONS -->
						<div class="col-lg-1 col-xl-1 d-md-none d-lg-block d-xl-block">
							<button type="button" class="btn btn-danger delete-item" title="Remove Item" data-id="<?php echo $item->PRODUCT_ID; ?>" data-buyer="<?php echo $item->PRODUCT_BUYER; ?>">
								<i class="fa fa-trash"></i>
							</button>
						</div>
						<!-- END DELETE CART OPTIONS -->

					</div>
				</div>
			</div>

			<!-- MOBILE SHOPPING CART -->
			<div class="row d-block d-md-none d-lg-none d-xl-none mt-1 mb-3 pl-2 pr-2">
				<div class="col-12 cart-product-separator pb-4">

					<div class="row">
						<div class="col-4">
							<a href="<?php echo base_url('product_detail?id=' . $item->PRODUCT_ID) ?>">
								<img class="img-list-order" src="<?php echo $item->PRODUCT_IMAGES; ?>" />
							</a>
						</div>
						<div class="col-8">
							<div class="row">
								<div class="col-12">
									<span class="font-weight-bold">Product Title</span>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<span><?php echo $item->PRODUCT_NAME; ?></span>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="row">
								<div class="col-12">
									<span class="font-weight-bold">Product Price</span>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<?php if ($price == 0) : ?>
										<span>Price Negotiable</span>
									<?php else : ?>
										<span>IDR <?php echo number_format($price, 2, ',', '.'); ?></span>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-3">
							<div class="row">
								<div class="col-12">
									<span class="font-weight-bold">Quantity</span>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<span><?php echo $item->PRODUCT_QUANTITY; ?></span>
								</div>
							</div>
						</div>
						<div class="col-2 offset-1 pr-0">
							<button type="button" class="btn btn-danger delete-item mt-3 mt-md-0 mt-lg-0 mt-xl-0" title="Remove Item" data-id="<?php echo $item->PRODUCT_ID; ?>" data-buyer="<?php echo $item->PRODUCT_BUYER; ?>">
								<i class="fas fa-trash-alt"></i>
							</button>
						</div>
					</div>

					<!-- INQUIRY SECTION -->
					<div class="row mt-2">
						<div class="col-12">
							<div class="form-group">
								<label class="font-weight-bold" for="text-input-<?php echo $i; ?>">Inquiry</label>
								<textarea class="form-control" id="text-input-<?php echo $i; ?>" type="text" name="customer-notes-<?php echo $i; ?>" style="background-color: #eee; width: 100%; height: auto;"><?php echo $item->PRODUCT_NOTES; ?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- END OF MOBILE SHOPPING CART -->

			<?php
			//SHOPPING CART PRICE CALCULATION
			$subtotal = $subtotal + $price;
			$subqty   = $subqty + $item->PRODUCT_QUANTITY;
			?>

		<?php $i++;
		} ?>

		<div class="row">
			<div class="col-5 col-md-3 col-lg-3 col-xl-2 offset-2 offset-md-6 offset-lg-7 offset-xl-8">
				<span class="font-weight-bold text-uppercase">estimated price</span>
			</div>
			<div class="col-5 col-md-3 col-lg-2 col-xl-2 text-right">
				<span class="pr-1 pr-md-0 pr-lg-0 pr-xl-0 font-weight-bold">IDR <?php echo number_format($subtotal, 2, ",", "."); ?></span>
			</div>
		</div>

		<div class="row cart-product-separator pb-3">
			<div class="col-5 col-md-3 col-lg-2 col-xl-2 offset-2 offset-md-6 offset-lg-7 offset-xl-8">
				<span class="font-weight-bold text-uppercase">total items</span>
			</div>
			<div class="col-3 col-md-2 col-lg-2 col-xl-2 offset-2 offset-md-1 offset-xl-0 text-right">
				<span class="pr-1 pr-md-0 pr-lg-0 pr-xl-0 font-weight-bold"><?php echo $subqty; ?></span>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-6 col-md-6 col-lg-6 col-xl-6">
				<div class="d-flex justify-content-start">
					<a href="<?php echo base_url(); ?>">
						<button type="button" class="btn btn-warning text-cart-button" title="Continue Shoping" style="color: white;"><i class="fa fa-angle-left"></i>&nbsp;CONTINUE SHOPPING</button>
					</a>
				</div>
			</div>

			<div class="col-6 col-md-6 col-lg-6 col-xl-6">
				<div class="d-flex justify-content-end">
					<button type="submit" class="btn btn-success text-cart-button" id="btnCheckOut" title="Submit Inquiry">SUBMIT INQUIRY&nbsp;<i class="fa fa-angle-right"></i></button></p>
				</div>
			</div>
		</div>

		<?php echo form_close(); ?>

	<? } else { ?>
		<div class="col-12 col-md-12 col-lg-12 col-xl-12">
			<div class="no-item-list">
				NO ITEM IN CART
			</div>
		</div>
	<?php } ?>



	<!-- RECOMENDATION PRODUCT PART -->
	<div class="row mt-3 mt-md-4 mt-lg-4 mt-xl-4">

		<div class="col-12 col-md-6 col-lg-6 col-xl-6">
			<span class="detail-txt-color">
				<label>You Might Also Like:</label>
			</span>
		</div>

	</div>

	<div class="row mt-2">
		<?php foreach ($recomended['prslist'] as $data) : ?>

			<?php
			//FORMAT THE PRICE 
			$finalPrice = $this->incube->setPrice($convertRate, $marginParameter, $data['sellPrice']);
			$newPath = $this->incube->replaceLink($data['picture2']);
			?>

			<div class="custom-product-list">
				<div class="card product-list" id="prod_<?php echo $data['id']; ?>">
					<a href="<?php echo base_url(); ?>product_detail?id=<?php echo $data['id']; ?>" style="text-decoration: none;">
						<div class="d-flex justify-content-center">
							<img alt="'<?php echo $data['title']; ?>" class="product-image" src="<?php echo $newPath . $data['picture2']; ?>" />
						</div>
						<p class="product-title mt-2"><?php echo ucwords(mb_strimwidth($data['title'], 0, 35, "...")); ?></p>
						<label class="product-label">Estimated Price</label></br>
						<?php if ($this->incube->priceEmpty($data['sellPrice'])) : ?>
							<span class="product-price">Price Negotiable</span>
						<?php else : ?>
							<span class="product-price">IDR <?php echo number_format($finalPrice, 2, '.', ','); ?></span>
						<?php endif; ?>
					</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<!-- END OF RECOMENDED PRODUCT SECTION -->

</div>


<script type="text/javascript">
	$(document).ready(function() {

		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false,
		});

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

					$.ajax({
						type: "GET",
						url: "<?php echo base_url('Cart/removeCartItem'); ?>",
						data: {
							rowid: id,
							buyer: email
						},
						success: function(data) {
							var divID = '#rowcart_' + id;
							$("#rowcart_" + id).animate({
								left: '+=100em',
								opacity: '0.5'
							}, 1000, function() {
								$("#rowcart_" + id).remove();
							});
						}
					});

					swalWithBootstrapButtons.fire(
						'Deleted!',
						'Selected product has been removed.',
						'success'
					).then((result) => {
						if (result.value) {
							location.reload();
						}
					});
				}
			});
		});

	});
</script>