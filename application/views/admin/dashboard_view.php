<script src="<?php echo base_url(); ?>assets/main/js/admin_dashboard.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row" data-bind="visible: !model.Processing()">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-usd fa-fw fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><span id="jumlahTransaksi"></span></div>
                        <div>Transaksi</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url() ?>index.php/admin_transaksi">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-car fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><span id="jumlahMobil"></span></div>
                        <div>Mobil</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url() ?>index.php/admin_mobil_travel">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-map fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><span id="jumlahCakupanDaerah"></span></div>
                        <div>Cakupan Daerah</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url() ?>index.php/admin_travel_detail_desa">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><span id="jumlahPelanggan"></span></div>
                        <div>Pelanggan</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url() ?>index.php/admin_master_pelanggan">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="row" data-bind="visible: !model.Processing()">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>Chart Transaksi
            </div>
            <div class="panel-body">
                <div id="ChartTransaksi"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>Chart Revenue
            </div>
            <div class="panel-body">
                <div id="ChartRevenew"></div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($loader); ?>

<?php
    $success = $this->session->flashdata('success');
    if ($success == 'success') {
       echo '
        <script types="text/javascript\">
            $(document).ready(function(){
                swal(
                  "Login Berhasil!",
                  "Selamat Datang, '.$this->session->userdata('USERNAME_ADMIN').'!",
                  "success"
                )
            });
          </script>
       ';
    } 
?> 