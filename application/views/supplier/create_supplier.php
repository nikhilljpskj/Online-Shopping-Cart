<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add New Supplier</h4>
        </div>
        <div class="card-body">
                     <?php echo form_open_multipart('supplier/supplier_store', array('id' => 'registerForm','class'=>'form form-horizontal')) ?>

            <div class="form-body">
              <div class="row">
       
                <div class="col-md-4">
                  <label  style="font-size:15px;color:black;">Supplier Name</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="supplier_name" class="form-control" name="supplier_name" placeholder="description">
                </div>
                <div class="col-md-4">
                  <label  style="font-size:15px;color:black;">Address</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="supplier_primaryaddress" class="form-control" name="supplier_primaryaddress" placeholder="description">
                </div>
                <div class="col-md-4">
                  <label  style="font-size:15px;color:black;">Area</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="supplier_areaprimary" class="form-control" name="supplier_areaprimary" placeholder="description">
                </div>
                <div class="col-md-4">
                  <label  style="font-size:15px;color:black;">District</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="supplier_districtprimary" class="form-control" name="supplier_districtprimary" placeholder="description">
                </div>
                <div class="col-md-4">
                  <label  style="font-size:15px;color:black;">State</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="supplier_stateprimary" class="form-control" name="supplier_stateprimary" placeholder="description">
                </div>
                <div class="col-md-4">
                  <label  style="font-size:15px;color:black;">Pincode</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="supplier_pincodeprimary" class="form-control" name="supplier_pincodeprimary" placeholder="description">
                </div>
                  <div class="col-md-4">
                  <label  style="font-size:15px;color:black;">GST No</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="supplier_gst" class="form-control" name="supplier_gst" placeholder="description">
                </div>
                  <div class="col-md-4">
                  <label  style="font-size:15px;color:black;">Contact</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="supplier_contactno1" class="form-control" name="supplier_contactno1" placeholder="description">
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