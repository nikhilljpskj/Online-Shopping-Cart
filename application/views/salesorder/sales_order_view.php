<section id="basic-datatable">
    <?= form_open_multipart('salesorder/crop_order_qty', array('id' => 'registerForm', 'class' => 'form')) ?>
   <div class="col-md-12">
            <div class="card-header">
                <h4> RECENT SALES ORDERS</h4>
            </div>
            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <!-- <th style="color:white;">Select</th> -->
                            <th nowrap>SO NO</th>
                            <th nowrap>PO NO</th>
                            <th nowrap>Product Name</th>
                            <th nowrap>Delivery Date</th>
                            <th nowrap>Ordered</th>
                            <th>Stock</th>
                            <th>Pending</th>
                            <th nowrap>Schedule</th>
                            <th nowrap>Schedule</th>
                            <th nowrap>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) {?>
                        <tr>
                            <!-- <td><input type="checkbox" id="<?php echo $row->id ?>" name="sales_order_num[]" value="<?php echo $row->id ?>"></td> -->
                            <td class=""><?php echo $row->id ?></td>
                            <td class=""><a href="<?php echo base_url() ?>salesorder/view_po_no/<?php echo $row->pono ?>"><?php echo $row->pono ?></a></td>
                            <td><a href="<?php echo base_url() ?>salesorder/view_product/<?php echo $row->product_id ?>/0"><?php echo $row->product_name . $row->name ?></td>
                            <!-- <td><?php echo $row->delivery_date ?></td> -->
                            <td><?php echo (isset($row->po_delivery_date) ? $row->po_delivery_date : '') ?></td>
                            <td><?php echo (isset($row->po_qty) ? $row->po_qty : 0) ?></td>
                            <td><?php echo (isset($row->stock) ? $row->stock : 0) ?></td>
                            <td><?php echo (isset($row->pending_qty) ? $row->pending_qty : 0) ?></td>
                            <!-- <td><button class="btn btn-primary" onclick="myFunction(<?php echo $row->id ?>)">Copy Text</button></td> -->
                            <?php //if ($row->pending_qty == NULL || $row->pending_qty != "0") { ?>
                            <td>
                                <?php if (isset($row->po_qty) && $row->po_qty > 0 ) { ?>
                                    <!-- <button type="button" class="btn btn-primary btn-xs del_model_btn" data-toggle="modal" data-target="#deliveryModalSchedule" data-hidden-product_id="<?php echo $row->product_id ?>" data-po_no="<?php echo $row->pono ?>" data-order_qty="<?php echo (isset($row->po_qty) ? $row->po_qty : 0) ?>" data-pending_qty="<?php echo (isset($row->pending_qty) ? $row->pending_qty : 0) ?>" data-hidden-so_id="<?php echo $row->id ?>" data-table-refresh="true" data-product_name="<?php echo $row->name . $row->description ?>">Delivery</button> -->
                                    
                                    <button type="button" class="btn btn-primary btn-xs" onclick="deliveryPopup(<?= $row->product_id ?>, '<?= $row->pono ?>', <?= $row->po_qty ?>, <?= $row->pending_qty ?>, <?= $row->id ?>, '<?= $row->name . $row->product_name ?>', <?= $row->stock?>)">Delivery</button>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if (isset($row->po_qty) && $row->po_qty > 0 ) { ?>
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#productionModalSchedule" data-hidden-product_id="<?php echo $row->product_id ?>" data-hidden-so_id="<?php echo $row->id ?>" data-table-refresh="true">Production</button>
                                <?php } ?>
                            </td>
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#packingModal" data-id="<?php echo $row->pono ?>" data-column="po_no" data-table-refresh="true">Packing</button> -->
                            <!--  <a href="<?php echo base_url() ?>salesorder/assign_delivery/<?php echo $row->id ?>" class="btn btn-primary">Schedule</a><br> -->
                            <td>
                                <progress value="<?php echo (100 * ($row->status / 6)) ?>" max="100"></progress>
                                <select name="status" class="form-control" width="10%" readonly disabled="disabled">
                                    <option selected value="">Booked </option>
                                    <option <?php echo ($row->status == 1 ? "selected" : "") ?> value="">Scheduled </option>
                                    <option <?php echo ($row->status == 2 ? "selected" : "") ?> value="">Work in Progress </option>
                                    <option <?php echo ($row->status == 3 ? "selected" : "") ?> value="">Ready to Pack</option>
                                    <option <?php echo ($row->status == 4 ? "selected" : "") ?> value="">Packing </option>
                                    <option <?php echo ($row->status == 5 ? "selected" : "") ?> value="">Dispatch </option>
                                    <option <?php echo ($row->status == 6 ? "selected" : "") ?> value="">POD </option>
                                </select>
                            </td>
                           <!-- <td>
                                <a class="btn btn-primary btn-xs" href="<?php echo base_url() ?>salesorder/view_po_no/<?php echo $row->pono ?>">Edit</a><br>
                            </td>
                            <td>
                               <a class="btn btn-danger btn-xs" href="<?php echo base_url() ?>salesorder/view_sales_order/<?php echo $row->id ?>">Delete</a><br> 
                            </td>-->
                        </tr>
                        <?php } ?>
                    </tbody>
                  <!--   <tfoot>
                        <tr>
                          
                            <th nowrap>SO NO</th>
                            <th nowrap>PO NO</th>
                            <th nowrap>Product</th>
                            <th>Accepted Delivery Date</th>
                            <th nowrap>Order Qty</th>
                            <th >Available Stock</th>
                            <th >Pending Qty</th>
                            <th nowrap>Schedule</th>
                            <th nowrap>Schedule</th>
                            <th nowrap>Status</th>
                        </tr>
                    </tfoot> -->
                </table>
    <?php echo form_close(); ?>
    </div>
</section>

<!-- Modal -->
<!-- <div class="modal fade" id="deliveryModalSchedule" tabindex="-1" role="dialog" aria-labelledby="deliveryModalScheduleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="ajax-form" ajax-url="/ajax/add_delivery_assign">
                <div class="modal-header">
                    <h5 class="modal-title" id="deliveryModalScheduleLabel">Delivery Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PO NO</th>
                                <th>Product</th>
                                <th>Order Qty</th>
                                <th>Pending Qty</th>
                            </tr>
                        </thead>
                        <tr>
                            <td id="po_nos"><?php echo $row->pono ?></td>
                            <td id="product_names"><?php echo $row->name . $row->description ?></td>
                            <td id="po_qtys"><?php echo $row->po_qty ?></td>
                            <td id="pending_qtys"><span id="dpending_qtys"><?php $qty = (isset($row->pending_qty) ? $row->pending_qty : 0); echo $qty; ?></span></td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <label for="stock_qty">Stock QTY :<?php echo $row->stock ?></label>
                    </div>
                    <div class="form-group">
                        <label for="assigned_quantity">Assign QTY - <?= $qty ?></label>
                        <input type="text" class="form-control" id="assigned_quantity" name="assigned_quantity" placeholder="Allocate QTY" onkeyup="return chkQty(this.value , <?php echo isset($qty) ? $qty : 0 ?> )">
                    </div>
                    <div class="form-group">
                        <label for="assigned_date">Assign Date</label>
                        <input type="date" class="form-control" id="assigned_date" name="assigned_date" placeholder="dd/mm/yyyy">
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
</div> -->

<div class="modal fade" id="deliveryModalSchedule" tabindex="-1" role="dialog" aria-labelledby="deliveryModalScheduleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="ajax-form" ajax-url="ajax/add_delivery_assign">
                <div class="modal-header">
                    <h5 class="modal-title" id="deliveryModalScheduleLabel">Delivery Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PO NO</th>
                                <th>Product</th>
                                <th>Order Qty</th>
                                <th>Pending Qty</th>
                            </tr>
                        </thead>
                        <tr>
                            <td id="po_nos"></td>
                            <td id="product_names"></td>
                            <td id="po_qtys"></td>
                            <td id="pending_qtys"></td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <label for="stock_qty">Stock QTY :<span id="stockQtyp"></span></label>
                    </div>
                    <div class="form-group">
                        <label for="assigned_quantity">Assign QTY</label>
                        <input type="hidden" id="so_id" name="so_id" value="">
                        <input type="hidden" id="product_id" name="product_id" value="">
                        <input type="number" class="form-control" id="assigned_quantity" name="assigned_quantity" placeholder="Allocate QTY" onblur="assignedQuantity()">
                    </div>
                    <div class="form-group">
                        <label for="assigned_date">Assign Date</label>
                        <input type="date" class="form-control" id="assigned_date" name="assigned_date" placeholder="dd/mm/yyyy">
                    </div>
                </div>
                <div class="loader text-center mx-3 mb-2">
                    <img src="<?= base_url(); ?>assets/images/oval.svg" />
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

<!-- Modal -->
<div class="modal fade" id="packingModal" tabindex="-1" role="dialog" aria-labelledby="packingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="ajax-form" ajax-url="ajax/add_box_shedule">
                <div class="modal-header">
                    <h5 class="modal-title" id="packingModalLabel">Box Assign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>                 
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="box_size">Box Size</label>
                            <select class="form-control" name="box_size" id="box_size">
                                <option disabled selected value="">Box Size</option>
                                <option value="1">S</option>
                                <option value="2">M</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="box_number">Box No</label>
                            <input type="text" class="form-control" id="box_number" name="box_number" placeholder="Box No">
                        </div>
                        <div class="form-group">
                            <label for="box_qty">Box QTY</label>
                            <input type="text" class="form-control" id="box_qty" name="box_qty" placeholder="Box QTY">
                        </div>
                        <div class="form-group">
                            <label for="box_weight">Box Weight</label>
                            <input type="text" class="form-control" id="box_weight" name="box_weight" placeholder="Box Weight">
                        </div>
                    </div>
                    <span class="loader text-center">Loading...</span>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productionModalSchedule" tabindex="-1" role="dialog" aria-labelledby="productionModalScheduleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="ajax-form" ajax-url="ajax/add_production_assign">
                <div class="modal-header">
                    <h5 class="modal-title" id="productionModalScheduleLabel">Production Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PO NO</th>
                                <th>Product</th>
                                <th>Order Qty</th>
                                <th>Pending Qty</th>
                            </tr>
                        </thead>
                        <tr>
                            <td id="po_nos"><?php echo $row->pono ?></td>
                            <td id="product_names"><?php echo $row->name . $row->description ?></td>
                            <td id="po_qtys"><?php echo $row->po_qty ?></td>
                            <td id="pending_qtys"><?php echo (isset($row->pending_qty) ? $row->pending_qty : 0) ?></td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <label for="stock_qty">stock QTY</label>
                        <?php echo $row->stock ?>
                    </div>
                    <div class="form-group">
                        <label for="production_qty">Production QTY</label>
                        <input type="text" class="form-control" id="production_qty" name="production_qty" placeholder="Production QTY">
                    </div>
                    <!-- <div class="form-group">
                        <label for="extra_production_qty">Extra Production QTY</label>
                        <input type="text" class="form-control" id="extra_production_qty" name="extra_production_qty" placeholder="Extra Production QTY">
                        </div> -->
                    <div class="form-group">
                        <label for="stage1">Stage1</label>
                        <input type="date" class="form-control" id="stage1" name="stage1" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="stage2">Stage2</label>
                        <input type="date" class="form-control" id="stage2" name="stage2" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="stage3">Stage3</label>
                        <input type="date" class="form-control" id="stage3" name="stage3" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="stage4">Stage4</label>
                        <input type="date" class="form-control" id="stage4" name="stage4" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="stage5">Stage5</label>
                        <input type="date" class="form-control" id="stage5" name="stage5" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="stage6">Stage6</label>
                        <input type="date" class="form-control" id="stage6" name="stage6" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="stage7">Stage7</label>
                        <input type="date" class="form-control" id="stage7" name="stage7" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="stage8">Stage8</label>
                        <input type="date" class="form-control" id="stage8" name="stage8" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="stage9">Stage9</label>
                        <input type="date" class="form-control" id="stage9" name="stage9" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="stage10">Stage10</label>
                        <input type="date" class="form-control" id="stage10" name="stage10" placeholder="dd/mm/yyyy">
                    </div>
                </div>
                <span class="loader text-center">Loading...</span>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function deliveryPopup(product_id, pono, po_qty, pending_qty, sono ,name, stock) {
        document.getElementById("assigned_quantity").value = ''
        $("#so_id").val(sono)
        $("#product_id").val(product_id)
        $("#po_nos").html(pono)
        $("#product_names").html(name)
        $("#po_qtys").html(po_qty)
        $("#poqty1").val(po_qty)
        $('#stockQtyp').html(stock)
        $("#pending_qtys").html(pending_qty)
        $('#deliveryModalSchedule').modal('show')
    }
    
    function assignedQuantity() {
        var qty = parseInt($("#poqty1").val())
        var val = parseInt($('#assigned_quantity').val())
        console.log(val + '<' + qty)
        if(val >= qty) {
            $('#assigned_quantity').val('')
        }
        // if(val == qty) {
        //     document.getElementById("assigned_quantity").value = val
        // }
        // else if(val < qty) {
        //     document.getElementById("assigned_quantity").value = val
        // }
        // else {
        //     document.getElementById("assigned_quantity").value = ''
        // }
    }
</script>