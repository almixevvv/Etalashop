<!-- CUSTOM DATE PICKER JAVASCRIPT -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="registration-container">

	<form action="<?php echo base_url('General/Register/input'); ?>" method="POST" class="needs-validation" novalidate>
 
		<div id="registration-inner-container">

			<div class="row"> 
				<div class="col-12">
					<div class="row pb-md-2 pb-lg-2 pb-xl-2 pt-md-1 pt-lg-1 pt-xl-1">
						<div class="col-12 pt-3 pb-3 pt-md-0 pt-lg-0 pt-xl-0 pb-md-0 pb-lg-0 pb-xl-0">
							<div class="d-flex justify-content-center">
								<span class="text-uppercase font-weight-bold login-text-color">Registration</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">

				<!-- REGISTRATION LEFT -->
				<div class="col-12 col-md-6 col-lg-6 col-xl-6">

					<div class="row">
						<div class="col-12 col-md-12 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="uFirstName">First Name</label>
								<?php if (isset($socialData['firstName'])) { ?>
									<input value="<?php echo $socialData['firstName']; ?>" type="text" class="form-control" name="uFirstName" id="uFirstName" onfocus="resetValidation()" placeholder="Enter Your First Name" required>
								<?php } else { ?>
									<input type="text" class="form-control" name="uFirstName" id="uFirstName" onfocus="resetValidation()" placeholder="Enter Your First Name" required>
								<?php } ?>
								<div class="invalid-feedback">
									Please enter valid first name
								</div>
							</div>
						</div>

						<div class="col-12 col-md-12 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="uLastName">Last Name</label>
								<?php if (isset($socialData['lastName'])) { ?>
									<input value="<?php echo $socialData['lastName']; ?>" type="text" class="form-control" name="uLastName" id="uLastName" placeholder="Enter Your Last Name">
								<?php } else { ?>
									<input type="text" class="form-control" name="uLastName" id="uLastName" placeholder="Enter Your Last Name">
								<?php } ?>
								<div class="invalid-feedback">
									Please enter valid last name
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="uEmail">Email Address</label>
								<?php if (isset($socialData['email'])) { ?>
									<input value="<?php echo $socialData['email']; ?>" type="email" class="form-control" name="uEmail" id="uEmail" onfocus="resetValidation()" aria-describedby="emailHelp" placeholder="something@mail.com" onblur="checkExistingEmail()" required>
								<?php } else { ?>
									<input type="email" class="form-control" name="uEmail" id="uEmail" onfocus="resetValidation()" aria-describedby="emailHelp" placeholder="something@mail.com" onblur="checkExistingEmail()" required>
								<?php } ?>
								<div class="invalid-feedback">
									This email is not available
								</div>
								<div class="valid-feedback">
									This email is available
								</div>
								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div>
						</div>
					</div>

					<div class="row">

						<div class="col-12 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="uEmail">Phone Number</label>
								<input type="number" class="form-control" name="uPhone" onfocus="resetValidation()" id="uPhone" aria-describedby="numberHelp" placeholder="08XXXXXXXXX" required>
								<small id="numberHelp" class="form-text text-muted">We'll never share your phone number with anyone else.</small>
								<div class="invalid-feedback">
									Valid phone number is required
								</div>
							</div>
						</div>

						<div class="col-12 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="datepicker">Birthdate</label>
								<input id="datepicker" class="form-control" name="uBirthdate" required>
							</div>
						</div>

					</div>

					<div class="row">

						<div class="col-12 col-md-6 col-lg-4 co-xl-4">
							<div class="form-group">
								<label for="uCountry">Country</label>
								<select class="form-control" id="uCountry" name="uCountry" onfocus="getCountry()">
								</select>
							</div>
						</div>

						<div class="col-12 col-md-6 col-lg-4 col-xl-4">
							<div class="form-group">
								<label for="uProvince">Province</label>
								<input id="uProvince" type="text" class="form-control" name="uProvince" required>
								<div class="invalid-feedback">
									Valid province is required
								</div>
							</div>
						</div>

						<div class="col-12 col-md-6 col-lg-4 col-xl-4">
							<div class="form-group">
								<label for="uZip">Zip Code</label>
								<input type="number" class="form-control" name="uZip" onfocus="resetValidation()" id="uZip" placeholder="xxxxxx" required>
							</div>
						</div>

					</div>

				</div>

				<!-- REGISTRATION RIGHT -->
				<div class="col-12 col-md-6 col-lg-6 col-xl-6">

					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="uAddress1">Address</label>
								<input type="text" class="form-control" name="uAddress1" onfocus="resetValidation()" id="uAddress1" aria-describedby="addressHelp" placeholder="Address" required>
								<div class="invalid-feedback">
									Address is required
								</div>
								<small id="addressHelp" class="form-text text-muted">We'll never share your address with anyone else.</small>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="uAddress1">Address 2</label>
								<input type="text" class="form-control" name="uAddress2" id="uAddress2" onfocus="resetValidation()" aria-describedby="addressHelp2" placeholder="Address 2">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="uPass">Password</label>
								<input type="password" class="form-control" name="uPass" id="uPass" onfocus="resetValidation()" aria-describedby="passHelp" placeholder="Password" required>
								<div class="invalid-feedback">
									Password is invalid
								</div>
								<small id="passHelp" class="form-text text-muted">Your password must be more than 8 characters, include a capital letter and a number.</small>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="uPass2">Confirm Password</label>
								<input type="password" class="form-control" id="uPass2" onfocus="resetValidation()" aria-describedby="passHelp" required>
								<div class="invalid-feedback">
									Password doesn't match
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

			<!-- REGISTRATION BUTTTON -->
			<div class="row">
				<div class="col-9 col-md-12 col-lg-12 col-xl-12">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="agree" id="uTerms" onfocus="resetValidation()" required>
						<label class="form-check-label" for="uTerms">
							I agree to ETALAshop <a href="<?php echo base_url('terms'); ?>">Terms of Service</a>
						</label>
						<div class="invalid-feedback">
							You must agree to our Terms of Service
						</div>
					</div>
				</div>
			</div>

			<!-- HIDDEN INPUT FOR IMAGE -->
			<?php if (isset($socialData['email'])) { ?>
				<input type="hidden" name="uImage" id="uImage" value="<?php echo $socialData['picture']; ?>">
			<?php } ?>

			<div class="row">
				<div class="col-5 col-md-3 col-lg-3 col-xl-3 pb-4 pb-md-0 pb-lg-0 pb-xl-0">
					<button type="submit" class="btn btn-kku" style="width:100%;">Register</button>
				</div>
			</div>

		</div>

	</form>
