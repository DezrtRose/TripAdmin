<div class="trip-sidebar">

    <div class="items box-ribbon">

        <div class="rectangle">

            <h4>Destination</h4>

        </div>


        <ul class="nav-links">

            <?php $destination = $this->common_model->get_all('tbl_destinations', '', 'id desc');

            foreach($destination as $a) { ?>

                <li>

                    <a href="<?php echo base_url('destinations/'.$a['slug']) ?>">

                        <?php echo $a['destination'] ?>

                    </a>

                    <span class="badge bg-green"><?php echo count_trips('dest_id', $a['id']) ?></span>

                </li>

            <?php } ?>

        </ul>

    </div>



    <div class="items box-ribbon">

        <div class="rectangle">

            <h4>Activity</h4>

        </div>

        <div class="triangle-l"></div>

        <div class="triangle-r"></div>

        <br class="clearfix">

        <ul class="nav-links">

            <?php $activity = $this->common_model->get_all('tbl_activities', '', 'id desc');

            foreach($activity as $a) { ?>

                <li>

                    <a href="<?php echo base_url('activities/'.$a['slug']) ?>">

                        <?php echo $a['activity'] ?>

                    </a>

                    <span class="badge bg-green"><?php echo count_trips('act_id', $a['id']) ?></span>

                </li>

            <?php } ?>

        </ul>

    </div>

</div>

