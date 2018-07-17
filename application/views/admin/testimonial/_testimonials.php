<?php $count = segment(4)+1; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <?php flash() ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Testimonial Manager</h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/testimonial/add-update') ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 70px">#</th>
                        <th>Testimonial By (Click on the name to view details)</th>
                        <th>Status</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                    <?php if(!empty($testimonials)) {
                        foreach($testimonials as $p) { ?>
                            <tr>
                                <td><?php echo $count;$count++; ?></td>
                                <td>
                                    <a href="<?php echo base_url('admin/testimonial/testimonial_detail/'.$p['id']) ?>" data-toggle="ajaxmodal">
                                        <?php echo $p['by'] ?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo ($p['approved'] == 1) ? 'Approved' : 'Not Approved' ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/testimonial/add-update/'.$p['id']) ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" href="<?php echo base_url('admin/testimonial/delete/'.$p['id']) ?>">Delete</a>
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
            <?php if(!empty($testimonials)) { ?>
                <div class="box-footer clearfix">
                    <?php echo $pagination ?>
                </div>
            <?php } ?>
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->
<script>
    $('[data-toggle="ajaxmodal"]').on('click',
        function(e) {
            $('#ajaxmodal').remove();
            e.preventDefault();
            var $this = $(this)
                , $remote = $this.data('remote') || $this.attr('href')
                , $modal = $('<div class="modal" id="ajaxmodal" style="z-index: 99999"><div class="modal-body"></div></div>');
            $('body').append($modal);
            $modal.modal({backdrop: 'static', keyboard: false});
            $modal.load($remote);
        }
    );
</script>