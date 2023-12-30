<section id="floating-label-layouts">
  <div class="row match-height">
    <div class="col"><!--col-md-6 col-12-->
    <div class="container">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><?php echo $table_name?></h4>
        </div>

        <div class="card-body">
          <?php echo form_open('rawmaterial/update_item', array('id' => 'registerForm','class'=>'form')) ?>
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-label-group">
                    <input type="text" id="name" class="form-control" placeholder="Value" value="<?php echo $data->name ?>"
                      name="name">
                  </div>
                  <div class="form-label-group">
                    <input type="text" id="category" class="form-control" placeholder="Value" value="<?php echo $data->category ?>"
                      name="category">
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="form-label-group">
                      <input type="text" id="\item_id" class="form-control" 
                      name="item_id" value="<?php echo $data->id?>" readonly>
                    <input type="text" id="table_name" class="form-control" 
                      name="table_name" value="<?php echo $table_name?>" readonly>
                  </div>
                </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary mr-1">Submit</button>
                  
                </div>
              </div>
            </div>
          <?php echo form_close()?>
        </div>
      </div>
    </div>
    </div>
  </div>

</section>