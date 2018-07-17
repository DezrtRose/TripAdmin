<div class="page-sidebar">
    <div class="row">
        <div class="col-md-6">
            <h4>Testimonials</h4>
        </div>

        <div class="col-md-6 text-right">
            <a href="<?php echo base_url('reviews') ?>">
                View All
            </a>
        </div>
    </div>

    <hr style="margin-top: 0"/>

    <div class="carousel">
        <?php
        $data = $this->common_model->get_where('tbl_testimonial', array('approved' => 1), '', 2);
        foreach($data as $d) {
            ?>
            <div>
                <p>
                    <?php echo $d['desc'] ?>
                </p>
                <div class="text-right">
                    <p>
                        <strong> - <?php echo $d['by'] ?></strong>
                    </p>
                </div>
            </div>
            <hr style="margin-top: 0"/>
        <?php } ?>
    </div>
    <!-- End carousel -->
</div>