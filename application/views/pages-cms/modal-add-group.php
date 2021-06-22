<?php echo form_open('Group_cms/addGroup');?>

<!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Add User Group</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-3">
      <!-- <input type="hidden" name="hidden_id" style="width: 100%" value="<?php echo $data->ID; ?>"> -->
      <label style="width: 5em;font-weight: bold;">ID</label>
      <label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-9">
        <input type="text" name="group_id" style="width: 100%" class="form-control" >
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-3">
      <label style="width: 5em;font-weight: bold;">Name</label>
      <label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-9">
        <input name="group_name" style="width: 100%" class="form-control" >
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-3">
      <label style="width: 5em;font-weight: bold;">Description</label>
      <label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-9">
        <input name="group_desc" style="width: 100%" class="form-control" >
    </div>
  </div>
</div>

<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 14px; font-weight: bold;">Main Module</p>
  
</div>
<div class="modal-body" style="padding: 0.2rem;">
  <table class="table table-stripped">
    <?php
     $this->db->select('*');
     $this->db->from('S_APPL');
     $this->db->where("ID='MEMBER' or ID='ORDER' or ID='MARGIN'");

     $query= $this->db->get();
      foreach ($query->result() as $key1) {
       echo"<tr>";
        echo"<td>".$key1->NAME."</td>";

         $this->db->select('*');
         $this->db->from('S_APPL_DETAIL');
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

<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 14px; font-weight: bold;">General Settings</p>

</div>
<div class="modal-body" style="padding: 0.2rem;">
  <table class="table table-stripped">
    <?php
     $this->db->select('*');
     $this->db->from('S_APPL');
     $this->db->where("ID<>'MEMBER' AND ID<>'ORDER' AND ID<>'MARGIN' AND ID<>'USER' AND ID<>'GROUP' ");

     $query= $this->db->get();
      foreach ($query->result() as $key1) {
       echo"<tr>";
        echo"<td>".$key1->NAME."</td>";

         $this->db->select('*');
         $this->db->from('S_APPL_DETAIL');
         $this->db->where('APPL_ID',$key1->ID);
         $query2= $this->db->get();

        foreach ($query2->result() as $key2) {
      
            echo"<td> <input name='".$key1->ID."[]' type='checkbox' value='".$key2->ID."' /> ".$key2->DESCRIPTION."</td>";
          }
       echo"</tr>";
      }
    ?>
  </table>
</div>

<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 14px; font-weight: bold;">System</p>

</div>
<div class="modal-body" style="padding: 0.2rem;">
  <table class="table table-stripped">
    <?php
     $this->db->select('*');
     $this->db->from('S_APPL');
     $this->db->where("ID<>'MEMBER' AND ID<>'ORDER' AND ID<>'MARGIN' AND ID<>'CONTACT' AND ID<>'PRIVACY' AND ID<>'BANNER' AND ID<>'ABOUT' AND ID<>'TERMS' AND ID<>'FAQ' ");

     $query= $this->db->get();
      foreach ($query->result() as $key1) {
       echo"<tr>";
        echo"<td>".$key1->NAME."</td>";

         $this->db->select('*');
         $this->db->from('S_APPL_DETAIL');
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
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
</div>

<?php echo form_close();?>

