<style>
  .primaryColorStyle {
    color: #337ab7;
  }

  #previewHolder .card-body {
    padding: .7rem;
  }

  #fatherPreview img {
    object-fit: contain;
    width: 100%;
    height: 150px;
  }

  #motherPreview img {
    width: 100%;
    height: auto;
    object-fit: contain;
  }

  .container-preview {
    width: 400px;
    position: relative;
  }
</style>

<div id="wrapper">

  <!-- Sidebar -->
  <?php $this->load->view('templates-cms/frame_side'); ?>

  <div id="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <button class="btn" style="background-color: #33969c; color: #fff; font-weight: bold" type="button" data-toggle="modal" data-target="#addProductModal" data-backdrop="static" data-keyboard="false">+ Add Product</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0" style="font-size:12px">
              <thead>
                <tr>
                  <th width="1%">NO</th>
                  <th width="30%">PRODUCT INFO</th>
                  <th width="25%">MORE INFO</th>
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
                          <span class="font-weight-bold">ID Product</span>
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
                          <span class="font-weight-bold">Category</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-8 pl-2">
                          <span><?= $dt->CATEGORY_NAME; ?></span>
                        </div>
                      </div>


                    </td>

                    <td>
                      <div class="row">
                        <div class="col-4 pr-0 pl-2">
                          <span class="font-weight-bold">STATUS</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-7 pl-2">
                          <span class="primaryColorStyle"><?= $dt->STATUS; ?></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4 pr-0 pl-2">
                          <span class="font-weight-bold">CREATED</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-7 pl-2">
                          <span><?= date('Y-m-d', strtotime($dt->CREATED)); ?></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4 pr-0 pl-2">
                          <span class="font-weight-bold">UPDATED</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-7 pl-2">
                          <span><?= ($dt->UPDATED != null ? date('Y-m-d', strtotime($dt->UPDATED)) : '-'); ?></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4 pr-0 pl-2">
                          <span class="font-weight-bold">USER</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-7 pl-2">
                          <span><?= 'temporary'; ?></span>
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
                            <img class="img-fluid" style="width:100%" src="<?= base_url('assets/uploads/products/' . $dt->IMAGES1); ?>" alt="<?= $dt->PRODUCT_NAME; ?>">
                          </div>
                        </div>
                      </div>
                    </td>

                    <td>
                      <button class="btn btn-info" style="width: 8em;font-size: 12px;margin-bottom: 1em;" type="button" data-toggle="modal">DETAIL</button>
                      <button class="btn btn-warning" style="width: 8em;font-size: 12px;margin-bottom: 1em;" type="button" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#editProductModal" data-id="<?= $dt->PRODUCT_ID; ?>">EDIT</button>
                      <a href="<?= base_url('cms/Product_cms/delete_product?id=' . $dt->PRODUCT_ID) ?>" class="btn btn-danger" style="width: 8em;font-size: 12px;margin-bottom: 1em;">DELETE</a>
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
            <div class="modal-header" style="background-color: #ababab">
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
                    <label for="txtPRODWeight">Weight (Kg)</label>
                    <input type="number" class="form-control" id="txtPRODWeight" name="txtPRODWeight" placeholder="Example : 8,9">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Product Image</label>
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

                <div class="col-6 priceContainer">
                  <label for="txtQUAN">Price Setting</label>
                  <div class="row originalPrice">
                    <div class="col-12">
                      <div class="d-flex">

                        <div class="form-group mr-2">
                          <input type="number" class="form-control txtQUANMin" name="txtQUANMin[]" placeholder="Min Qty">
                        </div>

                        <div class="form-group mr-2">
                          <input type="number" class="form-control txtQUANMax" name="txtQUANMax[]" placeholder="Max Qty">
                        </div>

                        <div class="form-group mr-2">
                          <input type="number" class="form-control txtQUANPrice" name="txtQUANPrice[]" placeholder="Price">
                        </div>

                        <div class="form-group">
                          <button type="button" class="btn btn-danger btnRemoveRow" disabled>X</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="row priceButton">
                    <div class="col-12">
                      <button type="button" class="btn btn-info w-100 px-3 btnAddRow">+ Add Quantity</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="editCATDesc">Description</label>
                    <textarea name="txtPRODDetail" id="txtPRODDetail"></textarea>
                  </div>
                </div>

              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-info btnSaveProduct">Save Products</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /Modal Add Product -->

    <!-- Modal Edit Product -->
    <div id="editProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProductModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <form id="editProduct" action="<?= base_url('CMS/Product_cms/edit_product') ?>" method="POST" enctype='multipart/form-data'>
          <div class="modal-content">
            <div class="modal-header" style="background-color: #ababab">
              <h5 class="modal-title text-light">Edit Products</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="editPRODID">Product ID</label>
                    <input type="text" class="form-control" id="editPRODID" name="editPRODID" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="editPRODSKU">SKU</label>
                    <input type="text" class="form-control" id="editPRODSKU" name="editPRODSKU" placeholder="SKU Number">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="editPRODName">Name</label>
                    <input type="text" class="form-control" id="editPRODName" name="editPRODName" placeholder="Product Name">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="editPRODCategory">Category</label>
                    <input type="text" class="form-control" id="editPRODCategory" name="editPRODCategory" aria-describedby="categoryHelp">
                    <small id="categoryHelp" class="form-text text-muted">Press <strong>SPACE</strong> to show all categories.</small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="editPRODWeight">Weight (Kg)</label>
                    <input type="number" class="form-control" id="editPRODWeight" name="editPRODWeight" placeholder="Weight">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Product Image</label>
                    <div class="card" id="previewHolder">
                      <div class="card-body">
                        <div class="d-flex flex-column" id="preview">
                          <div class="justify-content-center father-preview" id="fatherPreview">
                          </div>
                          <div class="d-flex flex-row justify-content-around mt-3 mother-preview" id="motherPreview">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="custom-file mt-2">
                      <input type="file" class="custom-file-input" id="editfilePRODImage" name="editfilePRODImage[]" accept="image/*" multiple>
                      <label class="custom-file-label" for="editfilePRODImage">Choose files*</label>
                    </div>
                    <div class="alert alert-danger mt-2" role="alert">
                      *Maximum 4 images (JPG, JPEG, PNG) <br>
                      *(Max 2MB)
                    </div>
                  </div>
                </div>

                <div class="col-6 priceContainer">
                  <label for="txtQUAN">Price Setting</label>
                  <div class="row originalPrice" id="editPriceList">
                    <div class="col-12">
                      <div class="d-flex">

                        <div class="form-group mr-2">
                          <input type="number" class="form-control editQUANMin" name="editQUANMin[]" placeholder="Min Qty">
                        </div>

                        <div class="form-group mr-2">
                          <input type="number" class="form-control editQUANMax" name="editQUANMax[]" placeholder="Max Qty">
                        </div>

                        <div class="form-group mr-2">
                          <input type="number" class="form-control editQUANPrice" name="editQUANPrice[]" placeholder="Price">
                        </div>

                        <div class="form-group">
                          <button type="button" class="btn btn-danger btnRemoveRow" disabled>X</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="row priceButton">
                    <div class="col-12">
                      <button type="button" class="btn btn-info w-100 px-3 btnAddRow">+ Add Quantity</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="editCATDesc">Description</label>
                    <textarea name="editPRODDetail" id="editPRODDetail"></textarea>
                  </div>
                </div>

              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-info" id="btnSaveProduct">Save Products</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
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
<script src="<?= base_url('assets/cms/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/bootstrap-4/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/cms/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Page level plugin JavaScript-->
<script src="<?= base_url('assets/cms/chart.js/Chart.min.js'); ?>"></script>
<script src="<?= base_url('assets/cms/datatables/jquery.dataTables.js'); ?>"></script>
<script src="<?= base_url('assets/cms/datatables/dataTables.bootstrap4.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/cms/js/sb-admin.min.js'); ?>"></script>

