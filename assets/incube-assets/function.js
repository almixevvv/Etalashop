/*
  INCUBE JAVASCRIPT


  1. Reset Registration Form Validation
  2. Password Validation
  3. Password Matching Validation
  4. Get Country Data from API
  5. Verification Process
  6. Form Verification Overide
  7. Limit Text Characters
*/

/* 
	1. Reset Validation Form
*/
function resetValidation() {
	$('.needs-validation').removeClass('was-validated');
	console.log('validation reset');
}

/*
	2. Password Format Validation
*/
function checkPassword() {
	var upperCase = new RegExp('[A-Z]');
	var lowerCase = new RegExp('[a-z]');
	var numbers = new RegExp('[0-9]');

	var input = $('#uPass').val();

	if (input.match(upperCase) && input.match(lowerCase) && input.match(numbers) && input.length > 8) {
		$('#uPass').removeClass('is-invalid').addClass('is-valid');
	} else {
		$('#uPass').removeClass('is-valid').addClass('is-invalid');
		$('#uPass2').removeClass('is-valid').addClass('is-invalid');
	}
}

function checkName() {
	var numbers = new RegExp('[0-9]');
	var symbols = new RegExp(/[!-/:-?{-~!"^_`\[\]]/);

	var firstName = $('#uFirstName').val();
	var lastName = $('#uLastName').val();

	if (firstName.match(numbers) || firstName.match(symbols)) {
		// alert('first name ada angka');
		$('#uFirstName').removeClass('is-valid').addClass('is-invalid');
	} else if (lastName.match(numbers) || lastName.match(symbols)) {
		// alert('last name ada angka');
		$('#uLastName').removeClass('is-valid').addClass('is-invalid');
	} else if (!firstName) {
		// alert('nama pertama kosong boi');
		$('#uFirstName').removeClass('is-valid').addClass('is-invalid');
	} else {
		// alert('ada yang lain boi');
		$('#uFirstName').removeClass('is-invalid').addClass('is-valid');
		$('#uLastName').removeClass('is-invalid').addClass('is-valid');
	}
}

function checkProvince() {
	var numbers = new RegExp('[0-9]');

	var province = $('#uProvince').val();

	if (province.match(numbers)) {
		$('#uProvince').removeClass('is-valid').addClass('is-invalid');
	} else if (!province) {
		$('#uProvince').removeClass('is-valid').addClass('is-invalid');
	} else {
		$('#uProvince').removeClass('is-invalid').addClass('is-valid');
	}
}

/*
	3. Password Matching Validation
*/

function matchPassword() {
	var password = $('#uPass').val();
	var confirmPassword = $('#uPass2').val();

	if ((password === confirmPassword || confirmPassword === password) && $('#uPass').hasClass('is-valid')) {
		// alert('password sama');
		$('#uPass2').removeClass('is-invalid').addClass('is-valid');
	} else if (!password) {
		// alert('password atas kosong');
		$('#uPass2').removeClass('is-valid').addClass('is-invalid');
	} else if (!confirmPassword) {
		// alert('password bawah kosong');
		$('#uPass2').removeClass('is-valid').addClass('is-invalid');
	} else {
		// alert('ada yang aneh boi');
		$('#uPass2').removeClass('is-valid').addClass('is-invalid');
	}
}

/*
	4. Get Country Data from API
*/

function getCountry() {
	$.ajax({
		url: 'https://restcountries.eu/rest/v2/all?fields=name;callingCodes;flag',
		type: 'GET',
		success: function(data) {
			var countryData = '';
			$.each(data, function(index, value) {
				//Get country data from API
				$('#uCountry').append(
					$('<option>', {
						value: value.name,
						text: value.name
					})
				);
			});
		},

		error: function(xhr, ajaxOptions, thrownError) {
			var errorMsg = 'Ajax request failed: ' + xhr.responseText;
			console.log(errorMsg);
		}
	});
}

/*
	5. Account Verification Process
*/
function startVerification(email, hash) {
	var baseUrl = document.location.origin + window.location.pathname + 'Register/verification';

	$.ajax({
		url: baseUrl,
		type: 'GET',
		data: { email: email, key: hash },
		success: function(data) {
			console.log(data);

			if (data === 'success') {
				swal.fire({
					title: 'Verification Successful',
					text: 'Account Verification Successful. Happy shopping!',
					type: 'success',
					showCancelButton: false
				});
			} else if (data === 'error') {
				swal.fire({
					title: 'Verification Unsuccessful',
					text: 'Something wrong with your registration process. Please try again later',
					type: 'error',
					showCancelButton: false
				});
			} else if (data === 'verified') {
				swal.fire({
					title: 'Verification Unsuccessful',
					text: 'This account is already verified',
					type: 'info',
					showCancelButton: false
				});
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			var errorMsg = 'Ajax Failed: ' + xhr.responseText;
			console.log(errorMsg);
		}
	});
}

/*
	6. Form Overide
*/

function formOveride() {
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';
		window.addEventListener(
			'load',
			function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener(
						'submit',
						function(event) {
							if (form.checkValidity() === false) {
								event.preventDefault();
								event.stopPropagation();
							}
							form.classList.add('was-validated');
						},
						false
					);
				});
			},
			false
		);
	})();
}

/*
	7. Empty Searchbox Fix
 */

function checkSearch() {
	var mobileQuery = $('#search-query-mobile').val();
	var desktopQuery = $('#search-query-desktop').val();

	if (mobileQuery.trim() || desktopQuery.trim()) {
		$('#searchbox-desktop').submit();
		$('#searchbox-mobile').submit();
	}
}

/*
	9. Get Confer Price
 */

function startVerification(quantity) {}

/*
	10. Set ZIP code to only include numbers 
 */

function zipCodeVerification() {
	$('#uZip').keydown(function(e) {
		var numbers = new RegExp('[0-9]');

		var keyPres = e.which;

		if (keyPres >= 48 && keyPres <= 57) {
			return true;
		} else if (keyPres >= 187 && keyPres <= 190) {
			return false;
		}
	});
}

/* 
	11. Base Url
*/
const getUrl = window.location;
const baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + getUrl.pathname.split('/')[0];

/*
	12. Quantity Verification
*/
function quantityVerification() {
	$('#quantity').keydown(function(e) {
		var numbers = new RegExp('[0-9]');

		var keyPres = e.which;

		console.log(e.which);

		if (keyPres >= 48 && keyPres <= 57) {
			return true;
		} else if (keyPres >= 187 && keyPres <= 190) {
			return false;
		}
	});
}
