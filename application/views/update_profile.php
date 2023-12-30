<!-- Updated update_profile.php -->

<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Profile</h4>
        </div>
        <div class="card-body">
          <?php echo form_open_multipart('customer/update_profile_store', array('id' => 'updateProfileForm', 'class' => 'form form-horizontal')) ?>
          <div class="form-body">
            <div class="row">
              <?php if (!empty($user_details)) : ?>
                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">First Name</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="firstname" class="form-control" name="firstname" placeholder="First Name" value="<?= $user_details->firstname ?>">
                </div>

                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">Last Name</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Last Name" value="<?= $user_details->lastname ?>">
                </div>

                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">Company Name</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="company_name" class="form-control" name="company_name" placeholder="Company Name" value="<?= $user_details->company_name ?>">
                </div>

                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">Billing Address</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="billing_address" class="form-control" name="billing_address" placeholder="Billing Address" value="<?= $user_details->billing_address ?>">
                </div>

                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">Shipping Address</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="shipping_address" class="form-control" name="shipping_address" placeholder="Shipping Address" value="<?= $user_details->shipping_address ?>">
                </div>

                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">Phone</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="phone" class="form-control" name="phone" placeholder="Phone" value="<?= $user_details->phone ?>">
                </div>

                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">Mobile</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="mobile" class="form-control" name="mobile" placeholder="Mobile" value="<?= $user_details->mobile ?>">
                </div>

                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">Email</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="<?= $user_details->email ?>">
                </div>

                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">GST No</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="gstno" class="form-control" name="gstno" placeholder="GST No" value="<?= $user_details->gstno ?>">
                </div>

                <div class="col-md-4">
                  <label style="font-size:15px;color:black;">PAN No</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="panno" class="form-control" name="panno" placeholder="PAN No" value="<?= $user_details->panno ?>">
                </div>

              <?php endif; ?>

              <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1">Update Profile</button>
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
