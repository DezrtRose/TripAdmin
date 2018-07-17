<div class="height"></div>
<div class="row">

    <div class="col-md-6">

        <h1>What Our Clients Say!!!</h1>

    </div>

    <div class="col-md-6 text-right">

        <a data-toggle="modal" data-target="#write-review" href="#" class="bdex-btn"
           style="display: inline-block;margin-top: 20px">Give Your Review</a>

    </div>

</div>

<hr/>

<div id="review-wraps">
	<?php
    $query   = "select r.*, t.name as trip_name from tbl_reviews r join tbl_trip_review tr on tr.review_id = r.id join tbl_trips t on t.id = tr.trip_id where r.status = 1 order by r.id desc";
	$reviews = $this->common_model->run_query( $query );
	foreach ( $reviews as $r ) {
	    ?>
        <div class="testimonial-main">
            <div class="testi-container">

                <div class="testi-text">

                    <blockquote>

                        <p>

							<?php echo $r['review'] ?>

                        </p>

                    </blockquote>

                </div>

                <div class="clear"></div>

            </div>

            <div class="testi-baloon"></div>

            <div class="testi-name">
				<?php echo $r['name'] ?>
				<?php for ( $i = 0; $i < $r['rating']; $i ++ ) { ?>
                    <i class="fa fa-star" style="color: #9EA33D;"></i>
				<?php } ?>
                <div class="text-muted">for <?= $r['trip_name'] ?></div>
            </div>
        </div>
	<?php } ?>
</div>
<!-- Modal -->

<div class="modal fade" id="write-review" tabindex="-1" role="dialog" aria-labelledby="email-trip-modal-Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="email-trip-modal-Label">Write a Review</h4>
            </div>
            <form action="<?= base_url( 'trips/review/' ) ?>" id="review-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" name="trip_id">
                                    <option value="">Choose a trip...</option>
									<?php
									$trips = $this->common_model->get_where( 'tbl_trips', array( 'status' => 1 ), 'id desc' );
									foreach ( $trips as $trip ) { ?>
                                        <option value="<?= $trip['id'] ?>"><?= $trip['name'] ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input placeholder="Name" type="text" name="name" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
								<?php $countries = $this->common_model->get_all( 'countries' ); ?>
                                <select class="form-control" name="country">
                                    <option value="">Select country</option>
									<?php
									foreach ( $countries as $country ) {
										echo "<option value='{$country['id']}'>{$country['country_name']}</option>";
									}
									?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <textarea rows="5" placeholder="Review" class="form-control" name="review"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label>Rating: </label>
                            <span class="rating">
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="rating" value="5"/><label class="full" for="star5"
                                                                                               title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4"/><label class="full" for="star4"
                                                                                               title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3"/><label class="full" for="star3"
                                                                                               title="Meh - 3 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2"/><label class="full" for="star2"
                                                                                               title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1"/><label class="full" for="star1"
                                                                                               title="Sucks big time - 1 star"></label>
                            </fieldset>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit-review" class="btn btn-theme">Send <i
                                class="fa fa-fw fa-chevron-circle-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>