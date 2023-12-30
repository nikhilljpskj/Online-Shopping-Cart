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
                  <th>Name</th>
                  <th>Buyer</th>
                  <th>Gsm</th>
                  <th>Board </th>
                  <th>Type</th>                  
                  <th>Category</th>
                  <th>Stock</th>
                </tr>
              </thead>
                      <tbody>

              <?php foreach($data1 as $row) {
              ?>
              <tr>
                  <td class="text-bold-500"><a href="<?php echo base_url()?>finished/view_product/<?php echo $row->id?>/0"><?php echo $row->name?></a></td>
                  <td><?php echo $row->buyer?></td>
                  <td><?php echo $row->f_gsm?></td>
                  <td><?php echo $row->f_board?></td>
                  <td><?php echo $row->f_type?></td>                  
                  <td><?php echo $row->f_category?></td>
                  <td><?php echo $row->stock?></td>
              </tr>
            <?php }?>

                             
                      </tbody>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Buyer</th>
                  <th>Front Gsm</th>
                  <th>Back Gsm</th>
                  <th>Front Board </th>
                  <th>Front Type</th>                  
                  <th>Front Category</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>