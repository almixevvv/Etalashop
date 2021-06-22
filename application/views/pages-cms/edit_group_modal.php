<?php echo form_open('Group_cms/updateGroup');?>
<?php foreach($group->result() as $data): ?>

<!-- HEADER -->
<div class="modal-header bg-primary" style="padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Edit Group</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <label>Group ID</label>
      <input type="text" name="txt_id" id="txt_id" class="form-control" value="<?php echo $data->ID;?>" readonly>
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <label>Name</label>
      <input type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo $data->NAME;?>">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-12">
      <label>Description</label>
      <input type="text" name="txt_desc" id="txt_desc" class="form-control" value="<?php echo $data->DESCRIPTION;?>">
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
     $this->db->where('ID', 'OUR_COMPANY');
     $this->db->or_where('ID', 'VISION_MISSION');
     $this->db->or_where('ID', 'CONTACT');
     $this->db->order_by('ORDER_NO', 'ASC');
     $query= $this->db->get();
      foreach ($query->result() as $key1) {
       echo"<tr>";
        echo"<td>".$key1->NAME."</td>";

         $this->db->select('*');
         $this->db->from('s_appl_detail');
         $this->db->where('APPL_ID',$key1->ID);
         $query2= $this->db->get();

         $query6=$this->db->query("SELECT COUNT(*) as TOTAL  FROM s_group_appl WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
         foreach($query6->result() as $data6);
         if($data6->TOTAL){
           $query3=$this->db->query("SELECT * FROM s_group_appl WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
           foreach($query3->result() as $data3);
         }
          foreach ($query2->result() as $key2) {
             $checked = "";
              if (($data6->TOTAL>0) and (stripos(@$data3->ROLE,$key2->ID.";")!==false)){
                  $checked = "checked";
              }
            echo"<td> <input name='".$key1->ID."[]' type='checkbox' ".$checked." value='".$key2->ID."' /> ".$key2->DESCRIPTION."</td>";
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
     $this->db->where_not_in('ID', "OUR_COMPANY");
     $this->db->where_not_in('ID', "VISION_MISSION");
     $this->db->where_not_in('ID', "CONTACT");
     $this->db->order_by('ORDER_NO', 'ASC');
     $query = $this->db->get();

      foreach ($query->result() as $key1) {
       echo"<tr>";
        echo"<td>".$key1->NAME."</td>";

         $this->db->select('*');
         $this->db->from('s_appl_detail');
         $this->db->where('APPL_ID',$key1->ID);
         $query2= $this->db->get();

         $query7=$this->db->query("SELECT COUNT(*) as TOTAL  FROM s_group_appl WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
         foreach($query7->result() as $data7);

         if($data7->TOTAL>0){
           $query8=$this->db->query("SELECT * FROM s_group_appl WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
           foreach($query8->result() as $data8);
         }
          foreach ($query2->result() as $key2) {
             $checked = "";
              if (($data7->TOTAL>0) and (stripos(@$data8->ROLE,$key2->ID.";")!==false)){
                  $checked = "checked";
              }
            echo"<td> <input name='".$key1->ID."[]' type='checkbox' ".$checked." value='".$key2->ID."' /> ".$key2->DESCRIPTION."</td>";
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

<?php endforeach; ?>
<?php echo form_close();?>