</div>

<script type="text/javascript">
	<?php if ($this->session->has_userdata('google_id')) { ?>
		swal.fire({
			text: 'To start shopping, please complete your registration process',
			showCancelButton: false,
		});
	<?php } ?>
	$('#datepicker').datepicker({
		uiLibrary: 'bootstrap4'
	});

	$('#uPass').change(function() {
		checkPassword();
		matchPassword();
	});

	$('#uFirstName').change(function() {
		checkName();
	});

	$('#uLastName').change(function() {
		checkName();
	});

	$('#uPass2').change(function() {
		matchPassword();
	});

	$('#uProvince').change(function() {
		checkProvince();
	});

	function checkExistingEmail() {

		var email = $('#uEmail').val();

		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

		if (email.match(mailformat)) {

			$("#uEmail").removeClass("is-invalid").addClass("is-valid");

			$.ajax({
				url: "<?php echo base_url('Register/checkExistingEmail'); ?>",
				type: "GET",
				data: {
					email: email
				},
				success: function(result) {
					if (result === 'existing') {
						$('#uEmail').removeClass("is-valid").addClass("is-invalid");
					} else {
						$("#uEmail").removeClass("is-invalid").addClass("is-valid");
					}
				}
			});

		} else {
			$('#uEmail').removeClass("is-valid").addClass("is-invalid");
		}

	}

	formOveride();
	zipCodeVerification();
</script>