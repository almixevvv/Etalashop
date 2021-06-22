<div id="wrapper">

  <!-- Sidebar -->


  <div id="content-wrapper" style="background-color: #f7f7f7;">

    <div class="container-fluid">

      <!-- ABOUT PART -->
      <div class="card mb-3">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <label style="">Filter by Level :</label><br>
              <?php if ($this->input->get('query') == 'all') : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=all'); ?>">
                  <button class="btn btn-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">ALL</button>
                </a>
              <?php else : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=all'); ?>">
                  <button class="btn btn-outline-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">ALL</button>
                </a>
              <?php endif; ?>

              <?php if ($this->input->get('query') == 'silver') : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=silver'); ?>">
                  <button class="btn btn-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">SILVER</button>
                </a>
              <?php else : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=silver'); ?>">
                  <button class="btn btn-outline-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">SILVER</button>
                </a>
              <?php endif; ?>

              <?php if ($this->input->get('query') == 'gold') : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=gold'); ?>">
                  <button class="btn btn-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">GOLD</button>
                </a>
              <?php else : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=gold'); ?>">
                  <button class="btn btn-outline-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">GOLD</button>
                </a>
              <?php endif; ?>

              <?php if ($this->input->get('query') == 'diamond') : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=diamond'); ?>">
                  <button class="btn btn-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">DIAMOND</button>
                </a>
              <?php else : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=diamond'); ?>">
                  <button class="btn btn-outline-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">DIAMOND</button>
                </a>
              <?php endif; ?>
            </div>

            <div class="col-lg-6">
              <label style="">Filter by Status :</label><br>
              <?php if ($this->input->get('query') == 'new') : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=new'); ?>">
                  <button class="btn btn-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">NEW</button>
                </a>
              <?php else : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=new'); ?>">
                  <button class="btn btn-outline-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">NEW</button>
                </a>
              <?php endif; ?>

              <?php if ($this->input->get('query') == 'active') : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=active'); ?>">
                  <button class="btn btn-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">ACTIVE</button>
                </a>
              <?php else : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=active'); ?>">
                  <button class="btn btn-outline-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">ACTIVE</button>
                </a>
              <?php endif; ?>

              <?php if ($this->input->get('query') == 'inactive') : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=inactive'); ?>">
                  <button class="btn btn-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">INACTIVE</button>
                </a>
              <?php else : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=inactive'); ?>">
                  <button class="btn btn-outline-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">INACTIVE</button>
                </a>
              <?php endif; ?>

              <?php if ($this->input->get('query') == 'not') : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=not'); ?>">
                  <button class="btn btn-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">NOT LINKED</button>
                </a>
              <?php else : ?>
                <a style="text-decoration: none!important;" href="<?php echo base_url('seller/cms/sales/filter?query=not'); ?>">
                  <button class="btn btn-outline-primary" style="font-weight: bold; font-size: 11px; margin-left: 1em; width: 20%;">NOT LINKED</button>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <!-- <?php echo $this->session->userdata('ID') ?> -->
            <!-- <button type="button" class="btn btn-success" style="width: 5%;font-size: 12px;margin-bottom: 1em;" data-toggle="modal" data-target="#addNewProduk"><i class="fas fa-plus"></i></button> -->
            <table class="table table-bordered" id="dataTable" cellspacing="0" style="font-size:12px">
              <thead>
                <tr>
                  <th width="1%">NO</th>
                  <th width="34%">COMPANY INFO</th>
                  <th width="10%">LEVEL</th>
                  <th width="15%">TOTAL SALES <?php echo date('Y'); ?></th>
                  <th width="15%">TOTAL SALES <?php echo date('Y') - 1; ?></th>
                  <th width="15%">TOTAL SALES <?php echo date('Y') - 2; ?></th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- end content -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<link rel="stylesheet" href="<?php echo base_url('reseller/assets/sweet-alert/sweetalert2.min.css'); ?>" />
<script type="text/javascript">
  var curYear = new Date().getFullYear();
  var lastYear = new Date().getFullYear() - 1;
  var twoYear = new Date().getFullYear() - 2;
  var tableBody = $('tbody');

  var mainData

  $.get(baseUrl + 'cms_reseller/Sales/getAllReseller', function(ex) {
    $.each(ex.data, function(index, value) {

      $.get('http://113.20.29.27:8088/SQS/api/action/totalSales.php', {
        resellerID: value.CID,
        companyID: 'IIS_SI'
      }, function(val) {

        let curData, lastData, pastData;

        $.each(val.data, function(index, value) {
          switch (value.YEAR) {
            case curYear:
              curData = value.TOTAL;
              break;
            case lastYear:
              lastData = value.TOTAL;
              break;
            case twoYear:
              pastData = value.TOTAL;
              break;
          }
        });

        tableBody.append("<tr><td>" + value.COUNTER + "</td>" +
          "<td>" + value.COMPANY_INFO + "</td>" +
          "<td>" + value.CATEGORY + "</td>" +
          "<td style='text-align: right;'>" + (curData == null ? '' : curData) + "</td>" +
          "<td style='text-align: right;'>" + (lastData == null ? '' : lastData) + "</td>" +
          "<td style='text-align: right;'>" + (pastData == null ? '' : pastData) + "</td>" + "</tr>");
      });

    });

  });

  // $('#dataTable').DataTable();
</script>
</script>
</body>