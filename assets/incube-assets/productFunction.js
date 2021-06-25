//1. Tambah tombol buat Quantity
$('body').on('click', '.btnAddRow', function(evt) {
	let button = evt.currentTarget;

	let $container = $(button).parents().closest('.priceContainer');
	let $originalPrice = $($container).children('.originalPrice');
	let $btn = $(button).parents().closest('.priceButton');

	let $clonePrice = $originalPrice.clone();

	$clonePrice.removeAttr('id');
	$clonePrice.removeClass('originalPrice').addClass('clonePrice');
	$clonePrice.find('.btnRemoveRow').removeAttr('disabled');
	$clonePrice.find(':input').val('');

	$clonePrice.insertBefore($btn);
});
//EoL 1

//2. Hapus Quantity di baris yang di klik
$('body').on('click', '.btnRemoveRow', function(evt) {
	let button = evt.currentTarget;

	$(button).parents().closest('.clonePrice').remove();
});
//EoL 2

//3. Nampilin Preview dari thumbnail
$('body').on('click', '.img-thumbnail', function(evt) {
	let imgPreview = evt.currentTarget;
	let curImage = $(imgPreview).attr('src');

	$('.img-preview').attr('src', curImage);
});
//EoL 3

//4. Nampilin semua kategori dari DB
var countries = [];

$.get(baseUrl + 'API/getAllCategories', function(resp) {
	$.each(resp, function(_index, value) {
		let ctgData;
		ctgData = {
			value: value.data,
			data: value.value
		};
		countries.push(ctgData);
	});
});
//EoL 4

