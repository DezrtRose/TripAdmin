<?php

$isNew = true;

if(segment(4) != '') {

	$team = $team[0];

	$isNew = false;

	$name = $team['name'];

	$desc = $team['description'];

	$image = $team['image'];

	$position = $team['position'];
	$facebook_link = $team['facebook_link'];
	$twitter_link = $team['twitter_link'];
	$linkedin_link = $team['linkedin_link'];
	$order = $team['order'];

}

?>

<!-- Small boxes (Stat box) -->

<div class="row">

	<div class="col-md-12">

		<div class="box">

			<div class="box-header">

				<h3 class="box-title">Team Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>

				<span class="pull-right add-new">

                    <a href="<?php echo base_url('admin/team/add-update') ?>" class="btn btn-success">Add New</a>

                </span>

			</div><!-- /.box-header -->

			<div class="box-body">

				<form action="" method="post" class="forms" enctype="multipart/form-data">

					<table class="table table-bordered">

						<tbody>

						<tr>

							<td>

								<label>Name <span class="text-danger">*</span></label>

								<input type="text" placeholder="Enter name" class="form-control required" name="name" value="<?php echo !$isNew ? $name : '' ?>">

							</td>

						</tr>

						<tr>

							<td>

								<label>Position<span class="text-danger">*</span></label>

								<input type="text" placeholder="Enter position" class="form-control required" name="position" value="<?php echo !$isNew ? $position : '' ?>">

							</td>

						</tr>

						<tr>

							<td>

								<label>Facebook</label>

								<input type="text" placeholder="Enter facebook link" class="form-control" name="facebook_link" value="<?php echo !$isNew ? $facebook_link : '' ?>">

							</td>

						</tr>

						<tr>

							<td>

								<label>Twitter</label>

								<input type="text" placeholder="Enter twitter link" class="form-control" name="twitter_link" value="<?php echo !$isNew ? $twitter_link : '' ?>">

							</td>

						</tr>

						<tr>

							<td>

								<label>LinkedIn</label>

								<input type="text" placeholder="Enter linkedin link" class="form-control" name="linkedin_link" value="<?php echo !$isNew ? $linkedin_link : '' ?>">

							</td>

						</tr>

						<tr>

							<td>

								<label>Sort Order</label>

								<input type="text" placeholder="Enter sort order" class="form-control" name="order" value="<?php echo !$isNew ? $order : '' ?>">

							</td>

						</tr>

						<tr>

                            <td>

                                <label>Description <span class="text-danger">*</span></label>

                                <textarea rows="5" name="description" placeholder="Enter description" class="form-control required" id="desc"><?php echo !$isNew ? $desc : '' ?></textarea>

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

								<label>Image</label>

								<input type="file" name="img">

							</td>

						</tr>

						<tr>

							<td>

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