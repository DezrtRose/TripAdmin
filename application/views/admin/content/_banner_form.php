<?php
$isNew = true;
if(segment(4) != '') {
    $banner = $banner[0];
    $isNew = false;
    $filename = $banner['filename'];
    $is_active = $banner['is_active'];
    $title = $banner['title'];
    $alt = $banner['alt'];
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Banner Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/content/add-update-banner') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form action="" method="post" class="forms" enctype="multipart/form-data">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>
                                <label>Banner Image <span class="text-danger">*</span></label>
                                <input type="file" name="banner" class="<?php echo ($isNew) ? 'required' : '' ?>">
                            </td>
                        </tr>
                        <?php if(!$isNew) { ?>
                            <tr>
                                <td>
                                    <img width="30%" src="<?php echo base_url('images/banner/'.$filename) ?>" class="img-responsive">
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>
                                <label>ALT Tag</label>
                                <input type="text" name="alt" class="form-control" value="<?php echo $isNew ? '' : $alt ?>">
                            </td>
                        </tr>
                        <input type="hidden" id="is_active" value="1" class="required" name="is_active">
                        <tr>
                            <td>
                                <label>Banner Caption</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $isNew ? '' : $title ?>">
                            </td>
                        </tr>
                        <tr>
                           
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