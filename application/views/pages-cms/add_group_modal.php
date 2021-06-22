<?php echo form_open('Group_cms/addGroup');?>

<!-- HEADER -->
<div class="modal-header bg-primary" style="padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Add Group</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <label>Group ID</label>
      <input type="text" name="txt_id" id="txt_id" class="form-control">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <label>Name</label>
      <input type="text" name="txt_name" id="txt_name" class="form-control">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <label>Description</label>
      <input type="text" name="txt_desc" id="txt_desc" class="form-control">
    </div>
  </div>
  
</div>

<div class="modal-header bg-primary" style="padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 14px; font-weight: bold;">Main Module</p>
</div>

<div class="modal-body" style="padding: 0.2rem;">
  <table class="table table-stripped">
    <?php
     $this->db->select('*');
     $this->db->from('s_appl');
     $this->db->where("ID='OUR_COMPANY' or ID='VISION_MISSION' or ID='CONTACT'");

     $query= $this->db->get();
      foreach ($query->result() as $key1) {
       echo"<tr>";
        echo"<td>".$key1->NAME."</td>";

         $this->db->select('*');
         $this->db->from('s_appl_detail');
         $this->db->where('APPL_ID',$key1->ID);
         $query2= $this->db->get();


          foreach ($query2->result() as $key2) {
            
            echo"<td> <input name='".$key1->ID."[]' type='checkbox'  value='".$key2->ID."' /> ".$key2->DESCRIPTION."</td>";
          }
       echo"</tr>";
      }
    ?>
  </table>
</div>

<div class="modal-header bg-primary" style="padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 14px; font-weight: bold;">General Settings</p>
</div>

<div class="modal-body" style="padding: 0.2rem;">
  <table class="table table-stripped">
    <?php
     $this->db->select('*');
     $this->db->from('s_appl');
     $this->db->where("ID<>'OUR_COMPANY' AND ID<>'VISION_MISSION' AND ID<>'CONTACT'");

     $query= $this->db->get();
      foreach ($query->result() as $key1) {
       echo"<tr>";
        echo"<td>".$key1->NAME."</td>";

         $this->db->select('*');
         $this->db->from('s_appl_detail');
         $this->db->where('APPL_ID',$key1->ID);
         $query2= $this->db->get();


          foreach ($query2->result() as $key2) {
           
            echo"<td> <input name='".$key1->ID."[]' type='checkbox'  value='".$key2->ID."' /> ".$key2->DESCRIPTION."</td>";
          }
       echo"</tr>";
      }
    ?>
  </table>
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default btn-info">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
</div>

<?php echo form_close();?>

