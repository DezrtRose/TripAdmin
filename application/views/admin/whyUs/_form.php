










<style>
    #ui-datepicker-div {
        z-index: 9999!important;
        font-size: 12px!important;
    }
</style>
<?php

$id = '';
$title = '';
$description = '';

if(isset($dataToEdit)){
    $id = $dataToEdit->id;
    $title = $dataToEdit->why_us_title;
    $description = $dataToEdit->why_us_description;
}

?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Why Us Manager | <?php // echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/why-travel-with-us/form') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
	    
	    
            <div class="box-body">
                <form action="<?= base_url('admin/why-travel-with-us/form') ?>" method="post" class="forms">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>
                                <label>Why Us Title<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter title" class="form-control required" name="why_us_title" value="<?= $title ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Why Us Description <span class="text-danger">*</span></label>
                                <textarea name="why_us_description" placeholder="Enter news description" class="form-control required" id="desc"><?= $description ?></textarea>
                                <label for="desc" class="error" style="display:none;">This field is required</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('desc',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                            </td>
                        </tr>
                        
			<tr>
                            <td>
				<input type="hidden" name="id" value="<?= $id ?>">
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

