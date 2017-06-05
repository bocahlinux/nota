<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8" />
		<title><?php echo $this->config->item('nama_aplikasi');?></title>
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo.png" type="image/x-icon" />

        <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/bootstrap/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/dist/css/skins/_all-skins.min.css">
        <!-- ==================================================================================================== -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/plugins/morris/morris.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/plugins/daterangepicker/daterangepicker-bs3.css">

				<link rel="stylesheet" href="<?php echo base_url();?>assets/griter/css/jquery.gritter.css" />
        <!-- ==================================================================================================== -->
        <!-- ===================================================================================================== -->
        <script src="<?php echo base_url();?>assets/admin_lte/raphael-min.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/plugins/morris/morris.min.js"></script>
        <!-- ===================================================================================================== -->
        <!-- jQuery 2.1.4
        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
        -->


        <script src="<?php echo base_url();?>assets/admin_lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/bootstrap/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url();?>assets/admin_lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/plugins/fastclick/fastclick.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/dist/js/app.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/jquery-ui.min.js"></script>
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="<?php echo base_url();?>assets/admin_lte/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/plugins/knob/jquery.knob.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/dist/js/demo.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url();?>assets/admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	</head>

    <body class="hold-transition skin-blue fixed sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="#" class="logo">
                    <span class="logo-mini"><b>B</b>L</span>
                    <span class="logo-lg"><b><?php echo $setting->judul_app;?></b></span>
                </a>

                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                  <img src="<?php echo base_url();?>assets/admin_lte/dist/img/avatar5.png" class="user-image" alt="User Image">
                                  <span class="hidden-xs">Beliang Net</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo base_url();?>assets/admin_lte/dist/img/avatar5.png" class="img-circle" alt="User Image">
                                        <p>
                                          Beliang Net
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Settings</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="header">MAIN MENU</li>
                        <?php $this->view('v_menu');?>
                    </ul>
                </section>
            </aside>

            <div class="content-wrapper" style="padding-bottom:20px">
                <section class="content-header">
                    <h1>
                        Aplikasi Nota <small><?php echo $setting->judul_app; ?></small>
                    </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url();?>">
                                    <i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li>
                            <li class="active"><?php echo $judul;?></li>
                            <li class="active"><?php echo $sub_judul;?></li>
                        </ol>
                </section>
                <?php $this->load->view($content);?>
            </div><!-- /.content-wrapper -->

            <nav class="navbar navbar-default navbar-fixed-bottom main-footer skin-red">

                <div class="pull-right hidden-xs">
                    Copyright Aplication &copy; by <b>BocahLinux</b>
                </div>
                <strong>
                    Copyright Themes &copy; 2014-2015
                    <a target="_blank" href="http://almsaeedstudio.com">Almsaeed Studio</a>.
                </strong> All rights reserved.
			</nav>
        </div>
				<script src="<?php echo base_url(); ?>assets/admin_lte/dist/js/pages/dashboard.js"></script>

				<script src="<?php echo base_url();?>assets/griter/js/jquery.gritter.js"></script>
				
    </body>
</html>
