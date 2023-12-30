<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">PENDING DELIVERIES</h4>
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
                                    <th>Po NO</th>
                                    <th>Product Name</th>
                                    <th>Accepted Delivery Date</th>
                                    <th>Order Qty</th>
                                    <th>Delivery Allocated Qty</th>
                                    <th>Packing Allocated Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($table_data as $row) { ?>
                                    <tr>
                                        <td class=""><a href="<?php echo base_url() ?>inventory/view_po_no/<?php echo isset($row["po_no"]) ? $row["po_no"] : 0 ?>"><?php echo isset($row["po_no"]) ? $row["po_no"] : 0 ?></a></td>
                                        <td><a href="<?php echo base_url() ?>inventory/view_product/<?php echo isset($row["product_id"]) ? $row["product_id"] : 0 ?>/0"><?php echo isset($row["product_name"]) ? $row["product_name"] : "" ?></td>
                                        <td><?php echo isset($row["accepting_date"]) ? $row["accepting_date"] : "" ?></td>
                                        <td><?php echo isset($row["po_qty"]) ? $row["po_qty"] : 0 ?></td>
                                        <td><?php echo isset($row["assigned_quantity"]) ? $row["assigned_quantity"] : 0 ?></td>
                                        <td><?php echo isset($row["packing_allocated_qty"]) ? $row["packing_allocated_qty"] : 0 ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#packingModal" data-hidden-product_id="<?php echo isset($row["product_id"]) ? $row["product_id"] : 0 ?>" data-hidden-po_no="<?php echo isset($row["po_no"]) ? $row["po_no"] : 0 ?>" data-hidden-delivery_id="<?php echo isset($row["delivery_id"]) ? $row["delivery_id"] : 0 ?>" data-table-refresh="true" data-hidden-so_id="<?php echo isset($row["so_id"]) ? $row["so_id"] : 0 ?>">Packing</button>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Po NO</th>
                                    <th>Product Name</th>
                                    <th>Accepted Delivery Date</th>
                                    <th>Order Qty</th>
                                    <th>Delivery Allocated Qty</th>
                                    <th>Packing Allocated Qty</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="packingModal" tabindex="-1" role="dialog" aria-labelledby="packingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="ajax-form" ajax-url="/ajax/add_box_shedule">
                <div class="modal-header">
                    <h5 class="modal-title" id="packingModalLabel">Box Assign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="multi-group">
                        <div class="form-row div_1">
                            <div class="col-md-3">
                                <label for="box_size">Box Size</label>
                                <select class="form-control" name="box_size[]" id="box_size_1" required>
                                    <option disabled selected value="">Box Size</option>
                                    <option value="1">S</option>
                                    <option value="2">M</option>
                                    <option value="3">L</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="box_number">Box No</label>
                                <input type="text" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" class="form-control" id="box_number_1" name="box_number[]" placeholder="Box No" required>
                            </div>
                            <div class="col-md-3">
                                <label for="box_qty">Box QTY</label>
                                <input type="text" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" class="form-control" id="box_qty_1" name="box_qty[]" placeholder="Box QTY" required>
                            </div>
                            <div class="col-md-3 pt-2">
                                <button type="button" onclick="return add_rows()" class="add btn btn-sm px-1 btn-primary"><i class="ficon bx bx-plus"></i></button>
                                <button type="button" onclick="return remove_rows(1)" class="btn btn-sm px-1 btn-danger"><i class="ficon bx bx-x"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="loader text-center mx-3 mb-2">
                        <img src="<?php echo base_url(); ?>assets/images/oval.svg" />
                    </div>

                    <div class="errors text-center mx-3 mb-2"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    var i = 1;

    function add_rows() {
        i++
        $('.multi-group').append('<div class="form-row div_' + i + '"><div class="col-md-3"> <label for="box_size">Box Size</label> <select class="form-control" name="box_size[]" id="box_size_' + i + '" required><option disabled selected value="">Box Size</option><option value="1">S</option><option value="2">M</option><option value="3">L</option> </select></div><div class="col-md-3"> <label for="box_number">Box No</label> <input type="text" class="form-control" id="box_number_' + i + '" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="box_number[]" placeholder="Box No" required></div><div class="col-md-3"> <label for="box_qty">Box QTY</label> <input type="text" class="form-control" id="box_qty_' + i + '" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="box_qty[]" placeholder="Box QTY" required></div><div class="col-md-3 pt-2"> <button type="button" onclick="return add_rows()" class="add btn btn-sm px-1 btn-primary"><i class="ficon bx bx-plus"></i></button> <button onclick="return remove_rows(' + i + ')" type="button" class="btn btn-sm px-1 btn-danger"><i class="ficon bx bx-x"></i></button></div></div>')
    }

    function remove_rows(cnt) {
        $('.div_' + cnt).remove()
    }
</script>