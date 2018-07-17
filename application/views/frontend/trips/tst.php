<?php $this->load->view('frontend/include/header'); ?>

<?php
$sql = "select * from `tbl_trips` t
        join `tbl_trip_discount` td on t.`id` = td.`trip_id`
        where td.`occasion_name` != ''";
$occasion_trips = $this->common_model->run_query($sql);
?>


    <div class="container">
        <div class="row">
            <h1 class="text-center"><strong>TOP DEALS</strong></h1>
            <div id='top-deals'>
                <?php foreach($occasion_trips as $occasion_trip) : ?>
                    <div class="item">
                        <div class="package-wrap">
                            <div class="package-thumb">
                                <!-- <div class="special">
                                    Save <?php echo $occasion_trip['discount'] ?> %
                                </div> -->
                               <!--  <div class="special-reason">
                                    <?php echo $occasion_trip['occasion_name'] ?>
                                </div> -->
			       
			       <?php $desti = $this->common_model->getWhere('tbl_destinations', array('id' => $occasion_trip['dest_id'])); ?>
                               <div class="place"><p><?= $desti->destination ?></p></div>
                               <div class="destination-desc hidden-sm hidden-xs">
                                    
				   <p>
                                   <?php echo substr(strip_tags($occasion_trip['overview']), 0, 150) ?>...
				   </p>
                                </div>
                                <a href="<?php echo base_url('trips/'.$occasion_trip['slug']) ?>">
                                    <?php
                                    $img = $this->common_model->get_where('tbl_trip_slider', array('trip_id' => $occasion_trip['trip_id']), '', 1);
                                    $img = $img ? $img : array(array('image' => ''));
                                    php_thumb_image('./images/trip/', $img[0]['image'], 335, 250, true, '')
                                    ?>
                                </a>
                            </div>
			    
                            <div class="package-detail">
                                <div class="content">
                                    <a href="<?php echo base_url('trips/'.$occasion_trip['slug']) ?>"><?php echo $occasion_trip['name'] ?></a>
                                    <h6>Activities:</h6>
                                    <div class="colours-tags" style="height: 54px;">
					<?php 
					    $desti = $this->common_model->getWhere('tbl_trips', array('slug' => $occasion_trip['slug'])); 
					    $act_id = $this->common_model->get_where('tbl_trip_activity', array('trip_id' => $desti->id),'',1);
					    $acty = $this->common_model->getWhere('tbl_activities', array('id' => $act_id[0]['act_id'])); 

					    echo '<button type="button" class="btn mb-xs btn-xs category-Trekking">'.$acty->activity.'</button><null></null>';
    					?>
				    </div>
				    
                                    <div class="priceOuter">
                                    <span class="priceFromLabel">From:</span>
                                    <br>
                                    <span class="priceCurrencySymbol">$</span>
				    
				    <?php 
					$trp = $this->common_model->getWhere('tbl_trips', array('slug' => $occasion_trip['slug'])); 
					$disc = $this->common_model->getWhere('tbl_trip_discount', array('trip_id' => $trp->id));
					$finalRate = round($trp->cost - ((($trp->cost)*($disc->discount))/100));	
					echo '<span class="priceAmount">'.$finalRate.'</span>&nbsp;';
				    ?>
				    
				    <span class="priceCurrencyCode">AUD</span>
                                    </div>

                                    <div class="ratecircle1">
                                    <h6>Duration:</h6>
                                    <p><?php echo $occasion_trip['duration'] ?><span></span></p>
                                    </div>

                                    <div class="ratecircle2">
					<h6>Grading:</h6>
					<div class="c100 p50 small green">
					    <span>
						
						<?php
						    $trp = $this->common_model->getWhere('tbl_trips', array('slug' => $occasion_trip['slug'])); 
						    if(($trp->grade)=='beginner'){
							echo "1";
						    } elseif (($trp->grade)=='easy') {
							echo "2";
						    } elseif (($trp->grade)=='moderate') {
							echo "3";
						    } elseif (($trp->grade)=='difficult') {
							echo "4";
						    } elseif (($trp->grade)=='advance') {
							echo "5";
						    }
						?>
					    </span>
					    <div class="slice">
						<div class="bar"><null></null>
						</div><div class="fill"><null></null>
						</div>
					    </div>
					</div>
                                    </div>

                                    <div class="ratecircle3">
					<p>
					    <?php
						$trp = $this->common_model->getWhere('tbl_trips', array('slug' => $occasion_trip['slug'])); 
						echo $trp->grade;
					    ?>
					<null></null>
					</p>
				    </div>

				    <form method="post" action="<?php echo base_url('trips/'.$occasion_trip['slug']) ?>">
					<button class="btn-block green-btn">View Trip <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
				    </form>
				    
                                </div>
				
				
                                <div class="bottom"><i class="fa fa-info-circle"></i> Review</div>
                                <!--<div><i class="fa fa-tag"></i> $<?php /*echo $occasion_trip['cost'] */?></div>-->
                                
				<!-- <div class="bottom">
                                    <?php if($occasion_trip['cost'] != 0) { ?>
                                        <?php
                                        if(!isset($occasion_trip['discount']) || $occasion_trip['discount'] == 0) { ?>
                                            <i class="fa fa-tag"></i> $<?php echo $occasion_trip['cost'] ?>
                                        <?php } else {
                                            $offer_price = round($occasion_trip['cost'] - ($occasion_trip['cost'] * ($occasion_trip['discount']/100)), 2);
                                            ?>
                                            <span style="text-decoration: line-through">$<?php echo $occasion_trip['cost'] ?></span>
                                            <span class="">  <i class="fa fa-tag"></i> $<?php echo $offer_price ?></span>
                                        <?php } ?>
                                    <?php } ?>
                                </div> -->
				
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>





<?php $this->load->view('frontend/include/footer'); ?>