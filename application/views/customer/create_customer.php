<!-- Updated create_customer.php -->

<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Profile Details</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Field</th>
                  <th>Value</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($user_details)) : ?>
                  <tr>
                    <td>First Name</td>
                    <td><?= $user_details->firstname ?></td>
                  </tr>
                  <tr>
                    <td>Last Name</td>
                    <td><?= $user_details->lastname ?></td>
                  </tr>
                  <tr>
                    <td>Company Name</td>
                    <td><?= $user_details->company_name ?></td>
                  </tr>
                  <tr>
                    <td>Billing Address</td>
                    <td><?= $user_details->billing_address ?></td>
                  </tr>
                  <tr>
                    <td>Shipping Address</td>
                    <td><?= $user_details->shipping_address ?></td>
                  </tr>
                  <tr>
                    <td>Phone</td>
                    <td><?= $user_details->phone ?></td>
                  </tr>
                  <tr>
                    <td>Mobile</td>
                    <td><?= $user_details->mobile ?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><?= $user_details->email ?></td>
                  </tr>
                  <tr>
                    <td>GST No</td>
                    <td><?= $user_details->gstno ?></td>
                  </tr>
                  <tr>
                    <td>PAN No</td>
                    <td><?= $user_details->panno ?></td>
                  </tr>
                  <!-- Add similar rows for other fields -->
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <?php if (!empty($user_details)) : ?>
            <div class="col-sm-12 d-flex justify-content-end">
              <a href="<?= base_url('customer/update_profile') ?>" class="btn btn-primary mr-1">Edit Profile</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
