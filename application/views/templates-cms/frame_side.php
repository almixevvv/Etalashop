<style>
  .sidebar-custom-bottom {
    border-bottom: 1px solid #00000021;
  }

  .sidebar-custom-top {
    border-top: 1px solid #00000021;
  }
</style>

<ul class="sidebar navbar-nav" style="background-image: linear-gradient(to top, #5bebc3 0%, #a6ffe7 100%);">

  <center>
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-1" href="dashboard">
      <div class="sidebar-brand-icon">
        <img class="img-profile rounded-circle" style="width: 40%" src="<?= base_url(); ?>assets/images/user_medium.jpg">
      </div>
    </a>

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
      <div class="sidebar-brand-icon">
        <label style="font-size: 14px; margin-bottom: -1em;color: #2db4d6">
          User
        </label><br>
        <label style="font-size: 15px; margin-bottom: -1em;color: #6c757d">
          <?= (isset($sess_data) ? $sess_data['user_name'] : ''); ?>
        </label><br>
      </div>
    </a>

    <a class=" d-flex align-items-center justify-content-center" href="dashboard">
      <div class="sidebar-brand-icon">
        <label class="mb-1" style="font-size: 14px; margin-bottom: -1em;color: #2db4d6">
          Group
        </label><br>
        <label style="font-size: 15px; margin-bottom: -1em;color: #6c757d">
          <?= (isset($sess_data) ? $sess_data['user_group'] : ''); ?>
        </label><br>
      </div>
    </a>
  </center>

  <li class="mt-4 nav-item sidebar-custom-bottom sidebar-custom-top">
    <a class="nav-link" href="<?= base_url('cms/dashboard'); ?>">
      <i class="fas fa-fw fa-tachometer-alt" style="color: #2db4d6"></i>
      <span style="color: #6c757d" class="font-weight-bold">Dashboard</span>
    </a>
  </li>

  <?php
  $queryParent = $this->cms->getFramesideParent($sess_data['user_group']);

  if ($queryParent->num_rows() != 0) {
    foreach ($queryParent->result() as $parent) {

      //Transform Name to ID
      $idName = strtoupper($parent->NAME);
      $idName = str_replace(' ', '', $idName);
  ?>

      <li class="nav-item sidebar-custom-bottom">
        <a class="nav-link" href="#<?= $parent->ID; ?>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="<?= $parent->ID; ?>" style="color: #6c757d;">
          <i class="<?= $parent->ICON; ?>" style="color: #2db4d6"></i>
          <span class="font-weight-bold"><?= $parent->NAME; ?></span>
        </a>

        <?php

        $queryChild = $this->cms->getFramesideChild($parent->ID, $sess_data['user_group']);

        if ($queryChild->num_rows() != 0) {
          foreach ($queryChild->result() as $child) {
        ?>

            <div class="collapse" id="<?= $child->APPL_GROUP_ID; ?>">
              <ul style="padding-left: 15px!important; list-style: none;">
                <li class="nav-item active" style="margin-top: -1em;">
                  <a class="nav-link" href="<?= base_url('cms/' . $child->LINK); ?>" style="color: #6c757d;">
                    <i class='<?= $child->DESCRIPTION; ?>' style="color: #2db4d6;"></i>
                    <span><?= $child->NAME; ?></span>
                  </a>
                </li>
              </ul>
            </div>
        <?php }
        } ?>

      </li>

  <?php }
  } ?>

</ul>

<!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#<?= $idName; ?>" aria-expanded="true" aria-controls="<?= $idName; ?>">
          <i class="<?= $parent->ICON; ?>"></i>
          <span><?= $parent->NAME; ?></span>
        </a>
        <div id="<?= $idName; ?>" class="collapse" aria-labelledby="<?= $idName; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <?php

            $queryChild = $this->cms->getFramesideChild($parent->ID, $sess_data['user_group']);

            if ($queryChild->num_rows() != 0) {
              foreach ($queryChild->result() as $child) {
            ?>
                <a class="collapse-item" href="<?= base_url($child->LINK); ?>"><?= $child->NAME; ?></a>
            <?php }
            }
            ?>
          </div>
        </div>
      </li> -->