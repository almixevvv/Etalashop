<style type="text/css">
  
  #faq-accordion {
    width: 75%;
    padding-left: 2em;
    padding-right: 2em;
  }



</style>


<div class="pages-container">
  <div class="pages-inner-container">

    <div class="row">
      <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="d-flex justify-content-center">
          <h4 class="text-uppercase text-center" style="color: #34ca9d">Frequently Ask Question</h4>
        </div>
      </div>    
    </div>

      <div class="row mt-md-4 mt-lg-4 mt-xl-4">
        <div class="col-12">
          <div class="d-flex justify-content-center pb-4">
            
            <div class="accordion" id="faq-accordion">
              
              <?php foreach($faq->result() as $data): ?>
              <div class="card">
                <div class="card-header" id="heading-<?php echo $data->REC_ID; ?>">
                  <h2 class="mb-0">
                      <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $data->REC_ID; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $data->REC_ID; ?>">
                        <?php echo $data->CONTENT; ?>
                      </button>
                  </h2>
                </div>

                <div id="collapse-<?php echo $data->REC_ID; ?>" class="collapse" aria-labelledby="heading-<?php echo $data->REC_ID; ?>" data-parent="#faq-accordion">
                  <div class="faq-card-container">
                    <?php echo $data->FAQ_CONTENT; ?>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>

            </div>

          </div>
      </div>
    </div>

  </div>
</div>