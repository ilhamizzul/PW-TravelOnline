<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Travel Online</title>

    <!-- CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/kendo-ui/styles/kendo.common.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/kendo-ui/styles/kendo.rtl.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/kendo-ui/styles/kendo.default.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/kendo-ui/styles/kendo.default.mobile.min.css">

    <!-- JS -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/vendor/kendo-ui/js/kendo.all.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/kendo-ui/js/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/knockout.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/knockout.mapping-latest.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/knockout.mapping-latest.debug.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/lodash.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/knockout-kendo.min.js"></script>

    <!-- SWAL -->
    <script src="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.min.css">

    <!-- MOMENT -->
    <script src="<?php echo base_url(); ?>assets/vendor/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/moment/moment.min.js"></script>

    <!-- inputmask -->
    <script src="<?php echo base_url(); ?>assets/vendor/inputmask/inputmask.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/inputmask/inputmask.regex.extensions.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/inputmask/inputmask.numeric.extensions.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/inputmask/jquery.inputmask.js"></script>

    <script src="<?php echo base_url(); ?>assets/dist/js/common.js"></script>
    
</head>

<body>

    <script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>'
        var ci_level = '<?php echo $this->session->userdata('LEVEL'); ?>';
        var ci_travel = '<?php echo $this->session->userdata('ID_TRAVEL'); ?>';
        var model ={
            Processing : ko.observable(false),
            IdTravel : ko.observable(ci_travel),
            Role : ko.observable(ci_level)
        }
    </script>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/admin_dashboard">Travel<b>Online</b></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <?php 
                            if ($this->session->userdata('logged_in') == TRUE){
                                echo '
                                    <li><a href="#"><i class="fa fa-user fa-fw"></i> Welcome,'.$this->session->userdata('USERNAME_ADMIN').'</a>
                                    </li> 
                                ';
                            }; 
                        ?>
                            
                        
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>index.php/admin_auth/Logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin_dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-database fa-fw"></i> Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin_master_daerah">Daerah</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin_master_jenis_mobil">Jenis Mobil</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin_master_pelanggan">Pelanggan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-car fa-fw"></i> Travel<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php 
                                    if ($this->session->userdata('LEVEL') == 'ADMIN') {
                                 ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin_travel_agen">Agen Travel</a>
                                </li>
                                <?php 
                                    }
                                 ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin_mobil_travel">Mobil Travel</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin_jadwal_travel">Jadwal Travel</a>
                                </li>
                                <?php 
                                    if ($this->session->userdata('LEVEL') == 'OWNER' || $this->session->userdata('LEVEL') == 'OPERATOR') {
                                 ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin_travel_detail_desa">Detail Desa Travel</a>
                                </li>
                                <?php
                                    } 
                                 ?>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin_transaksi"><i class="fa fa-usd fa-fw"></i> Transaksi</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Administrasi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php 
                                    if ($this->session->userdata('LEVEL') == 'ADMIN') {
                                 ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin_data_pemilik">Data Pemilik</a>
                                </li>
                                <?php 
                                    }
                                 ?>
                                 <?php 
                                    if ($this->session->userdata('LEVEL') == 'ADMIN' || $this->session->userdata('LEVEL') == 'OWNER') {
                                 ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin_data_operator">Data Operator</a>
                                </li>
                                <?php 
                                    }
                                 ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/account_setting">Account Setting</a>
                                </li>
                                <?php 
                                    if ($this->session->userdata('LEVEL') == 'OWNER') {
                                 ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/travel_setting">Travel Setting</a>
                                </li>
                                <?php 
                                    } 
                                ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <!-- Contain Begin -->
            <?php 
                $this->load->view($main_view);
            ?>
            <!-- Contain End -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script type="text/javascript">
        ko.applyBindings(model);
    </script>

</body>
</html>
