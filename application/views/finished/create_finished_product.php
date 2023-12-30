<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Finished Product</h4>
                </div>
                <div class="card-body">
                    <?php echo form_open_multipart('dashboard/finished_product_store', array('id' =>
                    'registerForm','class'=>'form form-horizontal')) ?>

                    <div class="form-body">
                        <div class="row mt-1 mb-2">
                                <div class="col-4">
                                    <label  style="font-size:15px;color:black;">Product Title</label>
                                    <input type="text" class="form-control" name="name" placeholder="Product name" />
                                </div>
                               <div class="col-4">
                                    <label  style="font-size:15px;color:black;">Description</label>
                                    <input type="text" class="form-control" name="description" placeholder="description" />
                                </div>

                                <div class="col-4">
                                    <label  style="font-size:15px;color:black;">select Buyer</label>
                                    <select name="buyer" class="form-control">
                                        <option value="">Select buyer </option>
                                        <?php foreach($buyer as $row) {?>
                                        <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                        <?php }?>
                                    </select>
                                </div>

                            <div class="col-4">
                                        <label  style="font-size:15px;color:black;">select Product Category</label>
                                        <select name="category" class="form-control">
                                            <option value="">Select Category </option>
                                            <?php foreach($categories as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row mt-1 mb-2">
                                <div class="col-4">
                                    <label  style="font-size:15px;color:black;">Product Dimension (Length X Breath)in mm</label>
                                    <input type="text" class="form-control" name="productdimension" placeholder="Product Dimension" />
                                </div>

                                <div class="col-4">
                                    <label  style="font-size:15px;color:black;">Select UOM</label>
                                    <select name="uom" class="form-control">
                                        <option value="">Select UOM </option>
                                        <option value="Pieces">Pieces </option>
                                        <option value="Bundles">Bundles </option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label  style="font-size:15px;color:black;">select Product photo</label>
                                    <input id="photo" type="file" name="photo" class="form-control" />
                                </div>
                                </div>
                                <div class="row mt-1 mb-2">
                                <div class="col-4">
                                  
                                        <label  style="font-size:15px;color:black;">Holes Shape</label>
                                        <input name="product_holes" type="text" class="form-control" value="" placeholder="Holes shape"/>
                                    </div>
                                    
                                    <div class="col-4">
                                        <label  style="font-size:15px;color:black;">Holes Diameter in mm</label>
                                        <input name="product_diameter" type="text" class="form-control" value="" placeholder="Dia in mm" />
                                    </div>
                                    </div>

                               

                                <div class="row mt-1 mb-2">
                                    <div class="col-2">
                                        <input id="is_front" checked onchange="onChangeFrontSide(this)" type="checkbox" name="is_front" value="1" />
                                        <label for="is_front"><h4>Front</h4></label>
                                    </div>
                                    <div class="col-2">
                                        <input id="is_back" onclick="onChangeBackSide(this)" type="checkbox" name="is_back" value="1" />
                                        <label for="is_back"><h4>Pasting-1</h4></label>
                                    </div>
                                    <div class="col-2">
                                        <input id="is_back" onclick="onChangeBackSide(this)" type="checkbox" name="is_p2" value="1" />
                                        <label for="is_back"><h4>Pasting-2</h4></label>
                                    </div>
                                    <div class="col-2">
                                        <input id="is_back" onclick="onChangeBackSide(this)" type="checkbox" name="is_p3" value="1" />
                                        <label for="is_back"><h4>Pasting-3</h4></label>
                                    </div>
                                    <div class="col-2">
                                        <input id="is_back" onclick="onChangeBackSide(this)" type="checkbox" name="is_p4" value="1" />
                                        <label for="is_back"><h4>Pasting-4</h4></label>
                                    </div>
                                </div>
                               </div>

                                                           
                            <div class="row mt-1 mb-2">
                                <div class="col-md-2">
                                    <section id="front_side">
                                            <div class="row mt-1">
                                                            <label  style="font-size:15px;color:black;">select Front Brand</label>
                                                            <select name="f_category" class="form-control">
                                                                <option value="">Select brand </option>
                                                                <?php foreach($brand as $row) {?>
                                                                <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                            <div class="row mt-1">
                                                            <label  style="font-size:15px;color:black;">select Front Gsm</label>
                                                            <select name="f_gsm" class="form-control">
                                                                <option value="">Select GSM </option>
                                                                <?php foreach($gsm as $row) {?>
                                                                <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>

                                            <div class="row mt-1">
                                                            <label  style="font-size:15px;color:black;">select Front product Board</label>
                                                            <select name="f_board" class="form-control">
                                                                <option value="">Select Board </option>
                                                                <?php foreach($board as $row) {?>
                                                                <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                            </div>
                    <div class="col-md-2">
                                <section id="back_side" style="display:none;">

                                        <div class="row mt-1">
                                        <label  style="font-size:15px;color:black;">select Back Brand</label>
                                        <select name="b_category" class="form-control">
                                            <option value="">Select Back Brand </option>
                                            <?php foreach($brand as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="row mt-1">
                                        <label  style="font-size:15px;color:black;">select Back Gsm</label>
                                        <select name="b_gsm" class="form-control">
                                            <option value="">Select GSM </option>
                                            <?php foreach($gsm as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="row mt-1">
                                        <label  style="font-size:15px;color:black;">select Back product Board</label>
                                        <select name="b_board" class="form-control">
                                            <option value="">Select Board </option>
                                            <?php foreach($board as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    </div>
                                    <!--<div class="row mt-1"> 
                                    <label  style="font-size:15px;color:black;">Front Cutting Process Details</label></div>
                                    <div class="row mt-1"> 
                                        <div class="form-group col-md-5">
                                            <input type="text" class="form-control" value="1" readonly />
                                        </div>/
                                        <div class="form-group col-md-5">
                                            <input type="text" class="form-control" value="2" />
                                        </div>
                                    </div>
									
                                    <div class="row mt-1">
                                        <label  style="font-size:15px;color:black;">Front Cutting Steps</label>
                                        <input name="f_steps" type="text" class="form-control" value="" placeholder="steps"/>
                                    </div>
                                    <div class="row mt-1">
                                        <label  style="font-size:15px;color:black;">Front Cut Size (Length x Breath in mm)</label>
                                        <input name="f_cut_size" type="text" class="form-control" value="" placeholder="cut_size"/>
                                    </div>-->
                               <!-- <div class="row mt-1">
                                    <div class="col-md-12">
                                    <label  style="font-size:15px;color:black;"><h4>Production stages</h4></label></br>
                                        <label  style="font-size:15px;color:black;">Stage 1</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="stage1[]" class="form-control">
                                            <option value="">Select Machine </option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    <input name="stage1[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>
                                <div class="row mt-1">
                                <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 2</label>
                                    </div>
                                     <div class="col-md-4">
                                        <select name="stage2[]" class="form-control">
                                            <option value="">Select process_stages </option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    <input name="stage2[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 3</label>
                                    </div>
                           
                                    <div class="col-md-4">
                                        <select name="stage3[]" class="form-control">
                                            <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    <input name="stage3[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>                                
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 4</label>
                                    </div>
                              
                                    <div class="col-md-4">
                                        <select name="stage4[]" class="form-control">
                                            <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    <input name="stage4[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>
                                
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 5</label>
                                    </div>
                         
                                    <div class="col-md-4">
                                        <select name="stage5[]" class="form-control">
                                            <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    <input name="stage5[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>                                
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 6</label>
                                    </div>
                                <div class="col-md-4">
                                        <select name="stage6[]" class="form-control">
                                            <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input name="stage6[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>                                
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 7</label>
                                    </div>
                                   
                                    <div class="col-md-4">
                                        <select name="stage7[]" class="form-control">
                                            <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    <input name="stage7[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div> 
    

                                </section>
                                </div> -->                               
                                    <!--<div class="row mt-1"> 
                                    <label  style="font-size:15px;color:black;">Back Cutting Process Details</label></div>
                                    <div class="row mt-1"> 
                                        <div class="form-group col-md-5">
                                            <input type="text" class="form-control" value="1" readonly />
                                        </div>/
                                        <div class="form-group col-md-5">
                                            <input type="text" class="form-control" value="2" />
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label  style="font-size:15px;color:black;">Back Cutting Steps</label>
                                        <input name="b_steps" type="text" class="form-control" value="" placeholder="steps" />
                                    </div>
                                    <div class="row mt-1">
                                        <label  style="font-size:15px;color:black;">Back Cut Size (Length x Breath in mm)</label>
                                        <input name="b_cut_size" type="text" class="form-control" value="" placeholder="cut_size" />
                                    </div> -->   
                          
                               <!-- <div class="row mt-1">
                                    <div class="col-md-12">
                                    <label  style="font-size:15px;color:black;"><h4>Production stages</h4></label></br>
                                        <label  style="font-size:15px;color:black;">select Product Stage 8</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="stage8[]" class="form-control">
                                            <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    <input name="stage8[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>                                
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 9</label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="stage9[]" class="form-control">
                                            <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    <input name="stage9[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>                                
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 10</label>
                                    </div>
                    
                                    <div class="col-md-4">
                                        <select name="stage10[]" class="form-control">
                                           <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input name="stage10[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 11</label>
                                    </div>
                       
                                    <div class="col-md-4">
                                        <select name="stage11[]" class="form-control">
                                           <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input name="stage11[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 12</label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="stage12[]" class="form-control">
                                           <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input name="stage12[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 13</label>
                                    </div>
           
                                    <div class="col-md-4">
                                        <select name="stage13[]" class="form-control">
                                           <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input name="stage13[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 14</label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="stage14[]" class="form-control">
                                           <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input name="stage14[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label  style="font-size:15px;color:black;">select Product Stage 15</label>
                                    </div>
 
                                    <div class="col-md-4">
                                        <select name="stage15[]" class="form-control">
                                           <option value="">process_stages</option>
                                            <?php foreach($process_stages as $row) {?>
                                            <option value="<?php echo$row->name?>"><?php echo$row->name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input name="stage15[]" type="text" class="form-control" value="" placeholder="Enter Process Description" />
                                    </div> --> 
                                </div>                             
                                </section>
                            </div>

    
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                        </div>
                    </div>

                    <?php echo form_close();?>
                </div>
            </div>
            
        </div>
    </div>
</section>