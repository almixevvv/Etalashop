<?php
	//INITIAL COUNTER    
	$subtotal 		= 0;
	$subqty 		= 0;
	$weightTotal 	= 0;
	$subWeight 		= 0;
	
	$weightTotalAkhir = 0;
	$priceWeightAkhir = 0;
	$priceWeightTotal = 0;
	$totalPrice = 0;
?>

<div class="cart-container">
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
			<label class="cart-header-label pl-0 pl-md-0 pl-lg-4 pl-xl-4"><?php echo $row = $items->num_rows(); ?> Item(s) in the Cart</label>
		</div>
		<!-- END OF TOTAL CART -->
	</div>

	<!-- DEKSTOP -->
	<div class="row">
		<div class="col-md-7 col-sm-12"> 
			<!-- TITLE MY CART -->
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
			<!-- END TITLE MY CART -->

			<!-- LOOPING PRODUCT IN MYCART -->
			<form method="POST" action="<?= base_url('cart/checkout') ?>">
			<?php 
				$i=0; 
				if($row>0){
					foreach ($items->result() as $key) {
						$price=$key->PRODUCT_PRICE;
						$weight = $key->WEIGHT;
			?>

				<!-- ITEMS LOOPING IN MYCART -->
				<div class="row" id="rowcart_<?php echo $key->PRODUCT_ID; ?>">
					<div class="col-md-12 mt-4  mt-lg-4 mt-xl-4 mb-4 mb-md-4 mb-lg-4 mb-xl-4">
						<div class="row pb-4 cart-product-separator">
							<!-- PRODUCT DETAIL PART -->
							<div class="col-md-6 col-sm-6">
								<div class="row">
									<div class="col-4">
										<a href="<?php echo base_url('product_detail?id=' . $key->PRODUCT_ID) ?>">
											<img class="img-list-order" src="<?php echo base_url()."assets/uploads/products/".$key->IMAGES1; ?>" style="width: 100%;"/>
										</a>
									</div>
									<div class="col-8 pl-0">
										<div class="d-flex flex-column">
											<div class="mb-1 text-capitalize" >
												<!-- <span class="font-weight-bold" style="font-size: 15px;">Product Name:</span> <br> -->
												<a href="<?php echo base_url('product_detail?id=' . $key->PRODUCT_ID); ?>" style="color: #212529; font-size: 15px;"><?php echo $key->PRODUCT_NAME; ?></a> 
											</div>
											<!-- Kalo Mobile Tampil -->
											<div class="col-sm-12 pl-0 d-md-none" >
												<span style="font-size: 0.8em; font-weight: bold">
													<?php  
														$pricing['price']=$key->PRODUCT_PRICE;
														$pricing['startingQuantity']=$key->PRODUCT_QUANTITY;
														$pricing['endingQUantity']=$key->PRODUCT_QUANTITY;
													?>
													IDR <?php echo number_format($pricing['price'], 2, ',', '.'); ?> / 
													<?php echo number_format($key->PRODUCT_QUANTITY); ?> pcs
												</span>
											</div>  
											<!-- End Kalo Mobile Tampil -->
											<div class="text-capitalize mb-2">
												<!-- <span class="font-weight-bold">Inquiry:</span> -->
												<textarea class="form-control mt-2" name="customer-notes-<?php echo $i; ?>" style="background-color: #eee; width: 100%; height:50px; font-size: 12px;"><?php echo $key->PRODUCT_NOTES; ?></textarea>
												<input type="hidden" name="txt-name" value="<?php echo  $key->PRODUCT_NOTES;?>">
												 
											</div> 
											<div class="col-sm-6 d-md-none text-right">
												<button type="button" class="btn btn-danger delete-item ml-5" style="height: 2.5em; width: 2.5em" title="Remove Item" data-id="<?php echo $key->PRODUCT_ID; ?>" data-buyer="<?php echo $key->PRODUCT_BUYER; ?>">
													<i class="fa fa-trash"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END OF PRODUCT DETAIL PART -->

							<!-- ESTIMATED PRICE SECTION -->
							<div class="col-3 col-md-3 col-sm-3">
								<div class="row">
									<div class="col-12 d-none d-md-flex">
										<!-- IF THE PRICE IS NEGOTIABLE -->
										<?php if ($key->PRODUCT_PRICE<=0) { ?>
											<div class="d-flex justify-content-center">
												<span>Price Negotiable</span>
											</div>
											<?php $currentPrice['price'] = 0; ?>

											<!-- CHECK IF THE SDIPRICELIST IS EMPTY -->
										<?php } else { 
											$pricing['price']=$key->PRODUCT_PRICE;
											$pricing['startingQuantity']=$key->PRODUCT_QUANTITY;
											$pricing['endingQUantity']=$key->PRODUCT_QUANTITY;
										?>

											<div class="justify-content-center">
												<span>IDR <?php echo number_format($pricing['price'], 2, ',', '.'); ?></span>
											</div>

											<?php if ($pricing['endingQUantity'] != 'none') { ?> 
											<?php } ?>
										<? } ?>
										<!-- IF THE PRICELIST IS NOT EMPTY, CHECK FOR CORRECT VALUE -->

									</div>
								</div>
							</div>
							<!-- END OF ESTIMATED PRICE SECTION -->

							<!-- QUANTITY SECTION -->
							<div class="col-md-1 d-none d-md-flex">
								<div class="d-flex justify-content-center">
									<span><?php echo number_format($key->PRODUCT_QUANTITY); ?></span>
								</div>
							</div>
							<!-- END OF QUANTITY SECTION -->  

							<div class="col-1 col-sm-12col-md-3 col-lg-2 pr-0 pl-0 d-none d-md-flex">  
							<button type="button" class="btn btn-danger delete-item ml-5" style="height: 2.5em; width: 2.5em" title="Remove Item" data-id="<?php echo $key->PRODUCT_ID; ?>" data-buyer="<?php echo $key->PRODUCT_BUYER; ?>">
								<i class="fa fa-trash"></i>
							</button> 
							</div>  

							<!-- Kalo Mobile Tampil -->
							
							<!-- End Kalo Mobile Tampil -->
				</div>
			</div></div>

					<?php
					//SHOPPING CART PRICE CALCULATION
					$subtotal = $subtotal + $price;
					$subqty   = $subqty + $key->PRODUCT_QUANTITY;
					$i++;

					// WEIGHT CALCULATION
					$subWeight	 = $subWeight + $weight;
					$weightTotal = $weightTotal+($weight*$key->PRODUCT_QUANTITY);
					
				
					// $priceWeight = 9000;
					// $priceWeightTotal = $priceWeight * $weightTotal;

					// $totalPrice = $priceWeightAkhir + $subtotal;
				}
				//echo $weightTotal;	
				$priceWeight = 9000;	
				$priceWeightTotal = $priceWeight * $weightTotal;	
				$totalPrice = $priceWeightTotal + $subtotal;

				?>

				<!-- END ISI LOOPING IN MYCART -->

				 
			<!-- END LOOPING PRODUCT IN MYCART -->
			<?php 
				}
				else{
			?>
					<div class="col-12 col-md-12 col-lg-12 col-xl-12">
						<div class="no-item-list"> NO ITEM IN CART </div>
					</div>
			<?php
				}
			?>
		</div>
 

		<div class="col-md-5" style="padding-left:5%; ">
			<div class="card" >
			  
			  	<div class="col-md-12">
			  		 <h5 class="mt-3 mb-3">Shopping Summary</h5> 
			  	</div>
			  	<div class="row">
			  		<div class="col-6 col-md-6 col-sm-6" style="padding-left: 30px;">
			  		 <span style="font-size: 12pt;">Total Items </span> 
				  	</div>
				  	<div class="col-6 col-md-6 col-sm-6" style="text-align: right;padding-right:10%; ">
				  		<?php echo $subqty; ?>
				  	</div> 
			  	</div>
			  	<div class="row">
			  		<div class="col-6 col-md-6 col-sm-6" style="padding-left: 30px;">
			  		 <span style="font-size: 12pt;">Total Price Items</span> 
				  	</div>
				  	
				  	<div class="col-6 col-md-6 col-sm-6" style="text-align: right;padding-right:10%; ">
				  		  IDR <?php echo number_format($subtotal, 2, ",", "."); ?>
				  	</div>
				  	
			  	</div>
			  	<div class="row">
			  		<div class="col-6 col-md-6 col-sm-6" style="padding-left: 30px;">
			  		 <span style="font-size: 12pt;">Total Weight</span> 
				  	</div>
				  	
				  	<div class="col-6 col-md-6 col-sm-6" style="text-align: right;padding-right:10%; ">
				  		 <?php echo number_format($weightTotal, 2, ",", "."); ?> Kg
				  	</div>
				  	
			  	</div>
			  	<div class="row">
			  		<div class="col-6 col-md-6 col-sm-6" style="padding-left: 30px;">
			  		 <span style="font-size: 12pt;">Total Price Weight</span> 
				  	</div>
				  	
				  	<div class="col-6 col-md-6 col-sm-6" style="text-align: right;padding-right:10%; ">
				  		 IDR <?php echo number_format($priceWeightTotal, 2, ",", "."); ?>
				  	</div>
				  	
			  	</div>
			  	<hr style="width: 95%; margin: 10px auto;">
			  	<div class="row">
			  		<div class="col-6 col-md-6 col-sm-6" style="padding-left: 30px;">
			  		 <span style="font-size: 12pt; font-weight: bold">TOTAL</span> 
				  	</div>
				  	
				  	<div class="col-6 col-md-6 col-sm-6" style="text-align: right;padding-right:10%; font-weight: bold">
				  		 IDR <?php echo number_format($totalPrice, 2, ",", "."); ?>
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
	
	<!-- END LOOPING PRODUCT IN MYCART -->
	</form>

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
						url: "<?php echo base_url('General/Cart/removeCartItem'); ?>",
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