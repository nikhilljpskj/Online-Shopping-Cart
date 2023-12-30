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
                  <th>ID</th>
                  <th>Material</th>
                  <th>Board</th>
                  <th>Brand</th>
                  <th>Gsm</th>
                  <th>Type</th>
                  <th nowrap>Length(in) </th>
                  <th nowrap>Breadth(in) </th>
                  <th>Stock</th>
                </tr>
              </thead>
                      <tbody>

              <?php foreach($data1 as $row) {
              ?>
              <tr>
                  <td ><?php echo $row->id?></td>
                  <td nowrap class="text-bold-500"><?php echo $row->material?></td>
                  <td><?php echo $row->board?></td>
                  <td><?php echo $row->brand?></td>
                  <td><?php echo $row->gsm?></td>
                  <td><?php echo $row->type?></td>
                  <td><?php echo $row->linch?></td>
                  <td><?php echo $row->binch?></td>
                  <td><?php echo $row->stock?></td>
              </tr>
            <?php }?>

                             
                      </tbody>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Material</th>
                  <th>Board</th>
                  <th>Brand</th>
                  <th>Gsm</th>
                  <th>Type</th>
                  <th>Length in inch </th>
                  <th>Breadth in inch </th>
                  <th>Stock</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>