<?php $count = segment(4) + 1; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Trip Slider Manager</h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/tripslider/add_update') ?>" class="btn btn-success">Add New</a>
                </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 70px">#</th>
                        <th>Image</th>
                        <th>Trip Name</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                    <?php if (!empty($admins)) {
                        foreach ($admins as $p) {
                            ?>
                            <tr>
                                <td><?php echo $count;
                                    $count++; ?></td>
                                <td>
                                    <img src="<?php echo base_url('images/trip/'.$p['image']) ?>" width="35%">
                                </td>
                                <td>
                                    <?php $trip = $this->common_model->get_where('tbl_trips', array('id' => $p['trip_id']));
                                    echo $trip[0]['name']; ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                       href="<?php echo base_url('admin/tripslider/add_update/' . $p['id']) ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger"
                                       href="<?php echo base_url('admin/tripslider/delete/' . $p['id']) ?>"
                                       onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
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
            </div>
            <!-- /.box-body -->
            <?php if (!empty($admins)) { ?>
                <div class="box-footer clearfix">
                    <?php echo $pagination ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>