<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/kendo-ui/js/pako.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/home_history.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/history_page.css">

<div class="container">
    <div class="col-md-12 history-box">
        <div class="col-md-12">
            <center>
                <h2>History Transaksi</h2>
            </center>
        </div>
        <dir class="row">
            <div class="col-md-12">
                <div id="gridTransaksi"></div>
            </div>
        </dir>
    </div>
</div>

<!-- Modal -->
<div id="ModalTiket" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Output Tiket</h4>
            </div> -->
            <div class="modal-body" id="pagePdf" data-bind="with: history">
                <div class="" data-bind="with: dataTiket">
                    <!-- HEDAR -->
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo base_url(); ?>assets/img/TravelOnlineLogo.png" class="img-responsive" width="75%">
                        </div>
                        <div class="col-md-6">
                            <center>
                                <h2>Travel Online</h2>
                                <!-- <h5>Since: 2018</h5> -->
                                <a href="<?php echo base_url(); ?>index.php ?>">www.TravelOnline.com</a><br>
                                <span data-bind="text: moment(new Date()).format('dddd, DD-MMM-YYYY HH:mm')"></span>
                            </center>
                        </div>
                        <div class="col-md-3">
                            <center>
                                <br>
                                <h4>TicketIssue</h4>
                                <h5>#<span data-bind="text: ID_RIWAYAT_TRANSAKSI"></span></h5>
                            </center>
                        </div>
                    </div>
                    <hr>
                    <!-- BODY -->
                    <div class="row">
                        <table class="col-md-12">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small>Nama Pemesan</small>
                                                <br>
                                                <label><?php echo $this->session->userdata('NAMA_MEMBER'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small>Travel</small>
                                                <br>
                                                <label data-bind="text: NAMA_TRAVEL"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small>qty:total</small>
                                                <br>
                                                <label data-bind="text:FULL"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small>Asal</small>
                                                <br>
                                                <label data-bind="text: KOTAT_ASAL"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small>Perkiraan Berangkat</small>
                                                <br>
                                                <label data-bind="text: WAKTU_BERANGKAT"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small>Detail Penjemputan</small>
                                                <br>
                                                <label data-bind="text: ALAMAT_PENJEMPUTAN"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small>Tujuan</small>
                                                <br>
                                                <label data-bind="text: KOTA_TUJUAN"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small>Perkiraan Tiba</small>
                                                <br>
                                                <label data-bind="text: WAKTU_SAMPAI"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small>Detail Penurunan</small>
                                                <br>
                                                <label data-bind="text: ALAMAT_PENURUNAN"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <!-- FOOTER -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group pull-right">
                                <center>
                                    <label><u data-bind="text: NAMA_OPERATOR"></u></label><br>
                                    <sup data-bind="text: APPROVAL"></sup><br>
                                    <small>CP: <small data-bind="text: CONTACT"></small></small>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="history.printTiket('#pagePdf')">Print</button>
            </div>
        </div>

    </div>
</div>