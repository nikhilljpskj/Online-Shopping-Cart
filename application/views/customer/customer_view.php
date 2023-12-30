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
                  <th>Customer</th>
                  <th>Address</th>
                  <th>Area</th>
                  <th>District</th>
                  <th>State</th>
                  <th nowrap>Pincode </th>
                  <th nowrap>GST</th>
                  <th>Contact</th>
                </tr>
              </thead>
                      <tbody>

              <?php foreach($data1 as $row) {
              ?>
              <tr>
                  <td ><?php echo $row->id?></td>
                  <td nowrap class="text-bold-500"><?php echo $row->customer_name?></td>
                  <td><?php echo $row->customer_primaryaddress?></td>
                  <td><?php echo $row->customer_areaprimary?></td>
                  <td><?php echo $row->customer_districtprimary?></td>
                  <td><?php echo $row->customer_stateprimary?></td>
                  <td><?php echo $row->customer_pincodeprimary?></td>
                  <td><?php echo $row->customer_gst?></td>
                  <td><?php echo $row->customer_contactno1?></td>
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