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
    width: 200px;
    position: relative;
  }

  .btn:focus,
  .btn:active,
  button:focus,
  button:active {
    outline: none !important;
    box-shadow: none !important;
  }

  #image-gallery-image {
    max-height: 50vh;
    max-width: 100%;
    object-fit: contain;
  }

  #image-gallery .modal-footer {
    display: block;
  }

  .thumb {
    margin-top: 15px;
    margin-bottom: 15px;
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

                      <div class="row">
                        <div class="col-3 pr-0 pl-2">
                          <span class="font-weight-bold">Weight</span>
                        </div>

                        <div class="col-1 pr-0">
                          <span>:</span>
                        </div>

                        <div class="col-8 pl-2">
                          <span><?= $dt->WEIGHT; ?> kg </span>
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
                          <span><?= date('Y-m-d h:i:sa', strtotime($dt->CREATED)); ?></span>
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
                          <span><?= ($dt->UPDATED != null ? date('Y-m-d h:i:sa', strtotime($dt->UPDATED)) : '-'); ?></span>
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
                          <!-- <span><?= $dt->USER_ID; ?></span> -->
                          <span><?= ($dt->USER_ID != null ? $dt->USER_ID : '-'); ?></span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="row">
                        <div class="col-12">
                          <div class="w-100 d-flex justify-content-center">
                            <a class="thumbnail" href="#" data-toggle="modal" data-image-id="" data-image="<?= (strpos($dt->IMAGES1, 'http') === false ? base_url('assets/uploads/products/' . $dt->IMAGES1) : $dt->IMAGES1); ?>" data-target="#image-gallery">
                              <img class="img-fluid img-thumbnail" style="max-height: 200px" src="<?= (strpos($dt->IMAGES1, 'http') === false ? base_url('assets/uploads/products/' . $dt->IMAGES1) : $dt->IMAGES1); ?>" alt="<?= $dt->PRODUCT_NAME; ?>" onError="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png') ?>'">
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-4">
                          <div class="w-100">
                            <a class="thumbnail" href="#" data-toggle="modal" data-image-id="" data-image="<?= (strpos($dt->IMAGES2, 'http') === false ? base_url('assets/uploads/products/' . $dt->IMAGES2) : $dt->IMAGES2); ?>" data-target="#image-gallery">
                              <img class="img-fluid img-thumbnail" style="max-height: 200px" src="<?= (strpos($dt->IMAGES2, 'http') === false ? base_url('assets/uploads/products/' . $dt->IMAGES2) : $dt->IMAGES2); ?>" alt="<?= $dt->PRODUCT_NAME; ?>" onError="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png') ?>'">
                            </a>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="w-100">
                            <a class="thumbnail" href="#" data-toggle="modal" data-image-id="" data-title="" data-image="<?= (strpos($dt->IMAGES3, 'http') === false ? base_url('assets/uploads/products/' . $dt->IMAGES3) : $dt->IMAGES3); ?>" data-target="#image-gallery">
                              <img class="img-fluid img-thumbnail" style="max-height: 200px" src="<?= (strpos($dt->IMAGES3, 'http') === false ? base_url('assets/uploads/products/' . $dt->IMAGES3) : $dt->IMAGES3); ?>" alt="<?= $dt->PRODUCT_NAME; ?>" onError="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png') ?>'">
                            </a>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="w-100">
                            <a class="thumbnail" href="#" data-toggle="modal" data-image-id="" data-title="" data-image="<?= (strpos($dt->IMAGES4, 'http') === false ? base_url('assets/uploads/products/' . $dt->IMAGES4) : $dt->IMAGES4); ?>" data-target="#image-gallery">
                              <img class="img-fluid img-thumbnail" style="max-height: 200px" src="<?= (strpos($dt->IMAGES4, 'http') === false ? base_url('assets/uploads/products/' . $dt->IMAGES4) : $dt->IMAGES4); ?>" alt="<?= $dt->PRODUCT_NAME; ?>" onError="this.onerror=null;this.src='<?= base_url('assets/images/no-image-icon.png') ?>'">
                            </a>
                          </div>
                        </div>
                      </div>
                    </td>



                    <td>
                      <a href="#" class="btn btn-info" style="width: 8em;font-size: 12px;margin-bottom: 1em;" onclick="buttonInfo('<?= $dt->PRODUCT_ID; ?>')">DETAIL</a>

                      <button class="btn btn-warning" style="width: 8em;font-size: 12px;margin-bottom: 1em;" type="button" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#editProductModal" data-id="<?= $dt->PRODUCT_ID; ?>">EDIT</button>

                      <a href="#" class="btn btn-danger" style="width: 8em;font-size: 12px;margin-bottom: 1em;" onclick="buttonDelete('<?= $dt->PRODUCT_ID; ?>')">DELETE</a>
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


  </div>

  <!-- Modal Detail Product -->
  <div id="detailProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailProductModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
      <!--  <form id="editProduct" action="<?= base_url('CMS/Product_cms/updateProduct') ?>" method="POST" enctype='multipart/form-data'> -->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #ababab">
          <h5 class="modal-title text-light">Detail Products</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="modal_body_detail">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <!-- </form> -->
  </div>
  <!-- /Modal Detail Product -->

  <!-- Modal Add Product -->
  <div id="addProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addProduct" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
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
                  <input type="number" class="form-control" id="txtPRODWeight" name="txtPRODWeight" placeholder="Example : 8.9" step="0.01" min="0">
                </div>
              </div>
              <div class="col-6 priceContainer">
                <label for="txtQUAN">Price Setting</label>
                <div class="row originalPrice">
                  <div class="col-12">
                    <div class="d-flex">

                      <div class="form-group mr-2" style="width: 25%;">
                        <input type="number" class="form-control txtQUANMin" name="txtQUANMin[]" placeholder="Min Qty" value="1">
                      </div>

                      <div class="form-group mr-2" style="width: 25%;">
                        <input type="number" class="form-control txtQUANMax" name="txtQUANMax[]" placeholder="Max Qty" value="999">
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

            <div class="row pt-4">
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
             <div class="col-6">
                <div class="form-group">
                  <label for="txtPRODDiscount">Discount</label>
                  <input type="text" class="form-control" id="txtPRODDiscount" name="txtPRODDiscount" value="0.00">
                  <small id="discountHelp" class="form-text text-muted"> Fill in this column if the item has a discounted price.</small>
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
    <div class="modal-dialog modal-xl" role="document">
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
                  <input type="number" class="form-control" id="editPRODWeight" name="editPRODWeight" placeholder="Weight" step="0.01" min="0">
                </div>
              </div>
              <div class="col-6 priceContainer">
                <label for="txtQUAN">Price Setting</label>
                <div class="row originalPrice" id="editPriceList">
                  <div class="col-12">
                    <div class="d-flex">

                      <div class="form-group mr-2" style="width: 25%;">
                        <input type="number" class="form-control editQUANMin" name="editQUANMin[]" placeholder="Min Qty">
                      </div>

                      <div class="form-group mr-2" style="width: 25%;">
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

            <div class="row pt-4">
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
               <div class="col-6">
                <div class="form-group">
                  <label for="editPRODDiscount">Discount</label>
                  <input type="text" class="form-control" id="editPRODDiscount" name="editPRODDiscount">
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

  <!-- Modal Images -->
  <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="image-gallery-title"></h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="image-gallery-image" class="img-responsive col-md-12" src="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
          </button>

          <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Images -->

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

<script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
<script src="<?= base_url('assets/autocomplete/jquery.autocomplete.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/autocomplete/autocomplete.css'); ?>">

<script src="<?= base_url('assets/incube-assets/productFunction.js?version=' . filemtime('./assets/incube-assets/productFunction.js')); ?>"></script>

<?php if ($this->session->userdata('inputError') == '0') { ?>
  <script>
    swal.fire({
      title: 'Success',
      text: `Process completed`,
      type: 'success',
      showCancelButton: false,
      cancelButtonColor: '#d33',
      confirmButtonText: 'Close',
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php } ?>

<?php if ($this->session->userdata('inputError') == '1') { ?>
  <script>
    swal.fire({
      title: 'Failed',
      text: `Something wrong while processing the product, please try again later`,
      type: 'error',
      showCancelButton: false,
      cancelButtonColor: '#d33',
      confirmButtonText: 'Close',
      confirmButtonColor: '#3085d6'
    });
  </script>
<?php } ?>