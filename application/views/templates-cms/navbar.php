<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark static-top" style="background-color: #ebebeb;">
    <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Kikikuku Logo" style="width: 10%;">

    <button class="btn btn-link btn-sm text order-1 order-sm-0" id="sidebarToggle" href="#" style="color: #6c757d;">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <div class="input-group-append">
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php foreach ($unview_order->result() as $total_unview_order); ?>
          <button type="button" class="btn btn" style="background-color: #2db4d6;color: #ebebeb;font-size: 14px;margin-left: 2em;border: white;"><?php echo $total_unview_order->unview_order; ?>
          </button>
          <label style="font-size: 12px;color: #6c757d;margin-right: 1em;">Incoming Order</label>
        </a>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="modal" data-target="#changePass" data-id="<?php echo $this->session->userdata('id'); ?>">
          <i class="fas fa-lock fa-lg fa-fw mr-2" style="color: orange;margin-top: 0.45em;"></i>
        </a>
      </li>

      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="buttonLogOut" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-sign-out-alt" style="color: #2db4d6;font-size: 20px;margin-top: 0.38em;"></i>
        </a>
      </li>
    </ul>

    <!-- Modal Change Password-->
    <div id="changePass" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-body" style="padding: 0!important;">
            <!-- LOAD THE CONTENT -->
          </div>
        </div>

      </div>
    </div>

  </nav>