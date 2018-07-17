<?php $count = segment(4) + 1; ?>
<!-- Small boxes (Stat box) -->
<div id="msg"></div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Trip Manager</h3>
                <form style="padding-top: 10px" id="search-form" action="" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" value="<?= isset($_GET['query']) ? $_GET['query'] : '' ?>" placeholder="Search" name="query" class="form-control" id="search-query"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="per_page" id="per-page">
                                    <option value="10" <?= isset($_GET['per_page']) && $_GET['per_page'] == '10' ? 'selected' : '' ?>>10</option>
                                    <option value="20" <?= isset($_GET['per_page']) && $_GET['per_page'] == '20' ? 'selected' : '' ?>>20</option>
                                    <option value="30" <?= isset($_GET['per_page']) && $_GET['per_page'] == '30' ? 'selected' : '' ?>>30</option>
                                    <option value="40" <?= isset($_GET['per_page']) && $_GET['per_page'] == '40' ? 'selected' : '' ?>>40</option>
                                    <option value="50" <?= isset($_GET['per_page']) && $_GET['per_page'] == '50' ? 'selected' : '' ?>>50</option>
                                    <option value="100" <?= isset($_GET['per_page']) && $_GET['per_page'] == '100' ? 'selected' : '' ?>>100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="button" id="search-btn" class="btn btn-info" value="Search"/>
                            </div>
                        </div>
                    </div>
                </form>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/trip/add_update') ?>" class="btn btn-success">Add New</a>
                </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 70px">#</th>
                        <th>Trip Name</th>
                        <th>Featured</th>
                        <th style="width: 250px">Action</th>
                    </tr>
                    <?php if (!empty($admins)) {
                        foreach ($admins as $p) {
                            ?>
                            <tr>
                                <td><?php echo $count;
                                    $count++; ?></td>
                                <td><?php echo $p['name'] ?></td>
                                <td>
                                    <input type="checkbox" <?php echo ($p['featured'] == 1) ? 'checked' : '' ?> id="<?php echo $p['id'].'_'.$p['featured'] ?>" class="add-featured">
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                       href="<?php echo base_url('admin/trip/status/' . $p['id']) ?>"><?= $p['status'] ? 'Hide' : 'Show' ?></a>
                                    <a class="btn btn-sm btn-danger"
                                       href="<?php echo base_url('admin/trip/delete/' . $p['id']) ?>"
                                       onclick="return confirm('Are you sure?')">Delete</a>
                                    <a class="btn btn-sm btn-info"
                                       href="<?php echo base_url('admin/trip/add_update/' . $p['id']) ?>">Edit</a>
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
<script>
    $('#per-page').on('change', function() {
        $('#search-form').submit();
    });
    $('#search-btn').on('click', function(e) {
        e.preventDefault();
        $('#search-form').submit();
    });
    $('.add-featured').on('click', function(){
        var id = $(this).attr('id');
        $.ajax({
            url: '<?php echo base_url('admin/trip/change_status') ?>',
            data: 'id='+id,
            type: 'post',
            success: function() {
                $('#msg').html(''+
                    '<div role="alert" class="alert alert-info alert-dismissible fade in">' +
                    '<button data-dismiss="alert" class="close" type="button">' +
                    '<span aria-hidden="true">×</span>' +
                    '<span class="sr-only">Close</span>' +
                    '</button>' +
                    'Trip saved' +
                    '</div>'
                );
            }
        });
    });
</script>