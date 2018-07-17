<?php // if(segment(1) != '') $this->load->view('frontend/include/_top_deals'); ?>
</div>


<footer class="footer-js">

    <section class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="footer-top-content">
                        <div class="form-group">
                            <div id="subscriber-msg"></div>
                            <h4>Join our newsletter</h4>
                            <input type="text" placeholder="Enter email" class="btn noEnterSubmit"
                                   id="subscriber-email" name="footerENewsletterEmail">
                            <button class="button2 large green newsletter-green-btn"><i
                                        class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <a href="#" data-toggle="modal" data-target="#ask-expert-modal" class="expert-btn">Ask an expert <i class="fa fa-chevron-circle-right"
                                                                   aria-hidden="true"></i></a>
                </div>

                <div class="col-sm-3">
                    <a href="" class="blog-btn">Visit our blog <i class="fa fa-chevron-circle-right"
                                                                  aria-hidden="true"></i></a>
                </div>

            </div>
        </div>
    </section>
    <div class="modal fade" id="ask-expert-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ask an Expert</h4>
                </div>
                <form id="form-ask-expert" action="<?= base_url('ask-expert') ?>" method="post">
                    <div class="modal-body ask-expert-modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="first_name" placeholder="First name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="last_name" placeholder="Last name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email address"/>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="msg" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LdbG0sUAAAAAL1NiCXOLTr3Kym-C27P8cMds2TR"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-theme footer-ask-expert-btn" data-form_type="modal">Send Message <i
                                        class="fa fa-fw fa-chevron-circle-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-links">
        <div class="container">
            <div class="row">
                <div class="footer">
                    <div class="col-md-3 col-sm-6">
                        <h4><i class="fa fa-chevron-right" aria-hidden="true"></i>Quick Links</h4>
                        <ul>
                            <li>
                                <a href="<?php echo base_url( 'about-us' ) ?>">About Us</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url( 'blog' ) ?>">Blog</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url( 'contact-us' ) ?>">Contact Us</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url( 'terms-conditions' ) ?>">Terms & Conditions</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url( 'privacy-policy' ) ?>">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4><i class="fa fa-chevron-right" aria-hidden="true"></i>Useful Links</h4>
                        <ul>
							<?php
							$footerlinks = $this->common_model->get_where( 'tbl_pages', array( 'is_footer' => 1 ) );
							foreach ( $footerlinks as $fl ) { ?>
                                <li>
                                    <a href="<?php echo base_url( $fl['slug'] ) ?>">
										<?php echo ucwords( strtolower( $fl['name'] ) ) ?>
                                    </a>
                                </li>
							<?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4><i class="fa fa-chevron-right" aria-hidden="true"></i>Quick Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Policies</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4><i class="fa fa-chevron-right" aria-hidden="true"></i> Get social</h4>
                        <ul class="list-inline social-footer">
                            <li><a target="_blank" href="<?= FB_LINK ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?= TWITTER_LINK ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?= INSTA_LINK ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?= GP_LINK ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?= PINTEREST_LINK ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?= LINKED_LINK ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
                        <ul>
                            <li>

                            </li>
                            <li>
                                <ul class="associated">
                                    <li><img alt="associated with logos" title="Associated with" src="<?php echo base_url( 'assets/img/assoc.png' ) ?>"></li>
                                </ul>
                            </li>
                            <li>
                                <h4>We Accept</h4>
                            </li>
                            <li><img alt="supported card types" title="Supported credit cards" src="<?php echo base_url( 'assets/img/cc.png' ) ?>"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center">All Rights Reserved &copy; 2018 <?php echo SITE_NAME ?></div>
                <div class="col-lg-6 text-center">Powered By: <a href="https://thirdeyesystem.com/" target="_blank">Third
                        Eye Systems (P.) Ltd.</a></div>
            </div>
        </div>
    </div>
</footer>
<div class="footer-ask-expert">
    <a href="#" id="ask-expert">Ask an Expert <i class="fa fa-fw fa-chevron-circle-up"></i></a>
</div>
<div class="footer-ask-expert-form">
    <div class="header">
        <h5>Ask an Expert <span id='footer-ask-expert-close'>×</span></h5>
        <div>That's what we are here for...</div>
    </div>
    <div class="body">
        <div>All fields are required.</div>
        <form action="<?= base_url('ask-expert') ?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" placeholder="First name"/>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" placeholder="Last name"/>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email address"/>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="msg" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6LdbG0sUAAAAAL1NiCXOLTr3Kym-C27P8cMds2TR"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-theme footer-ask-expert-btn" data-form_type="stickyfooter">Send Message <i class="fa fa-fw fa-chevron-circle-right"></i></button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.newsletter-green-btn').on('click', function (event) {
            event.preventDefault();
            var email = $('#subscriber-email').val();
            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
            var isEmail = pattern.test(email);

            if (email != '' && isEmail) {
                $.ajax({
                    url: '<?php echo base_url( 'welcome/add_subscriber' ) ?>',
                    data: 'email=' + email,
                    type: 'post',
                    success: function (res) {
                        if (res == 1) {
                            $('#subscriber-msg').html('Thank you for subscribing.');
                        } else if (res == 2) {
                            $('#subscriber-msg').html('Already subscribed.');
                        }
                    }
                })
            } else {
                $('#subscriber-msg').html('Please fill in proper email address.');
            }
        })


    });
    $(".open-button").on("click", function () {
        $(this).closest('.collapse-group').find('.collapse').collapse('show');
    });

    $(".close-button").on("click", function () {
        $(this).closest('.collapse-group').find('.collapse').collapse('hide');
    });

    $(function () {
        $(document).ready(function () {
            $('.dest-select').on('click', function () {
                var that = $(this);
                that.toggleClass('active');
                var dest_id = that.data('destid');
                (that.hasClass('active')) ? set_input_values('filter-dest-ids', dest_id) : remove_input_values('filter-dest-ids', dest_id);
            });
            $('.act-select').on('click', function () {
                var that = $(this);
                that.toggleClass('active');
                var act_id = that.data('actid');
                (that.hasClass('active')) ? set_input_values('filter-act-ids', act_id) : remove_input_values('filter-act-ids', act_id);
            });
            $('.price-select').on('click', function () {
                var that = $(this);
                $('.price-select').removeClass('active');
                that.toggleClass('active');
                var price = that.data('price');
                set_input_values('filter-prices', price, true);
            });
            $('.duration-select').on('click', function () {
                var that = $(this);
                $('.duration-select').removeClass('active');
                that.toggleClass('active');
                var duration = that.data('duration');
                set_input_values('filter-durations', duration, true);
            });

            $('.banner-filter-btn').on('click', function() {
                var destination = $('#filter-dest-ids').val();
                var activity = $('#filter-act-ids').val();
                var price = $('#filter-prices').val();
                var duration = $('#filter-durations').val();
                var url_query = 'dest='+destination+'&act='+activity+'&price='+price+'&duration='+duration;
                var filter_url = '<?= base_url("search?") ?>' + url_query;
                window.location.href = filter_url;
            });
            $('body').scrollspy({ target: '#trip-detail-sidenav' });

            $('#submit-review').on('click', function(e) {
                e.preventDefault();
                var form_data = $('#review-form').serialize();
                var url = $('#review-form').attr('action');
                $.ajax({
                    url: url,
                    data: form_data,
                    type: 'post',
                    success: function(res) {
                        if(res) {
                            res = $.parseJSON(res);
                            if(res.status == 'success') {
                                $('#review-form').remove();
                                $('#write-review .modal-content').append('<div class="modal-body"><p class="review-success">Thank you for your review !!!</p></div>');
                            } else {
                                $('#write-review .modal-body').prepend('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+res.msg+'</div>')
                            }
                        } else {
                            $('#review-form').prepend('<div class="alert alert-danger">Something went wrong. Please try again in a while. Thank you !!!</div>');
                        }
                    }
                })
            })
        });

        function set_input_values(element, data, clear_value) {
            var new_data = data;
            var current_data = $('#' + element).val();
            if (typeof clear_value == 'undefined' && current_data != '') {
                new_data = current_data + ',' + data
            }
            $('#' + element).val(new_data);
        }

        function remove_input_values(element, data) {
            var current_data = $('#' + element).val();
            var exploded_ids = current_data.split(',');
            exploded_ids.splice($.inArray(data.toString(), exploded_ids), 1);
            $('#' + element).val(exploded_ids);
        }
    })

</script>

 <!-- Google Tag Manager -->
 <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-525VKQC"
 height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
 <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
 new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
 j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
 '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
 })(window,document,'script','dataLayer','GTM-525VKQC');</script>
 <!-- End Google Tag Manager -->

