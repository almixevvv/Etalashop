<!-- MOBILE NAVBAR -->
<header class="header-mobile" id="fixed-navbar">

	<div class="row" style="width: 100%; margin-left: 0!important; margin-right: 0!important;">
		<div class="col-12" style="padding-left: 0!important; padding-right: 0!important;">
			<div id="header-separator"></div>
		</div>
	</div>

	<div class="row" style="width: 100%; margin-left: 0!important; margin-right: 0!important;">
		<div class="col-12" id="navbar-upper">
			<div class="float-left">
				<span class="navbar-text">ETALAshop App Coming Soon</span>
			</div>
			<div class="float-right">
				<span class="navbar-text">
					<a href="<?php echo base_url('about-us'); ?>">About ETALAshop</a>
				</span>
				<span class="navbar-text" style="padding-left: 2em;">
					<a href="<?php echo base_url('how-to'); ?>">Help Centre</a>
				</span>
			</div>
		</div>
	</div>

	<div id="navbar-main" class="row" style="width: 100%; margin-left: 0!important; margin-right: 0!important;">
		<div class="navbar-column-logo">
			<a href="<?php echo base_url(); ?>">
				<img src="<?php echo base_url('assets/images/logo2.png'); ?>" alt="ETALAshop Main Logo" id="main-logo">
			</a>
		</div>

		<div class="navbar-column-searchbox">

			<form action="<?php echo base_url('search'); ?>" id="searchbox-mobile" method="get">

				<div class="input-group mb-3" style="padding-top: 8px;">
					<?php if ($this->input->get('query') != null) : ?>
						<input type="text" class="form-control" name="query" placeholder="Product Keywords" style="margin-left: -3px;" value="<?php echo $this->input->get('query'); ?>">
					<?php else : ?>
						<input id="search-query-mobile" type="text" class="form-control" name="query" placeholder="Product Keywords" style="margin-left: -3px;">
					<?php endif; ?>
					<div class="input-group-append">
						<a onclick="checkSearch()" class="btn btn-outline-secondary button-search-custom">
							<i class="fas fa-search"></i>
						</a>
					</div>
				</div>

			</form>

		</div>

		<div class="navbar-column-account">

			<span class="mobile-icon" id="account-left">
				<a href="<?php echo base_url('mycart'); ?>">
					<i class="fas fa-shopping-cart"></i>
				</a>
			</span>

			<?php
			//ASSIGN SESSION TO LOCAL VARIABLE
			$userData = $this->session->user_data;
			if (isset($userData['EMAIL'])) {
			?>
				<span class="mobile-icon account-position-fix dropdown-toggle" id="dropdown-account-mobile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10, 10">
					<a href="<?php echo base_url(); ?>">
						<i class="fas fa-user-circle"></i>
					</a>
				</span>
				<div class="dropdown-menu" aria-labelledby="dropdown-account-mobile">
					<a class="dropdown-item" href="<?php echo base_url('profile/transaction'); ?>">Transaction History</a>
					<a class="dropdown-item" href="<?php echo base_url('profile/myprofile'); ?>">My Profile</a>
					<a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a>
				</div>
			<?php } else { ?>
				<span class="mobile-icon account-position-fix">
					<a href="<?php echo base_url('login'); ?>">
						<i class="fas fa-user"></i>
					</a>
				</span>
			<?php } ?>
		</div>
	</div>

</header>

<!-- DESKTOP NAVBAR -->
<header class="header-desktop" id="fixed-navbar">
	<div class="row" style="width: 100%; margin-left: 0!important; margin-right: 0!important;">
		<div id="header-separator"></div>
	</div>

	<div class="row" style="width: 100%; margin-left: 0!important; margin-right: 0!important;">
		<div class="col-12 col-lg-12 col-md-12 col-xl-12" id="navbar-upper">
			<div class="float-left">
				<span class="navbar-text">ETALAshop App Coming Soon</span>
			</div>
			<div class="float-right">
				<span class="navbar-text">
					<a href="<?php echo base_url('about-us'); ?>">About ETALAshop</a>
				</span>
				<span class="navbar-text" style="padding-left: 2em;">
					<a href="<?php echo base_url('how-to'); ?>">Help Centre</a>
				</span>
			</div>
		</div>
	</div>

	<div class="navbar-container" id="navbar-main">

		<div class="row" style="width: 100%; height: 100%; margin-left: 0!important; margin-right: 0!important;">

			<div class="navbar-column-logo">
				<a class="navbar-brand" href="<?php echo base_url(); ?>">
					<img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="ETALAshop Main Logo" id="main-logo">
				</a>
			</div>

			<div class="navbar-column-searchbox" id="search-box-container">

				<ul class="list-inline">
					<li class="list-inline-item" id="search-text">
						<span class="navbar-text" style="padding-top: 17px;">
							Search
						</span>
					</li>
					<li class="list-inline-item" id="main-search-box">

						<form action="<?php echo base_url('search'); ?>" id="searchbox-desktop" method="get">
							<div class="input-group mb-3" style="padding-top: 8px;">
								<?php if ($this->input->get('query') != null) : ?>
									<input type="text" class="form-control" name="query" placeholder="Products Keywords" aria-label="Search Query" value="<?php echo $this->input->get('query'); ?>">
								<?php else : ?>
									<input id="search-query-desktop" type="text" class="form-control" name="query" placeholder="Products Keywords" aria-label="Search Query">
								<?php endif; ?>
								<div class="input-group-append">
									<a class="btn btn-outline-secondary button-search-custom" onclick="checkSearch()">
										<i class="fas fa-search"></i>
									</a>
								</div>
							</div>
						</form>

					</li>
				</ul>

			</div>

			<div class="navbar-column-account"> 

				<span id="account-left">
					<a href="<?php echo base_url('mycart'); ?>">
						<i class="fas fa-shopping-cart" id="icon-shopping-cart"></i>
					</a>
				</span>

				<?php
				//ASSIGN SESSION TO LOCAL VARIABLE
				$userData = $this->session->user_data;
				if (isset($userData['EMAIL'])) {
				?>
					<span class="account-position-fix dropdown-toggle" id="dropdown-account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="20,15">
						<a href="#" style="color: #C1C1C1;">
							<?php if (!isset($userData['IMAGE'])) { ?>
								<img src="<?php echo $userData['IMAGE']; ?>" alt="<?php echo $userData['FIRST_NAME']; ?> Profile Image" id="navbar-account-profile" onError="this.onerror=null;this.src='<?= base_url('assets/images/member-img/no-profile.png') ?>'" style="width: 30px">
							<?php } else { ?>
								<i class="fas fa-user-circle" id="navbar-account-logo"></i>
							<?php } ?>
							<span style="color: black;">
								<?php echo $userData['FIRST_NAME']; ?>
							</span>
						</a>
					</span>
					<div class="dropdown-menu" aria-labelledby="dropdown-account">
						<a class="dropdown-item" href="<?php echo base_url('profile/transaction'); ?>">
							Transaction History
						</a>
						<a class="dropdown-item" href="<?php echo base_url('profile/myprofile'); ?>">My Profile</a>
						<a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a>
					</div>
				<?php } else { ?>
					<span class="account-position-fix-no-pad">
						<a href="<?php echo base_url('login'); ?>" id="navbar-login-button">
							<span style="color: rgba(0,0,0,.7);">Login</span>
						</a>
					</span>
					<span class="account-position-fix-no-pad">
						<a href="<?php echo base_url('register'); ?>" id="navbar-register-button">
							<span>Register</span>
						</a>
					</span>
				<?php } ?>

			</div>

		</div>

	</div>

</header>