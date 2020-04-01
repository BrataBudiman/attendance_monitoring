<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?php echo base_url('images/aimanage.ico') ?>">
    <title> AIMANAGE</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">

    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">

                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $this->session->userdata('username'); ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title"><?php $this->session->userdata('level'); ?></div>
                            <a href="<?php echo base_url()?>users/edit_profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo base_url('logout'); ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <?php
            $uri1 = $this->uri->segment(1);
            $uri2 = $this->uri->segment(2);
            ?>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                    <img src="<?php echo base_url('images/AIMANAGE.png') ?>" alt="AiManage" style="width:70%;height:auto;">
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                    <img src="<?php echo base_url('images/aimanage.ico') ?>" alt="AiManage" style="width:70%;height:auto;">
                    </div>
                    <ul class="sidebar-menu">
                        <li class="<?php echo ($uri1 == 'home' || $uri1 == '') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('home'); ?>"><i class="fas fa-home"></i> <span>Home</span></a></li>
                        <li class="menu-header">Starter</li>
                        <li class="dropdown <?php echo ($uri1 == 'users') ?  'active' : ''; ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>Master Data</span></a>
                            <ul class="dropdown-menu">
                                <li class="<?php echo ($uri1 == 'users') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('users'); ?>">Data Users</a></li>
                            </ul>
                        </li>
                        <li class="dropdown <?php echo ($uri1 == 'databases') ?  'active' : ''; ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Database Monitoring</span></a>
                            <ul class="dropdown-menu">
                                <li class="<?php echo ($uri1 == 'databases') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('databases'); ?>">Employees</a></li>
                            </ul>
                            <!-- <ul class="dropdown-menu">
                                <li class="<?php echo ($uri1 == 'devices') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('devices'); ?>">Devices</a></li>
                            </ul> -->
                            <!-- <ul class="dropdown-menu">
                                <li class="<?php echo ($uri1 == 'databases') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('databases/getViewAtts'); ?>">Database Attendances</a></li>
                            </ul> -->
                        </li>
                        <li class="<?php echo ($uri1 == 'devices') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('devices'); ?>"><i class="fas fa-desktop"></i> <span>Device Monitoring</span></a></li>
                        <li class="<?php echo ($uri1 == 'attendances') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('attendances'); ?>"><i class="fas fa-code"></i> <span>Attendance Logs</span></a></li>
                        <li class="dropdown <?php echo ($uri1 == 'transfers') ?  'active' : ''; ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-upload"></i> <span>Transfer Logs</span></a>
                            <ul class="dropdown-menu">
                                <li class="<?php echo ($uri1 == 'transfers') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('transfers'); ?>">File Logs</a></li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li class="<?php echo ($uri1 == 'transfers') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('transfers/data_logs'); ?>">Data Logs</a></li>
                            </ul>
                        </li>
                        <li class="dropdown <?php echo ($uri1 == 'settings') ?  'active' : ''; ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wrench"></i> <span>Settings</span></a>
                            <ul class="dropdown-menu">
                                <li class="<?php echo ($uri1 == 'settings') ?  'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('settings/connection'); ?>">Connection</a></li>
                            </ul>
                        </li>


                    </ul>

                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?php $this->load->view($content); ?>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                AIMANAGE Attendance Interface Application v.0.1.Beta1912
                </div>
                <div class="footer-right">
                    Provide by &copy; PT. Asia Sekuriti Indonesia, 2019 
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>

    <!-- JS Libraies -->
    <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/page/forms-advanced-forms.js"></script>

    <!-- Template JS File -->
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

</body>

</html>