<!DOCTYPE html>

<html lang="en">

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    $seo_data = $this->common_model->get_where('seo', array('id' => 1))[0];
    ?>

    <?php if(segment(1) == '') { ?>
        <title><?= $seo_data['title'] ?></title>
        <meta name='description' content='<?= $seo_data['og_description'] ?>' />
        <meta name='keywords' content='<?= $seo_data['keyword'] ?>' />
    <?php } else { ?>
        <title><?php echo isset($metatitle) && $metatitle != '' ? $metatitle : $seo_data['title'] ?></title>
        <meta name="description" content="<?php echo isset($metadescription) ? $metadescription : $seo_data['og_description'] ?>">
        <meta name='keywords' content="<?php echo isset($metakeyword) ? $metakeyword : $seo_data['keyword'] ?>" />
    <?php } ?>
    <meta property="fb:app_id" content="918639144973940" />
    <meta property="og:title" content="<?= isset($metatitle) ? $metatitle : $seo_data['og_title'] ?>" />
    <meta property="og:type" content="<?= $seo_data['og_type'] ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:site_name" content="<?= $seo_data['og_site_name'] ?>" />
    <meta property="og:image" content="<?= isset($og_image) ? $og_image : base_url('images/seo/' . $seo_data['og_image']) ?>" />
    <meta property="og:description" content="<?= isset($metadescription) ? $metadescription : $seo_data['og_description'] ?>" />
    <meta name="IndexType" content="trekking in Nepal,top travel agency in Nepal"/>
    <meta name="language" content="EN-US"/>
    <meta name="type" content="Everest Base Camp Trekking"/>
    <meta name="classification" content="Trekking, Tour operator in Nepal"/>
    <meta name="company" content="Black Diamond Expedition"/>
    <meta name="author" content="Black Diamond Expedition"/>
    <meta name="contact person" content="Black Diamond Expedition"/>
    <meta name="copyright" content="Black Diamond Expedition, Trekking/tour operator"/>
    <meta name="security" content="public"/>
    <meta content="all" name="robots"/>
    <meta name="document-type" content="Public"/>
    <meta name="category" content="Trekking in Nepal"/>
    <meta name="robots" content="all,index"/>
    <meta name="googlebot" content="INDEX, FOLLOW" />
    <meta name="YahooSeeker" content="INDEX, FOLLOW" />
    <meta name="msnbot" content="INDEX, FOLLOW" />
    <meta name="allow-search" content="Yes" />
    <meta name="doc-rights" content="Black Diamond Expedition Pvt. Ltd." />
    <meta name="doc-publisher" content="www.blackdiamondexpedition.com" />
    <meta name="p:domain_verify" content="3333479887ee6833060688c041983305"/>
    <?php if(isset($canonical_url) && $canonical_url != '') { ?>
        <link rel="canonical" href="<?= $canonical_url ?>" />
    <?php } ?>
    <!-- Mobile Specific Metas -->
    
    <link href="<?php echo base_url() ?>images/fav-icon.png" rel="shortcut icon" type="image/x-icon" />

    <style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Raleway:400,500,700');
