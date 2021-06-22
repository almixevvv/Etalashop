var minimumValue = $('#quantity').val();

//Initialize Function
quantityVerification();

//ZOOM KE GAMBAR
$('.detail-main-images').wrap('<span style="display:inline-block"></span>').css('display', 'block').parent().zoom();

//GANTI IMAGE
$('.row-images').each(function() {
	var $this = $(this);
	$this.on('click', function() {
		var image = $('.detail-main-images');
		//HARUS DIASIGN KE LOCAL VARIABLE BIAR BERUBAH
		var source = $(this).data('picture');
		image.fadeOut('fast', function() {
			image.attr('src', source);
			image.fadeIn('fast');
			$('.detail-main-images').trigger('zoom.destroy');
			$('.detail-main-images')
				.wrap('<span style="display:inline-block"></span>')
				.css('display', 'block')
				.parent()
				.zoom();
		});
	});
});

$('#quantity').on('change', function() {
	var id = $('#hiddenID').val();
	var curQty = $('#quantity').val();
	var curPrice = $('#hiddenPrice').val();

	$.ajax({
		url: 'http://kikikuku.com/API/pricing',
		method: 'GET',
		dataType: 'jsonp',
		data: {
			key: 'c549303dcef12a687e9077a21e1a51fb67851efb',
			id: id,
			quantity: curQty
		},
		cache: false,
		success: function(data) {
			$('#estimated-price').animate(
				{
					opacity: 0
				},
				250,
				function() {
					$('#estimated-price').number(data.price, 2, ',', '.').animate(
						{
							opacity: 1
						},
						250
					);
				}
			);
		}
	});
});

$('#quantity').on('change', function() {
	var curQty = parseInt($('#quantity').val());
	var minimumQty = parseInt($('#minimumQty').val());

	if (curQty >= minimumQty) {
		//If the quantity is more than the minimum, print as it is
		$('#quantity').val(curQty);
	} else if (curQty <= minimumQty) {
		//If the quantity is less than minimum, print the minimum value
		$('#quantity').val(minimumQty);
	}
});

$('#xplusone').click(function() {
	var qty = parseInt($('#quantity').val());
	var newqty = qty + 1;

	$('#quantity').val(newqty);
});

$('#xminusone').click(function() {
	var qty = parseInt($('#quantity').val());
	var minimumQty = parseInt($('#minimumQty').val());

	var newqty = qty - 1;

	if (qty < 1) {
		//If the number is less than 1, print 1
		$('#quantity').val(1);
		return true;
	} else if (qty <= minimumQty) {
		//If the number is less than minimum, then print the minimum value
		$('#quantity').val(minimumQty);
		return true;
	} else {
		//If the number is more than 1, then print - 1
		$('#quantity').val(newqty);
		return true;
	}
});
