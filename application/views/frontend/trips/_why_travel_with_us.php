

<?php 
$whyUsList = $this->common_model->get_all('tbl_why_us', '', 'id ASC');
?>

<?php if(isset($whyUsList)){ ?>



	    <div id="why" class="why-travel">
                <h4 class="black-title">Why travel with us</h4>
		
		<?php foreach ($whyUsList as $whyus){ ?>
		
                  <div class="template-usp template-heading">
                      <img alt="" src="/portals/0/images/icon-innovative-adventures.png">
                      <h2><?= $whyus['why_us_title'] ?></h2>
                      <div class="bottom-content-desc">
                      <p><?= $whyus['why_us_description'] ?></p>
                      </div>
                      <p><a href="#"><button type="button" class="btn green-empty">More <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button></a></p>
                    </div>
		
		<?php } ?>
		
            </div>

<?php } ?>