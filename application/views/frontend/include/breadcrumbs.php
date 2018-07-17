<div class="breadcrumbs">
    <div class="container">
        <ul>
		    <?php foreach($crumbs as $title => $link) { ?>
                <li>
                    <a href="<?= $link ?>"><?= $title ?></a>
                </li>
		    <?php } ?>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>