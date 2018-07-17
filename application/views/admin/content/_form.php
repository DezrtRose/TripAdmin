<?php
$isNew = true;
if(segment(4) != '' || $this->session->userdata('page_data')) {
    $page = segment(4) != '' ? $page[0] : $this->session->userdata('page_data');
    $isNew = false;
    $name = $page['name'];
    $desc = $page['desc'];
    $is_active = $page['is_active'];
    $is_footer = isset($page['is_footer']) ? $page['is_footer'] : '';
    $parent_page = $page['parent_page'];
	$seo_title = $page['seo_title'];
	$seo_description = $page['seo_description'];
	$seo_keyword = $page['seo_keyword'];
	$seo_image = isset($page['seo_image']) ? $page['seo_image'] : '';
	$slug = $page['slug'];
	$canonical_url = $page['canonical_url'];
	$banner_image = isset($page['banner_image']) ? $page['banner_image'] : '';
	$banner_image_alt = $page['banner_image_alt'];
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <?= flash() ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Page Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/content/add-update') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form action="" method="post" class="forms" enctype="multipart/form-data">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General Information</a></li>
                        <li role="presentation"><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SEO Manager</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="general">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>
                                        <label>Parent Page</label>
                                        <select name="parent_page" class="form-control">
                                            <option>Select Parent Page</option>
					                        <?php foreach($pages as $page) { ?>
                                                <option <?= !$isNew && $page['id'] == $parent_page ? 'selected' : '' ?> value="<?= $page['id'] ?>"><?= $page['name'] ?></option>
					                        <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label>Page Name <span class="text-danger">*</span></label>
                                        <input id="slug-source" type="text" placeholder="Enter page name" class="form-control required" name="name" value="<?php echo !$isNew ? $name : '' ?>">
                                    </td>
                                    <td>
                                        <label>Slug <span class="text-danger">*</span></label>
                                        <input id="slug-target" type="text" placeholder="Enter slug" class="form-control required" name="slug" value="<?php echo !$isNew ? $slug : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Banner image</label>
                                        <input type="file" class="form-control" name="banner_image">
		                                <?php if(isset($banner_image) && $banner_image != '') { ?>
                                            <img src="<?= base_url('images/page/' . $banner_image) ?>" width="25%">
		                                <?php } ?>
                                    </td>
                                    <td colspan="2">
                                        <label>Banner Image ALT Tag</label>
                                        <input type="text" class="form-control" name="banner_image_alt" value="<?php echo (!$isNew) ? $banner_image_alt : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <label>Page Description <span class="text-danger">*</span></label>
                                        <textarea name="desc" placeholder="Enter page description" class="form-control required" id="desc"><?php echo !$isNew ? $desc : '' ?></textarea>
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
                                    <td colspan="3">
                                        <label>Is Footer Page</label>
                                        <input type="radio" name="is_footer" <?php echo (!$isNew && $is_footer == 1) ? 'checked' : '' ?> value="1"> Yes
                                        <input type="radio" name="is_footer" <?php echo (!$isNew && $is_footer == 0) ? 'checked' : '' ?> value="0"> No
                                    </td>
                                </tr>
                                <input type="hidden" id="is_active" value="1" class="required" name="is_active">
                                <tr>
                                    <td colspan="3">
                                        <input id="has-ckeditor" class="btn btn-primary" type="submit" value="Save">
                                    </td>
                                </tr>
                                </tbody>
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
                                            <img src="<?= base_url('images/page/' . $seo_image) ?>" width="25%">
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
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->
<script>
    $(document).ready(function() {
        $('#slug-target').slugify('#slug-source');
    })
</script>