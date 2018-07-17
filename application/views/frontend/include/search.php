<div class="search-form">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading main-heading" role="tab" id="headingOne">
                <h4 class="panel-title main-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#banner-filter" aria-expanded="true">
                        ADVENTURE FINDER
                        <span class="sub-title">Find your dream adventure</span>
                    </a>
                </h4>
            </div>
            <div id="banner-filter" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading second-heading" role="tab" id="headingOne1">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#banner-destination" aria-expanded="true">
                                        Destination
                                    </a>
                                </h4>
                            </div>
                            <div id="banner-destination" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne1">
                                <div class="panel-body">
                                    <ul>
                                    <?php
                                    $destination = $this->common_model->get_all('tbl_destinations');
                                    foreach($destination as $d) {
                                        echo "<li data-destid='{$d['id']}' class='dest-select'>{$d['destination']}</li>";
                                    } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading second-heading" role="tab" id="headingOne2">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#banner-activity" aria-expanded="true">
                                        Activities
                                    </a>
                                </h4>
                            </div>
                            <div id="banner-activity" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne2">
                                <div class="panel-body">
                                    <ul>
		                                <?php
		                                $activity = $this->common_model->get_all('tbl_activities');
		                                foreach($activity as $a) {
			                                echo "<li data-actid='{$a['id']}' class='act-select'>{$a['activity']}</li>";
		                                } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading second-heading" role="tab" id="headingOne3">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#banner-price" aria-expanded="true">
                                        Price Range
                                    </a>
                                </h4>
                            </div>
                            <div id="banner-price" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne3">
                                <div class="panel-body">
                                    <ul>
                                        <li data-price="100.500" class="price-select">$100 - $500</li>
                                        <li data-price="500.1000" class="price-select">$500 - $1000</li>
                                        <li data-price="1000.1500" class="price-select">$1000 - $1500</li>
                                        <li data-price="2000" class="price-select">$2000 and above</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading second-heading" role="tab" id="headingOne4">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#banner-duration" aria-expanded="true">
                                        Duration
                                    </a>
                                </h4>
                            </div>
                            <div id="banner-duration" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne4">
                                <div class="panel-body">
                                    <ul>
                                        <li data-duration="1.5" class="duration-select">1 - 5 Day(s)</li>
                                        <li data-duration="5.10" class="duration-select">5 - 10 Day(s)</li>
                                        <li data-duration="10.20" class="duration-select">10 - 20 Day(s)</li>
                                        <li data-duration="20.40" class="duration-select">20 - 40 Day(s)</li>
                                        <li data-duration="40" class="duration-select">40 days and above</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 15px">
                        <input type="hidden" id="filter-dest-ids"/>
                        <input type="hidden" id="filter-act-ids"/>
                        <input type="hidden" id="filter-prices"/>
                        <input type="hidden" id="filter-durations"/>
                        <button class="banner-filter-btn btn btn-block">Find a Trip <i class="fa fa-chevron-circle-right fa-fw"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php /*
<div class="search-form">

    <div class="container-fluid">
        <form action="<?php echo base_url('search') ?>" method="get">

            <div class="search-boxes">

                <div class="form-group">

                    <select name="dest" class="form-control">

                        <option value="">Destination</option>

                        <?php

                        $destination = $this->common_model->get_all('tbl_destinations');

                        foreach($destination as $d) {

                            ?>

                            <option value="<?php echo $d['slug'] ?>">

                                <?php echo $d['destination'] ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

            </div>

            <div class="search-boxes">

                <div class="form-group">

                    <select name="act" class="form-control">

                        <option value="">Activity</option>

                        <?php

                        $activity = $this->common_model->get_all('tbl_activities');

                        foreach($activity as $d) {

                            ?>

                            <option value="<?php echo $d['slug'] ?>">

                                <?php echo $d['activity'] ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

            </div>

            <div class="search-boxes">

                <div class="form-group">

                    <select name="price" class="form-control">

                        <option value="">Price Range</option>

                        <option value="100,500">$100-$500</option>

                        <option value="500,1000">$500-$1000</option>

                        <option value="1000,1500">$1000-$1500</option>

                        <option value="1500,2000">$1500-$2000</option>

                        <option value="2000,above">$2000-above</option>

                    </select>

                </div>

            </div>

            <div class="search-boxes">

                <div class="form-group">

                    <select name="duration" class="form-control">

                        <option value="">Duration</option>

                        <option value="1,5">1-5 Day(s)</option>

                        <option value="5,10">5-10 Day(s)</option>

                        <option value="10,20">10-20 Day(s)</option>

                        <option value="20,40">20-40 Day(s)</option>

                        <option value="40,above">40 Day(s)-above</option>

                    </select>

                </div>

            </div>

            <div class="search-boxes">

                <button type="submit" class="bdex-btn">

                    <i class="fa fa-search"></i> Search

                </button>

            </div>

            <div class="clearfix"></div>



        </form>

    </div>

</div>
 */ ?>