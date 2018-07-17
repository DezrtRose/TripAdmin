<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container">
    <div class="inner-page-bg" style="margin-left: 30px; margin-right: 30px;">
        <h2 class="book-heading">&nbsp;</h2>
        <form method="post" action="<?php echo base_url( 'trips/booking/' . segment( 3 ) ); ?>"
              class="form-theme booking-form forms" style="margin-top: 130px;">
            <div class="row">
				<?php if ( validation_errors() ) {
					echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
				} ?>
                <h2>Your Personal details</h2>

                <div class="form-group">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="First Name" required="required">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"
                               required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Phone number"
                               required="required">
                    </div>
                    <div class="col-md-6">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email"
                               required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <input type="text" id="emergency" name="emergency" placeholder="Emergency Contact"
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="age" id="age" class="form-control" placeholder="Age"
                               required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <select class="form-control" required="required" name="country" id="country">
                            <option value="" selected>Select your country</option>
							<?php
							$country = $this->common_model->get_all( 'countries', '', 'country_name asc' );
							foreach ( $country as $c ) {
								?>
                                <option value="<?php echo $c['country_name'] ?>">
									<?php echo $c['country_name'] ?>
                                </option>
							<?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" required="required" name="gender" id="gender">
                            <option value="" selected>Select your gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <input type="text" name="passport" id="passport" class="form-control" required="required"
                               placeholder="Passport Number">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="issue" id="issue" class="form-control" placeholder="Issue Place">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <input type="text" name="issue_date" id="issue_date" class="form-control"
                               placeholder="Issue Date" required="required">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="exp_date" id="exp_date" placeholder="Expiration Date"
                               class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <textarea id="mailing_address" name="mailing_address" class="form-control"
                                  placeholder="Mailing Address"></textarea>
                    </div>
                    <div class="col-md-6">
                        <textarea id="special_request" name="special_request" class="form-control"
                                  placeholder="Special Request"></textarea>
                    </div>
                </div>
            </div>
            <h2 class="book-heading mt_10">Trip details</h2>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <select class="form-control" name="trip" id="trip" required="required">
                            <option value="" selected>Select your trip</option>
							<?php $trips = $this->common_model->get_all( 'tbl_trips' );
							foreach ( $trips as $t ) {
								?>
                                <option
                                        value="<?php echo $t['name'] ?>" <?php echo ( segment( 3 ) == $t['slug'] ) ? 'selected' : '' ?>>
									<?php echo $t['name'] ?>
                                </option>
							<?php } ?>
                        </select>
                    </div>
					<?php if ( ! isset( $_GET['departure'] ) ) { ?>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="date" name="date"
                                   placeholder="Preferred start date" required="required">
                        </div>
					<?php } else { ?>
                        <input type="hidden" value="<?php echo $_GET['departure'] ?>" name="departure_id">
					<?php } ?>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <input type="text" name="pax" id="pax" class="form-control" required="required"
                               placeholder="Number of People">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <input type="radio" name="insurance" value="yes"> I have full insurance coverage
                        <input type="radio" name="insurance" value="no" checked> I will provide later
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="g-recaptcha" data-sitekey="6LdbG0sUAAAAAL1NiCXOLTr3Kym-C27P8cMds2TR"></div>
                    </div>
                </div>

                <div class="form-group booking-form-btn" style="margin-bottom: 15px;">
                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        <input type="submit" value="Submit" onclick="ok()" class="bdex-btn"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div><!-- End Container -->
</div><!-- End Inner Page -->