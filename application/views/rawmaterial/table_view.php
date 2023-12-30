<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $table_name ?></h4>
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary" href="<?php echo base_url() ?>rawmaterial/add_item/<?php echo $table_name ?>">Add Item</a>
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
                                    <th>Id</th>
                                    <th>Name</th>
                                   <!-- <th>category</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($data1 as $row) {
                                ?>
                                    <tr>
                                        <td class="text-bold-500"><?php echo $row->id ?></td>
                                        <td><?php echo $row->name ?></td>
                                        <!--<td><?php echo $row->category ?></td> -->
                                        <td><a class="btn btn-info" href="<?php echo base_url() ?>rawmaterial/edit_item/<?php echo $table_name ?>/<?php echo $row->id ?>">Edit</a>
                                            <a class="btn btn-danger" href="<?php echo base_url() ?>rawmaterial/delete_item/<?php echo $table_name ?>/<?php echo $row->id ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
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