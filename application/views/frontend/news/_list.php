<div class="row">
    <div class="col-md-8 col-sm-6">
        <?php foreach($news as $n) { ?>
            <div class="news-items">
                <h4><?php echo $n['name'] ?></h4>
                <div class="post_info clearfix">
                    <div class="post-left">
                        <ul>
                            <li><i class="fa fa-calendar fa-fw"></i>On <span><?php echo date('d M Y',$n['date']) ?></span></li>
                        </ul>
                    </div>
                </div>
                <p><?php echo substr(strip_tags($n['desc']), 0, strpos(strip_tags($n['desc']), ' ', 250)).'...' ?></p>
                <p>
                    <a class="bdex-btn" href="<?php echo base_url('blog/'.$n['slug']) ?>">
                        Read More
                    </a>
                </p>
                <hr/>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-4 col-sm-6">
        <?php $this->load->view('frontend/include/recent_news') ?>
    </div>
</div>