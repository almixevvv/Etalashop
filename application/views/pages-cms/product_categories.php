<div id="wrapper">

    <!-- Sidebar -->


    <div id="content-wrapper" style="background-color: #f7f7f7;">

        <div class="container-fluid">

            <!-- ABOUT PART -->
            <div class="card mb-3">
                <div class="card-header">
                    <button <?= (stripos($this->session->userdata('ROLE'), "ADD;") == false ? 'disabled' : ''); ?> class="btn btn-success" type="button" data-toggle="modal" data-target="#addProductCategory" data-backdrop="static" data-keyboard="false">+ Add Product Category</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" cellspacing="0" style="font-size:12px">
                            <thead>
                                <tr class="text-center">
                                    <th width="1%">NO</th>
                                    <th width="10%">CATEGORY ID</th>
                                    <th width="10%">TYPE</th>
                                    <th width="15%">NAME</th>
                                    <th width="20%">DESCRIPTION</th>
                                    <th width="17%">CREATED</th>
                                    <th width="17%">UPDATED</th>
                                    <th width="10%">STATUS</th>
                                    <th width="17%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($categories->result() as $dt) {
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
                                        <td class="font-weight-bold">
                                            <?= $dt->TYPE_ID; ?>
                                        </td>
                                        <td>
                                            <?= $dt->NAME; ?>
                                        </td>
                                        <td>
                                            <?= $dt->DESCRIPTION; ?>
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
                                            <button <?= (stripos($this->session->userdata('ROLE'), 'EDIT;') === false ? 'disabled' : ''); ?> class="btn btn-warning" style="width: 6em;font-size: 12px;" type="button" data-toggle="modal" data-target="#editProductCategory" data-id="<?= $dt->REC_ID; ?>">EDIT</button>
                                            <button <?= (stripos($this->session->userdata('ROLE'), 'DELETE;') === false ? 'disabled' : ''); ?> class="buttonDeleteCategory btn btn-danger" style="width: 6em;font-size: 12px; margin-top: 5px;" type="button" data-id="<?= $dt->REC_ID; ?>">DELETE</button>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="addProductCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addProductCategory" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="addCategory">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-light">Add Products Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="txtCATID">Category ID</label>
                                            <input type="text" class="form-control" id="txtCATID" name="txtCATID" placeholder="EXAMPLE_ID">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="sctCATType">Type ID</label>
                                            <select class="form-control" id="sctCATType" name="sctCATType">
                                                <option value="none">-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="txtCATName">Name</label>
                                            <input type="text" class="form-control" id="txtCATName" name="txtCATName" placeholder="Category Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="txtCATDesc">Description</label>
                                            <input type="text" class="form-control" id="txtCATDesc" name="txtCATDesc" placeholder="Category Description">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="sctCATStatus">Status</label>
                                            <select class="form-control" id="sctCATStatus" name="sctCATStatus">
                                                <option value="none">-</option>
                                                <option value="ACTIVE">Active</option>
                                                <option value="INACTIVE">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="editProductCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProductCategory" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="editCategory">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-light">Edit Products Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editCATID">Category ID</label>
                                            <input type="text" class="form-control" id="editCATID" name="editCATID">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editCATType">Type ID</label>
                                            <select class="form-control" id="editCATType" name="editCATType">
                                                <option value="none">-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editCATName">Name</label>
                                            <input type="text" class="form-control" id="editCATName" name="editCATName">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editCATDesc">Description</label>
                                            <input type="text" class="form-control" id="editCATDesc" name="editCATDesc">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editCATStatus">Status</label>
                                            <select class="form-control" id="editCATStatus" name="editCATStatus">
                                                <option value="none">-</option>
                                                <option value="ACTIVE">Active</option>
                                                <option value="INACTIVE">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
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

<link rel="stylesheet" href="<?= base_url('assets_cms/sweet-alert/sweetalert2.min.css'); ?>" />
<script src="<?= base_url('assets_cms/js/categoryFunction.js?version=' . filemtime('./assets_cms/js/categoryFunction.js')); ?>"></script>

</body>