</style>


    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.smartmenus.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bxslider/jquery.bxslider.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>owl-carousel/owl.transitions.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/paginate.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/responsive.css">

    <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin-assets/js/jquery.validate.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/bxslider/jquery.bxslider.min.js"></script>
    <script src="<?php echo base_url() ?>fancybox/jquery.fancybox.js"></script>
    <script src="<?php echo base_url() ?>owl-carousel/owl.carousel.js"></script>
    <script src="<?php echo base_url() ?>assets/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.paginate.js"></script>
    <script src="<?php echo base_url() ?>assets/js/paginate.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.smartmenus.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.smartmenus.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/isotope.pkgd.min.js"></script>

    <script>

        $(document).ready(function () {

            $("#slider").owlCarousel({
                pagination: true,
                paginationNumbers: false,
                navigation: false, // Show next and prev buttons
                singleItem: true,
                autoPlay: 9000
            });

            $(".trip-slider").owlCarousel({
                navigation: false, // Show next and prev buttons
                singleItem: true,
                autoPlay: 9000
            });

            $("#testimonials").owlCarousel({
                navigation: false, // Show next and prev buttons
                singleItem: true,
                autoPlay: false,
                pagination: true,
                autoHeight: true,
                transitionStyle : "fade"

            });

            $('#top-deals').owlCarousel({
                items : 3,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3],
                navigation: true,
                navigationText: ['<i class="fa fa-fw fa-chevron-left"></i>', '<i class="fa fa-fw fa-chevron-right"></i>']
            });

            $(".gallery-img").fancybox({
                'transitionIn'	:	'fade',
                'transitionOut'	:	'fade',
                'speedIn'		:	600,
                'speedOut'		:	200,
                'overlayShow'	:	true
            });

            $(".trip-map").fancybox({
                'transitionIn'	:	'fade',
                'transitionOut'	:	'fade',
                'speedIn'		:	600,
                'speedOut'		:	200,
                'overlayShow'	:	true
            });

            $('.forms').validate();
            $('.add-datepicker').datepicker();

            // init Isotope
            var $container = $('.isotope').isotope({
                itemSelector: '.page',
                layoutMode: 'fitRows',
                getSortData: {
                    name: '.sort-name',
                    price: '.price parseInt'
                }
            });

            $('.page_link').on('click', function(){
                $container.isotope({
                    sortBy: 'price'
                });
            });

            // bind sort button click
            $('#sorts').on( 'change', function() {
                var inputValue = $(this).val();
                var order = $(this).find(':selected').data('order');
                $container.isotope({
                    sortBy: inputValue,
                    sortAscending: (order == 'asc') ? true : false
                });
            });
        });

    </script>

    <script>
        $(document).ready(function(){
            var divs = $(".titems");
            for(var i = 0; i < divs.length; i+=3) {
                divs.slice(i, i+3).wrapAll("<div class='trip-items'></div>");
            }
        });
    </script>
    
    
    <script>
    $(document).ready(function(){
    		
	var search_url = '<?php echo base_url()."/async-trip-search" ?>';
	$( "#advancedSearch" ).autocomplete({
	      source: search_url,
	      minLength: 1,
	      select: function( event, ui ) {
		var myForm  = this.closest("form");
		setTimeout(function(){ myForm.submit(); }, 0);
	      }
	});
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119462329-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-119462329-1');
</script>
<meta name="google-site-verification" content="oJNH9EapRpuwwvw2fJ2PLqxgkw7OClSpzXexVAaFAkI" />

    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>



<body>

<div class="top-cover">
    <div class="container">
            <div class="row">
                <div class="col-sm-3  col-md-5">
                     <a class="navbar-brand" href="<?php echo base_url() ?>"><img alt="<?= $seo_data['og_site_name'] ?>" title="<?= $seo_data['og_site_name'] ?>" src="<?php echo base_url() ?>images/logo.png"></a>
                </div>

                <div class="col-sm-9  col-md-7">
                    <ul class="world_nav pull-right list-inline">
                            <li><a href="<?= base_url('brochure') ?>">Brochures</a></li>
                            <li><a href="<?php echo base_url('how-to-book') ?>">How to book</a></li>
                            <li><a href="<?php echo base_url('gallery') ?>">Gallery</a></li>
                            <li><a href="<?= base_url('faq') ?>">FAQ</a></li>
                            <li><a href="<?php echo base_url('contact-us') ?>">Contact us</a></li>
                        </ul>
                        <div class="row">
                            <div class="col-md-6 col-lg-7 hidden-xs">
                                <div class="header-search">
                                    
                                    <form class="search-box" action="<?php echo base_url('search') ?>" method="get">
                                        <span><i class="fa fa-search"></i></span>
                                        <input placeholder="Search..." type="text" id="advancedSearch" name="query" value="">

                                        <button type="submit">
                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                        </button>

                                    </form>

                                </div>
                            </div>

                            <div class=" col-md-6 col-lg-5">
                                <div class="contact">
                                    <span class="circle"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <ul class="pull-right">
                                        <li>TALK TO AN EXPERT</li>
                                        <li><h3>
                                            +977-9851205619</h3>
                                        </li>
                                        <li><a href="mailto:info@blackdiamondexpedition.com">or EMAIL US</a></li>
                                    </ul>
                                    </div>
                            </div>
                        </div>

                        
                </div>

                
            </div>
        </div>
</div>
    

    <header>
        <nav class="navbar navbar-default" data-spy="affix" data-offset-top="100">

            <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navigation">

                        <span class="sr-only">Toggle navigation</span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                    </button>

                   

                </div>



                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse" id="main-navigation">

                    <ul class="nav navbar-nav" data-sm-options="{ showTimeout: 50, hideTimeout: 50 }">

                        <li class="dropdown<?php echo (segment(2) == 'destination') ? ' active' : '' ?>">

                            <a href="<?php echo base_url('destinations') ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Destinations <i class="fa fa-chevron-right fa-fw"></i></a>

                            <ul class="dropdown-menu sub-menu" role="menu">

                                <?php
                            $data = $this->common_model->get_all('tbl_destinations', '', 'id asc');
                            foreach($data as $d){ ?>
                            <li>
                                <a href="<?php echo base_url('destinations/'.$d['slug']) ?>">
                                    <?php echo $d['destination'] ?>
                                </a>
                            </li>
                            <?php } ?>
                            </ul>

                        </li>

                        <li class="dropdown<?php echo (segment(2) == 'activities') ? ' active' : '' ?>">

                            <a href="<?php echo base_url('activities') ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Activities <i class="fa fa-chevron-right fa-fw"></i></a>

                            <ul class="dropdown-menu sub-menu">

                                <?php
                            $data = $this->common_model->get_all('tbl_activities', '', 'id asc');
                            foreach($data as $d){ ?>
                                <li>
                                    <a href="<?php echo base_url('activities/'.$d['slug']) ?>">
                                        <?php echo $d['activity'] ?>
                                    </a>
                                </li>
                            <?php } ?>

                            </ul>

                        </li>

                         <li class="dropdown<?php echo (segment(1) == 'charity') ? ' active' : '' ?>">

                            <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url('charity') ?>">Charity <i class="fa fa-chevron-right fa-fw"></i></a>
                             <ul class="dropdown-menu sub-menu">

		                         <?php
		                         $data = $this->common_model->get_where('tbl_pages', array('parent_page' => 9));
		                         foreach($data as $d){ ?>
                                     <li>
                                         <a href="<?php echo base_url($d['slug']) ?>">
					                         <?php echo $d['name'] ?>
                                         </a>
                                     </li>
		                         <?php } ?>

                             </ul>
                        </li>
			
			
                        <li <?php echo (segment(1) == 'reviews') ? 'class="active"' : '' ?>>

                            <a href="<?php echo base_url('reviews') ?>">Reviews</a>

                        </li>

                        <li <?php echo (segment(1) == 'about-us') ? 'class="active dropdown"' : '' ?>>
                            <a href="<?php echo base_url('about-us') ?>">About us <i class="fa fa-chevron-right fa-fw"></i></a>
                            <ul class="dropdown-menu sub-menu">
	                            <?php
	                            $data = $this->common_model->get_where('tbl_pages', array('parent_page' => 7));
	                            foreach($data as $d){ ?>
                                    <li>
                                        <a href="<?php echo base_url($d['slug']) ?>">
				                            <?php echo $d['name'] ?>
                                        </a>
                                    </li>
	                            <?php } ?>
                                <li>
                                    <a href="<?= base_url('our-team') ?>">Our Team</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>

            </div>

        </nav>

    </header>

    <div class="content">