//5. Controller semua function dalam Modal Add Product
$('#addProductModal').on('show.bs.modal', function(event) {
	//5.1 Function buat nampilin preview gambar yang di upload
	function previewImages() {
		$('#fatherPreview').empty();
		$('#motherPreview').empty();

		if (this.files.length > 4) {
			swal.fire({
				title: 'Upload Failed',
				text: `Cannot upload more than 4 files at once`,
				type: 'warning',
				showCancelButton: false,
				cancelButtonColor: '#d33',
				confirmButtonText: 'Close',
				confirmButtonColor: '#3085d6'
			});
		} else {
			if (this.files) $.each(this.files, readAndPreview);

			function readAndPreview(i, file) {
				if (file.size > 2000000) {
					return swal.fire({
						title: 'Upload Failed',
						text: `File size exceeded! Maximum file size is 2MB`,
						type: 'warning',
						showCancelButton: false,
						cancelButtonColor: '#d33',
						confirmButtonText: 'Close',
						confirmButtonColor: '#3085d6'
					});
				}

				var reader = new FileReader();

				$(reader).on('load', function() {
					if (i == 0) {
						$imageContainer = $('<img>').attr('src', this.result).addClass('img-preview');
						$('#fatherPreview').append($imageContainer);

						$imageHolder = $('<div>').addClass('d-flex mr-2 container-preview');
						$imageContainer = $('<img>').attr('src', this.result).addClass('img-thumbnail');

						$imageHolder.append($imageContainer);
						$('#motherPreview').append($imageHolder);
					} else if (i == 3) {
						$imageHolder = $('<div>').addClass('d-flex container-preview');
						$imageContainer = $('<img>').attr('src', this.result).addClass('img-thumbnail');

						$imageHolder.append($imageContainer);
						$('#motherPreview').append($imageHolder);
					} else {
						$imageHolder = $('<div>').addClass('d-flex mr-2 container-preview');
						$imageContainer = $('<img>').attr('src', this.result).addClass('img-thumbnail');

						$imageHolder.append($imageContainer);
						$('#motherPreview').append($imageHolder);
					}
				});

				reader.readAsDataURL(file);
			}
		}
	}
	//EoL 5.1

	//5.2 Detect perubahan tiap kali user upload gambar
	$('#filePRODImage').on('change', previewImages);
	//EoL 5.2

	//5.3 Auto generate PID
	$.get(
		baseUrl + 'API/generatePID',
		{
			key: 'c549303dcef12a687e9077a21e1a51fb67851efb'
		},
		function(resp) {
			if (resp.code == 200) {
				$('#txtPRODID').val(resp.message);
			} else {
				swal.fire({
					title: 'Network Error',
					text: 'Cannot generate PID, please try again later',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: '#d33',
					confirmButtonText: 'Confirm',
					confirmButtonColor: '#3085d6'
				});
			}
		}
	);
	//EoL 5.3

	//5.4 Autocomplete buat Kategori
	$('#txtPRODCategory').autocomplete({
		lookup: countries,
		onSelect: function(suggestion) {
			console.log(suggestion);
		}
	});
	//EoL 5.4

	//5.5 Initiate TinyMCE
	tinymce.init({
		selector: 'textarea#txtPRODDetail',
		plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
		toolbar_mode: 'floating'
	});
	//EoL 5.5

	//5.6 Submit Form + Validasi
	$('#addProduct').submit(function(ex) {
		ex.preventDefault();

		console.log('clicked here');

		let qtyMin, qtyMax, qtyPrice;
		let minCheck, maxCheck, prcCheck;
		let minCounter, maxCounter, prcCounter;
		let rowCounter = $('#addProduct .originalPrice').length + $('#addProduct .clonePrice').length;
		let emptyCheck = checkEmptyForm(this);

		minCheck = false;
		maxCheck = false;
		prcCheck = false;

		minCounter = 0;
		maxCounter = 0;
		prcCounter = 0;

		qtyMin = [];
		qtyMax = [];
		qtyPrice = [];

		qtyMin = $('input[name="txtQUANMin[]"]')
			.map(function() {
				return $(this).val();
			})
			.get();
		qtyMax = $('input[name="txtQUANMax[]"]')
			.map(function() {
				return $(this).val();
			})
			.get();
		qtyPrice = $('input[name="txtQUANPrice[]"]')
			.map(function() {
				return $(this).val();
			})
			.get();

		$.each(qtyMin, function(_index, value) {
			if (value.length != 0) {
				minCounter++;
			}
		});

		$.each(qtyMax, function(_index, value) {
			if (value.length != 0) {
				maxCounter++;
			}
		});

		$.each(qtyPrice, function(_index, value) {
			if (value.length != 0) {
				prcCounter++;
			}
		});

		minCheck = minCounter == rowCounter ? true : false;
		maxCheck = maxCounter == rowCounter ? true : false;
		prcCheck = prcCounter == rowCounter ? true : false;

		if (minCheck == false || maxCheck == false || prcCheck == false) {
			$('#addProduct .priceButton').before(`
          		<div class="mt-2 alert alert-danger" role="alert">
            		Cannot be empty!
          		</div>
        	`);
		} else if (minCheck == true && maxCheck == true && prcCheck == true) {
			$('#addProduct .priceButton').prev('.alert').remove();
		}

		console.log('min counter ' + minCounter);
		console.log('max counter ' + maxCounter);
		console.log('price counter ' + prcCounter);

		console.log('min check ' + minCheck);
		console.log('max check ' + maxCheck);
		console.log('price check ' + prcCheck);

		console.log('row counter ' + rowCounter);

		//Final Check
		if (minCheck && maxCheck && prcCheck && emptyCheck) {
			console.log('ke klik');
			$('#addProduct')[0].submit();
		} else {
			console.log('masih ada yabg miss');
		}
		//EoL Final Check
	});
	//EoL 5.6

	//5.7 Number Format buat harga

	//EoL 5.
});
//EoL 5

