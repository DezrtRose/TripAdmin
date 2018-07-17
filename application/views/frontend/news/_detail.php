<div class="row">
    <div class="col-md-8 col-sm-6 border">
        <h1 class="page-title">
            <?php echo $news[0]['name'] ?>
        </h1>
        <div class="post_info clearfix">
            <div class="post-left">
                <ul>
                    <li><i class="fa fa-calendar fa-fw"></i>On <span><?php echo date('d M Y',$news[0]['date']) ?></span></li>
                </ul>
            </div>
        </div>
        <?php $news[0]['image'] != '' ? php_thumb_image('./images/news/', $news[0]['image'], 650, 250, true, 'class="img-thumbnail"') : '' ?>
        <?php echo $news[0]['desc'] ?>
    </div>
    <div class="col-md-4 col-sm-6">
        <?php $this->load->view('frontend/include/recent_news') ?>
    </div>
</div>

<p>

</p>