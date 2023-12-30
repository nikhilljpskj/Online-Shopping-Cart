
    <style>
        .warning-msg {
            color: red;
            text-transform: capitalize;
        }

        .need_validation_error {
            border: 1px solid red;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    


<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div style="text-align: left; margin-top: 20px; margin-bottom: 20px;">
                <h6>I'm a new customer</h6>
            </div>
            <form action="<?= base_url() . 'register/save' ?>" id="registerForm" method="post">
                <div class="form-group">
                    <select name="salutation" id="salutation" class="form-control need form-control-user" required>
                        <option value="Mr">Mr</option>
                        <option value="Ms">Ms</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="firstname" id="firstname" class="form-control need form-control-user" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="lastname" id="lastname" class="form-control need form-control-user" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control need form-control-user" placeholder="Your Email Address" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control need form-control-user" placeholder="Your Password" required>
                    <small>The password must contain at least 8 characters. The password is case sensitive.</small>
                </div>

                <div class="form-group">
                <h6>Company</h6>
                 <small>Please enter your data exactly as in the commercial register.</small>
                    <input type="text" name="company" id="company" class="form-control need form-control-user" placeholder="Company">
                   
                </div>
                <div class="form-group">
                    <input type="text" name="department" id="department" class="form-control need form-control-user" placeholder="Department">
                </div>
                <div class="form-group">
                <small>This VAT-No. is valid until recall for all further orders.</small>
                <input type="text" name="vat_id" id="vat_id" class="form-control need form-control-user" placeholder="VAT ID">
                </div>
                <div class="form-group">
                    <input type="text" name="brands" id="brands" class="form-control need form-control-user" placeholder="Brands you need to order. If you want to order BRN.Standard articles, please enter BRN.Standard">
                </div>
                <div class="form-group">
                    <input type="text" name="contact_sales" id="contact_sales" class="form-control need form-control-user" placeholder="Contact Sales">
                </div>
                <div class="form-group">
                    <input type="text" name="contact_accounting" id="contact_accounting" class="form-control need form-control-user" placeholder="Contact Accounting">
                </div>

              <!--  <div class="form-group">
                    <input type="text" name="email_accounting" id="email_accounting" class="form-control need form-control-user" placeholder="Email Accounting">
                </div> -->
                <div class="form-group">
                    <input type="text" name="phone" id="phone" class="form-control need form-control-user" placeholder="Phone">
                </div>
                <div class="form-group">
                    <input type="text" name="fax_number" id="fax_number" class="form-control need form-control-user" placeholder="Fax-number">
                </div>
                <div class="form-group">
                    <input type="text" name="mobile" id="mobile" class="form-control need form-control-user" placeholder="Mobile">
                </div>
                <div class="form-group">
                    <input type="text" name="website" id="website" class="form-control need form-control-user" placeholder="Website">
                </div>
                <div class="form-group">
                    <input type="text" name="shipping_method" id="shipping_method" class="form-control need form-control-user" placeholder="Shipping method">
                </div>
                <div class="form-group">
                    <input type="text" name="account_number" id="account_number" class="form-control need form-control-user" placeholder="Account number">
                </div>

                <!-- Billing Address -->
<div class="form-group">
    <label for="billing_address">Billing Address</label><a style="color:red;">*</a><input type="hidden" name="billing_address[address_type]" value="Billing Address">
    <div class="row mb-3">
       
        <div class="col">
            <input type="text" name="billing_address[address1]" id="billing_address1" class="form-control need form-control-user" placeholder="Address 1" required>
        </div>
        <div class="col">
            <input type="text" name="billing_address[address2]" id="billing_address2" class="form-control need form-control-user" placeholder="Address 2">
        </div>
    </div>
  <div class="row mb-3">
        <div class="col">
            <input type="text" name="billing_address[city]" id="billing_city" class="form-control need form-control-user" placeholder="City" >
        </div>
        <div class="col">
            <input type="text" name="billing_address[district]" id="billing_district" class="form-control need form-control-user" placeholder="Country">
        </div>
    </div>
   
    </div>


<!-- Shipping Address -->
<div class="form-group">
    <label for="shipping_address">Shipping Address</label><input type="hidden" name="shipping_address[address_type]" value="Shipping Address">
    <div class="row mb-3">
        
        <div class="col">
            <input type="text" name="shipping_address[address1]" id="shipping_address1" class="form-control need form-control-user" placeholder="Address 1" required>
        </div>
        <div class="col">
            <input type="text" name="shipping_address[address2]" id="shipping_address2" class="form-control need form-control-user" placeholder="Address 2">
        </div>
    </div>
   <div class="row mb-3">
        <div class="col">
            <input type="text" name="shipping_address[city]" id="shipping_city" class="form-control need form-control-user" placeholder="City" >
        </div>
        <div class="col">
            <input type="text" name="shipping_address[district]" id="shipping_district" class="form-control need form-control-user" placeholder="Country">
        </div>
    </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="privacy" id="privacy" class="form-check-input" required>
                        <label class="form-check-label" for="privacy">I have read the data protection information.</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-user btn-block" id="submitButton">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script>
    $(document).ready(function () {

        $('#registerForm').on('submit', function (e) {
            e.preventDefault();

            console.log("dv")

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json', // Expect JSON response
                    success: function (response) {
        console.log('AJAX Success. Response:', response);

        if (response.status === 'success') {
            console.log('Registration Successful. Showing SweetAlert...');
            Swal.fire({
                title: 'Registration Successful',
                text: 'You can now log in with your credentials.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                console.log('SweetAlert OK button clicked');
                if (result.isConfirmed) {
                    console.log('Redirecting to login page');
                    $('#registerForm').trigger('reset');
                    window.location.href = "<?= base_url() . 'login' ?>";
                }
            });
        } else if (response.status === 'error') {
            console.log('Registration Error. Showing SweetAlert...');
            Swal.fire({
                title: 'Registration Error',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    }
});
</script>