<section id="banner">
    <div id="slider">
        <?php $data = $this->common_model->get_all('tbl_banners');
        foreach ($data as $d) : ?>
        <div class="item">
            <?php
            $alt = $d['alt'] != '' ? $d['alt'] : $d['title'];
            php_thumb_image('./images/banner/', $d['filename'], 2125, 750, true, '', 'alt="' . $alt . '" title="' . $d['title'] . '"') ?>
            <div class="banner-content">
                <p><?php echo $d['title'] ?> <span>Admin</span></p>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <?php $this->load->view('frontend/include/search') ?>
</section>