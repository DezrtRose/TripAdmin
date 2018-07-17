<style>
    #ui-datepicker-div {
        z-index: 9999!important;
        font-size: 12px!important;
    }
</style>
<?php
$isNew = true;
if(segment(4) != '' || $this->session->userdata('news_data')) {
    $news = segment(4) != '' ? $news[0] : $this->session->userdata('news_data');
    $isNew = false;
    $name = $news['name'];
    $slug = $news['slug'];
	$seo_title = $news['seo_title'];
	$seo_description = $news['seo_description'];
	$seo_keyword = $news['seo_keyword'];
	$seo_image = isset($news['seo_image']) ? $news['seo_image'] : '';
    $desc = $news['desc'];
    $image = isset($news['image']) ? $news['image'] : '';
    $canonical_url = $news['canonical_url'];
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <?= flash() ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Blog Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/news/add_update') ?>" class="btn btn-success">Add New</a>
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
                                        <label>Blog Title<span class="text-danger">*</span></label>
                                        <input id="slug-source" type="text" placeholder="Enter news title" class="form-control required" name="name" value="<?php echo !$isNew ? $name : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Slug<span class="text-danger">*</span></label>
                                        <input id="slug-target" type="text" placeholder="Enter slug" class="form-control required" name="slug" value="<?php echo !$isNew ? $slug : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Blog Description <span class="text-danger">*</span></label>
                                        <textarea name="desc" placeholder="Enter news description" class="form-control required" id="desc"><?php echo !$isNew ? $desc : '' ?></textarea>
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
                                        <label>Blog Image</label>
                                        <input type="file" name="img">
                                    </td>
                                </tr>
		                        <?php if(!$isNew && $image != '') { ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo base_url('images/news/'.$image) ?>" width="20%">
                                        </td>
                                    </tr>
		                        <?php } ?>
                                <tr>
                                    <td>
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
                                            <img src="<?= base_url('images/news/' . $seo_image) ?>" width="25%">
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