<!-- Demo scripts for this page-->
<script src="<?= base_url('assets/cms/js/demo/datatables-demo.js'); ?>"></script>
<script src="<?= base_url('assets/cms/js/demo/chart-area-demo.js'); ?>"></script>


<link rel="stylesheet" href="<?= base_url('assets/sweet-alert/sweetalert2.min.css'); ?>" />
<script src="<?= base_url('assets/tinymce/js/tinymce.min.js'); ?>"></script>

<script src="<?= base_url('assets/autocomplete/jquery.autocomplete.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/autocomplete/autocomplete.css'); ?>">

<script>
  //HEADER BUAT LOCALHOST
  let getUrl = window.location;
  let baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + getUrl.pathname.split('/')[1] + '/';

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

  $('body').on('click', '.img-thumbnail', function(evt) {

    let imgPreview = evt.currentTarget;
    let curImage = $(imgPreview).attr('src');

    $('.img-preview').attr('src', curImage);
  });

  //3. Validasi form buat ngeliat yang kosong
  //3.1 Validasi Form Standard
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
  //EoL 3.1

  //3.2 Validasi Form Edit
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
  //EoL 3.2

  //EoL 3

  //4. Nampilin semua kategori dari DB
  var countries = [];

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

      let qtyMin, qtyMax, qtyPrice;
      let minCheck, maxCheck, prcCheck;
      let minCounter, maxCounter, prcCounter;
      let rowCounter = $('.originalPrice').length + 1;
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

      //DISNI
      qtyMin = $('input[name="txtQUANMin[]"]').map(function() {
        return $(this).val();
      }).get();
      qtyMax = $('input[name="txtQUANMax[]"]').map(function() {
        return $(this).val();
      }).get();
      qtyPrice = $('input[name="txtQUANPrice[]"]').map(function() {
        return $(this).val();
      }).get();

      $.each(qtyMin, function(index, value) {
        if (value.length != 0) {
          minCounter++;
        }
      });

      $.each(qtyMax, function(index, value) {
        if (value.length != 0) {
          maxCounter++
        }
      });

      $.each(qtyPrice, function(index, value) {
        if (value.length != 0) {
          prcCounter++;
        }
      });

      minCheck = (minCounter == rowCounter ? true : false);
      maxCheck = (maxCounter == rowCounter ? true : false);
      prcCheck = (prcCounter == rowCounter ? true : false);

      if (minCheck == false || maxCheck == false || prcCheck == false) {
        $('#btnAddQuantity').before(`
          <div class="mt-2 alert alert-danger" role="alert">
            Cannot be empty!
          </div>
        `);
      } else if (minCheck == true && maxCheck == true && prcCheck == true) {
        $('#btnAddQuantity').prev('.alert').remove();
      }

      //Final Check
      if (minCheck && maxCheck && prcCheck && emptyCheck) {
        $('#addProduct')[0].submit();
      }
      //EoL Final Check
    })
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
    $.get(baseUrl + 'API/getProductDetail', {
      id: btnID
    }, function(resp) {
      //Buat ngeliat datanya apa aja
      // console.log(resp)
      $('#editPRODID').val(resp[0].PRODUCT_ID);
      $('#editPRODCategory').val(resp[0].PRODUCT_ID);
      $('#editPRODName').val(resp[0].PRODUCT_NAME);

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
        if (index == 0) {
          $imageContainer = $('<img>').attr('src', baseUrl + 'assets/uploads/products/' + value).addClass('img-preview');
          $('.father-preview').append($imageContainer);

          $imageHolder = $('<div>').addClass('d-flex mr-2 container-preview');
          $imageContainer = $('<img>').attr('src', baseUrl + 'assets/uploads/products/' + value).addClass('img-thumbnail');

          $imageHolder.append($imageContainer);
          $('.mother-preview').append($imageHolder);
        } else if (index == 3) {
          $imageHolder = $('<div>').addClass('d-flex container-preview');
          $imageContainer = $('<img>').attr('src', baseUrl + 'assets/uploads/products/' + value).addClass('img-thumbnail');

          $imageHolder.append($imageContainer);
          $('.mother-preview').append($imageHolder);
        } else {
          $imageHolder = $('<div>').addClass('d-flex mr-2 container-preview');
          $imageContainer = $('<img>').attr('src', baseUrl + 'assets/uploads/products/' + value).addClass('img-thumbnail');

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
          'QTY_MIN': value.QUANTITY_MIN,
          'QTY_MAX': value.QUANTITY_MAX,
          'QTY_PRICE': value.QUANTITY_PRICE,
        }

        qtyArr.push(qtyDetail);
      });

      $.each(qtyArr, function(index, value) {
        let curMin = ($($container).find('.editQUANMin'));
        let curMax = ($($container).find('.editQUANMax'));
        let curPrice = ($($container).find('.editQUANPrice'));

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

      //6.2 Submit Form
      $('#editProduct').submit(function(ex) {
        ex.preventDefault();

        let qtyMin, qtyMax, qtyPrice;
        let minCheck, maxCheck, prcCheck;
        let minCounter, maxCounter, prcCounter;
        // let rowCounter = $('.originalPrice').length + 1;
        let emptyCheck = checkEmptyEditForm(this);

        // minCheck = false;
        // maxCheck = false;
        // prcCheck = false;

        // minCounter = 0;
        // maxCounter = 0;
        // prcCounter = 0;

        // qtyMin = [];
        // qtyMax = [];
        // qtyPrice = [];

        // //DISNI
        // qtyMin = $('input[name="txtQUANMin[]"]').map(function() {
        //   return $(this).val();
        // }).get();
        // qtyMax = $('input[name="txtQUANMax[]"]').map(function() {
        //   return $(this).val();
        // }).get();
        // qtyPrice = $('input[name="txtQUANPrice[]"]').map(function() {
        //   return $(this).val();
        // }).get();

        // $.each(qtyMin, function(index, value) {
        //   if (value.length != 0) {
        //     minCounter++;
        //   }
        // });

        // $.each(qtyMax, function(index, value) {
        //   if (value.length != 0) {
        //     maxCounter++
        //   }
        // });

        // $.each(qtyPrice, function(index, value) {
        //   if (value.length != 0) {
        //     prcCounter++;
        //   }
        // });

        // minCheck = (minCounter == rowCounter ? true : false);
        // maxCheck = (maxCounter == rowCounter ? true : false);
        // prcCheck = (prcCounter == rowCounter ? true : false);

        // if (minCheck == false || maxCheck == false || prcCheck == false) {
        //   $('#btnAddQuantity').before(`
        //   <div class="mt-2 alert alert-danger" role="alert">
        //     Cannot be empty!
        //   </div>
        // `);
        // } else if (minCheck == true && maxCheck == true && prcCheck == true) {
        //   $('#btnAddQuantity').prev('.alert').remove();
        // }

        // //Final Check
        // if (minCheck && maxCheck && prcCheck && emptyCheck) {
        //   $('#addProduct')[0].submit();
        // }
        // //EoL Final Check
      })
      //EoL 6.2
    });
    //EoL 6.1

    //6.2 Buat nyalain autocomplete
    $('#editPRODCategory').autocomplete({
      lookup: countries,
      onSelect: function(suggestion) {
        console.log(suggestion);
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
</script>