<?php $count = segment(4)+1; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <?php flash() ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Blog Manager</h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/news/add_update') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 70px">#</th>
                        <th>Blog Title</th>
                        <th>Publish Date</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                    <?php if(!empty($news)) {
                        foreach($news as $p) { ?>
                            <tr>
                                <td><?php echo $count;$count++; ?></td>
                                <td><?php echo $p['name'] ?></td>
                                <td>
                                    <?php echo date('d M, Y', $p['date']) ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/news/add_update/'.$p['id']) ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger" href="<?php echo base_url('admin/news/delete/'.$p['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php } } else { ?>
                        <tr>
                            <td>No data</td>
                            <td>No data</td>
                            <td>No data</td>
                            <td>No data</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <?php if(!empty($news)) { ?>
                <div class="box-footer clearfix">
                    <?php echo $pagination ?>
                </div>
            <?php } ?>
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->