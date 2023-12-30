<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">PACKING</h4>
          <div class="row">
            <div class="col">
              
            </div>  
          </div>
        </div>
        <div class="card-body card-dashboard">
          <p class="card-text">
            
          </p>

          <div class="table-responsive">
            <table class="table zero-configuration" style="width:100%">
            
              <thead>
                <tr>
                  <th>Po NO</th>
                  <th>Product Name</th>
                  <th>Accepted Delivery Date</th>
                  <th>Order Qty</th>
                  <th>Box Size</th>
                  <th>Box No</th>
                  <th>Box QTY</th>
                  <th>Box WGT</th>               
                  <th>Action</th>               
                </tr>
              </thead>
                      <tbody>

              <?php foreach($data as $row) { ?>
              <tr>       
                <form class="ajax-form" ajax-url="/ajax/update_box_weight" table_refresh="true">                   
                  <td class=""><a href="<?php echo base_url()?>inventory/view_po_no/<?php echo $row->po_no?>"><?php echo $row->po_no?></a></td>
                  <td><a href="<?php echo base_url()?>inventory/view_product/<?php echo $row->product_id?>/0"><?php echo $row->product_name?></td>              
                  <td><?php echo $row->accepting_date?></td>
                  <td><?php echo $row->po_qty?></td>
                  <td><?php echo $row->box_size?></td>                  
                  <td><?php echo $row->box_number?></td>                  
                  <td><?php echo $row->box_qty?></td>                  
                  <td>
                    <input type="hidden" name="id" value="<?php echo $row->box_id?>">
                    <?php if($row->box_weight > 0){ ?> 
                      <?php echo $row->box_weight ?>
                    <?php }else{ ?> 
                      <input type="text" class="form-control" id="box_weight" name="box_weight" placeholder="Box Weight" value="">
                    <?php } ?>                    
                  </td>                 
                  <td> 
                    <?php if($row->box_weight == 0){ ?> 
                      <button class="btn btn-primary" data-hidden-id="<?php echo $row->po_no?>" type="submit">Update</button> 
                                       
                    <a target="_blank" href="<?= base_url() . '/inventory/packing_barcode_print/' . $row->po_no?>/<?php echo $row->box_id ?>" class="btn btn-primary mr-5" type="submit">Print Barcode</a>
                    <?php } ?>  
                  </td>       
                </form>           
              </tr>
              <?php }?>                             
              </tbody>
              <tfoot>
                <tr>
                  <th>Po NO</th>
                  <th>Product Name</th>
                  <th>Accepted Delivery Date</th>
                  <th>Order Qty</th>
                  <th>Box Size</th>
                  <th>Box No</th>
                  <th>Box QTY</th>
                  <th>Box WGT</th>               
                  <th>Action</th>           
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="row">
    <div class="col text-center">
      <form class="ajax-form" ajax-url="/ajax/add_delivery_challan" table_refresh="true">
        <button class="btn btn-primary" type="submit">Generate DC</button>
      </form>           
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="packingModal" tabindex="-1" role="dialog" aria-labelledby="packingModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="ajax-form" ajax-url="/ajax/add_box_shedule">
        <div class="modal-header">
          <h5 class="modal-title" id="packingModalLabel">Box Assign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
          <div class="form-group">
            <label for="box_size">Box Size</label>
            <select class="form-control" name="box_size" id="box_size">
                    <option disabled selected value="">Box Size</option>
                    <option value="1">S</option>
                    <option value="2">M</option>
            </select>
          </div>

          <div class="form-group">
            <label for="box_number">Box No</label>
            <input type="text" class="form-control" id="box_number" name="box_number" placeholder="Box No">
          </div>

          <div class="form-group">
            <label for="box_qty">Box QTY</label>
            <input type="text" class="form-control" id="box_qty" name="box_qty" placeholder="Box QTY">
          </div>

          <div class="form-group">
            <label for="box_weight">Box Weight</label>
            <input type="text" class="form-control" id="box_weight" name="box_weight" placeholder="Box Weight">
          </div>

        </div>
        <span class="loader text-center">Loading...</span>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
