<?php $new = $this->common_model->get_where('tbl_trips', array('is_new' => 1, 'status' => 1), '', 3); ?>

<section id="new-trips" style="border-bottom: none">

    <div class="container">

        <div class="row">

            <h1 class="text-center"><strong>NEW TRIPS</strong></h1>

            <hr class="hr-underline"/>

            <?php foreach($new as $n) :
	            $desti = $this->common_model->getWhere('tbl_destinations', array('id' => $n['dest_id']));
	            $act_id = $this->common_model->get_where( 'tbl_trip_activity', array( 'trip_id' => $n['id'] ), '', 1 );
	            $acty   = $this->common_model->getWhere( 'tbl_activities', array( 'id' => $act_id[0]['act_id'] ) );
	            $activity = $this->common_model->getWhere( 'tbl_activities', array( 'id' => $n['primary_activity_id'] ? $n['primary_activity_id'] : $act_id[0]['act_id'] ) );
			    $trip_url = base_url($activity->slug . '/' . $n['slug']);
			    //$trip_url = base_url($desti->slug . '/' . $activity->slug . '/' . $n['slug']);
                ?>

                <div class="col-lg-4 col-md-4 col-sm-6">

                    <div class="package-wrap">

                        <div class="package-thumb">
                            <a href="<?= $trip_url ?>" class="bdex-btn">View</a>

                            <?php $is_discount = $this->common_model->get_where('tbl_trip_discount', array('trip_id' => $n['id']));

                            if($is_discount) { $discount = $is_discount[0]['discount'];?>

                                <div class="special">

                                    Save <?php echo $is_discount[0]['discount'] ?>%

                                </div>
                                

                            <?php } else { $discount = 0;} ?>

                            <a href="<?php echo $trip_url ?>">

                                <?php

                                $img = $this->common_model->get_where('tbl_trip_slider', array('trip_id' => $n['id']), '', 1);

                                $img = $img ? $img : array(array('image' => ''));
                                $alt_tag = $img[0]['alt'] != '' ? $img[0]['alt'] : $n['name'];

                                php_thumb_image('./images/trip/', $img[0]['image'], 335, 250, true, '', "alt='".$alt_tag."' title='" . $n['name'] . "'" )

                                ?>


                            </a>


                        </div>



                        <div class="package-detail">

                            <div class="content"><a href="<?php echo $trip_url ?>"><?php echo $n['name'] ?></a>
                                 <p>
                                    <?php echo substr(strip_tags($n['overview']), 0, 120) ?>....
                                </p>

                                <p >
                                    <a href="<?php echo $trip_url ?>" class="btn-transparent">View <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach ?>

        </div>

    </div>

</section>

