<?php
$isNew = true;
if(segment(4) != '') {
    $isNew = false;
    $data = $tripslider[0];
    $trip_id = $data['trip_id'];
    $image = $data['image'];
    $title = $data['title'];
    $description = $data['description'];
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Trip Slider Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/tripslider/add_update') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form enctype="multipart/form-data" action="" method="post" class="trips_add_form">
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <label>Select Trip <span class="text-danger">*</span></label>
                                <select class="form-control" name="trip_id">
                                    <option value="">Select Trip</option>
                                    <?php
                                    $trips = $this->common_model->get_all('tbl_trips');
                                    foreach($trips as $t) { ?>
                                        <option value="<?php echo $t['id'] ?>" <?php echo (!$isNew && $trip_id == $t['id']) ? 'selected' : '' ?>>
                                            <?php echo $t['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Trip Image</label>
                                <input type="file" name="photo">
                            </td>
                        </tr>
                        <?php if(!$isNew) { ?>
                            <tr>
                                <td>
                                    <img src="<?php echo base_url('images/trip/'.$image) ?>" width="35%">
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>
                                <label>Slider Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $isNew ? '' : $title ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="save" class="btn btn-primary" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->