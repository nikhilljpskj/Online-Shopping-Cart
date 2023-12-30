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
          <p class="card-text">
            
          </p>

          <div class="table-responsive">
            <table class="table zero-configuration">
            
              <thead>
                <tr>
                  <th>Sales Order Number</th>
                  <th>Po NO</th>
                  <th>po Date</th>
                  <th>po Delivery Date</th>
                  <th>Accepted Delivery Date</th>
                  <th>Order Qty</th>
                  <th>Delivery Allocated Qty</th>
                  <th>No of Boxes</th>
                  <th>Box QTY</th>
                  <th>Box WGT</th>
                  <th>Vehicle No</th>
                  <th>Driver Name</th>
                  <th>Driver No</th>
                  <th>Dc No</th>
                  <th>Action</th>
                </tr>
              </thead>
                      <tbody>

              <?php foreach($data as $row) { ?>
              <tr>
                  <td><?php echo $row->so_id?></td>
                  <td><?php echo $row->po_no?></td>
                  <td><?php echo $row->po_date?></td>
                  <td><?php echo $row->po_delivery_date?></td>
                  <td><?php echo $row->accepting_date?></td>
                  <td><?php echo $row->po_qty?></td>
                  <td><?php echo $row->assigned_quantity?></td>
                  <td><?php echo $row->number_of_boxes?></td>
                  <td><?php echo $row->box_qty?></td>
                  <td><?php echo $row->box_weight?></td>
                  <td><?php echo $row->vehicle_no?></td>
                  <td><?php echo $row->driver_name?></td>
                  <td><?php echo $row->driver_no?></td>
                  <td><?php echo $row->dc_id?></td>
                  <td>
                    <form class="ajax-form" ajax-url="ajax/add_dispatch" table_refresh="true">
                      <input type="hidden" name="so_id" value="<?php echo $row->so_id?>">
                      <input type="hidden" name="po_no" value="<?php echo $row->po_no?>">
                      <input type="hidden" name="po_date" value="<?php echo $row->po_date?>">
                      <input type="hidden" name="po_delivery_date" value="<?php echo $row->po_delivery_date?>">
                      <input type="hidden" name="accepting_date" value="<?php echo $row->accepting_date?>">
                      <input type="hidden" name="po_qty" value="<?php echo $row->po_qty?>">
                      <input type="hidden" name="assigned_quantity" value="<?php echo $row->assigned_quantity?>">
                      <input type="hidden" name="number_of_boxes" value="<?php echo $row->number_of_boxes?>">
                      <input type="hidden" name="box_qty" value="<?php echo $row->box_qty?>">
                      <input type="hidden" name="box_weight" value="<?php echo $row->box_weight?>">
                      <input type="hidden" name="vehicle_no" value="<?php echo $row->vehicle_no?>">
                      <input type="hidden" name="driver_name" value="<?php echo $row->driver_name?>">
                      <input type="hidden" name="driver_no" value="<?php echo $row->driver_no?>">
                      <input type="hidden" name="dc_no" value="<?php echo $row->dc_id?>">
                      <button class="btn btn-primary" type="submit">Dispatch</button>
                    </form>  
                  </td>

              </tr>
                <?php }?>

                             
                      </tbody>
              <tfoot>
                <tr>
                  <th>Sales Order Number</th>
                  <th>Po NO</th>
                  <th>po Date</th>
                  <th>po Delivery Date</th>
                  <th>Accepted Delivery Date</th>
                  <th>Order Qty</th>
                  <th>Delivery Allocated Qty</th>
                  <th>No of Boxes</th>
                  <th>Box QTY</th>
                  <th>Box WGT</th>
                  <th>Vehicle No</th>
                  <th>Driver Name</th>
                  <th>Driver No</th>
                  <th>Dc No</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>