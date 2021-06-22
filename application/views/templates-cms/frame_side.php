<ul class="sidebar navbar-nav" style="background-image: linear-gradient(to top, #5bebc3 0%, #a6ffe7 100%);">

<center>
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard" style="margin-top: 1em;">
    <div class="sidebar-brand-icon">
        <img class="img-profile rounded-circle" style="width: 40%" src="<?php echo base_url();?>assets/images/user_medium.jpg">
    </div>
  </a>

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard" style="margin-bottom: 0.5em;">
    <div class="sidebar-brand-icon">
      <label style="font-size: 14px; margin-bottom: -1em;color: #2db4d6">
        User
      </label><br>
      <label style="font-size: 15px; margin-bottom: -1em;color: #6c757d">
        <?php
          echo $this->session->userdata('name');
        ?>
      </label><br>
    </div>
  </a>

  <a class=" d-flex align-items-center justify-content-center" href="dashboard" style="margin-bottom: 0.5em;">
    <div class="sidebar-brand-icon">
      <label style="font-size: 14px; margin-bottom: -1em;color: #2db4d6">
        Group
      </label><br>
      <label style="font-size: 15px; margin-bottom: -1em;color: #6c757d">
        <?php
          echo $this->session->userdata('user_group');
        ?>
      </label><br>
    </div>
  </a>
  <hr style="color: #6c757d;margin-bottom: -0.5em;width: 75%" >
</center>

  <li class="nav-item active" style="margin-bottom: -1em;">
    <a class="nav-link" href="<?php echo base_url('cms/dashboard'); ?>">
      <i class="fas fa-fw fa-tachometer-alt" style="color: #2db4d6"></i>
      <span style="color: #6c757d">Dashboard</span>
    </a>
  </li>
  <?php
    $sql ="SELECT DISTINCT c.ID, c.NAME, c.DESCRIPTION AS ICON
           FROM s_group_appl a
           INNER JOIN s_appl b ON a.APPL_ID = b.ID
           INNER JOIN s_appl_group c ON b.APPL_GROUP_ID = c.ID
           WHERE a.GROUP_ID = '".$this->session->userdata('user_group')."'
           ORDER BY c.ORDER_NO";

    $i = 1;

    $query = $this->db->query($sql);
    foreach($query->result() as $data):
  ?>
  <?php
    //SECOND QUERY TO CHECK IF THERE'S ANY CHILD MENU
    $sql2 ="SELECT DISTINCT *
            FROM s_group_appl a
            INNER JOIN s_appl b ON a.APPL_ID = b.ID
            WHERE a.GROUP_ID='".$this->session->userdata('user_group')."'
            AND APPL_GROUP_ID='".$data->ID."'
            AND b.LINK<>''
            ORDER BY ORDER_NO";

    $query2 = $this->db->query($sql2);
    $total_rows = $query2->num_rows();
  ?>
    <li class="nav-item active" style="margin-bottom: -1em;">
      <a class="nav-link" href="#<?php echo $data->ID; ?>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="<?php echo $data->ID; ?>" style="color: #6c757d;">
        <i class="<?php echo $data->ICON; ?>" style="color: #2db4d6"></i>
        <span><?php echo $data->NAME; ?></span>
      </a>
      <!-- Start query for submenu -->
      <?php foreach($query2->result() as $data2): ?>
        <div class="collapse" id="<?php echo $data2->APPL_GROUP_ID; ?>" >
          <ul style="padding-left: 15px!important; list-style: none;">
            <li class="nav-item active" style="margin-top: -1em;">
              <a class="nav-link" href="<?php echo base_url('cms/'.$data2->LINK); ?>" style="color: #6c757d;">
                <i class='<?php echo $data2->DESCRIPTION;?>' style="color: #2db4d6;"></i>
                <span><?php echo $data2->NAME; ?></span>
              </a>
            </li>
          </ul>
        </div>
      <?php endforeach; ?>
    </li>
  <?php endforeach; ?>
</ul>
