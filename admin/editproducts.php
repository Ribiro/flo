<!-- Add product-->
<div class="modal fade" id="update_product<?php echo $fetch['product_id']?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="action.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label" >Product Name</label>

                        <div class="col-sm-5">
                            <input type="hidden" name="id" value="<?php echo $fetch['product_id'] ?>">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $fetch['product_name'] ?>" required>
                        </div>

                        <label for="category" class="col-sm-3 control-label">Category</label>

                        <div class="col-sm-5">
                            <select class="form-control" id="category" name="category" required>
                                <option value="<?php echo $fetch['id']?>"><?php echo $fetch['name']?></option>
                                <?php
                                $result=mysqli_query($con,"select * from category")or die ("query 1 incorrect.....");

                                while(list($id,$name)=mysqli_fetch_array($result))
                                {
                                    echo "
                                    <option value='$id'>$name</option>
                                   ";
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-3 control-label">Price</label>

                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="price" name="price" value="<?php echo $fetch['price'] ?>" required>
                        </div>

                        <label for="photo" class="col-sm-3 control-label">Photo</label>

                        <div class="col-sm-5">
                            <input type="file" id="image" name="image" value="<?php echo $fetch['photo'] ?>">
                        </div>
                    </div>
                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="editProduct"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>