<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Add these lines to include Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy/Z1DY+iW7CBtF5FlWgTIWEnZ8lCBNlD9"
        crossorigin="anonymous">

    <style>
        #button1 {
            background-color: #008CBA;
            color: white;
            padding: 2px 20px;
            font-size: 10px;
            margin: 20px;
        }

        #button2 {
            background-color: #008CBA;
            color: white;
            padding: 1px 20px;
            font-size: 10px;
            margin: 15px;
        }

        .btn-circle {
            width: 10px;
            height: 30px;
            text-align: center;
            padding: 2px 0;
            font-size: 5px;
            line-height: 1.428571429;
            border-radius: 20px;
        }

        .btn-circle.btn-lg {
            width: 50px;
            height: 50px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 25px;
        }

        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            font-size: 24px;
            line-height: 1.33;
            border-radius: 35px;
        }

        i.mdi.mdi-fullscreen {
            float: right;
            margin-left: 960px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo base_url('dashboard/addpurchase'); ?>" id="invoice-form" method="post"
                    class="invoice-form" role="form" novalidate>
                    <div class="load-animate animated fadeInUp">
                        <input id="currency" type="hidden" value="$">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>From,</h4>
                                <h5>ABARNA COLOURS</h5>
                                <h6>Tirupur</h6><br>
                            </div>
                            <div class="col-md-6">
                                <h3>To,</h3>
                                <div class="form-group">
                                    <select class="form-control" name="companyName" id="companyName" required>
                                        <option>Select Supplier</option>
                                        <?php foreach ($supplier as $key => $vals) { ?>
                                        <option data-supplieraddress="<?php echo $vals['supplier_primaryaddress']; ?>"
                                            data-supplier_name="<?php echo $vals['supplier_name']; ?>"
                                            data-supplier_areaprimary="<?php echo $vals['supplier_areaprimary']; ?>"
                                            data-supplier_districtprimary="<?php echo $vals['supplier_districtprimary']; ?>"
                                            data-supplier_stateprimary="<?php echo $vals['supplier_stateprimary']; ?>"
                                            data-supplier_pincodeprimary="<?php echo $vals['supplier_pincodeprimary']; ?>"
                                            data-supplier_gst="<?php echo $vals['supplier_gst']; ?>"
                                            data-supplier_contactno1="<?php echo $vals['supplier_contactno1']; ?>"
                                            value="<?php echo $vals['id']; ?>"><?php echo $vals['supplier_name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" name="address" id="address"
                                        placeholder="Your Address" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-condensed table-striped" id="invoiceItem">
                                    <thead>
                                        <tr>
                                            <th width="40%">Item Name</th>
                                            <th width="15%">Category</th>
                                            <th width="15%">Quantity</th>
                                            <th width="15%">Price</th>
                                            <th width="15%">Amount</th>
                                            <th width="15%">Action <a href="javascript:void(0);"
                                                    class="addmore"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="productsList form-control form-control-lg"
                                                    name="productName[]" id="productName_0" required>
                                                    <option>Select Item</option>
                                                    <?php foreach ($productdetails as $key => $vals) { ?>
                                                    <option data-id="0" data-category="<?php echo $vals['board']; ?>"
                                                        value="<?php echo $vals['id']; ?>"><?php echo $vals['material']; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input type="text" name="category[]" id="category_0" data-id="0"
                                                    class="form-control" readonly></td>
                                            <td><input type="number" name="quantity[]" id="quantity_0" data-id="0"
                                                    class="form-control quantity"></td>
                                            <td><input type="text" name="price[]" id="price_0" data-id="0"
                                                    class="form-control price"></td>
                                            <td><input type="text" name="total[]" id="total_0" data-id="0"
                                                    class="form-control total"></td>
                                            <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3 mb-3">
                                    <label>Sub Total: &nbsp;</label>
                                    <input value="" type="number" class="form-control" name="subTotal" id="subTotal"
                                        placeholder="Subtotal" readonly>
                                </div>
                                <div class="form-group mt-3 mb-3">
                                    <label>Tax Percentage: &nbsp;</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text currency">%</span>
                                        </div>
                                        <select class="form-control form-control-lg" name="taxRate" id="taxRate"
                                            required>
                                            <option>Select Tax</option>
                                            <?php foreach ($gst_details as $key => $vals) { ?>
                                            <option value="<?php echo $vals['id']; ?>"><?php echo $vals['cgst']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3 mb-3">
                                    <label>Tax Amount: &nbsp;</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text currency">$</span>
                                        </div>
                                        <input value="" type="number" class="form-control" name="taxAmount"
                                            id="taxAmount" placeholder="Tax Amount" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3 mb-3">
                                    <label>Total Amount: &nbsp;</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text currency">$</span>
                                        </div>
                                        <input value="" type="number" class="form-control" name="totalAftertax"
                                            id="totalAftertax" placeholder="Total" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save"
                                class="btn btn-success submit_btn invoice-save-btm">
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!-- Optional: Add Bootstrap 4 JS and Popper.js (for dropdowns, tooltips, and popovers) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy/Z1DY+iW7CBtF5FlWgTIWEnZ8lCBNlD9"
        crossorigin="anonymous"></script>

</body>

</html>
