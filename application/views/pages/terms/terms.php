


<div class="pages-container">
  <div class="pages-inner-container">

     <div class="row">        
        <div class="col-12">
          <div class="d-flex justify-content-center">
            <h4 class="text-uppercase" style="color: #34ca9d">Terms and Conditions</h4>
          </div>
        </div>
      </div>

      <div class="row mt-md-4 mt-lg-4 mt-xl-4">
        <div class="col-12">
          
        <?php foreach($terms->result() as $data): ?>
          <?php echo $data->CONTENT; ?>
        <?php endforeach; ?>

        </div>
      </div>

  </div>
</div>
