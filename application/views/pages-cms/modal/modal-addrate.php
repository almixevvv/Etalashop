<?php echo form_open_multipart('Margin_cms/addRate');?>

<!-- HEADER -->
                <div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
                  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Add Kurs Rate</p>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <!-- Add Margin -->
                <div class="modal-body" style="font-size: 14px;">
                  <div class="row" style=" margin-bottom: 1em;">
                    <div class="col-lg-4">
                      <label style="font-weight: bold;">ID</label>
                    </div>
                  <div class="col-lg-8">
                    <!-- <input type="hidden" name="margin_rec" style="width: 100%"> -->
                    <input name="rate_id" style="width: 100%">
                  </div>
                </div>

                <div class="row" style=" margin-bottom: 1em;">
                  <div class="col-lg-4">
                    <label style="font-weight: bold;">Value</label>
                  </div>
                  <div class="col-lg-8">
                      <input name="rate_value" style="width: 100%">
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <label style="font-weight: bold;">Description</label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <textarea name="rate_desc" class="md-textarea form-control" rows="5" style="font-size: 12px; width: 100%;"></textarea>
                  </div>
                </div>

              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-info">Save</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
              </div>

<?php echo form_close();?>