//6. Controller function modal Edit Product
$('#editProductModal').on('show.bs.modal', function(event) {
	let $button = $(event.relatedTarget);
	let btnID = $button.data('id');

	$('.father-preview').empty();
	$('.mother-preview').empty();

	//6.1 Ambil detail product
	$.get(
		baseUrl + 'API/getProductDetail',
		{
			id: btnID
		},
		function(resp) {
			//Buat ngeliat datanya apa aja
			console.log(resp);
			$('#editPRODID').val(resp[0].PRODUCT_ID);
			$('#editPRODCategory').val(resp[0].CATEGORY_NAME);
			$('#editPRODName').val(resp[0].PRODUCT_NAME);
			$('#editPRODSKU').val(resp[0].SKU);
			$('#editPRODWeight').val(resp[0].WEIGHT);
			$('#editPRODDetail').text(resp[0].PRODUCT_DETAIL);

			//6.1.1 Buat nampilin gambar secara otomatis pas klik tombol Edit
			let imagesArr = [];

			if (resp[0].IMAGES1.length > 0) {
				imagesArr.push(resp[0].IMAGES1);
			}

			if (resp[0].IMAGES2.length > 0) {
				imagesArr.push(resp[0].IMAGES2);
			}

			if (resp[0].IMAGES3.length > 0) {
				imagesArr.push(resp[0].IMAGES3);
			}

			if (resp[0].IMAGES4.length > 0) {
				imagesArr.push(resp[0].IMAGES4);
			}

			$.each(imagesArr, function(index, value) {
				console.log(index);
				console.log(value);

				if (index == 0) {
					$imageContainer = $('<img>')
						.attr(
							'src',
							value.substring(0, 4) == 'http' ? value : baseUrl + 'assets/uploads/products/' + value
						)
						.addClass('img-preview');
					$('.father-preview').append($imageContainer);

					$imageHolder = $('<div>').addClass('d-flex mr-2 container-preview');
					$imageContainer = $('<img>')
						.attr(
							'src',
							value.substring(0, 4) == 'http' ? value : baseUrl + 'assets/uploads/products/' + value
						)
						.addClass('img-thumbnail');

					$imageHolder.append($imageContainer);
					$('.mother-preview').append($imageHolder);
				} else if (index == 3) {
					$imageHolder = $('<div>').addClass('d-flex container-preview');
					$imageContainer = $('<img>')
						.attr(
							'src',
							value.substring(0, 4) == 'http' ? value : baseUrl + 'assets/uploads/products/' + value
						)
						.addClass('img-thumbnail');

					$imageHolder.append($imageContainer);
					$('.mother-preview').append($imageHolder);
				} else {
					$imageHolder = $('<div>').addClass('d-flex mr-2 container-preview');
					$imageContainer = $('<img>')
						.attr(
							'src',
							value.substring(0, 4) == 'http' ? value : baseUrl + 'assets/uploads/products/' + value
						)
						.addClass('img-thumbnail');

					$imageHolder.append($imageContainer);
					$('.mother-preview').append($imageHolder);
				}
			});
			//EoL 6.1.1

			//6.1.2 Nampilin Quantity sesuai jumlahnya
			let qtyArr = [];
			let $container = $('#editPriceList');
			let $btn = $($container).siblings('.priceButton');
			let $clonePrice = $container.clone();

			$.each(resp, function(index, value) {
				let qtyDetail = {};

				qtyDetail = {
					QTY_MIN: value.QUANTITY_MIN,
					QTY_MAX: value.QUANTITY_MAX,
					QTY_PRICE: value.QUANTITY_PRICE
				};

				qtyArr.push(qtyDetail);
			});

			$.each(qtyArr, function(index, value) {
				let curMin = $($container).find('.editQUANMin');
				let curMax = $($container).find('.editQUANMax');
				let curPrice = $($container).find('.editQUANPrice');

				if (index == 0) {
					$(curMin).val(value.QTY_MIN);
					$(curMax).val(value.QTY_MAX);
					$(curPrice).val(value.QTY_PRICE);
				} else {
					$clonePrice.removeAttr('id');
					$clonePrice.removeClass('originalPrice').addClass('clonePrice');
					$clonePrice.find('.btnRemoveRow').removeAttr('disabled');

					$($clonePrice).find('.editQUANMin').val(value.QTY_MIN);
					$($clonePrice).find('.editQUANMax').val(value.QTY_MAX);
					$($clonePrice).find('.editQUANPrice').val(value.QTY_PRICE);

					$clonePrice.insertBefore($btn);
				}
			});
			//EoL 6.1.2

			//6.2 Function buat nampilin preview gambar yang di upload
			function previewImages() {
				$('.father-preview').empty();
				$('.mother-preview').empty();

				if (this.files.length > 4) {
					swal.fire({
						title: 'Upload Failed',
						text: `Cannot upload more than 4 files at once`,
						type: 'warning',
						showCancelButton: false,
						cancelButtonColor: '#d33',
						confirmButtonText: 'Close',
						confirmButtonColor: '#3085d6'
					});
				} else {
					if (this.files) $.each(this.files, readAndPreview);

					function readAndPreview(i, file) {
						if (file.size > 2000000) {
							return swal.fire({
								title: 'Upload Failed',
								text: `File size exceeded! Maximum file size is 2MB`,
								type: 'warning',
								showCancelButton: false,
								cancelButtonColor: '#d33',
								confirmButtonText: 'Close',
								confirmButtonColor: '#3085d6'
							});
						}

						var reader = new FileReader();

						$(reader).on('load', function() {
							if (i == 0) {
								$imageContainer = $('<img>').attr('src', this.result).addClass('img-preview');
								$('.father-preview').append($imageContainer);

								$imageHolder = $('<div>').addClass('d-flex mr-2 container-preview');
								$imageContainer = $('<img>').attr('src', this.result).addClass('img-thumbnail');

								$imageHolder.append($imageContainer);
								$('.mother-preview').append($imageHolder);
							} else if (i == 3) {
								$imageHolder = $('<div>').addClass('d-flex container-preview');
								$imageContainer = $('<img>').attr('src', this.result).addClass('img-thumbnail');

								$imageHolder.append($imageContainer);
								$('.mother-preview').append($imageHolder);
							} else {
								$imageHolder = $('<div>').addClass('d-flex mr-2 container-preview');
								$imageContainer = $('<img>').attr('src', this.result).addClass('img-thumbnail');

								$imageHolder.append($imageContainer);
								$('.mother-preview').append($imageHolder);
							}
						});

						reader.readAsDataURL(file);
					}
				}
			}
			//EoL 6.2

			//6.3 Detect perubahan tiap kali user upload gambar
			$('#editfilePRODImage').on('change', previewImages);
			//EoL 6.3

			//6.4 Submit Form
			$('#editProduct').submit(function(ex) {
				ex.preventDefault();

				let qtyMin, qtyMax, qtyPrice;
				let minCheck, maxCheck, prcCheck;
				let minCounter, maxCounter, prcCounter;
				let rowCounter = $('#editProduct .originalPrice').length + $('#editProduct .clonePrice').length;
				let emptyCheck = checkEmptyEditForm(this);

				minCheck = false;
				maxCheck = false;
				prcCheck = false;

				minCounter = 0;
				maxCounter = 0;
				prcCounter = 0;

				qtyMin = [];
				qtyMax = [];
				qtyPrice = [];

				//DISNI
				qtyMin = $('#editProduct input[name="editQUANMin[]"]')
					.map(function() {
						return $(this).val();
					})
					.get();
				qtyMax = $('#editProduct input[name="editQUANMax[]"]')
					.map(function() {
						return $(this).val();
					})
					.get();
				qtyPrice = $('#editProduct input[name="editQUANPrice[]"]')
					.map(function() {
						return $(this).val();
					})
					.get();

				console.log(qtyMin);
				console.log(qtyMax);
				console.log(qtyPrice);

				console.log(rowCounter);

				$.each(qtyMin, function(index, value) {
					if (value.length != 0) {
						minCounter++;
					}
				});

				$.each(qtyMax, function(index, value) {
					if (value.length != 0) {
						maxCounter++;
					}
				});

				$.each(qtyPrice, function(index, value) {
					if (value.length != 0) {
						prcCounter++;
					}
				});

				minCheck = minCounter == rowCounter ? true : false;
				maxCheck = maxCounter == rowCounter ? true : false;
				prcCheck = prcCounter == rowCounter ? true : false;

				if (minCheck == false || maxCheck == false || prcCheck == false) {
					$('#editProduct .priceButton').prev('.alert').remove();

					$('#editProduct .priceButton').before(`
				        <div class="mt-2 alert alert-danger" role="alert">
				            Cannot be empty!
				        </div>
				        `);
				} else if (minCheck == true && maxCheck == true && prcCheck == true) {
					$('#editProduct .priceButton').prev('.alert').remove();
				}

				//Final Check
				if (minCheck && maxCheck && prcCheck && emptyCheck) {
					$('#editProduct')[0].submit();
				}
				//EoL Final Check
			});
			//EoL 6.4
		}
	);
	//EoL 6.1

	//6.2 Buat nyalain autocomplete
	$('#editPRODCategory').autocomplete({
		lookup: countries,
		onSelect: function(suggestion) {
			// console.log(suggestion);
		}
	});
	//EoL 6.2

	//6.3 Initiate TinyMCE
	tinymce.init({
		selector: 'textarea#editPRODDetail',
		plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
		toolbar_mode: 'floating'
	});
	//EoL 5.5
});
//EoL 6

