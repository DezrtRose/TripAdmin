<div class="trip-sidebar">
    <div class="items box-ribbon">
        <div class="rectangle">
            <h4>Trip Facts</h4>
        </div>
        <ul class="trip-facts">
            <?php if($trip[0]['cost'] != 0) { ?>
                <li class="hightlight-cost">
                    <strong>Cost: </strong>
                    <?php
                    $is_discount = $this->common_model->get_where('tbl_trip_discount', array('trip_id' => $trip[0]['id']));
                    if(!$is_discount) { ?>
                        $<?php echo $trip[0]['cost'] ?> USD
                    <?php } else {
                        $offer_price = round($trip[0]['cost'] - ($trip[0]['cost'] * ($is_discount[0]['discount']/100)), 2);
                        ?>
                        <span style="text-decoration: line-through">$<?php echo $trip[0]['cost'] ?></span>
                        <span class="badge" style="background-color: #E23900; color: #fff">$<?php echo $offer_price ?></span>
                    <?php } ?>
                </li>
            <?php } ?>
            <li>
                <strong>Duration: </strong><?php echo ($trip[0]['duration'] != '') ? $trip[0]['duration']  : 'N/A'?>
            </li>
            <li>
                <strong>Grade: </strong><?php echo ($trip[0]['duration'] != '') ? $trip[0]['grade'] : 'N/A' ?>
            </li>
            <li>
                <strong>Max Altitude: </strong><?php echo ($trip[0]['duration'] != '') ? $trip[0]['max_altitude'].'m' : 'N/A' ?>
            </li>
            <li>
                <strong>Starting Point: </strong><?php echo ($trip[0]['duration'] != '') ? $trip[0]['starting_point'] : 'N/A' ?>
            </li>
            <li>
                <strong>Accommodation: </strong><?php echo ($trip[0]['duration'] != '') ? strip_tags($trip[0]['accommodation']) : 'N/A' ?>
            </li>
            <li>
                <strong>Meals: </strong><?php echo strip_tags($trip[0]['meals']) ?>
            </li>
            <li>
                <strong>Transportation: </strong><?php echo strip_tags($trip[0]['transport']) ?>
            </li>
        </ul>
    </div>

    <div class="items box-ribbon">
        <div class="rectangle">
            <h4>Quick Query</h4>
        </div>
        <div class="triangle-l"></div>
        <div class="triangle-r"></div>
        <br class="clearfix">
        <form class="forms" method="post" action="<?php echo base_url('page/contact') ?>">
            <input type="hidden" value="<?php echo segment(2) ?>" name="trip_code">
            <div class="form-group">
                <input type="text" class="form-control required" id="name" name="first_name" placeholder="Enter First Name">
            </div>
            <div class="form-group">
                <select class="form-control " name="country" id="country">
                    <option value="" selected>Select your country</option>
                    <?php
                    $country = $this->common_model->get_all('countries', '', 'country_name asc');
                    foreach($country as $c) {
                        ?>
                        <option value="<?php echo $c['country_name'] ?>">
                            <?php echo $c['country_name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control required email" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <input type="text" name="phone" id="phone" class="form-control required" placeholder="Enter Phone number">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" style="height: 75px" placeholder="Enter your message"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit" class="bdex-btn"/>
            </div>
        </form>
    </div>

    <?php
    $similar_trips = $this->common_model->get_where_in('tbl_trips', 'id', explode(',', $trip[0]['similar']));
    if($similar_trips) {
        ?>
        <div class="items box-ribbon">
            <div class="rectangle">
                <h4>Similar Trips</h4>
            </div>
            <div class="triangle-l"></div>
            <div class="triangle-r"></div>
            <br class="clearfix">
            <div class="similar-trip">
                <ul class="similar-slider">
                    <?php foreach($similar_trips as $st) {
                        $trip_img = $this->common_model->get_where('tbl_trip_slider', array('trip_id' => $st['id']), '', 1);?>
                        <li>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="<?php echo base_url('trips/'.$st['slug']) ?>">
                                        <?php php_thumb_image('./images/trip/', $trip_img[0]['image'], 80, 80, true, 'class="similar-img"') ?>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <a href="<?php echo base_url('trips/'.$st['slug']) ?>">
                                        <?php echo $st['name'] ?>
                                    </a>
                                    <p>
                                        <?php echo substr(strip_tags($st['overview']), 0, strpos(strip_tags($st['overview']), ' ', (strlen(strip_tags($st['overview']))/30))).'...' ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>