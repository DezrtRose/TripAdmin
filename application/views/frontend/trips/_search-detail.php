<div class="search-form-detail">

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