<section id="basic-datatable">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Recent Work Order</h4>
        </div>
        <div class="card-body card-dashboard">
            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Work Order Id</th>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Buyer Name</th>
                            <th>Promising Date</th>                            
                            <th>Production Qty</th>
                            <th>Board Qty</th>
                            <th>Lot Qty</th>
                            <th>Print Type</th>
                            <th>Print Side</th>
                            <th>Issue Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) { ?>
                            <tr>
                                <td class=""><?php echo $row->id ?></td>
                                <td class=""><?php echo $row->wo_no ?></td>
                                <td class=""><?php echo $row->product_id ?></td>
                                <td><?php echo $row->product_name ?></td>
                                <td><?php echo $row->buyer_name ?></td>
                                <td><?php echo $row->promised_date ?></td>                                
                                <td><?php echo (isset($row->prd_qty) ? $row->prd_qty : 0) ?></td>
                                <td><?php echo (isset($row->board_qty) ? $row->board_qty : 0) ?></td>
                                <td><?php echo $row->lot_no ?></td>
                                <td><?php echo $row->print_type ?></td>
                                <td><?php echo $row->print_side ?></td>
                                <td><?php echo $row-> issue_status ?></td>
                                <td><a href="<?php echo base_url() ?>workorder/work_order_material_cutting" class="btn btn-primary">Inventory Cutting</a>  </td>    
                            </tr>
                        <?php } ?>


                    </tbody>
                </table>

            </div>

        </div>
        <?php if (isset($row->po_qty) && $row->po_qty > 0 && $row->po_qty > 0) { ?>
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#productionModalSchedule" data-hidden-product_id="<?php echo $row->product_id ?>" data-hidden-so_id="<?php echo $row->id ?>" data-table-refresh="true">Production Schedule</button>
        <?php } ?>

    </div>
    <?php echo form_close(); ?>
</section>


<!-- Modal -->
<div class="modal fade" id="deliveryModalSchedule" tabindex="-1" role="dialog" aria-labelledby="deliveryModalScheduleLabel" aria-hidden="true">
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
                            <td id="po_nos"><?php echo $row->po_no ?></td>
                            <td id="product_names"><?php echo $row->product_name ?></td>
                            <td id="po_qtys"><?php echo $row->po_qty ?></td>
                            <td id="pending_qtys"><?php echo (isset($row->pending_qty) ? $row->pending_qty : 0) ?></td>
                        </tr>
                    </table> 



                    <div class="form-group">
                        <label for="assigned_quantity">Assign QTY</label>
                        <input type="text" class="form-control" id="assigned_quantity" name="assigned_quantity" placeholder="Allocate QTY">
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
                </div>
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

