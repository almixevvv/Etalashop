<style>
  .primaryColorStyle {
    color: #337ab7;
  }
</style>

<div id="wrapper">

  <!-- Sidebar -->
  <?php $this->load->view('templates-cms/frame_side'); ?>

  <div id="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addProductModal" data-backdrop="static" data-keyboard="false">+ Add Product</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0" style="font-size:12px">
              <thead>
                <tr>
                  <th width="1%">NO</th>
                  <th width="25%">DESCRIPTION</th>
                  <th width="20%">STATUS</th>
                  <th width="15">IMAGE</th>
                  <th width="5%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;

                //hendry91
                //323

                foreach ($product_master->result() as $dt) {
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>

                    <td>
                      <div class="row">
                        <div class="col-3 pr-0 pl-2">
                          <span class="font-weight-bold">SKU</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-8 pl-2">
                          <span><?= $dt->SKU; ?></span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-3 pr-0 pl-2">
                          <span class="font-weight-bold">Name</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-8 pl-2">
                          <span><?= $dt->PRODUCT_NAME; ?></span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-3 pr-0 pl-2">
                          <span class="font-weight-bold">ID</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-8 pl-2">
                          <span><?= $dt->PRODUCT_ID; ?></span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-3 pr-0 pl-2">
                          <span class="font-weight-bold">Cat</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-8 pl-2">
                          <span><?= $dt->CATEGORY; ?></span>
                        </div>
                      </div>


                    </td>

                    <td>
                      <div class="row">
                        <div class="col-5 pr-0 pl-2">
                          <span class="font-weight-bold">STATUS</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-6 pl-2">
                          <span class="primaryColorStyle"><?= $dt->STATUS; ?></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-5 pr-0 pl-2">
                          <span class="font-weight-bold">CREATED</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-6 pl-2">
                          <span><?= date('Y-m-d', strtotime($dt->CREATED)); ?></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-5 pr-0 pl-2">
                          <span class="font-weight-bold">UPDATED</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-6 pl-2">
                          <span><?= ($dt->UPDATED != null ? date('Y-m-d', strtotime($dt->UPDATED)) : '-'); ?></span>
                        </div>
                      </div>
                      <!-- <label style="width: 5em; font-weight: bold;">STATUS</label><label>:</label> <label style="font-weight: bold;color: #337ab7;"><?= $dt->STATUS; ?></label><br>
                      <label style="width: 5em; font-weight: bold;">CREATED</label><label>:</label> <label style="font-weight: bold;color: #337ab7;"><?= $dt->CREATED; ?></label><br>
                      <label style="width: 5em; font-weight: bold;">UPDATED</label><label>:</label> <label style="font-weight: bold;color: #337ab7;"><?= $dt->UPDATED; ?></label><br> -->
                    </td>

                    <td>
                      <div class="row">
                        <div class="col-12">
                          <div class="w-100">
                            <img class="img-fluid" src="<?= $dt->IMAGES1; ?>" alt="<?= $dt->PRODUCT_NAME; ?>">
                          </div>
                        </div>
                      </div>

                    </td>

                    <td>
                      <button class="btn btn-info" style="width: 8em;font-size: 12px;margin-bottom: 1em;" type="button" data-toggle="modal">DETAIL</button>
                      <button class="btn btn-warning" style="width: 8em;font-size: 12px;margin-bottom: 1em;" type="button" data-toggle="modal" data-target="#editProductModal" data-id="<?php echo $dt->PRODUCT_ID; ?>">EDIT</button>
                      <a href="<?php echo base_url() . "/cms/Product_cms/delete_product?id=" . $dt->PRODUCT_ID ?>" class="btn btn-danger" style="width: 8em;font-size: 12px;margin-bottom: 1em;">DELETE</a>
                    </td>
                  </tr>
                <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Add Product -->
    <div id="addProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addProduct" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <form id="addProduct" action="<?= base_url('CMS/Product_cms/add_product') ?>" method="POST" enctype='multipart/form-data'>
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-light">Add Products</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="txtPRODID">Product ID</label>
                    <input type="text" class="form-control" id="txtPRODID" name="txtPRODID" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="txtPRODSKU">SKU</label>
                    <input type="text" class="form-control" id="txtPRODSKU" name="txtPRODSKU" placeholder="SKU Number">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="txtPRODName">Name</label>
                    <input type="text" class="form-control" id="txtPRODName" name="txtPRODName" placeholder="Product Name">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="txtPRODCategory">Category</label>
                    <input type="text" class="form-control" id="txtPRODCategory" name="txtPRODCategory" aria-describedby="categoryHelp">
                    <small id="categoryHelp" class="form-text text-muted">Press <strong>SPACE</strong> to show all categories.</small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Image</label>
                    <div class="card" id="previewHolder">
                      <div class="card-body">
                        <div class="d-flex flex-column" id="preview">
                          <div class="justify-content-center" id="fatherPreview">
                          </div>
                          <div class="d-flex flex-row justify-content-around mt-2" id="motherPreview">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="custom-file mt-2">
                      <input type="file" class="custom-file-input" id="filePRODImage" name="filePRODImage[]" accept="image/*" multiple>
                      <label class="custom-file-label" for="filePRODImage">Choose files*</label>
                    </div>
                    <div class="alert alert-danger mt-2" role="alert">
                      *Maximum 4 images (JPG, JPEG, PNG) <br>
                      *(Max 2MB)
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <label for="txtQUAN">Quantity</label>
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="txtQUANMin" name="txtQUANMin[]" placeholder="Minimum">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="txtQUANMax" name="txtQUANMax[]" placeholder="Maximum">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="txtQUANPrice" name="txtQUANPrice[]" placeholder="Price">
                      </div>
                    </div>
                    <!--  -->
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="txtQUANMin" name="txtQUANMin[]" placeholder="Minimum">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="txtQUANMax" name="txtQUANMax[]" placeholder="Maksimum">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="txtQUANPrice" name="txtQUANPrice[]" placeholder="Price">
                      </div>
                    </div>
                    <!--  -->
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="txtQUANMin" name="txtQUANMin[]" placeholder="Minimum">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="txtQUANMax" name="txtQUANMax[]" placeholder="Maksimum">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="txtQUANPrice" name="txtQUANPrice[]" placeholder="Price">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <!-- <div class="form-group">
                    <label for="txtPRODDetail">Detail</label>
                    <input type="text" class="form-control" id="txtPRODDetail" name="txtPRODDetail" placeholder="Product Detail">
                  </div> -->
                  <div class="form-group">
                    <label for="editCATDesc">Description</label>
                    <textarea name="txtPRODDetail" id="txtPRODDetail"></textarea>
                  </div>
                </div>

              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-info" id="btnSaveProduct">Save Products</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    <!-- /Modal Add Product -->

    <!-- Modal Edit Product -->
    <div id="editProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProductModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <form id="editProduct">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-light">Add Products</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="editPRODID">Product ID</label>
                    <input type="text" class="form-control" id="editPRODID" name="editPRODID" placeholder="Product ID">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="editPRODName">Name</label>
                    <input type="text" class="form-control" id="editPRODName" name="editPRODName" placeholder="Product Name">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="editPRODCategory">Category</label>
                    <input type="text" class="form-control" id="editPRODCategory" name="editPRODCategory" placeholder="Category">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="editPRODDetail">Detail</label>
                    <input type="text" class="form-control" id="editPRODDetail" name="editPRODDetail" placeholder="Product Detail">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Image</label>
                    <div class="card" id="previewHolder">
                      <div class="card-body">
                        <div class="d-flex flex-column" id="preview">
                          <div class="justify-content-center" id="fatherPreview">
                          </div>
                          <div class="d-flex flex-row justify-content-around mt-2" id="motherPreview">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="custom-file mt-2">
                      <input type="file" class="custom-file-input" id="filePRODImage" name="filePRODImage[]" accept="image/*" multiple>
                      <label class="custom-file-label" for="filePRODImage">Choose files*</label>
                    </div>
                    <div class="alert alert-danger mt-2" role="alert">
                      *Maximum 4 image
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <label for="editQUAN">Quantity</label>
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="editQUANMin" name="editQUANMin" placeholder="Minimal">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="editQUANMax" name="editQUANMax" placeholder="Maximal">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="number" class="form-control" id="editQUANPrice" name="editQUANPrice" placeholder="Price">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-info" id="btnSaveProduct">Save products</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    <!-- /Modal Edit Product -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © Incube Solutions 2019</span>
        </div>
      </div>
    </footer>

  </div>
  <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/cms/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-4/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/cms/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url('assets/cms/chart.js/Chart.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/cms/datatables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('assets/cms/datatables/dataTables.bootstrap4.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/cms/js/sb-admin.min.js'); ?>"></script>

<!-- Demo scripts for this page-->
<script src="<?php echo base_url('assets/cms/js/demo/datatables-demo.js'); ?>"></script>
<script src="<?php echo base_url('assets/cms/js/demo/chart-area-demo.js'); ?>"></script>


<link rel="stylesheet" href="<?= base_url('assets/sweet-alert/sweetalert2.min.css'); ?>" />
<script src="https://cdn.tiny.cloud/1/5so9csec4pxx56cgo27virgc2e2qpe35odaxln6p1fqifgld/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="<?= base_url('assets/autocomplete/jquery.autocomplete.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/autocomplete/autocomplete.css'); ?>">

<!-- <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.1.3/dist/autoComplete.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.1.3/dist/css/autoComplete.min.css"> -->


<!-- <?php

      $tmpData = $this->session->userdata('inputError');

      if (isset($tmpData) && $tmpData === true) { ?>
  <script>
    swal.fire({
      title: "System Error",
      text: "Cannot complete process, try again later",
      type: "error",
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: "Confirm",
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php } else if ($this->session->userdata('inputError') == false) { ?>
  <script>
    swal.fire({
      title: "Process Completed",
      text: "Data inserted",
      type: "success",
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: "Confirm",
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php } ?> -->

<script>
  //HEADER BUAT LOCALHOST
  let getUrl = window.location;
  let baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + getUrl.pathname.split('/')[1] + '/';

  var countries = [];

  const checkEmptyForm = function(form) {
    let formValue = $(form).find(':input').not('button');
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

  $.get(baseUrl + 'API/getAllCategories', function(resp) {
    $.each(resp, function(index, value) {
      let ctgData;
      ctgData = {
        value: value.data,
        data: value.value
      }
      countries.push(ctgData);
    });
  });

  //Detect modal kebuka, tanpa ini - script ga bakalan bisa jalan
  $('#addProductModal').on('show.bs.modal', function(event) {

    //Generate Product ID
    $.get(baseUrl + 'API/generatePID', {
      key: 'c549303dcef12a687e9077a21e1a51fb67851efb'
    }, function(resp) {

      if (resp.code == 200) {
        $('#txtPRODID').val(resp.message);
      } else {
        swal.fire({
          title: "Network Error",
          text: "Cannot generate PID, please try again later",
          type: "warning",
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonText: "Confirm",
          confirmButtonColor: '#3085d6'
        });
      }
    });

    $('#txtPRODCategory').autocomplete({
      lookup: countries,
      onSelect: function(suggestion) {
        console.log(suggestion);
      }
    });

    tinymce.init({
      selector: 'textarea#txtPRODDetail',
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating'
    });

    $('#addProduct').submit(function(ex) {
      ex.preventDefault();

      let emptyCheck = checkEmptyForm(this);

      if (emptyCheck) {
        $('#addProduct')[0].submit();
      }
    })


  });
</script>