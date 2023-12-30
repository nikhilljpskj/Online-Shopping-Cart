<style>
    li.borderless {
        border: 0 none;
    }

    .col-md-6,
    .ordersummary,
    .tap {
        box-shadow: 1px 6px 20px #5c5858;
        padding: 20px;
        border-radius: 15px;
    }

    .addprice,
    .product-qty {
        width: 30%;
        height: calc(1.5em + 0.75rem + 2px);
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
</style>
<style>
    #loading {
        width: 100%;
        height: 100%;
        top: 0px;
        left: 0px;
        position: fixed;
        display: block;
        opacity: 0.7;
        background-color: #fff;
        z-index: 99;
        text-align: center;
        background: rgba(255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
    }

    #loading-content {
        position: absolute;
        top: 50%;
        left: 40%;
        text-align: center;
        z-index: 100;
    }

    .hide {
        display: none;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Checkout</h4>
                <div class="container mt-5">
                    <!--  <form method="post" action="<?php echo base_url('checkout'); ?>"> -->
                    <div class="row">
                        <!-- Billing & Shipping Information -->
                        <div class="col-md-6">
                            <h4>Address Details</h4>
                            <div class="form-row">
                                <label for="firstName">Company Name</label>
                                <input type="text" class="form-control" name="company" value="<?php echo $company_data[0]->company_name; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email ID</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $company_data[0]->email; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" name="mobile" value="<?php echo $company_data[0]->mobile; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="address">Billing Address</label>
                                <textarea class="form-control" rows="8" readonly><?php echo $billing_address[0]->address1 . ",\n" .
                                                                                        $billing_address[0]->address2 . ",\n" .
                                                                                        $billing_address[0]->city . ",\n" .
                                                                                        $billing_address[0]->district . ",\n" .
                                                                                        $billing_address[0]->state . ",\n" .
                                                                                        $billing_address[0]->country . ",\n" .
                                                                                        $billing_address[0]->pincode;
                                                                                    ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="address">Shipping Address</label>
                                <textarea class="form-control" rows="8" readonly><?php echo $billing_address[0]->address1 . ",\n" .
                                                                                        $shipping_address[0]->address2 . ",\n" .
                                                                                        $shipping_address[0]->city . ",\n" .
                                                                                        $shipping_address[0]->district . ",\n" .
                                                                                        $shipping_address[0]->state . ",\n" .
                                                                                        $shipping_address[0]->country . ",\n" .
                                                                                        $shipping_address[0]->pincode;
                                                                                    ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="address">Delivery Date</label>
                                <input type="date" class="form-control " name="delivery_date" id="delivery_date" />
                            </div>
                        </div>
                        <!-- Order Summary -->
                        <!-- <div class="col-md-3">
                            <div class="tap">
                                <h4>Shipping Method</h4>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex  borderless">
                                        <input type="radio" name="shipping_method" value="1" checked><span id="label">Free Shipping</span>
                                    </li>
                                    <li class="list-group-item d-flex borderless">
                                        <input type="radio" name="shipping_method" value="2"><span>Flat Shipping</span>
                                    </li>
                                </ul>
                            </div>
                            <br>
                            <div class="tap">
                                <h4>Payment Method</h4>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex  borderless">
                                        <input type="radio" name="payment_method" value="1" checked><span>Cash On Delivery</span>
                                    </li>
                                    <li class="list-group-item d-flex  borderless">
                                        <input type="radio" name="payment_method" value="2"><span>Online</span>
                                    </li>
                                </ul>
                            </div>
                            <br>
                            <div class="tap">
                                <h4>Billing Address</h4>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex  borderless">
                                        <input type="checkbox" name="billing_shipping" value="1"><span>My Billing and Shipping Address are the Same </span>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                        <div class=" col-md-5">
                            <div class="ordersummary">
                                <h4>Order Summary</h4>
                                <table style="border: 1px;">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                    <?php
                                    $sub_tot = 0;
                                    foreach ($cartdatas as $row) { ?>
                                        <tr>
                                            <td><img src="<?php echo $row->image; ?>" alt="<?php echo $row->variation_name; ?>" style="width: 50px; height: 50px; margin-right: 10px; float: left;"></td>
                                            <td><?php echo $row->variation_name; ?></td>
                                            <td><?php echo $row->price; ?></td>
                                            <td><input type="text" class="product-qty" value="<?php echo $row->qty; ?>" data-cart_id="<?php echo $row->cart_id; ?>"></td>
                                            <td><?php echo $row->qty * $row->price; ?></td>
                                        </tr>
                                    <?php $sub_tot += ($row->qty * $row->price);
                                    } ?>
                                    <tr>
                                        <td colspan="4" class="text-center"><b style="margin-left: 123px;">Sub Total</b></td>
                                        <td><?php echo $sub_tot . '.00'; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div class="ordersummary">
                                <!-- <h4>Order Summary</h4> -->
                                <table style="border: 1px;">
                                    <tr>
                                        <th>Delivery Charges</th>
                                        <th><input type="text" class=" addprice" name="delivery_price" id="delivery_price" /></th>
                                        <th id="delivery_price_text"></th>
                                    </tr>
                                    <tr>
                                        <th>Discount</th>
                                        <th><input type="text" class="addprice" name="discount_price" id="discount_price" /> %</th>
                                        <th id="discount_price_text"></th>
                                    </tr>
                                    <tr>
                                        <th>Tax</th>
                                        <th><input type="text" class="addprice" name="tax" id="tax" /> %</th>
                                        <th id="tax_price_text"></th>
                                    </tr>

                                    <tr>
                                        <th>Total</th>
                                        <th><input type="hidden" id="total" name="total" value="<?php echo $sub_tot; ?>"></th>
                                        <th id="total_text"><?php echo $sub_tot . '.00'; ?></th>
                                    </tr>
                                </table>
                                <br>
                                <!-- More form elements as needed -->
                                <button type="submit" class="btn btn-primary" onclick="pay_now();">Place Order</button>
                            </div>
                        </div>
                    </div>
                    <!--  </form> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loading" style="display: none;">
    <div id="loading-content">
        <h5>Please wait. Your order is under process</h5>
    </div>
</div>
<script>
    function pay_now() {

        //$("#loading").removeClass('hide');
        $("#loading").show();
        //var pay_type = $('input[name="payment_method"]:checked').val();
        var order_amount = $('#total').val();
        var delivery_date = $('#delivery_date').val();
        var tax = $('#tax').val();
        var delivery_price = $('#delivery_price').val();
        var discount_price = $('#discount_price').val();
        var sub_total = <?php echo $sub_tot; ?>;
        $.ajax({
            url: "<?php echo site_url() ?>create_order",
            method: "POST",
            type: "ajax",
            async: false,
            data: {
                order_amount: order_amount,
                delivery_date: delivery_date,
                tax: tax,
                delivery_price: delivery_price,
                discount_price: discount_price,
                sub_total: sub_total,
            },
            success: function(data) {
                // $("#loading").addClass('hide');
                $("#loading").hide();
                if (data) {
                    Swal.fire(
                        'Success!',
                        'Thankyou for placing the Order with us',
                        'success'
                    ).then(function() {
                        window.location.href = '<?php echo base_url('seller/orders/manage_orders/') ?>';
                    });
                } else {
                    Swal.fire(
                        'Failed!',
                        'Verification Failed.',
                        'error'
                    );
                }

            },
            error: function(error) {
                console.log(error);
            }
        });

    }

    $('.addprice').keyup(function() {

        var delivery_price = $('#delivery_price').val();
        var tax = $('#tax').val();
        var discount_price = $('#discount_price').val();


        var sub_tot = '<?php echo $sub_tot; ?>';
        var amount = Number(sub_tot);
        if (delivery_price) {
            amount += Number(delivery_price);
        }
        if (discount_price) {

            var discount_amount = (Number(sub_tot) * Number(discount_price)) / 100;

            amount -= discount_amount;
            $('#discount_price_text').text(discount_amount);
        }

        if (tax) {

            var tax_amount = (Number(sub_tot) * Number(tax)) / 100;

            amount += tax_amount;
            $('#tax_price_text').text(tax_amount);
        }

        $('#total').val(amount);
        $('#total_text').text(amount);

    });
    $(".addprice, .product-qty").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, and enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
            // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $('.product-qty').keyup(function() {

        var qty = $(this).val();
        var cart_id = $(this).attr('data-cart_id');
        if (qty > 0) {
            $.ajax({
                url: "<?php echo site_url() ?>seller/orders/manage_orders/update_cart",
                method: "POST",
                type: "ajax",
                async: false,
                data: {
                    cart_id: cart_id,
                    qty: qty,
                },
                success: function(data) {

                    if (data) {
                        Swal.fire(
                            'Success!',
                            'Cart Updated',
                            'success'
                        );
                        location.reload();

                    } else {
                        Swal.fire(
                            'Failed!',
                            'Please try again later.',
                            'error'
                        );
                    }

                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });
</script>