<h1>Our Team</h1>
<ul class="media-list">
	<?php if($members) { foreach ( $members as $key => $member ) { ?>
        <li class="media our-team">
			<?php if ( $key % 2 == 0 ) { ?>
                <div class="media-left">
                    <img class="media-object img-rounded"
                         src="<?= php_thumb_image( './images/team/', $member['image'], 200, 200, true, '', '', true ) ?>"/>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?= $member['name'] ?></h4>
                    <div class="text-muted"><?= $member['position'] ?></div>
                    <div class="team-description"><?= $member['description'] ?></div>
                </div>
			<?php } else { ?>
                <div class="media-body">
                    <h4 class="media-heading"><?= $member['name'] ?></h4>
                    <div class="text-muted"><?= $member['position'] ?></div>
                    <div class="team-description"><?= $member['description'] ?></div>
                </div>
                <div class="media-right">
                    <img class="media-object img-rounded"
                         src="<?= php_thumb_image( './images/team/', $member['image'], 200, 200, true, '', '', true ) ?>"/>
                </div>
			<?php } ?>
        </li>
	<?php } } ?>
</ul>
