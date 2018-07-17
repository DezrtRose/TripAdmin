


<?php $count = segment(4)+1; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <?php flash() ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Redirection Manager</h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/redirections/form') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
			
                    <tr>
                        <th style="width: 100px">#</th>
                        <th>From URL</th>
                        <th>To URL</th>
                        <th style="width: 150px">Action</th>
                    </tr>
		    
                    <?php if(!empty($redirections)) {
                        foreach($redirections as $redirection) { ?>
                            <tr>
                                <td><?php echo $count;$count++; ?></td>
                                <td><?php echo $redirection['from_url'] ?></td>
                                <td><?php echo $redirection['to_url'] ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/redirections/edit/'.$redirection['id']) ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger" href="<?php echo base_url('admin/redirections/delete/'.$redirection['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
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
	        <?php if (!empty($redirections)) { ?>
                <div class="box-footer clearfix">
			        <?php echo $pagination ?>
                </div>
	        <?php } ?>
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->