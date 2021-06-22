<script src="<?php echo base_url('assets/js/tinymce/jquery.tinymce.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/tinymce/tinymce.min.js'); ?>"></script>
<script src="https://cdn.tiny.cloud/1/msbnet2c7sihztuw28mia4ssqlylmi1sr0nf98t8nisojtfw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: '#txt_desc'
    });
</script>

<div id="wrapper">

    <!-- Sidebar -->

    <div id="content-wrapper" style="background-color: #f7f7f7;">

        <div class="container-fluid">

            <!-- ABOUT PART -->
            <?php echo form_open('Product_cms/updateProduct');?>
            <div class="card mb-3">
              <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row" style=" margin-bottom: 1em;">
                        <a href="<?php echo base_url("cms/product");?>">
                            <button class="btn btn-warning" style="width: 6em;font-size: 12px;" type="button">BACK</button>
                        </a>
                        <div class="col-lg-12">
                          
                          <?php foreach($product->result() as $data): ?>
                          <div class="row">
                            <div class="col-lg-6" style=" margin-top: 1em;">
                              <label>Product ID</label>
                              <input type="hidden" name="txt_rec" id="txt_rec" class="form-control" value="<?php echo $data->ID;?>">
                              <input type="text" class="form-control" value="<?php echo $data->ID;?>" disabled>
                            </div>
                            <div class="col-lg-6" style=" margin-top: 1em;">
                              <label>Name</label>
                              <input type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo $data->NAME;?>">
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-6" style=" margin-top: 1em;">
                              <label>Division</label>
                              <select name="txt_division" class="form-control">
                                <?php 
                                foreach($division->result() as $gm_division): 
                                  if($gm_division->ID==$data->TYPE_ID){
                                    ?>
                                     <option value="<?php echo $gm_division->ID?>" selected="selected"><?php echo $gm_division->NAME; ?></option>
                                    <?php
                                  }
                                  else{
                                    ?>
                                     <option value="<?php echo $gm_division->ID?>"><?php echo $gm_division->NAME; ?></option>
                                    <?php
                                  }
                                  endforeach; 
                                ?>  
                              </select>
                            </div>
                            <div class="col-lg-6" style=" margin-top: 1em;">
                              <label>Category</label>
                              <select name="txt_category" class="form-control">
                                <?php 
                                foreach($category->result() as $gm_category): 
                                  if($gm_category->ID==$data->CATEGORY_ID){
                                    ?>
                                     <option value="<?php echo $gm_category->ID?>" selected="selected"><?php echo $gm_category->NAME; ?></option>
                                    <?php
                                  }
                                  else{
                                    ?>
                                     <option value="<?php echo $gm_category->ID?>"><?php echo $gm_category->NAME; ?></option>
                                    <?php
                                  }
                                  endforeach; 
                                ?>  
                              </select>
                            </div>
                          </div>  

                          <div class="row">
                            <div class="col-lg-12" style=" margin-top: 1em;">
                              <label>Description</label>
                              <textarea name="txt_desc" id="txt_desc" class="form-control"><?php echo $data->DESCRIPTION;?></textarea>
                            </div>
                          </div>
                          <?php endforeach; ?>
                        </div>
                        
                        <button class="btn btn-primary" style="width: 6em;font-size: 12px;margin-top: 1em;" type="submit">SAVE</button>
                        
                      </div>

                        
                    </div>
                      <!-- /.col-lg-8 -->
                      <!-- /.col-lg-4 -->
                  </div>
                </div>
              </div>
            <?php echo form_close();?>
            <!-- <button type="button" class="btn btn-success" style="width: 15%;font-size: 12px;margin-bottom: 1em;" data-toggle="modal" data-target="#addNewMargin" ><i class="fas fa-plus"></i> Tambah Batas</button> -->

        </div>
        <!-- end content -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->


<link rel="stylesheet" href="<?php echo base_url('reseller/assets/sweet-alert/sweetalert2.min.css'); ?>" />

</body>

<script>
    tinymce.init({
      selector: 'textarea#txt_desc',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });

var expanded = false;
</script>


