<?php
$isNew       = true;
$name        = '';
$description = '';
if ( segment( 4 ) != '' ) {
	$isNew       = false;
	$data        = $gallery[0];
	$images      = $this->common_model->get_where( 'tbl_gallery_image', array( 'gallery_id' => $data['id'] ) );
	$name        = $data['name'];
	$description = $data['description'];
}
?>
<div class="box-header">
    <h3 class="box-title">Gallery Manager | <?php echo ( $isNew ) ? 'Add' : 'Update' ?></h3>
    <span class="pull-right add-new">
                    <a href="<?php echo base_url( 'admin/gallery/add_update' ) ?>" class="btn btn-success">Add New</a>
                </span>
</div><!-- /.box-header -->
<div class="box-body">
    <form action="" class="forms" method="post" enctype="multipart/form-data">
        <input type="hidden" id="base_url" value="<?php echo base_url() ?>">
        <table class="table table-bordered">
            <tr>
                <td>
                    <label>Album</label>
                    <input name="name" type="text" class="form-control" value="<?= $name ?>"/>
                </td>
                <td>
                    <label>Gallery Images</label>
                    <input type="file" name="img[]" multiple>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Description</label>
                    <textarea id="description" class="form-control" name="description"><?= $description ?></textarea>
                    <script type="text/javascript">
                        var editor = CKEDITOR.replace('description',
                            {
                                customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                            });
                        CKFinder.setupCKEditor(editor, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');
                    </script>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" class="btn btn-primary" value="Save">
                </td>
            </tr>
        </table>
    </form>

	<?php if ( isset( $images ) ) { ?>
        <table class="table table-striped table-bordered">
            <tr>
                <td width="50%">Image</td>
                <td>Action</td>
            </tr>
			<?php foreach ( $images as $image ) { ?>
                <tr>
                    <td>
                        <img src="<?= base_url( 'images/gallery/' . $image['image'] ) ?>" width="20%"/>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/gallery/feature_image/' . $image['id'] . '?back=' . current_url()) ?>" class="btn btn-<?= $image['featured'] ? 'info' : 'primary' ?>"><?= $image['featured'] ? 'Unfeature' : 'Featured' ?></a>
                        <a href="<?= base_url('admin/gallery/delete_image/' . $image['id'] . '?back=' . current_url()) ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
			<?php } ?>
        </table>
	<?php } ?>
</div><!-- /.box-body -->