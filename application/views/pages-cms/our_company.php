<div id="wrapper">

    <!-- Sidebar -->


    <div id="content-wrapper" style="background-color: #f7f7f7;">

        <div class="container-fluid">

            <!-- ABOUT PART -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" cellspacing="0" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th width="59%">CONTENT</th>
                                    <th width="59%">TYPE</th>
                                    <th width="20%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($details->result() as $dt) {

                                    $output = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $dt->CONTENT);

                                ?>
                                    <tr>
                                        <td>
                                            <?= $no++; ?>
                                        </td>

                                        <td>
                                            <label><?= $output; ?></label>
                                        </td>

                                        <td>
                                            <label><?= str_replace('_', ' ', $dt->TYPE); ?></label>
                                        </td>

                                        <td class="text-center">
                                            <button <?= (stripos($this->session->userdata('ROLE'), 'EDIT;') === false ? 'disabled' : ''); ?> class="btn btn-warning" style="width: 6em;font-size: 12px;" type="button" data-toggle="modal" data-target="#editCompany" data-id="<?= $dt->REC_ID; ?>" data-type=<?= $dt->TYPE; ?>>EDIT</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="editCompany" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editCompany" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="editCompanyDetails">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-light">Edit Company Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="editABTID">Type</label>
                                            <input type="text" class="form-control" id="editABTID" name="editABTID" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="txtABTContent">Content</label>
                                            <textarea name="txtABTContent" id="txtABTContent"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="txtABTREC" id="txtABTREC">
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
<script src="https://cdn.tiny.cloud/1/5so9csec4pxx56cgo27virgc2e2qpe35odaxln6p1fqifgld/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?= base_url('assets_cms/js/companyDetailFunction.js?version=' . filemtime('./assets_cms/js/companyDetailFunction.js')); ?>"></script>

</body>