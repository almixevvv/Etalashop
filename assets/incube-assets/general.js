//1. BaseURL BUAT Javascript
let getUrl = window.location;
let baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + getUrl.pathname.split('/')[1] + '/';

//2. Validasi form buat ngeliat yang kosong
//2.1 Validasi Form Standard
const checkEmptyForm = function(form) {
	let formValue = $(form).find(':input').not('button, :input[type="number"]');

	let emptyCounter = 0;

	//Check for empty value section
	formValue.each(function(index) {
		let curValue = $(this).val();
		let curOptions = $(this).find(':selected').val();

		if (curValue.length == 0 || curOptions == 'none') {
			emptyCounter++;

			let siblingCount = $(this).siblings('.alert').length;

			if (siblingCount == 0) {
				$(this).after(`
                 <div class="mt-2 alert alert-danger" role="alert">
                 Cannot be empty!
                 </div>
             `);
			}
		} else if (curValue.length != 0 || curOptions != 'none') {
			$(this).next('.alert').remove();
		}
	});

	if (emptyCounter != 0) {
		return false;
	} else if (emptyCounter == 0) {
		return true;
	}
};
//EoL 2.1

//2.2 Validasi Form Edit
const checkEmptyEditForm = function(form) {
	let formValue = $(form).find(':input').not('button, :input[type="file"], :input[type="number"]');
	let emptyCounter = 0;

	//Check for empty value section
	formValue.each(function(index) {
		let curValue = $(this).val();
		let curOptions = $(this).find(':selected').val();

		if (curValue.length == 0 || curOptions == 'none') {
			emptyCounter++;

			let siblingCount = $(this).siblings('.alert').length;

			if (siblingCount == 0) {
				$(this).after(`
                 <div class="mt-2 alert alert-danger" role="alert">
                 Cannot be empty!
                 </div>
             `);
			}
		} else if (curValue.length != 0 || curOptions != 'none') {
			$(this).next('.alert').remove();
		}
	});

	if (emptyCounter != 0) {
		return false;
	} else if (emptyCounter == 0) {
		return true;
	}
};
//EoL 2.2
//EoL 2