<script>
    $('#ask-expert').on('click', function(e) {
        e.preventDefault();
        $('.footer-ask-expert-form').toggle();
        $('.footer-ask-expert').toggle();
    });
    $('body').on('click', '#footer-ask-expert-close', function() {
        $('.footer-ask-expert-form').toggle();
        $('.footer-ask-expert').toggle();
    });
    $('.footer-ask-expert-btn').on('click', function(e) {
        e.preventDefault();
        var form_type = $(this).data('form_type');
        if(form_type == 'stickyfooter') {
            var form_data = $('.footer-ask-expert-form form').serialize();
            var body_html = '.footer-ask-expert-form .body';
        } else {
            var form_data = $('#form-ask-expert').serialize();
            var body_html = '.ask-expert-modal-body';
        }
        $.ajax({
            url: "<?= base_url('ask-expert') ?>",
            type: 'post',
            data: form_data,
            success: function(resp) {
                resp = $.parseJSON(resp);
                var info_class = (resp.status == 'success') ? 'alert-success' : 'alert-danger';
                $(body_html).prepend('<div class="alert '+info_class+' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+resp.msg+'</div>');
            }
        })
    });
    $('#send-to-friend-btn').on('click', function(e) {
        e.preventDefault();
        var form_data = $('#send-friend').serialize();
        $.ajax({
            url: "<?= base_url('send-to-friend') ?>",
            type: 'post',
            data: form_data,
            success: function(resp) {
                resp = $.parseJSON(resp);
                var info_class = (resp.status == 'success') ? 'alert-success' : 'alert-danger';
                $('#send-friend').prepend('<div class="alert '+info_class+' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+resp.msg+'</div>');
            }
        })
    });
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b48503eda9fa38d"></script>
</body>
</html>