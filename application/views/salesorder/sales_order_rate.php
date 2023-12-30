<section id="basic-datatable">
    <?= form_open_multipart('salesorder/crop_order_qty', array('id' => 'registerForm', 'class' => 'form')) ?>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4> RECENT SALES ORDERS-RATE APPROVAL</h4>
                <div class="row">
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead style="background-color:#8B0000;">
                        <tr>
                            <!-- <th style="color:white;">Select</th> -->
                            <th style="color:white;" nowrap>SO NO</th>
                            <th style="color:white;" nowrap>PO NO</th>
                            <th style="color:white;" nowrap>Product</th>
                            <th style="color:white;" nowrap>Promised Date</th>
                            <th style="color:white;" nowrap>Ordered</th>
                            <th style="color:white;">Stock</th>
                            <th style="color:white;">Calculated Rate</th>
                            <th style="color:white;">Agreed Rate</th>
                            <th style="color:white;"nowrap>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) {?>
                        <tr>
                            <td class=""><?php echo $row->sono ?></td>
                            <td class=""><a href="<?php echo base_url() ?>salesorder/view_po_no/<?php echo $row->pono ?>"><?php echo $row->pono ?></a></td>
                            <td><a href="<?php echo base_url() ?>salesorder/view_product/<?php echo $row->product_id ?>/0"><?php echo $row->name .' '. $row->product_name ?></td>
                            <td><?php echo (isset($row->accepting_date) ? $row->accepting_date : '') ?></td>
                            <td><?php echo (isset($row->po_qty) ? $row->po_qty : 0) ?></td>
                            <td><?php echo (isset($row->stock) ? $row->stock : 0) ?></td>
                            <td><input type="text" id="name" class="form-control" placeholder="Calculated Rate" name="calculated_rate"></td>
                            <td><input type="text" id="name" class="form-control" placeholder="Agreed rate" name="agreed_rate"></td>
                            <td><button type="button" class="btn btn-primary btn-xs" onclick="ratePopup(<?= $row->product_id ?>, '<?= $row->pono ?>', <?= $row->po_qty ?>, <?= $row->pending_qty ?>, <?= $row->id ?>, '<?= $row->name . $row->description ?>', <?= $row->stock?>)">Approve</button>
                                <?php } ?>
                            </td>
                            
                        </tr>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                           <th style="color:white;" nowrap>SO NO</th>
                            <th style="color:white;" nowrap>PO NO</th>
                            <th style="color:white;" nowrap>Product</th>
                            <th style="color:white;" nowrap>Promised Date</th>
                            <th style="color:white;" nowrap>Ordered</th>
                            <th style="color:white;">Stock</th>
                            <th style="color:white;">Calculated Rate</th>
                            <th style="color:white;">Agreed Rate</th>
                            <th style="color:white;"nowrap>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</section>

<!-- Modal -->
<div class="modal fade" id="rateModalSchedule" tabindex="-1" role="dialog" aria-labelledby="rateModalScheduleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--<form class="ajax-form" ajax-url="/ajax/add_delivery_assign">-->
            <form class="ajax-form" ajax-url="/ajax/add_rate">
                <div class="modal-header">
                    <h5 class="modal-title" id="deliveryModalScheduleLabel">ADD RATE</h5>
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
                       <!-- <label for="assigned_quantity">Calculated Rate</label>-->
                        <label for="calculated_rate">Calculated Rate</label>

                        <input type="hidden" id="so_id" name="so_id" value="">
                        <input type="hidden" id="product_id" name="product_id" value="">
                       <!--<input type="number" class="form-control" id="assigned_quantity" name="assigned_quantity" placeholder="Allocate QTY" onblur="assignedQuantity()">-->
                        <input type="number" class="form-control" id="calculated_rate" name="calculated_rate" placeholder="Calculated Rate">
                        <input type="number" class="form-control" id="approved_rate" name="approved_rate" placeholder="Approved Rate">
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