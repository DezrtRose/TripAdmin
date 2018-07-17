<?php $this->load->view( 'frontend/include/banner' ) ?>
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1 class="mainheading">Why Travel with Us</h1>
                    <div class="clearfix"></div>
					<?php $whyUsList = $this->common_model->get_all( 'tbl_why_us', '', 'id ASC' ); ?>
					<?php if ( isset( $whyUsList ) ) { ?>
                        <ul class="tick">
							<?php foreach ( $whyUsList as $whyus ) { ?>
                                <li>
                                    <h4><?= $whyus['why_us_title'] ?></h4>
	                                <?= $whyus['why_us_description'] ?>
                                </li>
							<?php } ?>
                        </ul>
					<?php } ?>
                </div>
                <div class="col-lg-5">
                    <div id="TA_selfserveprop566" class="TA_selfserveprop">
                        <ul id="sEDY0h4FIx" class="TA_links znM6L4DhDZG">
                            <li id="PhFkYbVBS" class="L7uo3kdPgDvM">
                                <a target="_blank" href="https://www.tripadvisor.com/"><img
                                            src="https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png"
                                            alt="TripAdvisor"/></a>
                            </li>
                        </ul>
                    </div>
                    <script async
                            src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=566&amp;locationId=6000673&amp;lang=en_US&amp;rating=true&amp;nreviews=4&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=true&amp;border=true&amp;display_version=2"></script>
                </div>
            </div>
            <div class="row">
                <div class="well well-sm text-center" style="margin-top: 20px">
                    <div class="tick-mark"></div>
                    <h1 style="display: inline">Free Cancellation on Most of Our Trips</h1>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view( 'frontend/include/_top_deals' ) ?>
<?php $this->load->view( 'frontend/include/_most_popular' ) ?>
<?php $this->load->view( 'frontend/include/_new_trips' ) ?>