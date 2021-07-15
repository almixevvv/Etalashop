//1. Delete order details
$(document).on('click', '.buttonDelete', function() {
	let id = $(this).data('orderno');

	swal
		.fire({
			title: 'Delete Order',
			text: 'Are you sure you want to delete this order? This process cannot be reversed',
			type: 'warning',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			confirmButtonText: 'Delete data',
			confirmButtonColor: '#3085d6'
		})
		.then((result) => {
			if (result.value) {
				$.post(baseUrl + 'CMS/Orders_cms/deleteOrder', { orderNo: id }, function(resp) {
					if (resp.code == 200) {
						swal
							.fire({
								title: 'Success',
								text: 'Order has been deleted',
								type: 'success',
								showCancelButton: false,
								confirmButtonText: 'Ok',
								confirmButtonColor: '#3085d6'
							})
							.then((btnConfirm) => {
								if (btnConfirm.value) {
									location.reload();
								}
							});
					} else if (resp.code == 204) {
						swal.fire({
							title: 'Invalid Data',
							text: 'Order number not found, please try again later',
							type: 'error',
							showCancelButton: true,
							cancelButtonColor: '#d33',
							confirmButtonText: 'Ok',
							confirmButtonColor: '#3085d6'
						});
					} else if (resp.code == 504) {
						swal.fire({
							title: 'Unknown Error',
							text: 'Unknown error has occured, please try again later',
							type: 'error',
							showCancelButton: true,
							cancelButtonColor: '#d33',
							confirmButtonText: 'Delete data',
							confirmButtonColor: '#3085d6'
						});
					}
				});
			}
		});
});
//EoL 1

//2. Show order details
$('#order-details').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);

	var orderno = button.data('orderno');
	var rowid = button.data('rowid');
	var target = document.getElementById(rowid);

	$.get(baseUrl + 'CMS/Orders_cms/getDetails', { id: orderno }, function(resp) {
		// console.log(resp);

		//Delete previous product list
		$('.temporary-loop').remove();
		$('.productSeparator').not('.d-none').remove();

		if (resp.code == 200) {
			let response = resp.message.data;

			//General Order
			$('#orderNo').text(response.order_no);
			$('#orderDate').text(response.order_date);
			$('#orderDate').text(response.order_date);
			$('#orderStatus').val(response.order_status);
			$('#orderInstruction').val(response.order_status);
			$('#orderUpdated').text(response.order_updated);
			//EoL General Order

			//Member Details
			$('#memberName').empty();
			$('#memberMobile').empty();
			$('#memberAddress').empty();
			$('#memberEmail').empty();

			$('#memberName').append(response.member_name);
			$('#memberMobile').append(response.member_mobile);
			$('#memberAddress').append(
				response.member_address +
					'</br>' +
					response.member_address2 +
					'</br>' +
					response.member_country +
					' ' +
					response.member_province +
					' ' +
					response.member_zip
			);
			$('#memberEmail').append(response.member_email);
			//EoL Member Details

			//Shipping Details
			$('#shippingName').empty();
			$('#shippingMobile').empty();
			$('#shippingAddress').empty();
			$('#shippingEmail').empty();

			$('#shippingName').append(response.member_name);
			$('#shippingMobile').append(response.member_mobile);
			$('#shippingAddress').append(
				response.member_address +
					'</br>' +
					response.member_address2 +
					'</br>' +
					response.member_country +
					response.member_province +
					response.member_zip
			);
			$('#shippingEmail').append(response.member_email);
			//EoL Member Details

			//Order Total Price
			$('#productAmount').val(response.total_order);
			$('#productPostage').val(response.total_postage);
			$('#productTotal').val(response.amount);

			//EoL Order Total Price

			var $separator = $('.productSeparator').last().clone();

			resp.message.details.forEach(function(index) {
				// $('.productSeparator').not(':first').remove();

				var $mainLoop = $('.original-loop').last().clone();

				$mainLoop.addClass('temporary-loop').removeClass('d-none original-loop');
				$separator.removeClass('d-none');

				let $productImage = $mainLoop.find('.productImage');
				let $productID = $mainLoop.find('.productID');
				let $productName = $mainLoop.find('.productName');
				let $productPrice = $mainLoop.find('.productPrice');
				let $productQty = $mainLoop.find('.productQty');
				let $productNotes = $mainLoop.find('.productQueries');

				$productImage.attr('src', index.product_image);
				$productImage.attr('alt', index.product_name);
				$productNotes.text(index.product_notes);

				$productID.append(index.product_id);
				$productName.append(index.product_name);
				$productPrice.append('IDR ' + index.product_price);
				$productQty.append(index.product_quantity);

				$mainLoop.insertAfter('.original-loop');
				$separator.insertAfter('.temporary-loop');
			});
		} else {
			console.log('error');
		}
	});

	//2. Submit the form
	$('#formOrder').submit(function(evt) {
		// evt.preventDefault();
		// console.log('submit');
	});

	//EoL 2

	// $('#' + rowid)
	// console.log('Button Position ' + orderno);

	// var getDetails = baseUrl + 'Orders_cms/getDetails?id=';

	// $('.modal-body').load(getDetails + orderno, function() {
	// 	$('#exampleModal').modal({
	// 		show: true
	// 	});
	// });
});
//EoL 2

$('#exampleModal2').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var orderno = button.data('orderno');
	console.log('Button Position ' + orderno);

	var getPayment = baseUrl + 'Orders_cms/getPayment?id=';

	$('.modal-body').load(getPayment + orderno, function() {
		$('#exampleModal2').modal({
			show: true
		});
	});
});
