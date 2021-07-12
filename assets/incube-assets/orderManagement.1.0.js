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
				$.post(baseUrl + 'Orders_cms/deleteOrder', { orderNo: id }, function(resp) {
					console.log(data);
					location.reload();
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
