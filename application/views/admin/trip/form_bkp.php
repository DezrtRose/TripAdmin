<?php
$isNew = true;
if(segment(4) != '') {
    $trip = $trip[0];
    $isNew = false;
    $name = $trip['name'];
    $trip_id = $trip['id'];
    $slug = $trip['slug'];
    $is_new = $trip['is_new'];
    $duration = $trip['duration'];
    $max_altitude = $trip['max_altitude'];
    $group_size = $trip['group_size'];
    $grade = $trip['grade'];
    $accommodation = $trip['accommodation'];
    $meals = $trip['meals'];
    $overview = $trip['overview'];
    $itinerary = $trip['itinerary'];
    $dest_id = $trip['dest_id'];
    $act_id = $this->common_model->get_where('tbl_trip_activity', array('trip_id' => $trip_id));
    $acts[] = 0;
    if($act_id) {
        foreach($act_id as $a) {
            $acts[] = $a['act_id'];
        }
    }
    $act_id = $acts;
    $starting_point = $trip['starting_point'];
    $ending_point = $trip['ending_point'];
    $trek_mode = $trip['trek_mode'];
    $image = $trip['image'];
    $featured = $trip['featured'];
    $cost = $trip['cost'];
    $include = $trip['cost_inc'];
    $exclude = $trip['cost_ex'];
    $notes = $trip['notes'];
    $seo_meta_title = $trip['seo_meta_title'];
    $seo_meta_keywords = $trip['seo_meta_keywords'];
    $seo_meta_description = $trip['seo_meta_description'];
    $dates = $trip['departure'];
    $similar = explode(',', $trip['similar']);
    $transport = $trip['transport'];
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Trip Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/content/add-update') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form action="" method="post" class="forms">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>
                                <label>Trip Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo !$isNew ? $name : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Trip Duration(in days)</label>
                                <input type="text" class="form-control" name="duration" value="<?php echo !$isNew ? $duration : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Maximum Altitude(in meters)</label>
                                <input type="text" class="form-control" name="max_altitude" value="<?php echo !$isNew ? $max_altitude : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Group Size</label>
                                <input type="text" class="form-control" name="group_size" value="<?php echo !$isNew ? $group_size : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Cost</label>
                                <input type="text" class="form-control" name="cost" value="<?php echo !$isNew ? $cost : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Difficulty Grade</label>
                                <select class="form-control" name="grade">
                                    <option value="beginner" <?php echo (!$isNew && $grade == 'beginner') ? 'selected' : '' ?>>Beginner</option>
                                    <option value="easy" <?php echo (!$isNew && $grade == 'easy') ? 'selected' : '' ?>>Easy</option>
                                    <option value="moderate" <?php echo (!$isNew && $grade == 'moderate') ? 'selected' : '' ?>>Moderate</option>
                                    <option value="difficult" <?php echo (!$isNew && $grade == 'difficult') ? 'selected' : '' ?>>Difficult</option>
                                    <option value="advance" <?php echo (!$isNew && $grade == 'advance') ? 'selected' : '' ?>>Advance</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Starting Point</label>
                                <input type="text" class="form-control" name="starting_point" value="<?php echo !$isNew ? $starting_point : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Ending Point</label>
                                <input type="text" class="form-control" name="ending_point" value="<?php echo !$isNew ? $ending_point : '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Destination</label>
                                <select class="form-control" name="dest_id">
                                    <option value="">--select destination--</option>
                                    <?php
                                    $dest = $this->common_model->get_all('tbl_destinations');
                                    foreach($dest as $d){
                                    ?>
                                        <option value="<?php echo $d['id'] ?>" <?php echo (!$isNew && $d['id'] == $dest_id) ? 'selected' : '' ?>>
                                            <?php echo $d['destination'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Activity</label>
                                <select class="form-control" name="act_id[]" multiple>
                                    <option value="">--select activity--</option>
                                    <?php
                                    $dest = $this->common_model->get_all('tbl_activities');
                                    foreach($dest as $d){
                                        ?>
                                        <option value="<?php echo $d['id'] ?>" <?php echo (!$isNew && in_array($d['id'], $act_id)) ? 'selected' : '' ?>>
                                            <?php echo $d['activity'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Departure Dates</label>
                                <textarea name="departure" class="form-control" id="dates"><?php echo !$isNew ? $dates : '' ?></textarea>
                                <label for="dates" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('dates',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Accommodation</label>
                                <textarea name="accommodation" class="form-control" id="accommodation"><?php echo !$isNew ? $accommodation : '' ?></textarea>
                                <label for="accommodation" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('accommodation',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Meals</label>
                                <textarea name="meals" class="form-control" id="meals"><?php echo !$isNew ? $meals : '' ?></textarea>
                                <label for="meals" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('meals',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Transportation</label>
                                <textarea name="transport" class="form-control" id="transport"><?php echo !$isNew ? $transport : '' ?></textarea>
                                <label for="transport" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('transport',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Trek Mode</label>
                                <textarea name="trek_mode" class="form-control" id="trek_mode"><?php echo !$isNew ? $trek_mode : '' ?></textarea>
                                <label for="trek_mode" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('trek_mode',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Overview</label>
                                <textarea name="overview" class="form-control" id="overview"><?php echo !$isNew ? $overview : '' ?></textarea>
                                <label for="overview" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('overview',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Itinerary</label>
                                <textarea name="itinerary" class="form-control" id="itinerary"><?php echo !$isNew ? $itinerary : '' ?></textarea>
                                <label for="itinerary" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('itinerary',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Include</label>
                                <textarea name="cost_inc" class="form-control" id="cost_inc"><?php echo !$isNew ? $include : '' ?></textarea>
                                <label for="cost_inc" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('cost_inc',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Exclude</label>
                                <textarea name="cost_ex" class="form-control" id="cost_ex"><?php echo !$isNew ? $exclude : '' ?></textarea>
                                <label for="cost_ex" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('cost_ex',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tour Notes</label>
                                <textarea name="notes" class="form-control" id="notes"><?php echo !$isNew ? $notes : '' ?></textarea>
                                <label for="notes" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('notes',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Choose Similar Trip</label>
                                <select name="similar[]" class="form-control" multiple>
                                    <?php
                                    $dest = (!$isNew) ? $this->common_model->get_where('tbl_trips', array('id !=' => $trip_id)) : $this->common_model->get_all('tbl_trips');
                                    foreach($dest as $d){
                                        ?>
                                        <option value="<?php echo $d['id'] ?>" <?php echo (!$isNew && in_array($d['id'], $similar)) ? 'selected' : '' ?>>
                                            <?php echo $d['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Meta Title</label>
                                <textarea name="seo_meta_title" class="form-control" id="seo_meta_title"><?php echo !$isNew ? $seo_meta_title : '' ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Meta Keywords</label>
                                <textarea name="seo_meta_keywords" class="form-control" id="seo_meta_keywords"><?php echo !$isNew ? $seo_meta_keywords : '' ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Meta Description</label>
                                <textarea name="seo_meta_description" class="form-control" id="seo_meta_description"><?php echo !$isNew ? $seo_meta_description : '' ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Featured</label>
                                <input type="radio" name="featured" value="1" <?php echo (!$isNew && $featured == 1) ? 'checked' : '' ?>> Yes
                                <input type="radio" name="featured" value="0" <?php echo (!$isNew && $featured == 0) ? 'checked' : '' ?>> No
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>New Route?</label>
                                <input type="radio" name="is_new" value="1" <?php echo (!$isNew && $is_new == 1) ? 'checked' : '' ?>> Yes
                                <input type="radio" name="is_new" value="0" <?php echo (!$isNew && $is_new == 0) ? 'checked' : '' ?>> No
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="has-ckeditor" class="btn btn-primary" type="submit" value="Save">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->