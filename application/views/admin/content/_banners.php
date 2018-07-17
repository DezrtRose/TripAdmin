<?php $count = segment(4)+1; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <?php flash() ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Banner Manager</h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/content/add-update-banner') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 70px">#</th>
                        <th>Banner Image</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                    <?php if(!empty($banners)) {
                        foreach($banners as $p) { ?>
                            <tr>
                                <td><?php echo $count;$count++; ?></td>
                                <td>
                                    <?php php_thumb_image('./images/banner/', $p['filename'], '135', '100', true, 'no-image.png') ?>
                                    <!--<img src="<?php /*echo base_url('images/banner/'.$p['filename']) */?>">-->
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/content/add-update-banner/'.$p['id']) ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger" href="<?php echo base_url('admin/content/delete-banner/'.$p['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php } } else { ?>
                        <tr>
                            <td>No data</td>
                            <td>No data</td>
                            <td>No data</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <?php if(!empty($banners)) { ?>
                <div class="box-footer clearfix">
                    <?php echo $pagination ?>
                </div>
            <?php } ?>
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->