//7. Delete product
const buttonDelete = function(id_product) {
	swal
		.fire({
			title: 'Delete',
			text: 'Are you sure you want to Delete ?',
			type: 'error',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			confirmButtonText: 'Confirm',
			confirmButtonColor: '#3085d6'
		})
		.then((result) => {
			if (result.value) {
				window.location.replace(baseUrl + 'cms/Product_cms/delete_product?id=' + id_product);
			}
		});
};
//EoL 7

//8. Function Galery
let modalId = $('#image-gallery');

//8.3 Load Gallery Function
const loadGallery = function(setIDs, setClickAttr) {
	let current_image,
		selector,
		counter = 0;

	$('#show-next-image, #show-previous-image').click(function() {
		if ($(this).attr('id') == 'show-previous-image') {
			current_image = current_image <= 1 ? 1 : current_image - 1;
		} else {
			current_image = current_image + 1;
		}

		selector = $('[data-image-id="' + current_image + '"]');
		updateGallery(selector);
	});

	//8.3.1 Update Gallery
	function updateGallery(selector) {
		let $sel = selector;
		current_image = $sel.data('image-id');
		$('#image-gallery-title').text($sel.data('title'));
		$('#image-gallery-image').attr('src', $sel.data('image'));

		disableButtons(counter, $sel.data('image-id'));
	}

	if (setIDs == true) {
		$('[data-image-id]').each(function() {
			counter++;
			$(this).attr('data-image-id', counter);
		});
	}
	$(setClickAttr).on('click', function() {
		updateGallery($(this));
	});
	//EoL 8.3.1
};
//EoL 8.3

loadGallery(true, 'a.thumbnail');

//8.2 Disable Buttons
const disableButtons = function(counter_max, counter_current) {
	$('#show-previous-image, #show-next-image').show();
	if (counter_max === counter_current) {
		$('#show-next-image').hide();
	} else if (counter_current === 1) {
		$('#show-previous-image').hide();
	}
};
//EoL 8.2

//8.1 Prevent button clicked
$(document).keydown(function(e) {
	switch (e.which) {
		case 37: // left
			if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(':visible')) {
				$('#show-previous-image').click();
			}
			break;

		case 39: // right
			if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(':visible')) {
				$('#show-next-image').click();
			}
			break;

		default:
			return; // exit this handler for other keys
	}
	e.preventDefault(); // prevent the default action (scroll / move caret)
});
//EoL 8.1

const buttonInfo = function(id) {
	var idproduct = id;

	// AJAX request
	$.ajax({
		url: baseUrl + 'CMS/Product_cms/get_product_detail',
		type: 'POST',
		data: { idproduct: idproduct },
		success: function(response) {
			// Add response in Modal body
			$('#modal_body_detail').html(response);

			// Display Modal
			$('#detailProductModal').modal('show');
		}
	});
};

//EoL 8
