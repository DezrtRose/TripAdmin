<?php $count = segment( 4 ) + 1; ?>
    <div class="box-header">
        <h3 class="box-title">Review Manager</h3>
        <span class="pull-right add-new">
            <a href="<?php echo base_url( 'admin/review/add_update' ) ?>" class="btn btn-success">Add New</a>
        </span>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th style="width: 70px">#</th>
                <th>Review</th>
                <th style="width: 250px">Action</th>
            </tr>
			<?php if ( ! empty( $admins ) ) {
				foreach ( $admins as $p ) {
					?>
                    <tr>
                        <td><?php echo $count;
							$count ++; ?></td>
                        <td><a href="#" data-toggle="modal" data-target="#review-<?= $p['id'] ?>"><?php echo $p['review'] ?></a></td>
                        <td>
                            <a class="btn btn-sm btn-<?= ( $p['status'] ) ? 'primary' : 'info' ?>"
                               href="<?php echo base_url( 'admin/review/status/' . $p['id'] ) ?>"><?= ( $p['status'] ) ? 'Disapprove' : 'Approve' ?></a>
                            <a class="btn btn-sm btn-success" href="<?php echo base_url('admin/review/add_update/'.$p['id']) ?>">Edit</a>
                            <a class="btn btn-sm btn-danger"
                               href="<?php echo base_url( 'admin/review/delete/' . $p['id'] ) ?>"
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="review-<?= $p['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Review Details</h4>
                                </div>
                                <div class="modal-body">
                                    <ul class="review-modal">
                                        <li><span>Name : </span><?= $p['name'] ?></li>
                                        <li><span>Review : </span><?= $p['review'] ?></li>
                                        <li><span>Trip : </span><?= get_trip_name($p['id']) ?></li>
                                        <li><span>Action : </span><a class="btn btn-sm btn-<?= ( $p['status'] ) ? 'primary' : 'info' ?>"
                                                        href="<?php echo base_url( 'admin/review/status/' . $p['id'] ) ?>"><?= ( $p['status'] ) ? 'Disapprove' : 'Approve' ?></a></li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
				}
			} else {
				?>
                <tr>
                    <td>No data</td>
                    <td>No data</td>
                    <td>No data</td>
                </tr>
			<?php } ?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
<?php if ( ! empty( $admins ) ) { ?>
    <div class="box-footer clearfix">
		<?php echo $pagination ?>
    </div>
<?php } ?>