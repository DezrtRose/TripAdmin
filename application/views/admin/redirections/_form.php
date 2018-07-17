<?php
$id       = '';
$from_url = '';
$to_url   = '';
if ( isset( $dataToEdit ) ) {
	$id       = $dataToEdit->id;
	$from_url = $dataToEdit->from_url;
	$to_url   = $dataToEdit->to_url;
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Redirections Manager | <?php echo ($id == '') ? 'Add' : 'Update' ?></h3>
                <span class="pull-right add-new">
                    <a href="<?php echo base_url( 'admin/redirections/form' ) ?>" class="btn btn-success">Add New</a>
                </span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form action="<?= base_url( 'admin/redirections/form' ) ?>" method="post" class="forms">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>
                                <label>From URL<span class="text-danger">*</span></label>
                                <input type="text" class="form-control required"
                                       name="from_url" value="<?= $from_url ?>">
                            </td>
                            <td>
                                <label>To URL<span class="text-danger">*</span></label>
                                <input type="text" class="form-control required"
                                       name="to_url" value="<?= $to_url ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input id="has-ckeditor" class="btn btn-primary" type="submit" value="Save">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->