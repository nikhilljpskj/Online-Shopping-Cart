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
                  <th>Dc NO</th>
                  <th>Action</th>
                </tr>
              </thead>
                      <tbody>

              <?php foreach($data as $row) { ?>
              <tr>

                  <td><a href="<?php echo base_url()?>inventory/view_sales_order/<?php echo $row->id?>"><?php echo $row->dc_no?></a></td>
                <td style="width: 40%">
    <a href="javascript:void(0);" onclick="printDeliveryChallan(<?= $row->dc_no ?>)" class="btn btn-primary mr-5" type="button">Print</a>
</td>


                    <?php if($row->isLoaded == 0){ ?>
                      <form class="ajax-form" ajax-url="ajax/add_loading_challan" table_refresh="true">
                      <input type="hidden" name="dc_id" value="<?php echo $row->dc_no?>">
                      <button class="btn btn-primary" type="submit">Loading</button>
                    </form>  
                    <?php } ?>                    
                  </td>
              </tr>
                <?php }?>

                             
                      </tbody>
              <tfoot>
                <tr>
                  <th>Dc NO</th>
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

<!-- Modal -->
<div class="modal fade" id="packingModal" tabindex="-1" role="dialog" aria-labelledby="packingModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="ajax-form" ajax-url="ajax/add_box_shedule">
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

<script>
    function printDeliveryChallan(dcNo) {
        var printWindow = window.open('', '_blank');
        // Make an AJAX request to fetch the printable content
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?= base_url() . 'inventory/delivery_challan_print/' ?>' + dcNo, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                printWindow.document.write(xhr.responseText);
                printWindow.document.close();
                printWindow.print();
            }
        };
        xhr.send();
    }
</script>
