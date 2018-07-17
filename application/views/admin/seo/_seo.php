<?php
$seo_data = $seo_data[0];
$title = $seo_data['title'];
$keyword = $seo_data['keyword'];
$og_title = $seo_data['og_title'];
$og_type = $seo_data['og_type'];
$og_site_name = $seo_data['og_site_name'];
$og_image = $seo_data['og_image'];
$og_description = $seo_data['og_description'];
$phone2 = $seo_data['phone2'];
$phone1 = $seo_data['phone1'];
$fax = $seo_data['fax'];
$address1 = $seo_data['address1'];
$address2 = $seo_data['address2'];
$email = $seo_data['email'];
$fb_link = $seo_data['fb_link'];
$twitter_link = $seo_data['twitter_link'];
$gp_link = $seo_data['gp_link'];
$linked_link = $seo_data['linked_link'];
$pinterest_link = $seo_data['pinterest_link'];
$insta_link = $seo_data['insta_link'];
$skype_link = $seo_data['skype_link'];
$logo = $seo_data['logo'];
$slogan = $seo_data['slogan'];
?>
<div class="row">
    <div class="col-md-12">
		<?= flash() ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    <a data-toggle="collapse" href="#admin-config">
                        Website Configuration | Update
                    </a>
                </h3>
            </div><!-- /.box-header -->
            <div class="box-body collapse in" id="admin-config">
                <form role="form" class="forms" method="post" action="" enctype="multipart/form-data">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General Information</a></li>
                        <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contacts</a></li>
                        <li role="presentation"><a href="#social" aria-controls="social" role="tab" data-toggle="tab">Social Links</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="general">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <label>Title</label>
                                        <textarea class="form-control" name="title"><?= $title ?></textarea>
                                    </td>
                                    <td>
                                        <label>Keyword</label>
                                        <textarea class="form-control" name="keyword"><?= $keyword ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>OG Title</label>
                                        <textarea class="form-control" name="og_title"><?= $og_title ?></textarea>
                                    </td>
                                    <td>
                                        <label>OG Site Name</label>
                                        <input type="text" class="form-control" name="og_site_name" value="<?= $og_site_name ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>OG Image</label>
                                        <input type="file" class="form-control" name="og_image" value="<?= $og_image ?>"/>
								        <?php if($og_image != '') { ?>
                                            <img src="<?= base_url('images/seo/' . $og_image) ?>" width="30%">
								        <?php } ?>
                                    </td>
                                    <td>
                                        <label>Logo</label>
                                        <input type="file" class="form-control" name="logo"/>
								        <?php if($logo != '') { ?>
                                            <img src="<?= base_url('images/seo/' . $logo) ?>" width="30%">
								        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>OG Type</label>
                                        <input type="text" class="form-control" name="og_type" value="<?= $og_type ?>"/>
                                    </td>
                                    <td>
                                        <label>Slogan</label>
                                        <input type="text" class="form-control" name="slogan" value="<?= $slogan ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label>OG Description</label>
                                        <textarea class="form-control" name="og_description"><?= $og_description ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input class="btn btn-primary" type="submit" value="Save"/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="contact">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <label>Phone 1</label>
                                        <input class="form-control" type="text" name="phone1" placeholder="Phone number" value="<?= $phone1 ?>"/>
                                    </td>
                                    <td>
                                        <label>Phone 2</label>
                                        <input class="form-control" type="text" name="phone2" placeholder="Phone number" value="<?= $phone2 ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>FAX Number</label>
                                        <input class="form-control" type="text" name="fax" placeholder="FAX number" value="<?= $fax ?>"/>
                                    </td>
                                    <td>
                                        <label>Email Address</label>
                                        <input class="form-control" type="text" name="email" placeholder="Email address" value="<?= $email ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Address Line 1</label>
                                        <input class="form-control" type="text" name="address1" placeholder="Address line 1" value="<?= $address1 ?>"/>
                                    </td>
                                    <td>
                                        <label>Address Line 2</label>
                                        <input class="form-control" type="text" name="address2" placeholder="Address line 2" value="<?= $address2 ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input class="btn btn-primary" type="submit" value="Save"/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="social">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <label>Facebook Link</label>
                                        <input class="form-control" type="text" name="fb_link" placeholder="Facebook link" value="<?= $fb_link ?>"/>
                                    </td>
                                    <td>
                                        <label>Twitter Link</label>
                                        <input class="form-control" type="text" name="twitter_link" placeholder="Twitter link" value="<?= $twitter_link ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Google Plus Link</label>
                                        <input class="form-control" type="text" name="gp_link" placeholder="Goole plus link" value="<?= $gp_link ?>"/>
                                    </td>
                                    <td>
                                        <label>Skype Link</label>
                                        <input class="form-control" type="text" name="skype_link" placeholder="Skype link" value="<?= $skype_link ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Linkedin Link</label>
                                        <input class="form-control" type="text" name="linked_link" placeholder="Linkedin link" value="<?= $linked_link ?>"/>
                                    </td>
                                    <td>
                                        <label>Insta Link</label>
                                        <input class="form-control" type="text" name="insta_link" placeholder="Insta link" value="<?= $insta_link ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Pinterest Link</label>
                                        <input class="form-control" type="text" name="pinterest_link" placeholder="Pinterest link" value="<?= $pinterest_link ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input class="btn btn-primary" type="submit" value="Save"/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>