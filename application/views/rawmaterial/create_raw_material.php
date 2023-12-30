<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add New Raw Material</h4>
        </div>
        <div class="card-body">
                     <?php echo form_open_multipart('rawmaterial/raw_material_store', array('id' => 'registerForm','class'=>'form form-horizontal')) ?>

            <div class="form-body">
              <div class="row">
                <!--<div class="col-md-4">
                  <label>Raw Material</label>
                </div>
                <div class="col-md-8 form-group">
                  <input id="name_exist_input" onkeyup="onCheckRawMaterialName(this.value)" type="text" id="raw_id" class="form-control" name="raw_name" placeholder="Raw Material name">
                  <span class="errors" id="name_exist">Raw material name is already exist!</span>
                </div>
                <div class="col-md-4">
                  <label>Description</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="desc" class="form-control" name="desc" placeholder="description">
                </div>-->
                <div class="col-md-4">
                  <label>select Brand</label>
                </div>
                <div class="col-md-8 form-group">
                  <select id="brand" name="brand" class="form-control">
                  <option value="">Brand Name </option>
                    <?php foreach($data5 as $row) {?>
                          <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                    <?php }?>      
                  </select>
                </div>
                <div class="col-md-4">
                  <label>select Board</label>
                </div>
                <div class="col-md-8 form-group">
                  <select id="board" name="board" class="form-control">
                  <option value="">Board Name </option>
                    <?php foreach($data1 as $row) {?>
                          <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                    <?php }?>      
                  </select>
                </div>
                <div class="col-md-4">
                  <label>select Gsm</label>
                </div>
                <div class="col-md-8 form-group">
                  <select id="gsm" name="gsm" class="form-control">
                  <option value="">GSM </option>
                    <?php foreach($data2 as $row) {?>
                          <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                    <?php }?>      
                  </select>
                </div>
                <div class="col-md-4">
                  <label>select Colour</label>
                </div>
                <div class="col-md-8 form-group">
                  <select id="colour" name="colour" class="form-control">
                  <option value="">colour </option>
                    <?php foreach($data3 as $row) {?>
                          <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                    <?php }?>      
                  </select>
                </div>
                <div class="col-md-4">
                  <label>select type</label>
                </div>
                <div class="col-md-8 form-group">
                  <select id="type" name="type" class="form-control">
                  <option value="">type </option>
                    <?php foreach($data4 as $row) {?>
                          <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                    <?php }?>      
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Length in Inch</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="linch" class="form-control" name="linch" placeholder="Length in inch">
                </div>
                <div class="col-md-4">
                  <label>Breadth in Inch</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="binch" class="form-control" name="binch" placeholder="Breadth in Inch">
                </div>
                <div class="col-md-4">
                  <label>Length in mm</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="lmm" class="form-control" name="lmm" placeholder="Length in mm">
                </div>
                <div class="col-md-4">
                  <label>Breadth in mm</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="bmm" class="form-control" name="bmm" placeholder="Breadth in mm">
                </div>

                <div class="col-12 col-md-8 offset-md-4 form-group">
                  <fieldset>
                    
                  </fieldset>
                </div>
                <div class="col-sm-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary mr-1">Submit</button>
                  
                </div>
              </div>
            </div>
          <?php form_close();?>
        </div>
      </div>
    </div>
  </div>
</section>