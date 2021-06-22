
<style type="text/css">
  
  #maps {
    height: 400px;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
  }

</style>

<div class="pages-container">
  <div class="pages-inner-container">


    <div class="row">
      <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="d-flex justify-content-center">
          <h4 class="text-uppercase" style="color: #34ca9d">contact us</h4>
        </div>
      </div>    
    </div>

    <div class="row">

    <?php foreach($contactus->result() as $data): ?>
      <div class="col-12 col-md-4 col-lg-4 col-xl-4">
        
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-center">
              <img alt="<?php echo $data->TITLE; ?>" class="contact-logo" src="<?php echo base_url('assets/images/').$data->IMAGE; ?>" >
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-center">
              <span class="text-center"><?php echo $data->DESCRIPTION; ?></span>
            </div>
          </div>
        </div>

      </div>
    <?php endforeach; ?>
    
    </div>

    <div class="row mt-3">
      <div class="col-12 pl-5 pr-5 pt-3 pb-4">
        <div id="maps">

        </div>
      </div>
    </div>

  </div>
</div>

<script>

  // Initialize and add the map
  function initMap() {
    
    // The location of Uluru
    var uluru = {lat: -6.117511, lng: 106.7872833};
    
    // The map, centered at Uluru
    var map = new google.maps.Map(document.getElementById('maps'), {zoom: 16, center: uluru});
    
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: uluru, map: map});

  }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHrrMtxxFPWa5ad1eAIzpm_vrdooqr81M&callback=initMap"></script>