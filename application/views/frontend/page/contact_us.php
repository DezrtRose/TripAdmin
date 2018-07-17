<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="row">
    <div class="col-md-8">
        <div class="boxes">
            <h1>Contact us</h1>
            <hr>
            <h4>Send us a message</h4>
            <p>
                Please use the form below to contact us. Your inquires are most welcomed.
            </p>
            <?php flash() ?>
	        <?php if(validation_errors()) echo "<div class='alert alert-danger'>" . validation_errors() . "</div>"; ?>
            <div id="message-contact"></div>
            <form class="forms" method="post" action="<?php echo base_url('page/contact') ?>">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="required form-control style_2" value="<?php echo set_value('first_name'); ?>" id="first_name" name="first_name" placeholder="Enter First Name *">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control style_2" value="<?php echo set_value('last_name'); ?>" id="last_name" name="last_name" placeholder="Enter Last Name">
                        </div>
                    </div>
                </div><!-- End row -->
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" id="email" name="email" class="required email form-control style_2" value="<?php echo set_value('email'); ?>" placeholder="Enter Email *">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" id="phone" name="phone" class="form-control style_2" value="<?php echo set_value('phone'); ?>" placeholder="Enter Phone number">
                        </div>
                    </div>
                </div><!-- End row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea rows="5" id="message" name="message" class="required form-control style_2" placeholder="Write your message *" style="height:150px;"><?php echo set_value('message'); ?></textarea>
                        </div>
                    </div>
                </div><!-- End row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LdbG0sUAAAAAL1NiCXOLTr3Kym-C27P8cMds2TR"></div>
                        </div>
                    </div>
                </div><!-- End row -->
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="submit" value="Submit" class="bdex-btn"/>
                        </div>
                    </div>
                </div><!-- End row -->
            </form>
        </div>
    </div><!-- End col-md-9 -->

    <aside class="col-md-4">
        <div class="boxes">
            <h4>Address</h4>
            <p>
                Our head office (Kathmandu, Nepal) open from 9.00 AM up to 6.00 PM.
            </p>
            <p>
                <strong>Thamel Marg, Thamel, Kathmandu</strong>
            </p>
            <ul id="contact-info">

                <hr>
                <li>
                    <i class="fa fa-fw fa-phone"></i>
                <span style="display: inline-table">
                    +977-1-4412922, 01-4418830<br/> 01-4418809
                </span>
                </li>
                <li>
                    <i class="fa fa-fw fa-envelope"></i>
                
                    <a href="#">info@blackdiamondexpedition.com</a>
                
                </li>

                 <li>
                    <i class="fa fa-fw fa-envelope"></i>
                
                    <a href="#">sales@blackdiamondexpedition.com</a>
                
                </li>
                <hr>
            </ul>
        </div>
    </aside><!-- End col-md-3 -->
</div><!-- End row -->