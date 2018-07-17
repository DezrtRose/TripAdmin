<?php
$isNew = true;
if(segment(4) != '') {
    $isNew = false;
    $data = $tripmenu[0];
    $trip_id = $data['trip_id'];
    $altitude_chart = $data['altitude_chart'];
    $acclimatzation = $data['acclimatzation'];
    $leader_staff = $data['leader_staff'];
    $experience = $data['experience'];
    $trip_faq = $data['trip_faq'];
    $high_altitude = $data['high_altitude'];
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Trip Menu Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/tripmenu/add_update') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form action="" method="post" class="trips_add_form">
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
                                <label>Altitude Chart</label>
                                <textarea required="required" class="ckeditor1" id="altitude_chart" rows="10" name="altitude_chart"><?php if(!$isNew){echo $altitude_chart;}?></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('altitude_chart',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url()?>plugins/ckfinder/');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Acclimatzation</label>
                                <textarea required="required" class="ckeditor1" id="acclimatzation" rows="10" name="acclimatzation"><?php if(!$isNew){echo $acclimatzation;}?></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('acclimatzation',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url()?>plugins/ckfinder/');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Leader & Staff</label>
                                <textarea required="required" class="ckeditor1" id="leader_staff" rows="10" name="leader_staff"><?php if(!$isNew){echo $leader_staff;}?></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('leader_staff',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url()?>plugins/ckfinder/');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Experience Required</label>
                                <textarea required="required" class="ckeditor1" id="experience" rows="10" name="experience"><?php if(!$isNew){echo $experience;}?></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('experience',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url()?>plugins/ckfinder/');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Trip FAQ</label>
                                <textarea required="required" class="ckeditor1" id="trip_faq" rows="10" name="trip_faq"><?php if(!$isNew){echo $trip_faq;}?></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('trip_faq',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url()?>plugins/ckfinder/');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>High Altitude</label>
                                <textarea required="required" class="ckeditor1" id="high_altitude" rows="10" name="high_altitude"><?php if(!$isNew){echo $high_altitude;}?></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('high_altitude',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url()?>plugins/ckfinder/');
                                </script>
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