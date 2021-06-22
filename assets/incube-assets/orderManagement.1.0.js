$(document).ready(function() {
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	});

	$('.buttonDelete').on('click', function() {
		var id = $(this).attr('data-orderno');

		swal
			.fire({
				title: 'Delete Order',
				text: 'Are you sure you want to delete this order from order management?',
				type: 'warning',
				showCancelButton: true,
				cancelButtonColor: '#d33',
				confirmButtonText: 'Confirm',
				confirmButtonColor: '#3085d6'
			})
			.then((result) => {
				if (result.value) {
					swalWithBootstrapButtons.fire('Deleted!', 'Selected order has been deleted.', 'success');

					$.ajax({
						type: 'POST',
						url: baseUrl + 'Orders_cms/deleteOrder',
						data: {
							orderNo: id
						},

						success: function(data) {
							console.log(data);
							location.reload();
						}
					});
				}
			});
	});
});

function remove_style(all) {
	var i = all.length;
	var j, is_hidden;

	// Presentational attributes.

	var attr = [
		'align',
		'background',
		'bgcolor',
		'border',
		'cellpadding',
		'cellspacing',
		'color',
		'face',
		'height',
		'hspace',
		'marginheight',
		'marginwidth',
		'noshade',
		'nowrap',
		'valign',
		'vspace',
		'width',
		'vlink',
		'alink',
		'text',
		'link',
		'frame',
		'frameborder',
		'clear',
		'scrolling',
		'style'
	];

	var attr_len = attr.length;

	while (i--) {
		is_hidden = all[i].style.display === 'none';
		j = attr_len;
		while (j--) {
			all[i].removeAttribute(attr[j]);
		}

		// Re-hide display:none elements,
		// so they can be toggled via JS.
		if (is_hidden) {
			all[i].style.display = 'none';
			is_hidden = false;
		}
	}
}

$('#exampleModal').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var orderno = button.data('orderno');
	var rowid = button.data('rowid');
	var target = document.getElementById(rowid);

	target.removeAttribute('style');

	// $('#' + rowid)
	console.log('Button Position ' + orderno);

	var getDetails = baseUrl + 'Orders_cms/getDetails?id=';

	$('.modal-body').load(getDetails + orderno, function() {
		$('#exampleModal').modal({
			show: true
		});
	});
});

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
