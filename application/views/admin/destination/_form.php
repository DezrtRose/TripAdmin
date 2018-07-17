<?php
$isNew = true;
if(segment(4) != '' || $this->session->userdata('destination_data')) {
    $data = segment(4) != '' ? $destination[0] : $this->session->userdata('destination_data');
    $isNew = false;
    $name = $data['destination'];
    $seo_title = $data['seo_title'];
    $seo_description = $data['seo_description'];
    $seo_keyword = $data['seo_keyword'];
    $seo_image = isset($data['seo_image']) ? $data['seo_image'] : '';
    $description = $data['description'];
    $banner_image = isset($data['banner_image']) ? $data['banner_image'] : '';
    $banner_image_alt = $data['banner_image_alt'];
    $slug = $data['slug'];
    $canonical_url = $data['canonical_url'];
}
?>
<div class="box-header">
    <h3 class="box-title">Destination Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/destination/add_update') ?>" class="btn btn-success">Add New</a>
                </span>
</div><!-- /.box-header -->
<div class="box-body">
    <form action="" class="forms" method="post" enctype="multipart/form-data">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General Information</a></li>
            <li role="presentation"><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SEO Manager</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="general">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <label>Add destination</label>
                            <input id="slug-source" type="text" class="form-control required" name="destination" value="<?php echo (!$isNew) ? $name : '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Destination Slug</label>
                            <input id="slug-target" type="text" class="form-control required" name="slug" value="<?php echo (!$isNew) ? $slug : '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Banner image</label>
                            <input type="file" class="form-control" name="banner_image">
	                        <?php if(isset($banner_image) && $banner_image != '') { ?>
                                <img src="<?= base_url('images/destination/' . $banner_image) ?>" width="25%">
	                        <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Banner Image ALT Tag</label>
                            <input type="text" class="form-control" name="banner_image_alt" value="<?php echo (!$isNew) ? $banner_image_alt : '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Description</label>
                            <textarea id="description" class="form-control" name="description"><?= (!$isNew) ? $description : '' ?></textarea>
                            <script type="text/javascript">
                                var editor = CKEDITOR.replace('description',
                                    {
                                        customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                    });
                                CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="has-ckeditor" type="submit" class="btn btn-primary" value="Save">
                        </td>
                    </tr>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="seo">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <label>Meta Title</label>
                            <input type="text" class="form-control" name="seo_title" value="<?php echo (!$isNew) ? $seo_title : '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Meta Keyword</label>
                            <input type="text" class="form-control" name="seo_keyword" value="<?php echo (!$isNew) ? $seo_keyword : '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Canonical URL</label>
                            <input type="text" class="form-control" name="canonical_url" value="<?php echo (!$isNew) ? $canonical_url : '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Meta Description</label>
                            <textarea class="form-control" id="seo_description" name="seo_description"><?= (!$isNew) ? $seo_description : '' ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Social image</label>
                            <input type="file" class="form-control" name="seo_image">
	                        <?php if(isset($seo_image) && $seo_image != '') { ?>
                                <img src="<?= base_url('images/destination/' . $seo_image) ?>" width="25%">
	                        <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="has-ckeditor" type="submit" class="btn btn-primary" value="Save">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div><!-- /.box-body -->
<script>
    $(document).ready(function() {
        $('#slug-target').slugify('#slug-source');
    })
</script>