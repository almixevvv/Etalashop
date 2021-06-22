<div id="wrapper">

    <!-- Sidebar -->


    <div id="content-wrapper" style="background-color: #f7f7f7;">

        <div class="container-fluid">

            <!-- ABOUT PART -->
            <div class="card mb-3">
                <div class="card-header">
                    <button <?= (stripos($this->session->userdata('ROLE'), "ADD;") == false ? 'disabled' : ''); ?> class="btn btn-success" type="button" data-toggle="modal" data-target="#addProductModal" data-backdrop="static" data-keyboard="false">+ Add Product Markets</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" cellspacing="0" style="font-size:12px">
                            <thead>
                                <tr class="text-center">
                                    <th width="1%">NO</th>
                                    <th width="10%">MARKET ID</th>
                                    <th width="15%">NAME</th>
                                    <th width="20%">DESCRIPTION</th>
                                    <th width="10%">IMAGES</th>
                                    <th width="17%">CREATED</th>
                                    <th width="17%">UPDATED</th>
                                    <th width="10%">STATUS</th>
                                    <th width="17%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($types->result() as $dt) {

                                    if ($dt->STATUS == "ACTIVE") {
                                        $arrStatus = array(
                                            'COLOR'   => '#2bba34',
                                            'STATUS'  => 'ACTIVE'
                                        );
                                    } else {
                                        $arrStatus = array(
                                            'COLOR'   => 'red',
                                            'STATUS'  => 'INACTIVE'
                                        );
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <?= $no++; ?>
                                        </td>
                                        <td class="font-weight-bold">
                                            <?= $dt->ID; ?>
                                        </td>
                                        <td>
                                            <?= $dt->NAME; ?>
                                        </td>
                                        <td>
                                            <?= $dt->DESCRIPTION; ?>
                                        </td>
                                        <td>
                                            <img class="img-fluid <?= ($dt->IMAGES == null ? 'd-none' : ''); ?>" src="<?= base_url('assets/img/product/' . $dt->IMAGES); ?>" alt="<?= $dt->NAME; ?>">
                                        </td>
                                        <td class="text-center">
                                            <?= $dt->CREATED; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $dt->UPDATED; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="font-weight-bold" style="color: <?= $arrStatus['COLOR'] ?>"><?= $arrStatus['STATUS']; ?></span>
                                        </td>
                                        <td class="flex">
                                            <button <?= (stripos($this->session->userdata('ROLE'), 'EDIT;') === false ? 'disabled' : ''); ?> class="btn btn-warning" style="width: 6em;font-size: 12px;" type="button" data-toggle="modal" data-target="#editProductType" data-id="<?= $dt->REC_ID; ?>">EDIT</button>
                                            <button <?= (stripos($this->session->userdata('ROLE'), 'DELETE;') === false ? 'disabled' : ''); ?> class="buttonDeleteUser btn btn-danger" style="width: 6em;font-size: 12px; margin-top: 5px;" type="button" data-id="<?= $dt->REC_ID; ?>">DELETE</button>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="editProductType" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProductType" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <form id="editType">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-light">Edit Products Types</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editTypeID">Type ID</label>
                                            <input type="text" class="form-control" name="editTypeID" id="editTypeID" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editTypeName">Name</label>
                                            <input type="text" class="form-control" name="editTypeName" id="editTypeName">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editTypeDesc">Description</label>
                                            <input type="text" class="form-control" name="editTypeDesc" id="editTypeDesc">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <div class="card" id="updatePreviewHolder">
                                                <div class="card-body">
                                                    <div class="d-flex flex-column" id="updatePreview">

                                                        <div class="justify-content-center" id="updateFatherPreview">

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-file mt-2">
                                                <input type="file" class="custom-file-input" id="editTypeImage" name="editTypeImage" accept="image/*">
                                                <label class="custom-file-label" for="editTypeImage">Choose files*</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editTypeStatus">Status</label>
                                            <select class="form-control" name="editTypeStatus" id="editTypeStatus">
                                                <option value="none">-</option>
                                                <option value="ACTIVE">Active</option>
                                                <option value="INACTIVE">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="editRECID" id="editRECID">
                                        </div>
                                    </div> <!-- hidden input -->

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Edit Types</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="addProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addProductModal" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <form id="addType">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-light">Add Products Markets</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="txtTypeID">Type ID</label>
                                            <input type="text" class="form-control" name="txtTypeID" id="txtTypeID" placeholder="EXAMPLE_ID">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="txtTypeName">Name</label>
                                            <input type="text" class="form-control" name="txtTypeName" id="txtTypeName" placeholder="Type Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="txtTypeDesc">Description</label>
                                            <input type="text" class="form-control" name="txtTypeDesc" id="txtTypeDesc" placeholder="Type Description">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <div class="card" id="previewHolder">
                                                <div class="card-body">
                                                    <div class="d-flex flex-column" id="preview">

                                                        <div class="justify-content-center" id="fatherPreview">

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-file mt-2">
                                                <input type="file" class="custom-file-input" id="addTypeImage" name="addTypeImage" accept="image/*">
                                                <label class="custom-file-label" for="addTypeImage">Choose files*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="sctTypeStatus">Status</label>
                                            <select class="form-control" name="sctTypeStatus" id="sctTypeStatus">
                                                <option value="none">-</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Add Types</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
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

<link rel="stylesheet" href="<?= base_url('assets_cms/sweet-alert/sweetalert2.min.css'); ?>" />
<script src="<?= base_url('assets_cms/js/typeFunction.js?version=' . filemtime('./assets_cms/js/typeFunction.js')); ?>"></script>

</body>