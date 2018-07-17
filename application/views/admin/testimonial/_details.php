<style>
    .large {
        width: 70%;
    }
</style>
<div class="modal-dialog large">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="border-bottom: 0">Testimonial Review</h4>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td><?php echo $by ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td><?php echo $desc ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <?php if($approved == 0) { ?>
                            <a href="<?php echo base_url('admin/testimonial/approve/'.$id) ?>" class="btn btn-info">
                                Approve Testimonial
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo base_url('admin/testimonial/disapprove/'.$id) ?>" class="btn btn-danger">
                                Disapprove Testimonial
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('.rate').raty({
        readOnly: true,
        score: function(){return $(this).attr('id');},
        path: '../raty/images',
        hints: ['bad', 'poor', 'okay', 'good', 'awesome']
    })
</script>