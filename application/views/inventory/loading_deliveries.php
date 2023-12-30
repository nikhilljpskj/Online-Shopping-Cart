<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"></h4>
          <div class="row">
            <div class="col">
              
            </div>  
          </div>
        </div>
        <div class="card-body card-dashboard">
          <div class="table-responsive">
            <table id="loading-table" class="table">            
              <thead>
                <tr>
                  <th>Action</th>
                  <th>Dc NO</th>
                  <th>Sales Order Number</th>
                  <th>Po NO</th>
                  <th>Product Name</th>
                  <th>Accepted Delivery Date</th>
                  <th>Order Qty</th>
                  <th>Delivery Allocated Qty</th>
                  <th>Box Size</th>
                  <th>Box No</th>
                  <th>Box QTY</th>
                  <th>Box WGT</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach($data as $row) { ?>
                  <tr>
                      <td><input type="checkbox" name="loading[]"/></td>
                      <td><?php echo $row->dc_id?></td>
                      <td><?php echo $row->so_id?></td>
                      <td><?php echo $row->po_no?></td>
                      <td><?php echo $row->product_name?></td>
                      <td><?php echo $row->accepting_date?></td>
                      <td><?php echo $row->po_qty?></td>
                      <td><?php echo $row->delivery_allocated_qty?></td>
                      <td><?php echo $row->box_size?></td>
                      <td><?php echo $row->box_number?></td>
                      <td><?php echo $row->box_qty?></td>
                      <td><?php echo $row->box_weight?></td>
                  </tr>
                <?php }?>

                             
              </tbody>
              <tfoot>
                <tr>
                  <th>Action</th>
                  <th>Dc NO</th>
                  <th>Sales Order Number</th>
                  <th>Po NO</th>
                  <th>Product Name</th>
                  <th>Accepted Delivery Date</th>
                  <th>Order Qty</th>
                  <th>Delivery Allocated Qty</th>
                  <th>Box Size</th>
                  <th>Box No</th>
                  <th>Box QTY</th>
                  <th>Box WGT</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>        
      </div>

      <div style="display: none;" id="update-btn" class="row">
        <div class="col text-center">
          <form class="ajax-form" ajax-url="ajax/add_delivery_challan">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loadingModal" data-table-refresh="true">Update</button>                    
          </form>           
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="ajax-form" ajax-url="ajax/update_delivery_challan">
        <div class="modal-header">
          <h5 class="modal-title" id="loadingModalLabel">Update DC</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
          <div class="form-group">
            <label for="dc_no">DC ID's</label>
            <select class="form-control" name="dc_no" id="dc_no">
              <option disabled selected value="">DC NO</option>
              <?php foreach($delivery_challans as $challan){ ?>
                <option value="<?php echo $challan->dc_no ?>"><?php echo $challan->dc_no ?></option>  
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="vehicle_no">Vehicle No</label>
            <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" placeholder="Vehicle No">
          </div>

          <div class="form-group">
            <label for="driver_name">Driver Name</label>
            <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Driver Name">
          </div>

          <div class="form-group">
            <label for="driver_no">Driver No</label>
            <input type="text" class="form-control" id="driver_no" name="driver_no" placeholder="Driver No">
          </div>

        </div>
        <span class="loader text-center">Loading...</span>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
