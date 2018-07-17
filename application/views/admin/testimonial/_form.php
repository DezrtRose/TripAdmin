<?php
$isNew = true;
if(segment(4) != '') {
    $testimonial = $testimonial[0];
    $isNew = false;
    $name = $testimonial['by'];
    $image  = $testimonial['image'];
    $email  = $testimonial['email'];
    $desc = $testimonial['desc'];
    $approved = $testimonial['approved'];
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Testimonial Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/testimonial/add-update') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form action="" method="post" class="forms">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <input type="hidden" name="approved" value="<?php echo !$isNew ? $approved : '1' ?>">
                            <td>
                                <label>Testimonial By <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter page name" class="form-control required" name="by" value="<?php echo !$isNew ? $name : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Image</label>
                                <input onclick="BrowseServer(this);" data-multiple="false" id="user-image" data-resource-type="Images" type="text" placeholder="Select image" class="form-control" name="image" value="<?php echo !$isNew ? $image : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email Address</label>
                                <input type="text" placeholder="Enter email address" class="form-control email" name="email" value="<?php echo !$isNew ? $email : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Testimonial Content <span class="text-danger">*</span></label>
                                <textarea rows="5" name="desc" placeholder="Enter page description" class="form-control required" id="desc"><?php echo !$isNew ? $desc : '' ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="btn btn-primary" type="submit" value="Save">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->