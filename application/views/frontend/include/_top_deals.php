<?php
$sql = "select * from `tbl_trips` t
        join `tbl_trip_discount` td on t.`id` = td.`trip_id`
        where t.status = 1";
$occasion_trips = $this->common_model->run_query($sql);
?>
<section id="special-trips" class="top-deals">
    <div class="container">
        <div class="row">
            <h1 class="text-center"><strong>TOP DEALS</strong></h1>
            <div id='top-deals'>
                <?php foreach($occasion_trips as $occasion_trip) : ?>
                    <div class="item">
                        <?php $this->load->view('frontend/include/package_box', array('trip' => $occasion_trip)); ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>