<section id="floating-label-layouts">
    <div class="row match-height">
        <div class="col">
            <!--col-md-6 col-12-->
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $table_name ?></h4>
                    </div>

                    <div class="card-body">
                        <?php echo form_open('finished/store_item', array('id' => 'registerForm', 'class' => 'form')) ?>
                        <div class="form-body">
                         <div class="col-md-6 col-12">
                                    <div class="form-label-group">
                                        <input type="hidden" id="table_name" class="form-control" name="table_name" value="<?php echo $table_name ?>" readonly>

                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-label-group">
                                        <input type="text" id="name" class="form-control" placeholder="Enter Name" name="name">
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-label-group">
                                        <input type="hidden" id="category" class="form-control" placeholder="Enter Category" name="category">
                                    </div>
                                </div>
                             </div>
                               
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mr-1">Submit</button>

                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
    </div>

</section>