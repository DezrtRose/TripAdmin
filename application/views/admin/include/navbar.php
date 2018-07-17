<?php
$session = $this->session->all_userdata();
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
                <p>Hello, <?php echo ucfirst( $session['username'] ); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php echo ( segment( 2 ) == 'dashboard' || segment( 2 ) == '' ) ? 'active' : '' ?>">
                <a href="<?php echo base_url( 'admin/dashboard' ) ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?php echo ( segment( 2 ) == 'content' || segment(2) == 'team' ) ? 'active' : '' ?>">
                <a href="javascript:;">
                    <i class="fa fa-file"></i>
                    <span>Content Manager</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ( segment( 3 ) == 'pages' || segment( 3 ) == 'add-update' ) ? 'active' : '' ?>">
                        <a href="<?php echo base_url( 'admin/content/pages' ) ?>"><i
                                    class="fa fa-angle-double-right"></i> Page Manager</a></li>
                    <li class="<?php echo ( segment( 3 ) == 'banners' || segment( 3 ) == 'add-update-banner' ) ? 'active' : '' ?>">
                        <a href="<?php echo base_url( 'admin/content/banners' ) ?>"><i
                                    class="fa fa-angle-double-right"></i> Banner Manager</a></li>
                    <li class="<?php echo ( segment( 2 ) == 'team' ) ? 'active' : '' ?>">
                        <a href="<?php echo base_url( 'admin/team' ) ?>"><i
                                    class="fa fa-angle-double-right"></i> Team Manager</a></li>

                </ul>
            </li>
            <li class="treeview <?php echo ( in_array( segment( 2 ), array(
				'tripmenu',
				'trip',
				'destination',
				'activity',
				'tripslider',
                'review',
                'departure'
			) ) ) ? 'active' : '' ?>">
                <a href="javascript:;">
                    <i class="fa fa-plane"></i>
                    <span>Trip Manager</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ( segment( 2 ) == 'trip' ) ? 'active' : '' ?>"><a
                                href="<?php echo base_url( 'admin/trip' ) ?>"><i class="fa fa-angle-double-right"></i>
                            Trips</a></li>
                    <li class="<?php echo ( segment( 2 ) == 'destination' ) ? 'active' : '' ?>"><a
                                href="<?php echo base_url( 'admin/destination' ) ?>"><i
                                    class="fa fa-angle-double-right"></i> Destinations</a></li>
                    <li class="<?php echo ( segment( 2 ) == 'activity' ) ? 'active' : '' ?>"><a
                                href="<?php echo base_url( 'admin/activity' ) ?>"><i
                                    class="fa fa-angle-double-right"></i> Activities</a></li>
                    <li class="<?php echo ( segment( 2 ) == 'discount' ) ? 'active' : '' ?>"><a
                                href="<?php echo base_url( 'admin/discount' ) ?>"><i
                                    class="fa fa-angle-double-right"></i> Trip Discount</a></li>
                    <li class="<?php echo ( segment( 2 ) == 'review' ) ? 'active' : '' ?>"><a
                                href="<?php echo base_url( 'admin/review' ) ?>"><i class="fa fa-angle-double-right"></i>
                            Trip Reviews</a></li>
                    <li class="<?php echo ( segment( 2 ) == 'departure' ) ? 'active' : '' ?>"><a
                                href="<?php echo base_url( 'admin/departure' ) ?>"><i
                                    class="fa fa-angle-double-right"></i> Trip Departure Dates</a></li>

                </ul>
            </li>
            <li class="<?php echo ( segment( 2 ) == 'news' ) ? 'active' : '' ?>">
                <a href="<?php echo base_url( 'admin/news' ) ?>">
                    <i class="fa fa-globe"></i> <span>Blogs</span>
                </a>
            </li>
            <li class="<?php echo ( segment( 2 ) == 'subscriber' ) ? 'active' : '' ?>">
                <a href="<?php echo base_url( 'admin/subscriber' ) ?>">
                    <i class="fa fa-rss-square"></i> <span>Subscribers</span>
                </a>
            </li>

            <li class="<?php echo ( segment( 2 ) == 'seo' ) ? 'active' : '' ?>">
                <a href="<?php echo base_url( 'admin/seo' ) ?>">
                    <i class="fa fa-google"></i> <span>Website Configuration</span>
                </a>
            </li>

            <li class="<?php echo ( segment( 2 ) == 'redirections' ) ? 'active' : '' ?>">
                <a href="<?php echo base_url( 'admin/redirections' ) ?>">
                    <i class="fa fa-link"></i> <span>Redirections Manager</span>
                </a>
            </li>

            <li class="<?php echo ( segment( 2 ) == 'config' ) ? 'active' : '' ?>">
                <a href="<?php echo base_url( 'admin/config' ) ?>">
                    <i class="fa fa-cogs"></i> <span>Admin User Manager</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>