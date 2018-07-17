<div class="widget">
    <h4>Recent post</h4>
    <ul class="recent_post">
        <?php $news = $this->common_model->get_all('tbl_news', '', 'date desc');
        foreach($news as $n) { ?>
        <li>
            <i class="fa fa-calendar fa-fw"></i> <?php echo date('d M Y', $n['date']) ?>
            <div>
                <a href="<?php echo base_url('blog/'.$n['slug']) ?>">
                    <?php echo substr(strip_tags($n['desc']), 0, strpos(strip_tags($n['desc']), ' ', 70)) ?>
                </a>
            </div>
        </li>
        <hr style="margin-top: 5px"/>
        <?php } ?>
    </ul>
</div>