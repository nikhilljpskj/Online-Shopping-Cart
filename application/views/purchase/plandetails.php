<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Purchase Details</h4>
                    <table id="plan-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th> Purchase No </th>
                                <th> Product Name </th>
                                 <th> Requester Name </th>
                                 <th> Department </th>
                                <th> Created Date</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            if (!empty($data)) {
                                foreach ($data as $key => $vals) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $key + 1; ?> </td>
                                        <td> <?php echo $vals['order_material']; ?> </td>
                                        <td> <?php echo $vals['order_requestername']; ?> </td>
                                        <td> <?php echo $vals['order_dept']; ?> </td>
                                        <td> <?php echo $vals['order_date']; ?> </td>
                                        <td> <a href="<?php echo base_url('dashboard/invoice/') . $vals['order_id']; ?>" title="Print Invoice"><button class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button></a> <?php if($vals['orderGRNStatus'] == 'Pending') { ?>| <a href="<?php echo base_url('dashboard/edit_purchase/') . $vals['order_id']; ?>" title="Edit Invoice"><button class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button></a>| <a href="<?php echo base_url('dashboard/edit_purchases?id=') . $vals['order_id']; ?>" title="Edit Invoice"><button class="btn btn-warning btn-sm">PO</button></a><?php } ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="append_div"></div>
</div>