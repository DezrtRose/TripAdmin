<?php
$seo_data = $seo_data[0];
$title = $seo_data['title'];
$keyword = $seo_data['keyword'];
$og_title = $seo_data['og_title'];
$og_type = $seo_data['og_type'];
$og_site_name = $seo_data['og_site_name'];
$og_image = $seo_data['og_image'];
$og_description = $seo_data['og_description'];
?>
<div class="box-header">
	<h3 class="box-title">
		<a data-toggle="collapse" href="#admin-config">
			Seo Manager | Update
		</a>
	</h3>
</div><!-- /.box-header -->
<div class="box-body collapse in" id="admin-config">
	<form role="form" class="forms" method="post" action="" enctype="multipart/form-data">
		<table class="table table-bordered">
			<tr>
				<td>
					<label>Title</label>
					<textarea class="form-control" name="title"><?= $title ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label>Keyword</label>
					<textarea class="form-control" name="keyword"><?= $keyword ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label>OG Title</label>
					<textarea class="form-control" name="og_title"><?= $og_title ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label>OG Type</label>
					<input type="text" class="form-control" name="og_type" value="<?= $og_type ?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<label>OG Site Name</label>
					<input type="text" class="form-control" name="og_site_name" value="<?= $og_site_name ?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<label>OG Image</label>
					<input type="file" class="form-control" name="og_image" value="<?= $og_image ?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<label>OG Description</label>
					<textarea class="form-control" name="og_description"><?= $og_description ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input class="btn btn-primary" type="submit" value="Save"/>
				</td>
			</tr>
		</table>
	</form>
</div>