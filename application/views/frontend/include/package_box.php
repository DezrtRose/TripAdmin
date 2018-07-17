<div class="package-wrap">
    <div class="package-thumb">
		<?php
        $desti = $this->common_model->getWhere( 'tbl_destinations', array( 'id' => $trip['dest_id'] ) );
		$act_id = $this->common_model->get_where( 'tbl_trip_activity', array( 'trip_id' => isset($trip['trip_id']) ? $trip['trip_id'] : $trip['id'] ), '', 1 );
		$acty   = $this->common_model->getWhere( 'tbl_activities', array( 'id' => $act_id[0]['act_id'] ) );
		$activity = $this->common_model->getWhere( 'tbl_activities', array( 'id' => $trip['primary_activity_id'] ? $trip['primary_activity_id'] : $act_id[0]['act_id'] ) );
		$trip_url = base_url($activity->slug . '/' . $trip['slug']);
		//$trip_url = base_url($desti->slug . '/' . $activity->slug . '/' . $trip['slug']);
        ?>
        <div class="place"><p><?= $desti->destination ?></p></div>
        <div class="destination-desc hidden-sm hidden-xs">

            <p>
				<?php echo substr( strip_tags( $trip['overview'] ), 0, 150 ) ?>...
            </p>
        </div>
        <a href="<?php echo $trip_url ?>">
			<?php
			$trip_id = isset($trip['trip_id']) ? $trip['trip_id'] : $trip['id'];
			$img = $this->common_model->get_where( 'tbl_trip_slider', array( 'trip_id' => $trip_id ), '', 1 );
			$img = $img ? $img : array( array( 'image' => '' ) );
			$alt_tag = $img[0]['alt'] != '' ? $img[0]['alt'] : $trip['name'];
			php_thumb_image( './images/trip/', $img[0]['image'], 335, 250, true, '', "alt=\"".$alt_tag."\" title=\"" . $trip['name'] . "\"" )
			?>
        </a>
    </div>

    <div class="package-detail">
        <div class="content">
            <a href="<?php echo $trip_url ?>"><?php echo $trip['name'] ?></a>
            <h6>Activities:</h6>
            <div class="colours-tags" style="height: 54px;">
				<?php echo '<button type="button" class="btn mb-xs btn-xs category-Trekking">' . $acty->activity . '</button>'; ?>
            </div>

            <div class="priceOuter">
                <span class="priceFromLabel">From:</span>
                <br>
                <span class="priceCurrencySymbol"></span>

				<?php
				$trp       = $this->common_model->getWhere( 'tbl_trips', array( 'slug' => $trip['slug'] ) );
				$disc      = $this->common_model->getWhere( 'tbl_trip_discount', array( 'trip_id' => $trp->id ) );
				if ( $disc != null ) {
					$finalRate = round( $trp->cost - $disc->discount );
					echo "<span style='color: #BE191F!important;font-size: 20px;text-decoration: line-through;'>$".$trip['cost']." USD</span><br>";
					echo '<span class="priceAmount">$' . $finalRate . '</span>&nbsp;';

				} else {
					echo '<span class="priceAmount">$' . $trip['cost'] . '</span>&nbsp;';
				}
				?>

                <span class="priceCurrencyCode">USD</span>
            </div>

            <div class="ratecircle1">
                <h6>Duration:</h6>
                <p><?php preg_match_all('!\d+!', $trip['duration'], $matches);echo $matches[0][0] ?><span>Days</span></p>
            </div>

            <div class="ratecircle2">
                <h6>Grading:</h6>
                <div class="rating-number">
					<?php
					$trp = $this->common_model->getWhere( 'tbl_trips', array( 'slug' => $trip['slug'] ) );
					if ( ( $trp->grade ) == 'beginner' ) {
						echo '1';
						$svg_pattern = '80 20';
					} elseif ( ( $trp->grade ) == 'easy' ) {
						echo '2';
						$svg_pattern = '60 40';
					} elseif ( ( $trp->grade ) == 'moderate' ) {
						echo '3';
						$svg_pattern = '40 60';
					} elseif ( ( $trp->grade ) == 'difficult' ) {
						echo '4';
						$svg_pattern = '20 80';
					} elseif ( ( $trp->grade ) == 'advance' ) {
						echo '5';
						$svg_pattern = '0 100';
					}
					?>
                </div>
                <svg width="100%" height="100%" viewBox="0 0 42 42" class="donut">
                    <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="#fff"></circle>
                    <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#4DB53C" stroke-width="6"></circle>
                    <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#CCC" stroke-width="6" stroke-dasharray="<?= $svg_pattern ?>" stroke-dashoffset="25"></circle>
                </svg>
            </div>

            <div class="ratecircle3">
                <p>
					<?php
					$trp = $this->common_model->getWhere( 'tbl_trips', array( 'slug' => $trip['slug'] ) );
					echo $trp->grade;
					?>
                </p>
            </div>
            <form method="post" action="<?php echo $trip_url ?>">
                <button class="btn-block green-btn">View Trip <i class="fa fa-chevron-circle-right"
                                                                 aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="bottom"><a href="<?= base_url('trips/' . $trip['slug'] . '#review') ?>"><?= get_review_count($trip_id) ?> Review(s)</a></div>
    </div>
</div>