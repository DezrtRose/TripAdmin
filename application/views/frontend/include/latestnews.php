<div class="latest-news">
    <h4>LAtest news</h4>
    <?php $news = $this->common_model->get_all('tbl_news', '', '', 2) ?>
    <?php if($news) {
        foreach($news as $n) { ?>
            <div class="news-items">
                <h5><?php echo $n['name'] ?></h5>
                <p>
                    <?php echo substr(strip_tags($n['desc']), 0, strpos(strip_tags($n['desc']), ' ', 100)) ?>
                </p>
                <span class="pull-left">- <?php echo date('d M, Y') ?></span>
                        <span class="pull-right">
                            <a href="<?php echo base_url('news/'.$n['slug']) ?>" class="btn btn-warning btn-sm">read more</a>
                        </span>
                <div class="clearfix"></div>
            </div>
        <?php }
    } ?>
    <p class="pull-right text-right view-news">
        <a href="<?php echo base_url('news') ?>">view all news »</a>
    </p>
</div>
<div class="clearfix"></div>