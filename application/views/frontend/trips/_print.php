<?php $trip = $trip[0] ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <title><?php echo $trip['name'] ?></title>
    <link href="<?php echo base_url() ?>assets/css/print.css" rel="stylesheet">
</head>
<body bgcolor="#FFFFFF">
<div class="wrapper">
    <a id="top-page" href="top-page"></a>
    <div class="header">
        <div class="trip-title">
            <?php echo strtoupper($trip['name']) ?>
        </div>
        <div class="print">
            <a href="#" onclick="window.print()">Print Page</a>
        </div>
    </div>
    <div class="clear"></div>
    <div class="trip-misc">
        <table class="table" border="1">
            <tr>
                <th>
                    Trip Name
                </th>
                <td>
                    <?php echo $trip['name'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Max Altitude
                </th>
                <td>
                    <?php echo $trip['max_altitude'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Grade
                </th>
                <td>
                    <?php echo $trip['grade'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Activity
                </th>
                <td>
                    <?php
                    $act = $this->common_model->get_where('tbl_trip_activity', array('trip_id' => $trip['id']));
                    if($act) {
                        $act = $this->common_model->get_where('tbl_activities', array('id' => $act[0]['act_id']));
                        echo $act[0]['activity'];
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Trip Duration</th>
                <td><?php echo $trip['duration'].' days' ?></td>
            </tr>
            <tr>
                <th>Minimum Group Size</th>
                <td><?php echo $trip['group_size'] ?></td>
            </tr>
            <tr>
                <th>
                    Destination
                </th>
                <td>
                    <?php
                    $dest = $this->common_model->get_where('tbl_destinations', array('id' => $trip['dest_id']));
                    echo $dest[0]['destination'];
                    ?>
                </td>
            </tr>
            <tr>
                <th>Starting Point</th>
                <td><?php echo $trip['starting_point'] ?></td>
            </tr>
            <tr>
                <th>Ending Point</th>
                <td><?php echo $trip['ending_point'] ?></td>
            </tr>
        </table>
        <div class="trip-desc-box">
            <h2 class="trip-title">Overview</h2>
            <p>
                <?php echo $trip['overview'] ?>
            </p>
        </div>
        <div class="trip-desc-box">
            <h2 class="trip-title">Itinerary</h2>
            <p>
                <?php echo $trip['itinerary'] ?>
            </p>
        </div>
        <div class="trip-desc-box">
            <h2 class="trip-title">Cost Includes</h2>
            <p>
                <?php echo $trip['cost_inc'] ?>
            </p>
        </div>
        <div class="trip-desc-box">
            <h2 class="trip-title">Cost Excludes</h2>
            <p>
                <?php echo $trip['cost_ex'] ?>
            </p>
        </div>
        <div class="trip-desc-box">
            <h2 class="trip-title">Accommodation</h2>
            <p>
                <?php echo $trip['accommodation'] ?>
            </p>
        </div>
        <div class="trip-desc-box">
            <h2 class="trip-title">Meals</h2>
            <p>
                <?php echo $trip['meals'] ?>
            </p>
        </div>
    </div>
    <div class="print">
        <a href="#top-page">Goto Top</a> |
        <a href="#" onclick="window.print()">Print Page</a>
    </div>
    <div class="clear"></div>
</div>
</body>
</html>