
<!-- <?php $trip = $trip[0]; ?>

<h1><?php echo $trip['name'] ?></h1>



<hr> -->



<!-- <?php

$trip_img = $this->common_model->get_where('tbl_trip_slider', array('trip_id' => $trip['id']));

if($trip_img){

    ?>

    <ul class="trip-slider">

        <?php foreach($trip_img as $i) { ?>

            <li style="left: 0">

                <img src="<?php echo base_url('images/trip/'.$i['image']) ?>" width="800" height="370">

                <div class="slider-caption">

                    <?php if($i['title'] != '')  { ?>

                    

                    <?php } ?>

                </div>

            </li>

        <?php } ?>

    </ul>

<?php } ?> -->



<!-- <div class="row trip-btn">

    <div class="col-md-12 text-center">

       

        <a href="<?php echo base_url('trips/booking/'.$trip['slug']) ?>" class="bdex-btn"><i class="icon icon-bookmark"></i> Book Now</a>

        <a href="<?php echo base_url('print/'.$trip['slug']) ?>" class="bdex-btn"><i class="icon icon-print-1"></i> Print Trip Info</a>

       

    </div>

</div> -->



<div role="tabpanel" class="tab-detail">



    <!-- Nav tabs -->

    <ul class="nav nav-tabs tabs" role="tablist">

        <li role="presentation" class="active">

            <a href="#overview" class="bdex-btn" aria-controls="overview" role="tab" data-toggle="tab">Overview</a>

        </li>

        <li role="presentation">

            <a href="#itinerary" class="bdex-btn" aria-controls="itinerary" role="tab" data-toggle="tab">Itinerary</a>

        </li>

        <li role="presentation">

            <a href="#departure" class="bdex-btn" aria-controls="departure" role="tab" data-toggle="tab">Departure</a>

        </li>

        <li role="presentation">

            <a href="#cost_inc" class="bdex-btn" aria-controls="cost_inc" role="tab" data-toggle="tab">Trip Includes</a>

        </li>

        <li role="presentation">

            <a href="#cost_ex" class="bdex-btn" aria-controls="cost_ex" role="tab" data-toggle="tab">Trip Excludes</a>

        </li>

        <li role="presentation">

            <a href="#notes" class="bdex-btn" aria-controls="notes" role="tab" data-toggle="tab">Tour Notes</a>

        </li>

    </ul>



    <!-- Tab panes -->

    <div class="tab-content">

        <div role="tabpanel" class="tab-pane fade in active" id="overview">

            <?php echo $trip['overview'] ?>

        </div>

        <div role="tabpanel" class="tab-pane fade" id="itinerary">

            <?php echo $trip['itinerary'] ?>

        </div>

        <div role="tabpanel" class="tab-pane fade" id="departure">

            <?php echo $trip['departure'] ?>

        </div>

        <div role="tabpanel" class="tab-pane fade included" id="cost_inc">

            <?php echo $trip['cost_inc'] ?>

        </div>

        <div role="tabpanel" class="tab-pane fade excluded" id="cost_ex">

            <?php echo $trip['cost_ex'] ?>

        </div>

        <div role="tabpanel" class="tab-pane fade" id="notes">

            <?php echo $trip['notes'] ?>

        </div>

    </div>



</div>