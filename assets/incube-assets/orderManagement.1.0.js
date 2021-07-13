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
$('#exampleModal').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);

	var orderno = button.data('orderno');
	var rowid = button.data('rowid');
	var target = document.getElementById(rowid);

	target.removeAttribute('style');
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
