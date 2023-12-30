<?php foreach ($settings as $s) {
}
?>
<style>
    @media print {
        img[src]:after {
            content: none !important;
        }
    }

    @media print {
        @page {
            size: 8.5in 5.5in;
            size: portrait;
        }

        .row {
            page-break-inside: avoid;
        }
    }
</style>
<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Orders</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Orders</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="float-right d-none d-md-block ">
            <a class="btn btn-primary waves-effect waves-light" id="view_button" href="<?php echo base_url('/orders'); ?>">
                <i class="mdi mdi-plus mr-2"></i> View Orders
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="invoice-title">
            <div class="row">
                <img src="<?php echo $s->company_logo; ?>" width="75px" height="75px">&nbsp;&nbsp;
                <div class="text-left">
                    <address>
                        <h2><?php echo $s->company_name; ?></h2>
                        <h5 class="">
                            <?php echo $s->company_address  . '-' . $s->pincode; ?>.
                        </h5>
                        <h5 class="">
                            <?php echo $s->company_phone_number; ?>
                        </h5>
                    </address>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <address>
                    <h5 class=""><strong>Billed To:</strong><br></h5>
                    <p class=""><?php echo $company_data['company_name']; ?></p>
                    <p class=""><?php echo $order_data['baddress1'] . ',<br>' . $order_data['baddress2'] . ',<br>' . $order_data['bcity'] . ',<br>' . $order_data['bdistrict'] . ',<br>' . $order_data['bstate'] . ',<br>' . $order_data['bcountry'] . ',<br>' . $order_data['bpincode']; ?></p>
                </address>
            </div>
            <div class="col-4">
                <address>
                    <h5 class=""><strong>Shipping To:</strong><br></h5>
                    <p class=""><?php echo $company_data['company_name']; ?></p>
                    <p class=""><?php echo $order_data['saddress1'] . ',<br>' . $order_data['saddress2'] . ',<br>' . $order_data['scity'] . ',<br>' . $order_data['sdistrict'] . ',<br>' . $order_data['sstate'] . ',<br>' . $order_data['scountry'] . ',<br>' . $order_data['spincode']; ?></p>
                </address>
            </div>
            <div class="col-4 text-right">
                <address>
                    <h5 class=""><strong>Order Number:
                            #<?php echo $s->ord_str_num; ?><?php echo $order_data['order_id']; ?></strong></h5>
                    <h5 class=""><strong>Order Date:<?php echo $order_data['o_created_date']; ?></strong></h5>
                    <?php if (!empty($order_data['delivery_date'])) { ?>
                        <h5 class=""><strong>Deliver Date:<?php echo $order_data['delivery_date']; ?></strong></h5>
                    <?php } ?>
                </address>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div>
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>S.No</strong></td>
                                <td class="text-center"><strong>Variation Name</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-center"><strong>Unit Price</strong></td>
                                <td class="text-center"><strong>Total</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sub_tot = 0;
                            foreach ($get_order_details as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $key + 1; ?></td>
                                    <td class="text-center"><?php echo $value->variation_name; ?></td>
                                    <td class="text-center"><?php echo $value->order_qty; ?></td>
                                    <td class="text-center"><?php echo $value->order_price; ?></td>
                                    <td class="text-center"><?php $t_amount = $value->order_qty * $value->order_price;  ?><?php echo $t_amount; ?></td>
                                </tr>
                            <?php $sub_tot += $t_amount;
                            } ?>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>SUB Total</strong></td>
                                <td class="text-center thick-line text-right"><?php echo number_format($sub_tot, 2); ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Delivery Charges</strong></td>
                                <td class="text-center thick-line text-right"><?php echo number_format($order_data['delivery_price'], 2); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Discount %</strong></td>
                                <td class="text-center thick-line text-right">
                                    <?php echo number_format($order_data['discount_price'], 2); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Tax %</strong></td>
                                <td class="text-center thick-line text-right">
                                    <?php echo number_format($order_data['tax'], 2); ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Total</strong></td>
                                <td class="text-center thick-line text-right">
                                    <?php echo number_format($order_data['order_amount'], 2); ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="d-print-none">
                    <div class="float-right">
                        <!-- <a href="javascript:void();" class="btn btn-success waves-effect waves-light d2print" id="btnPrint"><i class="fa fa-print"></i></a> -->
                        <a class="btn btn-success waves-effect waves-light " id="btnPrint"><i class="ficon bx bx-printer"></i></a>
                        <!-- <a href="#" class="btn btn-primary waves-effect waves-light">Send</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end row -->


<script>
    $('#btnPrint').click(function() {
        window.print();
    });
</script>
