<?php
$isNew = true;
$name = '';
$country_id = '';
$review_msg = '';
$rating = '';
$trip_id = '';
if(segment(4) != '') {
	$reviews = $review[0];
	$review_id = $reviews['id'];
	$review_trip = $this->common_model->get_where('tbl_trip_review', array('review_id' => $review_id), '', '', true);
	$isNew = false;
	$name = $reviews['name'];
	$country_id = $reviews['country'];
	$review_msg = $reviews['review'];
	$rating = $reviews['rating'];
    $trip_id = $review_trip->trip_id;
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Review Manager | <?php echo ($isNew) ? 'Add' : 'Update' ?></h3>
				<span class="pull-right add-new">
                    <a href="<?php echo base_url('admin/review/add_update') ?>" class="btn btn-success">Add New</a>
                </span>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form action="" method="post" class="forms" enctype="multipart/form-data">
					<table class="table table-bordered">
						<tbody>
						<tr>
							<td>
								<label>Choose Trip <span class="text-danger">*</span></label>
								<select class="form-control required" name="trip_id">
									<option value="">Choose a trip...</option>
									<?php
									$trips = $this->common_model->get_where( 'tbl_trips', array( 'status' => 1 ), 'id desc' );
									foreach ( $trips as $trip ) { ?>
										<option <?= (!$isNew) && $trip['id'] == $trip_id ? 'selected' : '' ?> value="<?= $trip['id'] ?>"><?= $trip['name'] ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>Reviewer Name <span class="text-danger">*</span></label>
								<input value="<?= $name ?>" placeholder="Name" type="text" name="name" class="form-control required"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Reviewer Country</label>
								<?php $countries = $this->common_model->get_all( 'countries' ); ?>
								<select class="form-control required" name="country">
									<option value="">Select country</option>
									<?php
									foreach ( $countries as $country ) { ?>
                                    <option <?= (!$isNew) && $country['id'] == $country_id ? 'selected' : '' ?> value='<?= $country['id'] ?>'><?= $country['country_name'] ?></option>";
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>Review <span class="text-danger">*</span></label>
								<textarea rows="5" placeholder="Review" class="form-control required" name="review"><?= $review_msg ?></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<label>Rating</label>
                                <span class="rating">
                                    <fieldset class="rating">
                                        <input type="radio" <?= $rating == 5 ? 'checked' : '' ?> id="star5" name="rating" value="5"/><label class="full" for="star5"
                                                                                                       title="Awesome - 5 stars"></label>
                                        <input type="radio" <?= $rating == 4 ? 'checked' : '' ?> id="star4" name="rating" value="4"/><label class="full" for="star4"
                                                                                                       title="Pretty good - 4 stars"></label>
                                        <input type="radio" <?= $rating == 3 ? 'checked' : '' ?> id="star3" name="rating" value="3"/><label class="full" for="star3"
                                                                                                       title="Meh - 3 stars"></label>
                                        <input type="radio" <?= $rating == 2 ? 'checked' : '' ?> id="star2" name="rating" value="2"/><label class="full" for="star2"
                                                                                                       title="Kinda bad - 2 stars"></label>
                                        <input type="radio" <?= $rating == 1 ? 'checked' : '' ?> id="star1" name="rating" value="1"/><label class="full" for="star1"
                                                                                                       title="Sucks big time - 1 star"></label>
                                    </fieldset>
                                </span>
							</td>
						</tr>
						<tr>
							<td>
								<input class="btn btn-primary" type="submit" value="Save">
							</td>
						</tr>
						</tbody>
					</table>
				</form>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</div><!-- /.row -->