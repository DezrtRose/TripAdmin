<?php $count = segment(4)+1; ?>

<!-- Small boxes (Stat box) -->

<div class="row">

	<div class="col-md-12">

		<?php flash() ?>

		<div class="box">

			<div class="box-header">

				<h3 class="box-title">Team Manager</h3>

				<span class="pull-right add-new">

                    <a href="<?php echo base_url('admin/team/add-update') ?>" class="btn btn-success">Add New</a>

                </span>

			</div><!-- /.box-header -->

			<div class="box-body">

				<table class="table table-bordered">

					<tbody>

					<tr>

						<th style="width: 70px">#</th>

						<th>Name</th>

						<th>Image</th>

						<th>Position</th>

						<th style="width: 150px">Action</th>

					</tr>

					<?php if(!empty($teams)) {

						foreach($teams as $p) { ?>

							<tr>

								<td><?php echo $count;$count++; ?></td>

								<td>

									<?php echo $p['name'] ?>

								</td>

								<td>

									<?php if(file_exists('images/team/'.$p['image'])) { ?>

										<img src="<?php echo base_url('images/team/'.$p['image']) ?>" width="20%">

									<?php } else {

										echo 'No team image.';

									} ?>

								</td>

								<td>

									<?php echo $p['position'] ?>

								</td>

								<td>

									<a class="btn btn-sm btn-info" href="<?php echo base_url('admin/team/add-update/'.$p['id']) ?>">Edit</a>

									<a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" href="<?php echo base_url('admin/team/delete/'.$p['id']) ?>">Delete</a>

								</td>

							</tr>

						<?php } } else { ?>

						<tr>

							<td colspan="5">No data</td>

						</tr>

					<?php } ?>

					</tbody>

				</table>

			</div><!-- /.box-body -->

			<?php if(!empty($teams)) { ?>

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