

<section id="banner">
<div id="slider">

        <?php $data = $this->common_model->get_all('tbl_banners');
        foreach ($data as $d) : ?>
        <div class="item">
            <?php php_thumb_image('./images/banner/', $d['filename'], 1375, 550, true, '') ?>
            <div class="slider-caption">
                <?php if($d['title'] != '')  { ?>
                    <div class="caption-header">
                        <h3><?php echo $d['title'] ?></h3>
                    </div>
                <?php } ?>
               
            </div>
            <div class="banner-content detail">
                <p>hello testing <span>Admin</span></p>
            </div>

        </div>
        <?php endforeach ?>
        
</div>
<div class="treak-detail-title">
                <h3>Everest View Trekking</h3>
        </div>
</section>
