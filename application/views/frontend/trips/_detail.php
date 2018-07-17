<?php foreach ( $trip as $trp ) { ?>


    <section id="banner">
        <div id="slider">

			<?php $trip_img = $this->common_model->get_where( 'tbl_trip_slider', array( 'trip_id' => $trp['id'] ) );

			if ( ( $trip_img ) != '' ) { ?>
				<?php foreach ( $trip_img as $i ) { ?>
                    <div class="item">
                        <img src="<?= base_url( 'images/trip/' . $i['image'] ) ?>" style="width: 100%" alt="<?= $i['alt'] ?>" title="<?= $trp['name'] ?>">
                        <div class="banner-content detail">
                            <p>
								<?php if ( $i['title'] != '' ) { ?>
									<?php echo $i['title'] ?>
								<?php } ?>
                                <span>
			<?php if ( $i['description'] != '' ) { ?>
				<?php echo $i['description'] ?>
			<?php } ?>
		    </span>
                            </p>
                        </div>
                    </div>
				<?php } ?>

			<?php } else { ?>
                <p> No any slider are available now. </p>
			<?php } ?>


        </div>
        <div class="trek-detail-title">
          <?= $trp['name'] ?>
        </div>
    </section>

    <section class="detail-share">
        <div class="container">
            <div class="pull-right">
                <div class="addthis_inline_share_toolbox"></div>
            </div>
        </div>
    </section>

    <section class="detail-toptable">
        <div class="container">
            <div class="body">
                <div class="data">
                    <h4><span><img src="<?php echo base_url() ?>images/icon-trip-duration.png"></span>Duration</h4>
                    <h3 class="text-center"><?php preg_match_all( '!\d+!', $trp['duration'], $matches );
						echo $matches[0][0] ?> days</h3>
                </div>

                <div class="data">
                    <h4><span><img src="<?php echo base_url() ?>images/bag.png"></a></span>Activities</h4>
                    <ul>
						<?php $acti = $this->common_model->get_where( 'tbl_trip_activity', array( 'trip_id' => $trp['id'] ) );
						foreach ( $acti as $value ) { ?>
							<?php $act = $this->common_model->getWhere( 'tbl_activities', array( 'id' => $value['act_id'] ) );
							echo '<li>' . $act->activity . '</li>';
							?>
						<?php } ?>
                    </ul>
                </div>

                <div class="data">
                    <h4><span><img src="<?php echo base_url() ?>images/accomodation.png"></a></span>Accomodation</h4>
					<?= $trp['accommodation'] ?>
                </div>

                <div class="data">
                    <h4><span><img src="<?php echo base_url() ?>images/meals.png"></a></span>Meals</h4>
					<?= $trp['meals'] ?>
                </div>

                <div class="data detail-price">
                    <h4><span class="price">Price</span> <span class="offer" data-toggle="tooltip" data-placement="top"
                                                               title="Tooltip on top goes here">special offer</span>
                    </h4>
                    <h5>
                        from

			
			<?php
							$disc = $this->common_model->getWhere( 'tbl_trip_discount', array( 'trip_id' => $trp['id'] ) );
							if ( isset( $disc->id ) ) {
								$finalRate = round( $trp['cost'] - ( $disc->discount ) );
								echo "<span style='color: #BE191F!important;font-size: 20px;text-decoration: line-through;'>$".$trp['cost']."</span><br>";
								echo "<span>$".$finalRate."</span>";
							} else {
								echo "<span>$".$trp['cost']."</span>";
							}
							?>

                            <!--$4190-->

                        <span class="currency">USD</span>
                    </h5>
                    <form method="post" action="<?php echo base_url( 'trips/booking/' . $trp['slug'] ) ?>">
                        <button class="primary-btn book-now">Book now
                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <div class="container">
        <div class="col-sm-3 finder">
	       <?php //$this->load->view('frontend/include/search') ?>

            <div id="trip-detail-sidenav">
            <ul class="nav side-list " data-spy="affix" data-offset-top="1000" data-offset-bottom="1500">
                <li><a href="#overview">Overview <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i></a>
                </li>
                <li><a href="#itinery">Itinerary <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i></a>
                </li>
                <li><a href="#Inclusions">Inclusions <i class="fa fa-chevron-right pull-right"
                                                        aria-hidden="true"></i></a></li>
                <li><a href="#leader">About your leader <i class="fa fa-chevron-right pull-right"
                                                           aria-hidden="true"></i></a></li>
                <li><a href="#departure">Departure dates <i class="fa fa-chevron-right pull-right"
                                                            aria-hidden="true"></i></a></li>
                <li><a href="#departure">Book now <i
                                class="fa fa-chevron-right pull-right" aria-hidden="true"></i></a></li>
                <li><a href="#review">Trip reviews <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i></a>
                </li>
                <li><a href="#why">Why travel with us <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i></a>
                </li>
            </ul>
            </div>
        </div>

        <div class="col-sm-9">
            <div class="detail-main-content">
                <div id="overview" class="row">

                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6"><h3>Overview</h3></div>
                            <div class="col-sm-6">
                                <?php if($trp['pdf_file'] != '') { ?>
                                <a href="<?= base_url('pdf/' . $trp['pdf_file']) ?>" class="btn-block red"><i class="fa fa-download fa-fw"></i> Download trip notes
                                </a>
                                <?php } ?>


                                <button data-toggle="modal" data-target="#email-trip-modal" class="btn-block empty red"><i class="fa fa-envelope-o fa-fw"></i> Email this
                                    trip
                                </button>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 overview">
                                <h4 class="detail-title"><span><i class="fa fa-location-arrow"
                                                                  aria-hidden="true"></i></span>Trip highlights</h4>
                                <div>
			                        <?= $trp['highlights'] ?>
                                </div>
                                <p>
			                        <?= $trp['overview'] ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="region-activity">
                            <h6>Activities:</h6>
							<?php
							$desti  = $this->common_model->getWhere( 'tbl_trips', array( 'slug' => $trp['slug'] ) );
							$act_id = $this->common_model->get_where( 'tbl_trip_activity', array( 'trip_id' => $desti->id ), '', 1 );
							$acty   = $this->common_model->getWhere( 'tbl_activities', array( 'id' => $act_id[0]['act_id'] ) );
							?>
                            <a target="_blank" href="<?= base_url( 'activities/' . $acty->slug ) ?>"
                               class="badge badge-theme"><?= $acty->activity ?></a>
                            <div class="ratecircle2">
                                <h6>Grading:</h6>
                                <div class="rating-number">
									<?php
									$trps = $this->common_model->getWhere( 'tbl_trips', array( 'slug' => $trp['slug'] ) );
									if ( ( $trps->grade ) == 'beginner' ) {
										echo '1';
										$svg_pattern = '80 20';
									} elseif ( ( $trps->grade ) == 'easy' ) {
										echo '2';
										$svg_pattern = '60 40';
									} elseif ( ( $trps->grade ) == 'moderate' ) {
										echo '3';
										$svg_pattern = '40 60';
									} elseif ( ( $trps->grade ) == 'difficult' ) {
										echo '4';
										$svg_pattern = '20 80';
									} elseif ( ( $trps->grade ) == 'advance' ) {
										echo '5';
										$svg_pattern = '0 100';
									}
									?>
                                </div>
                                <svg width="100%" height="100%" viewBox="0 0 42 42" class="donut">
                                    <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954"
                                            fill="#fff"></circle>
                                    <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent"
                                            stroke="#4DB53C" stroke-width="6"></circle>
                                    <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954"
                                            fill="transparent" stroke="#CCC" stroke-width="6"
                                            stroke-dasharray="<?= $svg_pattern ?>" stroke-dashoffset="25"></circle>
                                </svg>
                                <div class="grading-number"><?= $trps->grade ?></div>
                            </div>
                        </div>
                    </div>

                </div>


                <div id="itinery" class="Itinerary">

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="col-md-4">
                                <h4 class="black-title" style="margin-top: 0;"> Itinerary</h4>
                            </div>
                            <div class="col-md-8 text-right">
                                <a href="#" id="expand-all"><i class="fa fa-fw fa-chevron-down"></i> Expand All</a> | <a href="#" id="collapse-all"><i class="fa fa-fw fa-chevron-up"></i> Collapse All</a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="panel-group" id="accordion">

								<?php if ( $trp['itinerary'] ){ ?>
								<?php foreach ( json_decode( $trp['itinerary'] ) as $key => $itinerary ){ ?>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a <?= $key > 0 ? 'class="collapsed"' : '' ?> data-toggle="collapse" data-parent="#accordion"
                                               href="#<?= $itinerary->day ?>">
                                                <div class="iti-day">
                                                    <div class="day">Day <?= $itinerary->day ?>:</div>
                                                    <p class="iti-title"><?= $itinerary->title ?></p>
                                                </div>
                                            </a>

                                        </h4>
                                    </div>

									<?php if ( $key == 0 ) {
										echo '<div id="' . $itinerary->day . '" class="panel-collapse collapse in">';
									} else {
										echo '<div id="' . $itinerary->day . '" class="panel-collapse collapse">';
									} ?>

                                    <div class="panel-body iti-desc">
										<?= $itinerary->description ?>
                                    </div>
                                </div>
                            </div>

							<?php } ?>
							<?php } ?>

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="side-map">
                            <?php if($trp['map']) { ?>
                                <a class="trip-map" href="<?= base_url('images/maps/' . $trp['map']) ?>">
                                    <img src="<?= base_url('images/maps/' . $trp['map']) ?>"/>
                                </a>
                            <?php } ?>
	                        <?php if($trp['pdf_file'] != '') { ?>
                            <a href="<?= base_url('pdf/' . $trp['pdf_file']) ?>" class="btn-block red"><i class="fa fa-download fa-fw"></i> Download trip notes</a>
                            <?php } ?>
                        </div>


                    </div>
                </div>

            </div>

            <div id="Inclusions" class="inclusion">
                <h4 class="black-title"> Inclusion</h4>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default include">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#include">Whats included <i
                                            class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </h4>
                        </div>
                        <div id="include" class="panel-collapse collapse in">
                            <div class="panel-body">
	                            <?= $trp['cost_inc'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default exclude">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#exclude">Whats excluded <i
                                            class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </h4>
                        </div>
                        <div id="exclude" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <i><?= $trp['cost_ex'] ?></i>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div id="leader" class="leader">
                <h4 class="black-title"> About your leader</h4><br>

				<?= $trp['leader'] ?>

            </div>

            <div id="departure" class="departure">
                <h3 class="black-title"> Departure dates</h3>
	            <?php
	            $today_date = date('m/d/Y');
	            $departure_query = "SELECT dd.* FROM tbl_departures d JOIN tbl_departure_date dd ON dd.departure_id = d.id WHERE d.trip_id = {$trp['id']} AND dd.date_from >= '{$today_date}' ORDER BY STR_TO_DATE(dd.date_from,'%m/%d/%Y') asc";
	            $departure_dates = $this->db->query( $departure_query )->result_array();
	            ?>
                <div class="<?= count($departure_dates) > 5 ? 'dates-wrap' : '' ?>">
                <div class="row">
                    <div class="col-sm-3"><h4>Dates</h4></div>
                    <div class="col-sm-3"><h4>Availability</h4></div>
                    <div class="col-sm-2"><h4>Status</h4></div>
                    <div class="col-sm-2"><h4>Price</h4></div>
                    <div class="col-sm-2"><h4>Notes</h4></div>
                </div>

				<?php
				$c = 1;
				foreach ( $departure_dates as $departure_date ) {
					$c ++ ?>
                    <div class="row">

						<?php if ( $c % 2 == 0 ){ ?>
                        <div class="bookodd">
							<?php } else {
								echo '<div class="bookeven">';
							} ?>
                            <div class="col-sm-3">
                                <h5>
									<?= date( 'd M Y', strtotime( $departure_date['date_from'] ) ) ?>
                                    -
									<?= date( 'd M Y', strtotime( $departure_date['date_to'] ) ) ?>
                                </h5>
                            </div>
                            <div class="col-sm-3"><p><span style="color: #72fd1f;">●</span> Available</p></div>
                            <div class="col-sm-2">Guaranteed</div>
                            <div class="col-sm-2">
                                <h6>
                                    <span>from </span>
                                    <?= $trp['cost'] != $departure_date['price'] ? "<span style='display: inline-block;text-decoration: line-through;color: rgb(119, 119, 119);font-size: 10px;padding: 5px 0;'>$" . $trp['cost'] . " USD</span>" : '' ?>
                                    $<?= $departure_date['price'] ?> USD
                                </h6>
                            </div>
                            <div class="col-sm-2">

                                <form method="post"
                                      action="<?= base_url( 'trips/booking/' . $trp['slug'] . '?departure=' . $departure_date['id'] ) ?>">
                                    <button class="primary-btn btn-yellow">Book now <i
                                                class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
                                </form>


                            </div>
                        </div>
                    </div>
				<?php } ?>
                </div>
                <?php if(count($departure_dates) > 5) { ?>
                <a href="#" id="show-more-departures">Show More</a>
                <?php } ?>
            </div>


            <div id="review" class="detail-review">
                <h4 class="black-title pull-left">Trip reviews</h4>
                <a href="#" class="btn green-btn pull-right" data-toggle="modal" data-target="#write-review">Write a Review</a>
                <?php
                $query = "select * from tbl_reviews r join tbl_trip_review tr on tr.review_id = r.id where tr.trip_id = " . $trp['id'] . " and r.status = 1";
                $trip_reviews = $this->common_model->run_query($query);
                if($trip_reviews) { foreach($trip_reviews as $trip_review) { ?>
                    <div class="testimonial-main">
                        <div class="testi-container">

                            <div class="testi-text">

                                <blockquote>

                                    <p>

                                        <?= $trip_review['review'] ?>

                                    </p>

                                </blockquote>

                            </div>

                            <div class="clear"></div>

                        </div>

                        <div class="testi-baloon"></div>

                        <div class="testi-name">
                            <h6><?= $trip_review['name'] ?></h6>
                            <?php for($i = 0; $i < $trip_review['rating']; $i++) { ?>
                                <i class="fa fa-star" style="color: #9EA33D;"></i>
                            <?php } ?>
                        </div>
                    </div>
                <?php } } else { echo "<div class='clearfix'></div>No reviews yet. Be the first and write about your experience by clicking the Write a review button above."; } ?>
            </div>


			<?php $this->load->view( 'frontend/trips/_why_travel_with_us' ) ?>
        </div>
    </div>
    </div>
	<?php $this->load->view('frontend/include/_top_deals') ?>


<?php } ?>
<div class="modal fade" id="write-review" tabindex="-1" role="dialog" aria-labelledby="write-review-modal-Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="email-trip-modal-Label">Write a Review</h4>
            </div>
            <form action="<?= base_url('trips/review/' . $trp['id']) ?>" id="review-form">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input placeholder="Name" type="text" name="name"class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php $countries = $this->common_model->get_all('countries'); ?>
                            <select class="form-control" name="country">
                                <option value="">Select country</option>
                                <?php
                                foreach($countries as $country) {
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
                                <input type="radio" id="star5" name="rating" value="5"/><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4"/><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3"/><label class="full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2"/><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1"/><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                            </fieldset>
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit-review" class="btn btn-theme">Send <i class="fa fa-fw fa-chevron-circle-right"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="email-trip-modal" tabindex="-1" role="dialog" aria-labelledby="email-trip-modal-Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="email-trip-modal-Label">Send to a Friend</h4>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('send-to-friend') ?>" method="post" id="send-friend">
                    <input type="hidden" value="<?= current_url() ?>" name="trip_link"/>
                    <input type="hidden" value="<?= $trp['name'] ?>" name="trip_name"/>
                    <div class="form-group">
                        <input type="text" class="form-control" name="sender_name" placeholder="Your name *"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="sender_email" placeholder="Your email address *"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="receiver_name" placeholder="Friend's name *"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="receiver_email" placeholder="Friend's email address *"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="Subject *"/>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="personal_msg" placeholder="Personal message *"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LdbG0sUAAAAAL1NiCXOLTr3Kym-C27P8cMds2TR"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="send-to-friend-btn">Send Message <i class="fa fa-fw fa-chevron-circle-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#expand-all').on('click', function (e) {
        e.preventDefault();
        $('#accordion .panel-collapse').collapse('show');
    });
    $('#collapse-all').on('click', function (e) {
        e.preventDefault();
        $('#accordion .panel-collapse').collapse('hide');
    });
    $('#show-more-departures').on('click', function(e) {
        e.preventDefault();
        var link_value = $(this).text() == 'Show More' ? 'Show Less' : 'Show More';
        $(this).text(link_value);
        $('.dates-wrap').toggleClass('active');
    })
</script>