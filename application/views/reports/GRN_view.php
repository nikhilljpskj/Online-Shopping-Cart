<section id="basic-datatable">
    <?= form_open_multipart('reports/GRN_show', array('id' => 'registerForm', 'class' => 'form')) ?>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4> RECENT GRN REPORT</h4>
                <div class="row">
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead style="background-color:#8B0000;">
                        <tr>
                        <table class="table table-bordered text-center" >
                        <th style="width:15%"><label>GRN No</label></th>
                                <th style="white-space:nowrap"><label>Supplier</label></th>
                                <th style="white-space:nowrap"><label>Status</label></th>
                                <th style="white-space:nowrap"><label>Item</label></th>
                                <th style="white-space:nowrap"><label>Order Qty</label></th>
                                <th style="white-space:nowrap"><label>DC No</label></th>
                                <th style="white-space:nowrap"><label>DC Date</label></th>
                                <th style="white-space:nowrap"><label>Invoice No</label></th>
                                <th style="white-space:nowrap"><label>Invoice Date</label></th>
                                <th style="white-space:nowrap"><label>GRN Date</label></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) {?>
                 
                        <tr>
                            
                            <td><?php echo $row->order_grn_id ?></td>
                            <td><?php echo $row->order_receiver_address ?></td>
                            <td><?php echo $row->orderGRNStatus ?></td>
                            <td><?php echo $row->order_item_name ?></td>
                            <td><?php echo $row->order_item_quantity ?></td>
                            <td><?php echo $row->order_item_dc_date ?></td>
                            <td><?php echo $row->order_item_invoice_no ?></td>
                            <td><?php echo $row->order_item_invoice_date ?></td>
                            <td><?php echo $row->createdDate ?></td>
                    
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
            <th style="width:15%"><label>GRN No</label></th>
            <th style="white-space:nowrap"><label>Supplier</label></th>
            <th style="white-space:nowrap"><label>Status</label></th>
            <th style="white-space:nowrap"><label>Item</label></th>
            <th style="white-space:nowrap"><label>Order Qty</label></th>
            <th style="white-space:nowrap"><label>DC No</label></th>
            <th style="white-space:nowrap"><label>DC Date</label></th>
            <th style="white-space:nowrap"><label>Invoice No</label></th>
            <th style="white-space:nowrap"><label>Invoice Date</label></th>
            <th style="white-space:nowrap"><label>GRN Date</label></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</section>