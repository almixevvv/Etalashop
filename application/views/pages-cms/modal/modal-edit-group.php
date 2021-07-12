<?php echo form_open('Group_cms/updateGroup');?>
<?php foreach($content->result() as $data): ?>

<!-- HEADER -->
<div class="modal-header" style="background-color: #2dd6a7  ;padding: 0.2rem;">
  <p style="color: white;margin-top: 0.5em; margin-left: 0.5em; font-size: 20px; font-weight: bold;">Edit User Group</p>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <!-- Edit Margin -->
<div class="modal-body" style="font-size: 14px;">
  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-3">
    	<input type="hidden" name="hidden_id" style="width: 100%" value="<?php echo $data->ID; ?>">
    	<label style="width: 5em;font-weight: bold;">ID</label>
    	<label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-9">
        <input disabled="" name="group_id" style="width: 100%" value="<?php echo $data->ID; ?>" class="form-control">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-3">
      <label style="width: 5em;font-weight: bold;">Nama</label>
      <label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-9">
        <input name="group_name" style="width: 100%" value="<?php echo $data->NAME; ?>" class="form-control">
    </div>
  </div>

  <div class="row" style=" margin-bottom: 1em;">
    <div class="col-lg-3">
      <label style="width: 5em;font-weight: bold;">Deskripsi</label>
      <label style="margin-left: 4em; font-weight: bold;">:</label>
    </div>
    <div class="col-lg-9">
        <input name="group_desc" style="width: 100%" value="<?php echo $data->DESCRIPTION; ?>" class="form-control">
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

         /* $this->db->select('*');
         $this->db->from('S_GROUP_APPL');
         $this->db->where('GROUP_ID',$data->ID);
         $this->db->where('APPL_ID',$key1->ID);
         $query3= $this->db->get();*/
         $query6=$this->db->query("SELECT COUNT(*) as TOTAL  FROM S_GROUP_APPL WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
         foreach($query6->result() as $data6);
         if($data6->TOTAL){
           $query3=$this->db->query("SELECT * FROM S_GROUP_APPL WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
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

        /*$this->db->select('*');
         $this->db->from('S_GROUP_APPL');
         $this->db->where('GROUP_ID',$data->ID);
         $this->db->where('APPL_ID',$key1->ID);
         $query4= $this->db->get();*/
         $query7=$this->db->query("SELECT COUNT(*) as TOTAL  FROM S_GROUP_APPL WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
         foreach($query7->result() as $data7);

         if($data7->TOTAL>0){
           $query8=$this->db->query("SELECT * FROM S_GROUP_APPL WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
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

        /*$this->db->select('*');
         $this->db->from('S_GROUP_APPL');
         $this->db->where('GROUP_ID',$data->ID);
         $this->db->where('APPL_ID',$key1->ID);
         $query4= $this->db->get();*/
         $query5=$this->db->query("SELECT COUNT(*) as TOTAL  FROM S_GROUP_APPL WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
         foreach($query5->result() as $data5);

         if($data5->TOTAL>0){
           $query4=$this->db->query("SELECT * FROM S_GROUP_APPL WHERE GROUP_ID='".$data->ID."' AND APPL_ID='".$key1->ID."'");
           foreach($query4->result() as $data4);
         }
          foreach ($query2->result() as $key2) {
             $checked = "";
              if (($data5->TOTAL>0) and (stripos(@$data4->ROLE,$key2->ID.";")!==false)){
                  $checked = "checked";
              }
            echo"<td> <input name='".$key1->ID."[]' type='checkbox' ".$checked." value='".$key2->ID."' /> ".$key2->DESCRIPTION."</td>";
          }
       echo"</tr>";
      }
    ?>
  </table>
</div>
 
  
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-default btn-info">Save</button>
  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
</div>

<?php endforeach; ?>
<?php echo form_close();?>

