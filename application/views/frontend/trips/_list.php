<script type="text/javascript" src="<?php echo base_url( 'assets/frontend' ) ?>/js/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $('#destination').on('change', function () {

            var inputValue = $(this).val();

            if (inputValue != "") {

                var seg1 = "<?php echo $this->uri->segment( 1 ) ?>";
                var seg2 = "<?php echo $this->uri->segment( 2 ) ?>";
                var seg3 = "<?php echo $this->uri->segment( 3 ) ?>";
                if (seg1 == "trip-act") {
                    window.location.href = "<?= base_url( 'trip-dest-act' ); ?>" + "/" + inputValue + "/" + seg2;
                } else if (seg1 == "trip-dest-act") {
                    window.location.href = "<?= base_url( 'trip-dest-act' ); ?>" + "/" + inputValue + "/" + seg3;
                } else {
                    window.location.href = "<?= base_url( 'trip-dest' ); ?>" + "/" + inputValue;
                }
            }
        });

        $('#activity').on('change', function () {
            var inputValue = $(this).val();
            if (inputValue != "") {
                var seg1 = "<?php echo $this->uri->segment( 1 ) ?>";
                var seg2 = "<?php echo $this->uri->segment( 2 ) ?>";
                var seg3 = "<?php echo $this->uri->segment( 3 ) ?>";
                if (seg1 == "trip-dest") {
                    window.location.href = "<?= base_url( 'trip-dest-act' ); ?>" + "/" + seg2 + "/" + inputValue;
                } else if (seg1 == "trip-dest-act") {
                    window.location.href = "<?= base_url( 'trip-dest-act' ); ?>" + "/" + seg2 + "/" + inputValue;
                } else {
                    window.location.href = "<?= base_url( 'trip-act' ); ?>" + "/" + inputValue;
                }
            }
        });

        $(function () {
            $("#duration-range").slider({
                range: true,
                min: 0,
                max: 40,
                values: [0, 60],
                slide: function (event, ui) {
                    $("#durationR").val("(" + ui.values[0] + " - " + ui.values[1] + ") days");
                }
            });
            $("#durationR").val("(" + $("#duration-range").slider("values", 0) +
                " - " + $("#duration-range").slider("values", 1) + ") days");
        });

        $(function () {
            $("#price-range").slider({
                range: true,
                min: 0,
                max: 30000,
                values: [0, 50000],
                slide: function (event, ui) {
                    $("#amountR").val("$" + ui.values[0] + " - $" + ui.values[1]);


                }
            });
            $("#amountR").val("$" + $("#price-range").slider("values", 0) +
                " - $" + $("#price-range").slider("values", 1));
        });


        $('#sortBy').on('change', function () {

            var inputValue = $(this).val();
            var seg1 = "<?php echo $this->uri->segment( 1 ) ?>";

            if (seg1 == 'trip-all') {
                window.location.href = "<?= base_url( 'trip-all' ); ?>" + "/" + inputValue;
            } else if (seg1 == 'trip-dest') {
                window.location.href = "<?= base_url( 'trip-dest' . '/' . $this->uri->segment( 2 ) ); ?>" + "/" + inputValue;
            } else if (seg1 == 'trip-act') {
                window.location.href = "<?= base_url( 'trip-act' . '/' . $this->uri->segment( 2 ) ); ?>" + "/" + inputValue;
            } else if (seg1 == 'trip-dest-act') {
                window.location.href = "<?= base_url( 'trip-dest-act' . '/' . $this->uri->segment( 2 ) ); ?>" + "/" + "<?= $this->uri->segment( 3 ) ?>" + "/" + inputValue;
            }

        });
    });
</script>


