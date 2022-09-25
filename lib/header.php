<!DOCTYPE html>
<html>
    
<!-- Mirrored from coderthemes.com/adminto/dark_menu/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Aug 2018 11:26:01 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $cfg_desc; ?>.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo $cfg_baseurl; ?>aas.png">

        <title><?php echo $cfg_webname; ?></title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="<?php echo $cfg_baseurl; ?>lib/assets/plugins/morris/morris.css">

        <!-- App css -->
        <link href="<?php echo $cfg_baseurl; ?>lib/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>lib/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>lib/assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>staff.css" type="text/css" />

        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/modernizr.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/modernizr.min.js"></script>
    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="<?php echo $cfg_baseurl; ?>" class="logo"><span>FAQ<span>CINE</span></span><i class="mdi mdi-layers"></i></a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">

                        <!-- Page title -->
                        <ul class="nav navbar-nav list-inline navbar-left">
                            <li class="list-inline-item">
                                <button class="button-menu-mobile open-left">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                            <li class="list-inline-item">
                                <h4 class="page-title">Rajawali Code</h4>
                            </li>
                        </ul>

                        <nav class="navbar-custom">

                            <ul class="list-unstyled topbar-right-menu float-right mb-0">

                                <li class="hide-phone">
                                    <form class="app-search">
                                        <input type="text" placeholder="Search..."
                                               class="form-control">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </li>

                            </ul>
                        </nav>
                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        <div class="user-img">
                            <img src="<?php echo $cfg_baseurl; ?>lib/assets/images/users/users-1.jpeg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                            <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                        </div>
                        <h5><a href="#"><?php echo $_SESSION['username']; ?></a> </h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="<?php echo $cfg_baseurl; ?>settings.php" >
                                    <i class="mdi mdi-settings"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="<?php echo $cfg_baseurl; ?>logout.php" class="text-custom">
                                    <i class="mdi mdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        	<li class="text-muted menu-title">Navigation</li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>" class="waves-effect"><i class="fa fa-home"></i> <span> Dashboard </span> </a>
                            </li>
<?php
							if (isset($_SESSION[ 'user'])) {
							?>
                            
<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i><span> Akun </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
									<li><a href="<?php echo $cfg_baseurl; ?>settings.php">Pengaturan</a>
									</li>
									<li><a href="<?php echo $cfg_baseurl; ?>logout.php">Keluar</a>
									</li>
								</ul>
							</li>
<li>
                                <a href="<?php echo $cfg_baseurl; ?>tickets.php" class="waves-effect"><i class="fa fa-flag"></i> <span> Tiket Bantuan </span> </a>
                            </li>
							<?php
							if ($data_user[ 'level'] != "Member" ) {
							?>
							<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-align-justify"></i> <span> Staff Admin fitur</span> <span class="menu-arrow"></span></a>
              <ul class="list-unstyled">
											    <li><a href="<?php echo $cfg_baseurl; ?>staff/add_member.php">Tambah Member</a></li>
                                                <li>
										<a href="<?php echo $cfg_baseurl; ?>admin/users.php">Kelola Penggunaan</a>
									</li>
                                    <li><a href="<?php echo $cfg_baseurl; ?>admin/news.php">Kelola Berita</a></li>
                                    <li><a href="<?php echo $cfg_baseurl; ?>admin/tickets.php">Kelola Ticket</a></li>

                                    </ul>
						<?php
							}
							?>
							<?php
							if ($data_user[ 'level'] == "Developers") {
							?>
						<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user-tie"></i> <span> Developer Fitur </span> <span class="menu-arrow"></span></a>
              <ul class="list-unstyled">
									<li>
										<a href="<?php echo $cfg_baseurl; ?>admin/users.php">Kelola Penggunaan</a>
									</li>
									
									<li><a href="<?php echo $cfg_baseurl; ?>admin/news.php">Kelola Berita</a></li>
									<li><a href="<?php echo $cfg_baseurl; ?>admin/staff.php">Kelola Staff</a></li>
										<li><a href="<?php echo $cfg_baseurl; ?>admin/tickets.php">Kelola Ticket</a></li>
										<li><a href="<?php echo $cfg_baseurl; ?>admin/aktifitas.php">Kelolah Aktifitas</a></li>
								</ul>
							</li>
							<?php
							}
							?>
					

										<?php
							} else {
							?>
							<li>
                                <a href="<?php echo $cfg_baseurl; ?>index.php" class="waves-effect"><i class="fa fa-sign-in-alt"></i> <span> Masuk </span> </a>
                            </li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>daftar.php" class="waves-effect"><i class="fa fa-user-plus"></i> <span> Daftar </span> </a>
                            </li>
										<?php
							}
							?>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>dev.php" class="waves-effect"><i class="fa fa-phone"></i> <span> Kontak Developer </span> </a>
                            </li>

										
											
										<li>
                                <a href="<?php echo $cfg_baseurl; ?>terms.php" class="waves-effect"><i class="fa fa-info icon"></i> <span> Ketentuan </span> </a>
                            </li>
          </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">