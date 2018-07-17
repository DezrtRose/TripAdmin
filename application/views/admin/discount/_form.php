<style>
    #season_name {
        display: none;
    }
</style>
<?php
$isNew = true;
if(segment(4) != '') {
    $isNew = false;
    $data = $discount[0];
    $trip_id = $data['trip_id'];
    $discount = $data['discount'];
}
?>
<div class="box-header">
    <h3 class="box-title">Discount Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/discount/add_update') ?>" class="btn btn-success">Add New</a>
                </span>
</div><!-- /.box-header -->
<div class="box-body">
    <form action="" class="forms" method="post">
        <table class="table table-bordered">
            <tr>
                <td>
                    <label>Select Trip</label>
                    <select name="trip_id" class="form-control">
                        <option value="">Select Trip</option>
                        <?php
                        $trips = $this->common_model->get_where('tbl_trips', array('cost !=' => 0));
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
                    <label>Discount Rate</label>
                    <input type="text" class="form-control required" name="discount" value="<?php echo (!$isNew) ? $discount : '' ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Occasional Discount: </label>
                    <input type="checkbox" onclick="show_occasion_name()">
                </td>
            </tr>
            <tr id="season_name">
                <td>
                    <label>Occasion Name</label>
                    <input type="text" placeholder="Enter the name of the occasion" class="form-control required" name="occasion_name"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="btn btn-primary" value="Save">
                </td>
            </tr>
        </table>
    </form>
</div><!-- /.box-body -->
<script>
    function show_occasion_name() {
        var season_name = $('#season_name');
        season_name.toggle();
    }
</script>