<div class="content-central">
    <div class="content_info">
        <div class="grid-elements-container">
            <div class="grid-elements">
	            <?php
	            if(isset($destination_data) || isset($activity_data)) {
	                if(isset($destination_data)) {
		                $top_detail_data = $destination_data;
		                $title = $top_detail_data['destination'];
		                $folder = 'destination';
                    } else {
	                    $top_detail_data = $activity_data;
	                    $title =  $top_detail_data['activity'];
	                    $folder = 'activity';
                    } ?>
                    <div class="top-detail-banner">
                        <?php
                        $alt_tag = $top_detail_data['banner_image_alt'] != '' ? $top_detail_data['banner_image_alt'] : $title;
                        php_thumb_image( './images/'.$folder.'/', $top_detail_data['banner_image'], 1920, 720, true, '', "alt='".$alt_tag."' title='" . $title . "'" )
                        ?>
                        <h1><?= $title ?></h1>
                    </div>
		            <?php
		            $crumbs = [
			            'Home' => base_url(),
			            ucwords($folder) => base_url($folder),
			            $title => ''
		            ];
		            $this->load->view('frontend/include/breadcrumbs', array('crumbs' => $crumbs));
		            ?>
                    <div class="container">
	                    <?= $top_detail_data['description'] ?>
                    </div>
	            <?php } ?>
	            <?php
                if(!isset($top_detail_data)) {
	                $crumbs = [
		                'Home' => base_url(),
		                'All Trips' => base_url('trips')
	                ];
	                echo '<div class="height"></div>';
	                $this->load->view('frontend/include/breadcrumbs', array('crumbs' => $crumbs));
                }
	            ?>
                <div class="container">
                    <div class="filter-section list-filter">
                        <div class="row">
                            <div class="filter-inner">
                                <form action="<?php echo site_url( 'trips/search' ) ?>" method="get">

                                    <div class="col-md-2 col-sm-6">
                                        <h4>Filter By:</h4>
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <select name="destinations" id="destination">
                                            <option value="">-- destination --</option>
											<?php $destinations = $this->common_model->get_all( 'tbl_destinations' ); ?>
											<?php foreach ( $destinations as $d ) { ?>
                                                <option onchange="" <?php if ( ( ( $this->uri->segment( 2 ) ) == $d['slug'] ) ) {
													echo "selected";
												} ?> value="<?php echo $d['slug'] ?>">
													<?php echo $d['destination'] ?>
                                                </option>
											<?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <select name="activities" id="activity">
                                            <option value=""> -- activities --</option>
											<?php $activities = $this->common_model->get_all( 'tbl_activities' ); ?>
											<?php foreach ( $activities as $d ) { ?>
                                                <option onchange="" <?php if ( ( ( $this->uri->segment( 2 ) ) == $d['slug'] ) || ( ( $this->uri->segment( 3 ) ) == $d['slug'] ) ) {
													echo "selected";
												} ?> value="<?php echo $d['slug'] ?>">
													<?php echo $d['activity'] ?>
                                                </option>
											<?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <div class="range">
                                            <p>
                                                <label>Duration :</label>
                                                <input type="text" id="durationR" readonly>
                                            </p>
                                            <div id="duration-range"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <div class="range">
                                            <p>
                                                <label>Price :</label>
                                                <input type="text" id="amountR" readonly>
                                            </p>
                                            <div id="price-range"></div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 col-sm-6" style="margin-top: -8px;margin-bottom: 10px;">
                            <select class="form-control" id="sortBy">

                                <option value="">--- Sort By ---</option>
                                <option onchange="" <?php if ( ( ( $this->uri->segment( 2 ) ) == 'name-asc' ) || ( ( $this->uri->segment( 3 ) ) == 'name-asc' ) || ( ( $this->uri->segment( 4 ) ) == 'name-asc' ) ) {
									echo "selected";
								} ?> value="name-asc" data-order="asc">Name Ascending
                                </option>
                                <option onchange="" <?php if ( ( ( $this->uri->segment( 2 ) ) == 'name-desc' ) || ( ( $this->uri->segment( 3 ) ) == 'name-desc' ) || ( ( $this->uri->segment( 4 ) ) == 'name-desc' ) ) {
									echo "selected";
								} ?> value="name-desc" data-order="desc">Name Descending
                                </option>
                                <option onchange="" <?php if ( ( ( $this->uri->segment( 2 ) ) == 'price-asc' ) || ( ( $this->uri->segment( 3 ) ) == 'price-asc' ) || ( ( $this->uri->segment( 4 ) ) == 'price-asc' ) ) {
									echo "selected";
								} ?> value="price-asc" data-order="asc">Price Ascending
                                </option>
                                <option onchange="" <?php if ( ( ( $this->uri->segment( 2 ) ) == 'price-desc' ) || ( ( $this->uri->segment( 3 ) ) == 'price-desc' ) || ( ( $this->uri->segment( 4 ) ) == 'price-desc' ) ) {
									echo "selected";
								} ?> value="price-desc" data-order="desc">Price Descending
                                </option>
                                <option onchange="" <?php if ( ( ( $this->uri->segment( 2 ) ) == 'duration-max' ) || ( ( $this->uri->segment( 3 ) ) == 'duration-max' ) || ( ( $this->uri->segment( 4 ) ) == 'duration-max' ) ) {
									echo "selected";
								} ?> value="duration-max" data-order="asc">Duration max
                                </option>
                                <option onchange="" <?php if ( ( ( $this->uri->segment( 2 ) ) == 'duration-min' ) || ( ( $this->uri->segment( 3 ) ) == 'duration-min' ) || ( ( $this->uri->segment( 4 ) ) == 'duration-min' ) ) {
									echo "selected";
								} ?> value="duration-min" data-order="desc">Duration Min
                                </option>

                            </select>
                        </div>
                    </div>

                    <div class="row">

						<?php
						if ( $trip ) {
							foreach ( $trip as $d ) { ?>

                                <div class="col-xs-12 col-sm-6 col-md-4 tripDiv">
                                    <div class="item">

										<?php $this->load->view('frontend/include/package_box', array('trip' => $d)) ?>

                                    </div>
                                </div>


							<?php } ?>

                            <div class="loding">

                                <div class="loader" style="align-items: center;float: right;margin-right: 48%;">

                                </div>

                            </div>


                            <div class="clearfix"></div>

						<?php } else { ?>

                            <div class="col-md-12">

                                <div class="alert alert-info no-trips">

                                    Sorry! No trips found in this category. <a
                                            href="<?php echo base_url( 'trip-all' ) ?>">Click

                                        here</a> to view all our available trips.

                                </div>

                            </div>

						<?php } ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url( 'assets/frontend' ) ?>/js/jquery.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {

//    alert('hhh');

        var wd = window.screen.availWidth;

//    alert(wd);

        var c = 0;
        var size = $(".tripDiv").length;
        $('.loding').show();
        $(".tripDiv").slice(0, 6).show();
        c = c + 4;

//    window.screen.availWidth


        if (wd < 400) {

            var nearToBottom = 1900;
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >
                    $(document).height() - nearToBottom) {

                    $('.loding').hide();
                    $(".tripDiv:hidden").slice(0, 2).slideDown();
                    $(".tripDiv").slice(0, 6).show();
                    c = c + 2;
                    if ($(".tripDiv:hidden").length == 0) {
                        $(".load").fadeOut('slow');
                    }
                }
            });


        } else {

            var nearToBottom = 600;
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >
                    $(document).height() - nearToBottom) {

                    $('.loding').hide();
                    $(".tripDiv:hidden").slice(0, 2).slideDown();
                    $(".tripDiv").slice(0, 6).show();
                    c = c + 2;
                    if ($(".tripDiv:hidden").length == 0) {
                        $(".load").fadeOut('slow');
                    }
                }
            });

        }


    });
</script> 
